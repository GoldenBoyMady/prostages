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

        return $this->render('proStages/index.html.twig', ['stages' => 'listeStages']);
    }

    /**
     * @Route("/entreprises", name="pro_stage_entreprises")
     */
    public function entreprises(): Response
    {
        // RECUPERATION REPERTOIRE Entreprise
        $repertoireEntreprise = $this->getDoctrine()->getRepository(Entreprise::class);
        
        $entreprises = $repertoireEntreprise->findAll();

        return $this->render('proStages/entreprises.html.twig', ['entreprises' => 'entreprises']);
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

        $listeStages = $repertoireStage->findByEntreprise($entreprise);


        return $this->render('proStages/entreprises.html.twig', ['nomEntreprise' => 'nomEntreprise','stages' => 'listeStages' ]);
    }

    /**
     * @Route("/formations", name="pro_stage_formations")
     */
    public function formations(): Response
    {
        // RECUPERATION REPERTOIRE Formation
        $repertoireFormation = $this->getDoctrine()->getRepository(Formation::class);
        
        $listeFormation = $repertoireFormation->findAll();

        return $this->render('proStages/formations.html.twig', ['formations' => 'listeFormation']);
    }

    /**
     * @Route("/formations/{id}", name="liste_stages_par_formations")
     */
    public function listeStagesParFormations($id): Response
    {
        // RECUPERATION DE LA FORMATION CHOISIT DANS LE FILTRE
        $repertoireFormation = $this->getDoctrine()->getRepository(Formation::class);
        
        $formation = $repertoireFormation->Find($id);

        $nomLongFormation = $formation->getNomLong();


        // RECUPERATION DES STAGES PROPOSEES PAR L'ENTREPRISE FILTRE
        $repertoireStage = $this->getDoctrine()->getRepository(Stage::class);

        $listeStages = $repertoireStage->findByFormation($formation);


        return $this->render('proStages/entreprises.html.twig', ['nomLongFormation' => 'nomLongFormation','stages' => 'listeStages']);
    }
}
