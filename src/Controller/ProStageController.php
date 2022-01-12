<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Stage;
use App\Entity\Entreprise;
use App\Entity\Formation;

class ProStageController extends AbstractController
{
    
    /**
     * @Route("/", name="pro_stage_acceuil")
     */
    public function index(): Response
    {
        // RECUPERATION REPERTOIRE Stage
        $repertoireStage = $this->getDoctrine()->getRepository(Stage::class);
        
        $listeStage = $repertoireStage->findAll();

        return $this->render('proStages/index.html.twig', ['stages' => $listeStage]);
    }

    /**
     * @Route("/descriptionStage/{id}", name="description_stage")
     */
    public function descriptionStage($id): Response
    {
        // RECUPERATION DE LA DESCRIPTION DU STAGE CHOISIT
        $repertoireStage = $this->getDoctrine()->getRepository(Stage::class);

        $stage = $repertoireStage->Find($id);
        $entreprise = $stage->getIdEntreprise();
        $listeFormations = $stage->getIdFormation();

        return $this->render('proStages/descriptionStage.html.twig', ['stage' => $stage,'entreprise' => $entreprise, 'formations' => $listeFormations]);
    }

    /**
     * @Route("/entreprises", name="pro_stage_entreprises")
     */
    public function entreprises(): Response
    {
        // RECUPERATION REPERTOIRE Entreprise
        $repertoireEntreprise = $this->getDoctrine()->getRepository(Entreprise::class);
        
        $listeEntreprises = $repertoireEntreprise->findAll();

        return $this->render('proStages/entreprises.html.twig', ['entreprises' => $listeEntreprises]);
    }

    /**
     * @Route("/entreprises/{id}", name="liste_stages_par_entreprise")
     */
    public function listeStagesParEntreprise($id): Response
    {
        // RECUPERATION DE L'ENTREPRISE CHOISIT DANS LE FILTRE
        $repertoireEntreprise = $this->getDoctrine()->getRepository(Entreprise::class);
        
        $entreprise = $repertoireEntreprise->Find($id);

        $nomEntreprise = $entreprise->getNom();


        // RECUPERATION DES STAGES PROPOSEES PAR L'ENTREPRISE FILTRE
        $repertoireStage = $this->getDoctrine()->getRepository(Stage::class);

        $listeStages = $repertoireStage->FindBy(["id" => $id]);


        return $this->render('proStages/stagesParEntreprises.html.twig', ['nomEntreprise' => $nomEntreprise,'stages' => $listeStages]);
    }

    /**
     * @Route("/formations", name="pro_stage_formations")
     */
    public function formations(): Response
    {
        // RECUPERATION REPERTOIRE Formation
        $repertoireFormation = $this->getDoctrine()->getRepository(Formation::class);
        
        $listeFormations = $repertoireFormation->findAll();

        return $this->render('proStages/formations.html.twig', ['formations' => $listeFormations]);
    }

    /**
     * @Route("/formations/{id}", name="liste_stages_par_formation")
     */
    public function listeStagesParFormations($id): Response
    {
        // RECUPERATION DE LA FORMATION CHOISIT DANS LE FILTRE
        $repertoireFormation = $this->getDoctrine()->getRepository(Formation::class);
        
        $formation = $repertoireFormation->Find($id);

        $nomLongFormation = $formation->getNomLong();


        // RECUPERATION DES STAGES PROPOSEES PAR L'ENTREPRISE FILTRE
        $listeStages = $formation->getStages();


        return $this->render('proStages/stagesParFormations.html.twig', ['nomLongFormation' => $nomLongFormation,'stages' => $listeStages]);
    }
}
