<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProStageController extends AbstractController
{
    /**
     * @Route("/", name="pro_stage_acceuil")
     */
    public function index(): Response
    {
        return $this->render('proStages/index.html.twig', [
            'controller_name' => 'proStageController',
        ]);
    }

    /**
     * @Route("/entreprises", name="pro_stage_entreprises")
     */
    public function entreprises(): Response
    {
        return $this->render('proStages/entreprises.html.twig', [
            'controller_name' => 'proStageController',
        ]);
    }

    /**
     * @Route("/formations", name="pro_stage_formations")
     */
    public function formations(): Response
    {
        return $this->render('proStages/formations.html.twig', [
            'controller_name' => 'proStageController',
        ]);
    }

    /**
     * @Route("/stages/{id}", name="pro_stage_stages")
     */
    public function stages(): Response
    {
        return $this->render('proStages/stages.html.twig', [
            'controller_name' => 'proStageController',
        ]);
    }
}
