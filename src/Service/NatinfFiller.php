<?php


namespace App\Service;

use App\Entity\Natinf;
use Doctrine\ORM\EntityManagerInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Promise;

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
     * @param bool  $returnObjects
     *
     * @return array
     */
    public function fromArray(array $natinfs, bool $returnObjects = false): array {
        $result = [];
        if(0 === count($natinfs)) {
            return $result;
        }

        $client = new Client(['base_uri' => $this->api]);

        $promises = [];

        foreach($natinfs as $codeNatinf) {
            $promises[$codeNatinf] = $client->getAsync("natinfs/".$codeNatinf);
        }

        $responses = Promise\settle($promises)->wait();

        foreach($responses as $key => $natinfResponse) {
            if("fulfilled" === $natinfResponse['state']) {
                $bodyStr = (string)($natinfResponse['value']->getBody());
                $body = json_decode($bodyStr);
                $natinfObj = new Natinf();
                $natinfObj->setNumero($body->natinf)
                    ->setDescription($body->qualificationInfraction)
                    ->setLibelle($body->libelleNataff);

                $exists = $this->em->getRepository('App:Natinf')->findOneBy(['numero' => $natinfObj->getNumero()]);

                if($returnObjects && $exists) {
                    $result[$key] = $exists;
                } else {
                    $this->em->persist($natinfObj);
                    if($returnObjects) {
                        $result[$key] = $natinfObj;
                    }
                }
            } elseif($returnObjects) {

                $natinfObj = new Natinf();
                $natinfObj->setNumero($key);

                $result[$key] = $natinfObj;
            }
        }

        $this->em->flush();

        if($returnObjects) {
            return $result;
        } else {
            return $natinfs;
        }

    }

}