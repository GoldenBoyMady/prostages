<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Entreprise;
use App\Entity\Stage;
use App\Entity\Formation;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //RECUPERATION DE LA LIBRAIRIE FAKER
        $faker = \Faker\Factory::create('fr_FR');

        // CREATION ENTREPRISES
        $entrepriseComitronic = new Entreprise();
        $entrepriseComitronic->setNom("COMITRONIC BTI");
        $entrepriseComitronic->setAdresse("14 Rue Pierre Paul De Riquet, 33610 Canéjan");
        $entrepriseComitronic->setActivite("Conception et fabrication de composants de sécurité");
        $entrepriseComitronic->setSiteWeb("https://www.comitronic-bti.com/index.php");
        $entrepriseComitronic->setEmail("contact@comitronic-bti.fr");

        $entrepriseWebTech = new Entreprise();
        $entrepriseWebTech->setNom("Web Tech");
        $entrepriseWebTech->setAdresse($faker->address());// ici, aucune adresse retrouvable, utilisation de la librairie faker par défaut
        $entrepriseWebTech->setActivite("Développement web");
        $entrepriseWebTech->setSiteWeb("https://webtech.fr/");
        $entrepriseWebTech->setEmail("contact@webtech.fr");

        $entrepriseInflexsys = new Entreprise();
        $entrepriseInflexsys->setNom("Inflexsys");
        $entrepriseInflexsys->setAdresse("8 AV de la Grande Semaine, 33700 Mérignac");
        $entrepriseInflexsys->setActivite("Conception et développement d'applications mobile");
        $entrepriseInflexsys->setSiteWeb("https://www.inflexsys.com");
        $entrepriseInflexsys->setEmail("contact@inflexsys.fr");

        $entrepriseErcom = new Entreprise();
        $entrepriseErcom->setNom("Ercom");
        $entrepriseErcom->setAdresse("6 Rue Dewoitine, 78140 Vélizy Villacoublay");
        $entrepriseErcom->setActivite("CyberSécurité");
        $entrepriseErcom->setSiteWeb("https://www.ercom.fr");
        $entrepriseErcom->setEmail("contact@Ercom.fr");

        $entrepriseBixoko = new Entreprise();
        $entrepriseBixoko->setNom("Bixoko");
        $entrepriseBixoko->setAdresse("5 Rue Gaztelu Zena, Saint-Palais");
        $entrepriseBixoko->setActivite("Développement web");
        $entrepriseBixoko->setSiteWeb("https://bixoko.com/agence-web-pays-basque");
        $entrepriseBixoko->setEmail("contact@Bixoko.fr");

        $tableauEntreprises = array($entrepriseComitronic,$entrepriseWebTech,$entrepriseInflexsys,$entrepriseErcom,$entrepriseBixoko);

        foreach( $tableauEntreprises as $entreprise )
        {
        $manager->persist($entreprise);
        }



        // CREATION FORMATIONS
        $formationDut = new Formation();
        $formationDut->setNomCourt("DUT");
        $formationDut->setNomLong("Diplôme Universitaire de Technologie");

        $formationBut = new Formation();
        $formationBut->setNomCourt("BUT");
        $formationBut->setNomLong("Bachelor Universitaire de Technologie");

        $formationBts = new Formation();
        $formationBts->setNomCourt("BTS");
        $formationBts->setNomLong("Brevet Technicien Supérieur");

        $formationL1 = new Formation();
        $formationL1->setNomCourt("L1");
        $formationL1->setNomLong("Licence 1");

        $formationL2 = new Formation();
        $formationL2->setNomCourt("L2");
        $formationL2->setNomLong("Licence 2");

        $formationL3 = new Formation();
        $formationL3->setNomCourt("L3");
        $formationL3->setNomLong("Licence 3");

        $formationM1 = new Formation();
        $formationM1->setNomCourt("M1");
        $formationM1->setNomLong("Master 1");

        $formationM2 = new Formation();
        $formationM2->setNomCourt("M2");
        $formationM2->setNomLong("Master 2");

        $formationIng = new Formation();
        $formationIng->setNomCourt("Ingénieur");
        $formationIng->setNomLong("Ingénieur");

        $tableauFormations = array($formationDut,$formationBut,$formationBts,$formationL1,$formationL2,$formationL3,$formationM1,$formationM2,$formationIng);

        foreach( $tableauFormations as $formation )
        {
            $manager->persist($formation);
        }



        // CREATION STAGES
            $stageComitronicWeb = new Stage();
            $stageComitronicWeb->setTitre("Développeur Back-End PHP H/F");
            $stageComitronicWeb->setMission("Intégrez au sein du pôle technique de Bordeaux (Pessac), vos missions seront :

            -De développer de nouvelles fonctionnalités sur les outils TimeOne,
            -D’améliorer les processus techniques et les environnements de développement,
            -De prendre en main des problématiques métier plus que des technologies,
            -Et de rendre nos utilisateurs heureux !");

            // Création relation Stage --> Formation
            $stageComitronicWeb -> addIdFormation($formationBut);
            $stageComitronicWeb -> addIdFormation($formationL3);

            // Création relation Stage --> Entreprise
            $stageComitronicWeb -> setIdEntreprise($tableauEntreprises[0]);
            // Création relation Entreprise --> Stage
            $tableauEntreprises[0] -> addStage($stageComitronicWeb);

            /*----------------------------------------------------------------------------------------------------------------------------------------------------------------*/

            $stageComitronicSql = new Stage();
            $stageComitronicSql->setTitre("Développeur SQL H/F"); 
            $stageComitronicSql->setMission("Intégrez au sein du pôle technique de Bordeaux (Pessac), vos missions seront :

            -De développer de nouvelles fonctionnalités sur les outils TimeOne,
            -D’améliorer les processus techniques et les environnements de développement,
            -De prendre en main des problématiques métier plus que des technologies,
            -Et de rendre nos utilisateurs heureux !");

            // Création relation Stage --> Formation
            $stageComitronicSql -> addIdFormation($formationM1);
            $stageComitronicSql -> addIdFormation($formationM2);
            $stageComitronicSql -> addIdFormation($formationIng);

            // Création relation Stage --> Entreprise
            $stageComitronicSql -> setIdEntreprise($tableauEntreprises[0]);
            // Création relation Entreprise --> Stage
            $tableauEntreprises[0] -> addStage($stageComitronicSql);

            /*----------------------------------------------------------------------------------------------------------------------------------------------------------------*/

            $stageWebTech = new Stage();
            $stageWebTech->setTitre("Développeur back-end Symfony Full Stack H/F");
            $stageWebTech->setMission("Forts de plusieurs années d’expérience ( > 5 ans) dans le développement digital (outils, extranet, intranet, portail web, API...).
            La Team est en charge de :
            
            -l’estimation du développement des user-stories en équipe lors du planning poker sur la base des spécifications fonctionnelles détaillées rédigées par le PO,
            -la rédaction des spécifications techniques des développements,
            -les tests unitaires,
            -le développement de la story,
            -la code review,
            -de livrer le code sur le Git du projet.");

            // Création relation Stage --> Formation
            $stageWebTech -> addIdFormation($formationDut);
            $stageWebTech -> addIdFormation($formationBts);
            $stageWebTech -> addIdFormation($formationBut);

            // Création relation Stage --> Entreprise
            $stageWebTech -> setIdEntreprise($tableauEntreprises[1]);
            // Création relation Entreprise --> Stage
            $tableauEntreprises[1] -> addStage($stageWebTech);

            /*----------------------------------------------------------------------------------------------------------------------------------------------------------------*/

            $stageInflexsysMobile = new Stage();
            $stageInflexsysMobile->setTitre("Développeur Back-End H/F"); 
            $stageInflexsysMobile->setMission("→ Mission

            Ton rôle consistera à prendre en charge les développements backend de notre API et nos algos de matching. Node.JS et MongoDB (compétence aggrégation nécessaire). Tu seras accompagné par notre CTO sur ta montée en puissance.
            
            → Responsabilités
            
            Gérer le déploiement de la V3 de notre solution côté backend
            Gérer l'architecture et les migrations de data si nécessaire
            Ouvrir de nouvelles routes sur notre API + intégrations d'APIs tierces (DataTourisme par ex.)
            Mise en place d’un process de déploiement continu (tests E2E)
            Optimisation du code existant (refacto, bugfixing etc.)");

            // Création relation Stage --> Formation
            $stageInflexsysMobile -> addIdFormation($formationDut);
            $stageInflexsysMobile -> addIdFormation($formationBts);

            // Création relation Stage --> Entreprise
            $stageInflexsysMobile -> setIdEntreprise($tableauEntreprises[2]);
            // Création relation Entreprise --> Stage
            $tableauEntreprises[2] -> addStage($stageInflexsysMobile);

            /*----------------------------------------------------------------------------------------------------------------------------------------------------------------*/

            $stageInflexsysWeb = new Stage();
            $stageInflexsysWeb->setTitre("Développeur Back-End PHP H/F");
            $stageInflexsysWeb->setMission("1. Objectif d’ensemble :

                Au sein d’une équipe jeune et dynamique, vous serez coaché par d'autres développeurs et participerez au développement front d'un logiciel de maintenance très utilisé et approfondirez vos connaissances en ReactJS notamment.
                Vous travaillerez en lien direct avec le CTO de la startup et aurez l’occasion d’évoluer vers d’autres langages.
                
                2. Stack technique : React.JS, Javascript, Node.JS
                
                3. Principales missions et responsabilités :
                
                Vous développerez de nouvelles fonctionnalités Front (ReactJS, Java) en intégrant des maquettes sur tous types d'écran en HTML5, CSS et avec les
                composants ReactJS
                
                Vous aurez également l'occasion d’apprendre et travailler sur les aspects de l'optimisation SEO (prerender, Hn, URLs, Webperf, content, etc) organisés en méthode Agile
                Vous pourrez proposer des améliorations sur la performance, l'ergonomie et les évolutions possibles");

            // Création relation Stage --> Formation
            $stageInflexsysWeb -> addIdFormation($formationDut);
            $stageInflexsysWeb -> addIdFormation($formationBts);

            // Création relation Stage --> Entreprise
             $stageInflexsysWeb -> setIdEntreprise($tableauEntreprises[2]);
            // Création relation Entreprise --> Stage
            $tableauEntreprises[2] -> addStage($stageInflexsysWeb);

            /*----------------------------------------------------------------------------------------------------------------------------------------------------------------*/

            $stageErcom  = new Stage();
            $stageErcom->setTitre("Stage - Développeur backend - H/F"); 
            $stageErcom->setMission("En tant que membre à part entière de l’équipe, vous assurerez toutes les activités clés du métier de développeur :

                Etude technique et conception
                Développement et Tests unitaires
                Participation aux différentes cérémonies dans un cadre de travail Agile");

            // Création relation Stage --> Formation
            $stageErcom -> addIdFormation($formationBts);

            // Création relation Stage --> Entreprise
            $stageErcom -> setIdEntreprise($tableauEntreprises[3]);
            // Création relation Entreprise --> Stage
            $tableauEntreprises[3] -> addStage($stageErcom);

            /*----------------------------------------------------------------------------------------------------------------------------------------------------------------*/

            $stageBixoko = new Stage();
            $stageBixoko->setTitre("Développeur back-end Java"); 
            $stageBixoko->setMission("Rattaché(e) à l’équipe Java Backend et à une équipe agile, vous intégrez l’équipe de notre client en tant qu’Ingénieur Développement Backend (Java)(H/F), vous pourrez notamment :

            Participer dans un environnement agile à de nombreux projets de nouveaux développements du serveur et des API Rest
            Développer de nouvelles fonctionnalités avec Java et d’autres technos, car notre stack backend est variée
            Contribuer à la construction d’une infrastructure en micro-services
            Proposer de nouvelles technos et solutions");

            // Création relation Stage --> Formation
            $stageBixoko -> addIdFormation($formationIng);

            // Création relation Stage --> Entreprise
             $stageBixoko -> setIdEntreprise($tableauEntreprises[4]);
             // Création relation Entreprise --> Stage
            $tableauEntreprises[4] -> addStage($stageBixoko);
            


        $tableauStages = array($stageComitronicWeb,$stageComitronicSql,$stageWebTech,$stageInflexsysMobile,$stageInflexsysWeb,$stageErcom,$stageBixoko);

        foreach( $tableauStages as $stage )
        {
        $manager->persist($stage);
        }

        
        $manager->flush();
    }
}
