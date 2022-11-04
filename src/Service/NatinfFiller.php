<?php


namespace App\Service;

use App\Entity\Natinf;
use Doctrine\ORM\EntityManagerInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Pool;

/**
 * Class NatinfFiller request NatInf API with Natinf Number to create the NatInf object then persit it if the Natinf
 * numbers were valid.
 */
class NatinfFiller {

    /**
     * @var array
     */
    private $api;
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em, string $api) {
        $this->api = $api;
        $this->em = $em;
    }

    /**
     * Convert an array of Natinf numbers to an array of Natinf objects
     *
     * @param array $natinfs
     * @param bool  $returnValidObjects
     *
     * @return array
     */
    public function fromArray(array $natinfs, bool $returnValidObjects = false): array {
        $result = [];
        $newNatinfs = [];
        if(0 === count($natinfs)) {
            return $result;
        }

        foreach($natinfs as $natinf) {
            /** @var string $natinf */
            $exists = $this->em->getRepository(Natinf::class)->findOneBy(['numero' => $natinf]);
            if(!$exists) {
                $newNatinfs[] = $natinf;
            } elseif($returnValidObjects) {
                $result[] = $exists;
            }
        }
        if(0 === count($newNatinfs)) {
            return $returnValidObjects ? $result : $natinfs;
        }

        $client = new Client(['base_uri' => $this->api]);

        $requests = function(array $natinfs) use ($client) {
            $uri = 'natinfs/';
            for($i = 0 ; $i < count($natinfs) ; $i++) {
                yield function() use ($client, $uri, $natinfs, $i) {
                    return $client->getAsync($uri.$natinfs[$i]);
                };
            }
        };

        $pool = new Pool($client, $requests($newNatinfs), [
            'concurrency' => 5,
            'fulfilled' => function($response, $index) use ($returnValidObjects, &$result) {
                $bodyStr = (string)($response->getBody());
                $body = json_decode($bodyStr);
                $natinfObj = new Natinf();
                $natinfObj->setNumero($body->natinf)
                    ->setDescription($body->qualificationInfraction)
                    ->setLibelle($body->libelleNataff);
                $this->em->persist($natinfObj);

                if($returnValidObjects) {
                    $result[] = $natinfObj;
                }
            },
        ]);

        $promises = $pool->promise();
        $promises->wait();

        $this->em->flush();

        return $returnValidObjects ? $result : $natinfs;

    }

}
