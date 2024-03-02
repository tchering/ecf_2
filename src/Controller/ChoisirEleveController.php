<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ChoisirEleveController extends AbstractController
{
    #[Route('/choisir/eleve', name: '')]
    public function index(): Response
    {
        return $this->render('choisir_eleve/index.html.twig', [
            'controller_name' => 'ChoisirEleveController',
        ]);
    }
}
