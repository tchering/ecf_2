<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SaisirNoteController extends AbstractController
{
    #[Route('/saisir/note', name: 'app_saisir_note')]
    public function index(): Response
    {
        return $this->render('saisir_note/index.html.twig', [
            'controller_name' => 'SaisirNoteController',
        ]);
    }
}
