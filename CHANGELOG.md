#Changelog v0.x


## Changelog v0.12 -> 0.12.1

* Add a button on home screen to switch to PAM interface
* packages update

## Changelog v0.11.2 -> 0.12

* Add PAM report pages

## Changelog v0.10.1 -> 0.11.0
* Correction d'un bug sur la gestion des brouillon (information manquante)
* Champ immatriculation insensible à la case 
* Ajout d'éléments dans l'interface d'adminnistration (Service, Mois Clos)
* Ajout du code NatAff et interface admin pour les Natinfs

## Changelog v0.10.0 -> 0.10.1


## Changelog v0.9.0 -> 0.10.0
* Uniformisation des champs (front et base de donnée) de commentaires

## Changelog v0.8.2 -> 0.9.0 (05/03/2020)
* Ajout de l'enregistrement de la date et utilisateur ayant créé et modifié un rapport (dernière modification)
* Ajout d'un champs de texte pour les sélections "Autre" dans les activités
* Meilleur gestion des erreurs (résout un bug sur l'enregistrement des Activités compostant des informations invalides)
* Correction : affichage du nombre de contrôles réalisés sur la synthèse mission
* Intégration de l'export SATI (en test sur une partie limitée)
* Correction du bouton mois précédent sur la liste des rapports (affichait le mois suivant)
* Correction du chargement de brouillon et amélioration de la résilience aux erreurs
* Possibilité de supprimer un brouillon
* Ajout d'un message de confirmation lors de l'enregistrement d'un brouillon
* Ajout de la partie admin pour les CategorieMoyen et CategorieMethodeCiblage

## Changelog v0.8.1 -> 0.8.2
* Correction d'un bug sur l'affichage du nombre de contrôles sans PV

## Changelog v0.8.0 -> 0.8.1 
* Correction d'un bug sur l'enregistrement des codes NatInf (l'enregistrement d'un rapport avec NatInf renvoyait une erreur 500). 
* Ajout de la possibilité de signaler une mission comme conjointe avec un autre service. 
* Correction d'un bug sur l'affichage du champ "nombre de bateaux" sur les contrôles d'établissements
* Ajout de champs manquants pour la répartition des heures
* Ajout du suivi Chlordécone et complément sur la répartition du temps
* Correction : le bouton se "rappeler de moi" ne fonctionnait pas
* Amélioration de la partie administration et meilleur gestion des accès

## Changelog v0.7.2 -> 0.8.0 (07/01/2020)
* Possibilité de lister des navires non professionnels contrôlés sans PV
* Correction de vocabulaire, titre, ...
* Ajout de l'activité "autres contrôles"
* Suppression de rapportTopic.js, cette classe n'était plus utilisé depuis l'ajout de VueJs pour les activités
* Déplacement des coordonnées géographiques et lieu (terre/mer) de l'activité vers le contrôle (pour navire et pêche à pied seulement, l'information n'est pas pertinante pour les autres types d'activité)
* Amélioration de la gestion des brouillons
* Corrigé le bug d'affichage des zones et départements

## Changelog v0.7.1 -> 0.7.2 (31/12/2019)
* Correction : les erreurs dans la partie pêche à pied n'étaient pas affichées 
* Correction : certains éléments étaient affichés comme obligatoires mais ne l'étaient pas

## Changelog v0.7.0 -> 0.7.1 (30/12/2019)
* Mise à jours de composants et dépendances
* Correction de bugs visuels en particulier sur les boutons à bascule (switch)
* Clarification du vocabulaire avec le bureau AM3
* Meilleure visibilité des erreurs dans les activités
* Ajout d'un message d'avertissement en environnement de test
* Correction de bugs divers

## Changelog v0.6.2 -> 0.7.0 (23/12/2019)
* Corrige les boutons de validation de formulaire (ne demandent plus confirmation pour quitter la page)
* Ajoute les contrôle de loisirs nautiques
* Corrige l'iframe Metabase
* Simplifie l'entrée du temps moteur (comme un temps format heure:minutes)
* Corrige le pré-chargement des données lors de l'édition de rapport existant
* Les contrôles peuvent être signalés en aire marine protégée
* Ajout des types détaillés d'activité administrative
* Mise à jour de sécurité sur le frontal (front-end)
* Ajoute la possibilité d'ajouter des navires étrangers
* Ajout d'un tableau de répartition des heures
* Ajout d'une heure pour les contrôles (navires, pêche à pied, établissements)

## Changelog v0.6.1 -> 0.6.2
* Mises à jour Framework

## Changelog v0.6.0 -> 0.6.1

* Meilleure intégration de Metabase
* Limitation du nombre de champs obligatoires
* Bug/corrections
  * Erreur de typage sur l'objet Agent, import Formulaire Contrôle Pêcheur à pied
  * Erreur lors de l'enregistrement de mission (les missions hors navire ne s'enregistraient pas car nécessitaient typeCiblage, non pertinent)

