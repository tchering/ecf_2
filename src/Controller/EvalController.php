<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EvalController extends AbstractController
{
    #[Route('/eval', name: 'app_eval')]
    public function index(): Response
    {
        return $this->render('eval/index.html.twig', [
            'controller_name' => 'EvalController',
        ]);
    }

    #[Route('/eval/new/{id}', name: 'app_eval_new')]
    public function  new()
    {
        return $this->render('eval/show.html.twig');
    }
}
