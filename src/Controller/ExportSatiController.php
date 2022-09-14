<?php

namespace App\Controller;

use App\Entity\ControleNavire;
use App\Entity\ActiviteNavire;
use App\Entity\User;
use App\Entity\Rapport;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Templating\EngineInterface;

/**
 * @Route("/sati")
 */
class ExportSatiController extends AbstractController {
    /**
     * @Route("/inspection_mer/{id}",
     *     name="export_sati_inspection_mer",
     *     requirements={"id"="\d+"}
     * )
     * @param EntityManagerInterface $em
     * @param EngineInterface        $twig
     * @param int                    $id
     *
     * @return Response
     */
    public function inspectionMer(EntityManagerInterface $em, EngineInterface $twig, int $id) {
        /** @var User $user */
        $user = $this->getUser();
        $rapport = $em->getRepository(Rapport::class)->findOneBy(["id" => $id, "serviceCreateur" => $user->getService()]);

        if(!$rapport) {
            throw $this->createNotFoundException("Le rapport n'existe pas ou n'est pas accessible pour cet utilisateur");
        }

        $categoriesControle = $em->getRepository(CategorieUsageNavire::class)->findAll();
        $idCatPechePro=null;
        for($i=0;$i < count($categoriesControle);$i++) {
            if(preg_match('/Navire de pêche pro/', $categoriesControle[$i]->getNom())) {
                $idCatPechePro = $categoriesControle[$i]->getId();
                break;
            }
        }

        $export = [];
        foreach($rapport->getActivites() as $activite) {
            if(!$activite || ActiviteNavire::class !== get_class($activite)) {
                continue 1;
            }
            foreach($activite->getControles() as $controleNavire) {
                /** @var ControleNavire $controleNavire */
                if($idCatPechePro === $controleNavire->getNavire()->getCategorieUsageNavire()->getId() &&
                    false === $controleNavire->getTerrestre()) {
                    $export[] = $controleNavire;
                }
            }
        }

        if(0 >= count($export)) {
            return $this->render('export_sati/erreur.html.twig');
        }

        $zip = new \ZipArchive();
        $zipName = "RapportNav-export-sati-R".$rapport->getId().".zip";
        $zip->open($zipName,  \ZipArchive::CREATE);

        foreach($export as $data) {
            /** @var ControleNavire $data */
            $file = $twig->render("export_sati/inspectionNavireMer.json.twig", [
                'rapport' => $rapport,
                'controle' => $data,
                'numOrion' => $rapport->getId().$data->getId(),
                'date' => ($data->getDate()->getTimestamp())*1000,
            ]);
            $zip->addFromString("M1_RAPPORTNAV" . $rapport->getId() . "-" . $data->getId() . ".json",  $file);
        }

        $zip->close();

        $response = new Response(file_get_contents($zipName));
        $response->headers->set('Content-Type', 'application/zip');
        $response->headers->set('Content-Disposition', 'attachment;filename="' . $zipName . '"');
        $response->headers->set('Content-length', filesize($zipName));

        @unlink($zipName);

        return $response;
    }
}
