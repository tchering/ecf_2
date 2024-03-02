<?php

namespace App\Controller;

use App\Entity\Evaluation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SaisirNoteController extends AbstractController
{
    #[Route('/saisir/note/{id}', name: 'app_saisir_note')]
    public function index(EntityManagerInterface $em, $id): Response
    {
        $evaluation = $em->getRepository(Evaluation::class)->find($id);
        return $this->render('saisir_note/index.html.twig', [
            'controller_name' => 'SaisirNoteController',
            'evaluation' => $evaluation,
            'disabled' => 'disabled'
        ]);
    }
}
