<?php

namespace App\Service;

use App\Entity\ActiviteAdministratif;
use App\Entity\ActiviteFormation;
use App\Entity\ActiviteNavire;
use App\Entity\CategorieControleNavire;
use App\Entity\ControleAutre;
use App\Entity\ControleEtablissement;
use App\Entity\ControleLoisir;
use App\Entity\ControleNavire;
use App\Entity\ControlePecheurPied;
use App\Entity\ZoneGeographique;
use App\Exception\RapportNotFound;
use App\Repository\RapportRepository;
use PhpOffice\PhpWord\Element\Table;
use PhpOffice\PhpWord\SimpleType\TblWidth;
use PhpOffice\PhpWord\TemplateProcessor;

class ExportService {

    /**
     * @var RapportRepository
     */
    private $rapportRepository;

    public function __construct(RapportRepository $rapportRepository)
    {
        $this->rapportRepository = $rapportRepository;
    }

    public function getDataForExport($id)
    {
        $rapport = $this->rapportRepository->find($id);

        if(!$rapport) {
            throw new RapportNotFound("Le rapport n'a pas été trouvé.");
        }

        $templateProcessor = new TemplateProcessor(dirname(__DIR__) . '/Service/samples/SAMPLE_Rapport_mission_ULAM.docx');

        $templateProcessor->setValues([
            'nomService' => $rapport->getCreatedBy()->getService()->getNom(),
            'numRapport' => $rapport->getId(),
            'dateDebut' => $rapport->getDateDebutMission()->format('d/m/Y'),
            'heureDebut' => $rapport->getDateDebutMission()->format('H:i'),
            'dateFin' => $rapport->getDateFinMission()->format('d/m/Y'),
            'heureFin' => $rapport->getDateFinMission()->format('H:i'),
            'missionArme' => $rapport->getArme() ? 'La mission était armée.' : "La mission n'était pas armée.",
            'controleMer' => $rapport->getRepartitionHeures()->getControleMer() / 60,
            'controleTerre' => $rapport->getRepartitionHeures()->getControleTerre() / 60,
            'controleAerien' => $rapport->getRepartitionHeures()->getControleAerien() / 60,
            'controleAireProtegeeMer' => $rapport->getRepartitionHeures()->getControleAireProtegeeMer() / 60,
            'controleAireProtegeeTerre' => $rapport->getRepartitionHeures()->getControleAireProtegeeTerre() / 60,
            'controleAireProtegeeAerien' => $rapport->getRepartitionHeures()->getControleAireProtegeeAerien() / 60,
            'controlePollutionMer' => $rapport->getRepartitionHeures()->getControlePollutionMer() / 60,
            'controlePollutionTerre' => $rapport->getRepartitionHeures()->getControlePollutionTerre() / 60,
            'controlePollutionAerien' => $rapport->getRepartitionHeures()->getControlePollutionAerien() / 60,
            'controleEnvironnementMer' => $rapport->getRepartitionHeures()->getControleEnvironnementMer() / 60,
            'controleEnvironnementTerre' => $rapport->getRepartitionHeures()->getControleEnvironnementTerre() / 60,
            'controleEnvironnementAerien' => $rapport->getRepartitionHeures()->getControleEnvironnementAerien() / 60,
            'controleChlordeconeTotalMer' => $rapport->getRepartitionHeures()->getControleChlordeconeTotalMer() / 60,
            'controleChlordeconeTotalTerre' => $rapport->getRepartitionHeures()->getControleChlordeconeTotalTerre() / 60,
            'controleChlordeconePartielMer' => $rapport->getRepartitionHeures()->getControleChlordeconePartielMer() / 60,
            'controleChlordeconePartielTerre' => $rapport->getRepartitionHeures()->getControleChlordeconePartielTerre() / 60,
            'controleCroise' => $rapport->getRepartitionHeures()->getControleCroise() / 60,
            'immigration' => $rapport->getRepartitionHeures()->getImmigration() / 60,
            'visiteSecurite' => $rapport->getRepartitionHeures()->getVisiteSecurite() / 60,
            'surveillanceManifestationMer' => $rapport->getRepartitionHeures()->getSurveillanceManifestationMer() / 60,
            'surveillanceManifestationTerre' => $rapport->getRepartitionHeures()->getSurveillanceManifestationTerre() / 60,
            'surveillanceDpmMer' => $rapport->getRepartitionHeures()->getSurveillanceDpmMer() / 60,
            'surveillanceDpmTerre' => $rapport->getRepartitionHeures()->getSurveillanceDpmTerre() / 60,
            'surete' => $rapport->getRepartitionHeures()->getSurete() / 60,
            'maintientOrdre' => $rapport->getRepartitionHeures()->getMaintienOrdre() / 60,
            'assistance' => $rapport->getRepartitionHeures()->getAssistance() / 60,
            'plongee' => $rapport->getRepartitionHeures()->getPlongee() / 60,
            'nombreVisiteSecurite' => $rapport->getRepartitionHeures()->getNombreVisiteSecurite() ?? 0,
            'commentaires' => $rapport->getCommentaire(),
            'missionAvecService' => $rapport->getServiceConjoints()->count() > 0 ? 'La mission était une mission conjointe avec le ou les services suivants : ' : 'La mission n’était pas réalisée avec d’autres services.',
        ]);


        if($rapport->getServiceConjoints()->count() > 0) {
            $tableServicesConjoints = new Table(['borderSize' => 0.5, 'borderColor' => 'black', 'width' => 6000, 'unit' => TblWidth::TWIP]);
            $tableServicesConjoints->addRow();
            $tableServicesConjoints->addCell(900)->addText('Nom du service');
            foreach($rapport->getServiceConjoints() as $serviceConjoint) {
                $tableServicesConjoints->addRow();
                $tableServicesConjoints->addCell(900)->addText($serviceConjoint->getNom());
            }

            $templateProcessor->setComplexBlock('table_services', $tableServicesConjoints);
        } else {
            $templateProcessor->setValue('table_services', ''); // remove macro
        }

        $templateProcessor->setValues([
            'block_services' => '',
            '/block_services' => ''
        ]); // remove macros


        $tableAgents = new Table(['borderSize' => 0.5, 'borderColor' => 'black', 'width' => 6000, 'unit' => TblWidth::TWIP]);
        $tableAgents->addRow();
        $tableAgents->addCell(800)->addText('Nom');
        $tableAgents->addCell(800)->addText('Prénom');
        foreach($rapport->getAgents() as $agent) {
            $tableAgents->addRow();
            $tableAgents->addCell(500)->addText($agent->getNom());
            $tableAgents->addCell(500)->addText($agent->getPrenom());
        }

        $templateProcessor->setComplexBlock('agent_list', $tableAgents);

        $tableMoyens = new Table(['borderSize' => 0.5, 'borderColor' => 'black', 'width' => 100 * 50, 'unit' => TblWidth::PERCENT]);
        $tableMoyens->addRow();
        $tableMoyens->addCell(800)->addText('Nom');
        $tableMoyens->addCell(800)->addText('Nautique / terrestre');
        $tableMoyens->addCell(800)->addText('Km');
        $tableMoyens->addCell(800)->addText('heures moteur');

        foreach($rapport->getMoyens() as $moyen) {
            $tableMoyens->addRow();
            $tableMoyens->addCell(800)->addText($moyen->getMoyen()->getNom());
            $tableMoyens->addCell(800)->addText($moyen->getMoyen()->getTerrestre() ? 'terrestre' :  'nautique');
            $tableMoyens->addCell(800)->addText($moyen->getDistance());
            $tableMoyens->addCell(800)->addText($moyen->getTempsMoteur() / 60);
        }

        $templateProcessor->setComplexBlock('table_moyens', $tableMoyens);

        $tableControleNavire = new Table(['borderSize' => 0.5, 'borderColor' => 'black', 'width' => 100 * 50, 'unit' => TblWidth::PERCENT]);
        $tableControleNavire->addRow();
        $tableControleNavire->addCell(600)->addText('Immatriculation');
        $tableControleNavire->addCell(600)->addText('Informations');
        $tableControleNavire->addCell(600)->addText('Contrôles réalisés');
        $tableControleNavire->addCell(600)->addText('Date/lieu de contrôle');
        $tableControleNavire->addCell(600)->addText('Sanction(s)');
        $tableControleNavire->addCell(600)->addText('Commentaires');
        $commentaireNavire = null;
        $totalControlesNavires = 0;
        $totalCatPecheSanitaire = 0;
        $totalCatEquipementSecurite = 0;
        $totalCatPoliceNavigation = 0;
        $totalCatEnvironnementPollution = 0;
        $totalCatReglementTravail = 0;
        $totalCatAutre = 0;

        foreach($rapport->getActivites() as $activite) {
            if($activite instanceof ActiviteNavire) {
                $totalControlesNavires = $activite->getControleSansPv()->getNombreControleMer()
                                        + $activite->getControleSansPv()->getNombreControleTerre();

                foreach($activite->getControleSansPv()->getControleNavireRealises() as $controleNavireRealise) {
                    switch($controleNavireRealise) {
                        case CategorieControleNavire::PECHE_SANITAIRE:
                            $totalCatPecheSanitaire += $totalControlesNavires;
                            break;
                        case CategorieControleNavire::REGLEMENTATION_TRAVAIL_MARITIME:
                            $totalCatReglementTravail += $totalControlesNavires;
                            break;
                        case CategorieControleNavire::ENVIRONNEMENT_POLLUTION:
                            $totalCatEnvironnementPollution += $totalControlesNavires;
                            break;
                        case CategorieControleNavire::EQUIPEMENT_SECURITE_PERMIS:
                            $totalCatEquipementSecurite += $totalControlesNavires;
                            break;
                        case CategorieControleNavire::POLICE_NAVIGATION:
                            $totalCatPoliceNavigation += $totalControlesNavires;
                            break;
                        case CategorieControleNavire::AUTRE:
                            $totalCatAutre += $totalControlesNavires;
                            break;
                    }
                }

            }
        }

        $lieuxControlesNavires = null;

        $tableControlesEtablissements = new Table(['borderSize' => 0.5, 'borderColor' => 'black', 'width' => 100 * 50, 'unit' => TblWidth::PERCENT]);
        $tableControlesEtablissements->addRow();
        $tableControlesEtablissements->addCell(600)->addText('Établissement');
        $tableControlesEtablissements->addCell(600)->addText('Date du contrôle');
        $tableControlesEtablissements->addCell(600)->addText('Information spécifique');
        $tableControlesEtablissements->addCell(600)->addText('Sanction(s)');
        $tableControlesEtablissements->addCell(600)->addText('Commentaires');
        $totalEtablissementControles = 0;
        $commentaireEtablissement = null;
        $lieuxControlesEtablissements = null;

        $tableControlePechePied = new Table(['borderSize' => 0.5, 'borderColor' => 'black', 'width' => 100 * 50, 'unit' => TblWidth::PERCENT]);
        $tableControlePechePied->addRow();
        $tableControlePechePied->addCell(600)->addText('Pêcheur à pied');
        $tableControlePechePied->addCell(600)->addText('Statut du pêcheur');
        $tableControlePechePied->addCell(600)->addText('Contrôles');
        $tableControlePechePied->addCell(600)->addText('Sanction(s)');
        $tableControlePechePied->addCell(600)->addText('Commentaires');
        $totalControlePechePied = 0;
        $commentairePechePied = null;
        $lieuxControlesPechePied = null;


        $tableControleLoisirsNautiques = new Table(['borderSize' => 0.5, 'borderColor' => 'black', 'width' => 8000, 'unit' => TblWidth::TWIP]);
        $tableControleLoisirsNautiques->addRow();
        $tableControleLoisirsNautiques->addCell(300)->addText('Loisir nautique');
        $tableControleLoisirsNautiques->addCell(300)->addText('Contrôles');
        $tableControleLoisirsNautiques->addCell(300)->addText('Sanction(s)');
        $tableControleLoisirsNautiques->addCell(300)->addText('Commentaires');
        $totalControleLoisirNautique = 0;
        $commentaireLoisurNautique = null;
        $lieuxControlesLoisirsNautiques = null;

        $tableControlesAutres = new Table(['borderSize' => 0.5, 'borderColor' => 'black', 'width' => 8000, 'unit' => TblWidth::TWIP]);
        $tableControlesAutres->addRow();
        $tableControlesAutres->addCell(800)->addText('Type de contrôle');
        $tableControlesAutres->addCell(600)->addText('Nombre de contrôles réalisés');
        $tableControlesAutres->addCell(600)->addText('Information spécifique');
        $tableControlesAutres->addCell(600)->addText('Sanction');
        $tableControlesAutres->addCell(1000)->addText('Commentaire');

        $tableActivitesAdministratives = new Table(['borderSize' => 0.5, 'borderColor' => 'black', 'width' => 8000, 'unit' => TblWidth::TWIP]);
        $tableActivitesAdministratives->addRow();
        $tableActivitesAdministratives->addCell(800)->addText('Tâche');
        $tableActivitesAdministratives->addCell(600)->addText('Information spécifique');
        $tableActivitesAdministratives->addCell(600)->addText('Durée');
        $tableActivitesAdministratives->addCell(1000)->addText('Commentaire');
        $lieuxActivitesAdministratif = null;

        $totalAutreTypeControles = 0;
        $lieuxAutreTypeControles = null;
        $commentaireAutreTypeControle = null;

        $totalActivitesAdministratives = 0;
        $lieuxFormations = null;
        $totalFormations = 0;

        $predefinedMultilevelStyle = ['listType' => \PhpOffice\PhpWord\Style\ListItem::TYPE_BULLET_FILLED];


        foreach($rapport->getActivites() as $activite) {

            if($activite->getControles()) {
                foreach($activite->getControles() as $controle) {
                    /** @var ControleNavire $controle */
                    if($controle instanceof ControleNavire) {
                        $commentaireNavire = $controle->getActivite()->getCommentaire();
                        $totalControlesNavires += 1;
                        $tableControleNavire->addRow();
                        $tableControleNavire->addCell(600)->addText($controle->getNavire()->getImmatriculation());
                        $informationCell = $tableControleNavire->addCell(600);
                        $informationCell->addListItem('Pavillon : ' . $controle->getNavire()->getPavillon(), 0, null, $predefinedMultilevelStyle);
                        $informationCell->addListItem('Nom : ' . $controle->getNavire()->getNom());
                        $informationCell->addListItem('Longueur : ' . $controle->getNavire()->getLongueurHorsTout());
                        $informationCell->addListItem('Type : ' . $controle->getNavire()->getGenreNav());
                        $informationCell->addListItem('Catégorie : ' . $controle->getNavire()->getCategorieUsageNavire()->getNom());

                        $controlesRealisesCell = $tableControleNavire->addCell(600);

                        foreach($controle->getControleNavireRealises() as $controleNavireRealise) {
                            $controlesRealisesCell->addListItem($controleNavireRealise);
                            switch($controleNavireRealise) {
                                case CategorieControleNavire::PECHE_SANITAIRE:
                                    $totalCatPecheSanitaire += 1;
                                    break;
                                case CategorieControleNavire::REGLEMENTATION_TRAVAIL_MARITIME:
                                    $totalCatReglementTravail += 1;
                                    break;
                                case CategorieControleNavire::ENVIRONNEMENT_POLLUTION:
                                    $totalCatEnvironnementPollution += 1;
                                    break;
                                case CategorieControleNavire::EQUIPEMENT_SECURITE_PERMIS:
                                    $totalCatEquipementSecurite += 1;
                                    break;
                                case CategorieControleNavire::POLICE_NAVIGATION:
                                    $totalCatPoliceNavigation += 1;
                                    break;
                                case CategorieControleNavire::AUTRE:
                                    $totalCatAutre += 1;
                                    break;
                            }
                        }

                        $tableControleNavire->addCell(600)->addText($controle->getDate()->format('d/m/Y'));

                        $sanctionsCell = $tableControleNavire->addCell(600);
                        $sanctionsCell->addText($controle->getPv() ? 'PV : oui' : 'PV : non');

                        if($controle->getNatinfs()->count() > 0) {
                            $sanctionsCell->addText('Natinfs concernés : ');
                            foreach($controle->getNatinfs() as $natinf) {
                                $sanctionsCell->addListItem($natinf->getCodeNatAff());
                            }
                        }

                        if($controle->getDeroutement()) {
                            $sanctionsCell->addText($controle->getDeroutement()->getNom());
                        }

                        $tableControleNavire->addCell(600)->addText($controle->getCommentaire());

                        foreach($activite->getZones() as $zone) {
                            $lieuxControlesNavires = $lieuxControlesNavires . ', ' .$zone;
                        }
                    }

                    /** @var ControleEtablissement $controle */
                    if($controle instanceof ControleEtablissement) {
                        $lieux = null;
                        $commentaireEtablissement = $controle->getActivite()->getCommentaire();
                        $totalEtablissementControles += 1;
                        foreach($controle->getActivite()->getZones() as $zone) {
                            $lieux = $lieux . ' / ' . $zone->getNom();
                        }

                        $tableControlesEtablissements->addRow();
                        $informationCell = $tableControlesEtablissements->addCell(600);
                        $informationCell->addText('Nom : ' . $controle->getEtablissement()->getNom());
                        $informationCell->addText('Adresse : ' . $controle->getEtablissement()->getAdresse() . ', ' . $controle->getEtablissement()->getCommune());
                        $informationCell->addText('Type : ' . $controle->getEtablissement()->getType()->getNom());

                        $tableControlesEtablissements->addCell(600)->addText($controle->getDate()->format('d/m/Y à H:i'));
                        $tableControlesEtablissements->addCell(600)->addText($controle->getBateauxControles() ?
                                                    "Nombre de navires contrôlés : " . $controle->getBateauxControles() : "-");

                        $sanctionsCell = $tableControlesEtablissements->addCell(600);
                        $sanctionsCell->addText($controle->getPv() ? 'PV : oui' : 'PV : non');

                        if($controle->getNatinfs()->count() > 0) {
                            $sanctionsCell->addText('Natinfs concernés : ');
                            foreach($controle->getNatinfs() as $natinf) {
                                $sanctionsCell->addListItem($natinf->getCodeNatAff());
                            }
                        }
                        $tableControlesEtablissements->addCell(600)->addText($controle->getCommentaire());

                        $lieuxControlesEtablissements = implode(', ',
                                                            array_map(function(ZoneGeographique $zg)
                                                                    { return $zg->getNom(); },
                                                                $activite->getZones()->toArray())
                                                            );
                    }


                    /** @var ControlePecheurPied $controle */
                    if($controle instanceof ControlePecheurPied) {
                        $controleProSansPv = $controle->getActivite()->getControleProSansPv();
                        $controlePlaisanceSansPv = $controle->getActivite()->getControlePlaisanceSansPv();

                        $nbControlesPechePiedPro = $controleProSansPv->getNombreControle();
                        $nbControleAMPPechePiedPro = $controleProSansPv->getNombreControleAireProtegee();
                        $nbControleChlordeconeTotalePechePiedPro = $controleProSansPv->getNombreControleChlordeconeTotale();
                        $nbControleChlordeconePartiellePechePiedPro = $controleProSansPv->getNombreControleChlordeconePartiel();

                        $nbControlesPechePiedPlaisance = $controlePlaisanceSansPv->getNombreControle();
                        $nbControleAMPPechePiedPlaisance = $controlePlaisanceSansPv->getNombreControleAireProtegee();
                        $nbControleChlordeconeTotalePechePiedPlaisance = $controlePlaisanceSansPv->getNombreControleChlordeconeTotale();
                        $nbControleChlordeconePartiellePechePiedPlaisance = $controlePlaisanceSansPv->getNombreControleChlordeconePartiel();

                        $templateProcessor->setValues([
                            'nbControlesPecheursPlaisance' => $nbControlesPechePiedPlaisance,
                            'nbControlesPecheursPro' => $nbControlesPechePiedPro,
                            'nbControlesAMPPlaisance' => $nbControleAMPPechePiedPlaisance,
                            'nbControlesAMPPro' => $nbControleAMPPechePiedPro,
                            'nbControlesChlordeconeTotalePlaisance' => $nbControleChlordeconeTotalePechePiedPlaisance,
                            'nbControlesChlordeconeTotalePro' => $nbControleChlordeconeTotalePechePiedPro,
                            'nbControlesChlordeconePartielPlaisance' => $nbControleChlordeconePartiellePechePiedPlaisance,
                            'nbControlesChlordeconePartielPro' => $nbControleChlordeconePartiellePechePiedPro
                        ]);

                        $commentairePechePied = $controle->getActivite()->getCommentaire();
                        $totalControlePechePied += 1;
                        $tableControlePechePied->addRow();
                        $tableControlePechePied->addCell(600)->addText($controle->getPecheurPied()->getPrenom(). " ". $controle->getPecheurPied()->getNom());
                        $tableControlePechePied->addCell(600)->addText($controle->getPecheurPied()->getEstPro() ? 'Professionnel' : 'Plaisancier');
                        $controlesCell = $tableControlePechePied->addCell(600);
                        $controlesCell->addText('Date : ' . $controle->getDate()->format('d/m/Y à H:i'));
                        $controlesCell->addListItem( $controle->getTerrestre() ? 'Réalisé à terre' : 'Réalisé en mer');

                        if($controle->getAireProtegee()) {
                            $controlesCell->addListItem('Contrôle en AMP');
                        }
                        if($controle->getChloredeconeTotal()) {
                            $controlesCell->addListItem('Contrôle en zone Chloredecone total');
                        }

                        if($controle->getChloredeconeTotal()) {
                            $controlesCell->addListItem('Contrôle en zone Chloredecone partielle');
                        }


                        $sanctionsCell = $tableControlePechePied->addCell(600);
                        $sanctionsCell->addText($controle->getPv() ? 'PV : oui' : 'PV : non');

                        if($controle->getNatinfs()->count() > 0) {
                            $sanctionsCell->addText('Natinfs concernés : ');
                            foreach($controle->getNatinfs() as $natinf) {
                                $sanctionsCell->addListItem($natinf->getCodeNatAff());
                            }
                        }


                        $tableControlePechePied->addCell(600)->addText($controle->getCommentaire());

                        foreach($activite->getZones() as $zone) {
                            $lieuxControlesPechePied = $lieuxControlesPechePied . ',' . $zone;
                        }
                    }

                    /** @var ControleLoisir $controle */
                    if($controle instanceof ControleLoisir) {
                        $commentaireLoisurNautique = $controle->getActivite()->getCommentaire();
                        $totalControleLoisirNautique += 1;
                        $tableControleLoisirsNautiques->addRow();
                        $tableControleLoisirsNautiques->addCell(600)->addText(
                            $controle->getLoisir()->getNom() .
                            ($controle->getDetailLoisir() ? ' (' . $controle->getDetailLoisir() . ')' : '')
                        );
                        $controlesCell = $tableControleLoisirsNautiques->addCell(600);
                        $controlesCell->addText('Nombre total de contrôles : ' . $controle->getNombreControle());
                        $controlesCell->addText('dont en AMP : ' . $controle->getNombreControleAireProtegee());

                        $sanctionsCell = $tableControleLoisirsNautiques->addCell(600);
                        $sanctionsCell->addText('PV : ' . ($controle->getNombrePv() > 0 ? $controle->getNombrePv(): 'non'));

                        if($controle->getNatinfs()->count() > 0) {
                            $sanctionsCell->addText('Natinfs concernés : ');
                            foreach($controle->getNatinfs() as $natinf) {
                                $sanctionsCell->addListItem($natinf->getCodeNatAff());
                            }
                        }

                        $tableControleLoisirsNautiques->addCell(600)->addText($controle->getCommentaire());

                        foreach($activite->getZones() as $zone) {
                            $lieuxControlesLoisirsNautiques = $lieuxControlesLoisirsNautiques . ',' . $zone;
                        }
                    }

                    /** @var ControleAutre $controle */
                    if($controle instanceof ControleAutre) {
                        $commentaireAutreTypeControle = $controle->getActivite()->getCommentaire();
                        $totalAutreTypeControles += 1;

                        foreach($controle->getActivite()->getZones() as $zone) {
                            $lieuxAutreTypeControles = $zone;
                        }

                        $tableControlesAutres->addRow();
                        $tableControlesAutres->addCell()->addText($controle->getControle()->getNom());
                        $tableControlesAutres->addCell()->addText($controle->getNombreControle());
                        $tableControlesAutres->addCell()->addText(
                            $controle->getNombreDetruit() > 0 ?
                            'Nombre d\'équipements détruits : ' . $controle->getNombreDetruit() :
                            '');
                        $sanctionsAutresCell = $tableControlesAutres->addCell();

                        $sanctionsAutresCell->addText('Nombre de PV : '  . $controle->getNombrePv());

                        if($controle->getNatinfs()->count() > 0) {
                            $sanctionsAutresCell->addText('Natinfs concernés : ');
                            foreach($controle->getNatinfs() as $natinf) {
                                $sanctionsAutresCell->addListItem($natinf->getCodeNatAff());
                            }
                        }
                        $tableControlesAutres->addCell()->addText($controle->getCommentaire());

                    }
                }
            }


            /** @var ActiviteAdministratif $activite */
            if($activite instanceof ActiviteAdministratif) {
                $commentaireActivitesAdministratives = $controle->getActivite()->getCommentaire();

                foreach($controle->getActivite()->getZones() as $zone) {
                    $lieuxActivitesAdministratif .= ', ' . $zone->getNom();
                }
                foreach($activite->getTaches() as $tache) {
                    $totalActivitesAdministratives += 1;
                    $tableActivitesAdministratives->addRow();
                    $tableActivitesAdministratives->addCell()->addText($tache->getTache()->getNom());
                    $tableActivitesAdministratives->addCell()->addText(
                        ($tache->getDetailTache() ? $tache->getDetailTache() : '') . 
                        ($tache->getNombreDossiers() > 0 ?'Nombre de dossiers traités : '. $tache->getNombreDossiers() : '')
                    );
                    $tableActivitesAdministratives->addCell()->addText($tache->getDureeTache()/60);
                    $tableActivitesAdministratives->addCell()->addText($tache->getCommentaire());
                }
            }

            /** @var ActiviteFormation $activite */
            if($activite instanceof ActiviteFormation) {
                $totalFormations += 1;
                $templateProcessor->setValue('formateur', $activite->getFormateur() ? 'formateur' : 'stagiaire');
                $templateProcessor->setValue('commentaireFormateur', $activite->getCommentaire());
            }
       }

        if($totalControlesNavires > 0) {
            $templateProcessor->setComplexBlock('tableControlesNavires', $tableControleNavire);
            $templateProcessor->setValues([
                'block_controles_navires' => '',
                '/block_controles_navires' => '',
                'commentairesControlesNavires' => $commentaireNavire,
                'lieuxControlesNavires' => $lieuxControlesNavires,
                'totalPecheSanitaire' => $totalCatPecheSanitaire,
                'totalEquipementSecurite' => $totalCatEquipementSecurite,
                'totalPoliceNavigation' => $totalCatPoliceNavigation,
                'totalEnvironnement' => $totalCatEnvironnementPollution,
                'totalReglementTravail' => $totalCatReglementTravail,
                'totalAutre' => $totalCatAutre
            ]);
        } else {
            $templateProcessor->cloneBlock('block_controles_navires', 0, true, true);
        }

        if($totalEtablissementControles > 0) {
            $templateProcessor->setComplexBlock('tableControlesEtablissements', $tableControlesEtablissements);
            $templateProcessor->setValues([
                'block_controles_etablissements' => '',
                '/block_controles_etablissements' => '',
                'commentairesControlesEtablissements' => $commentaireEtablissement,
                'lieuxControlesEtablissements' => $lieuxControlesEtablissements
            ]);
        } else {
            $templateProcessor->cloneBlock('block_controles_etablissements', 0, true, true);
        }

        if($totalControlePechePied > 0) {
            $templateProcessor->setComplexBlock('tableControlesDetailPechePied', $tableControlePechePied);
            $templateProcessor->setValues([
                'block_controles_peche_pied' => '',
                '/block_controles_peche_pied' => '',
                'commentairesControlePechePied' => $commentairePechePied,
                'lieuxControlesPechePied' => $lieuxControlesPechePied
            ]);
        } else {
            $templateProcessor->cloneBlock('block_controles_peche_pied', 0, true, true);
        }

        if($totalControleLoisirNautique > 0) {
            $templateProcessor->setComplexBlock('tableControlesLoisirsNautiques', $tableControleLoisirsNautiques);
            $templateProcessor->setValues([
                'block_controles_loisirs_nautiques' => '',
                '/block_controles_loisirs_nautiques' => '',
                'commentaireControleLoisirNautique' => $commentaireLoisurNautique,
                'lieuxControlesLoisirsNautiques' => $lieuxControlesLoisirsNautiques
            ]);
        } else {
            $templateProcessor->cloneBlock('block_controles_loisirs_nautiques', 0, true, true);
        }

        if($totalAutreTypeControles > 0) {
            $templateProcessor->setComplexBlock('tableAutreTypeControles', $tableControlesAutres);
            $templateProcessor->setValues([
                'block_autre_controles' => '',
                '/block_autre_controles' => '',
                'commentaireAutreTypeControles' => $commentaireAutreTypeControle,
                'lieuxAutreTypeControles' => $lieuxAutreTypeControles
            ]);
        } else {
            $templateProcessor->cloneBlock('block_autre_controles', 0, true, true);
        }

        if($totalActivitesAdministratives > 0) {
            $templateProcessor->setComplexBlock('tableActivitesAdministratives', $tableActivitesAdministratives);
            $templateProcessor->setValues([
                'block_activites_administratives' => '',
                '/block_activites_administratives' => '',
                'lieuxActivitesAdministratives' => $lieuxActivitesAdministratif,
                'commentaireActivitesAdministratives' => $commentaireActivitesAdministratives,
            ]);
        } else {
            $templateProcessor->cloneBlock('block_activites_administratives', 0, true, true);
        }

        if($totalFormations > 0) {
            $templateProcessor->setValues([
                'block_formations' => '',
                '/block_formations' => '',
                'lieuxFormations' => $lieuxFormations
            ]);
        } else {
            $templateProcessor->cloneBlock('block_formations', 0, true, true);
        }





        $templateProcessor->setValues([
            'totalActivitesAdministratives' => $totalActivitesAdministratives,
            'totalControlesNavires' => $totalControlesNavires,
            'totalAutreTypeControles' => $totalAutreTypeControles,
            'totalControlePechePied' => $totalControlePechePied,
            'totalEtablissementsControles' => $totalEtablissementControles,
            'totalControleLoisirNautique' => $totalControleLoisirNautique,
            'totalFormations' => $totalFormations
        ]);

        return $templateProcessor;
    }

}
