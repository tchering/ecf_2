<?php

namespace App\Controller;

use App\Entity\Evaluation;
use App\Form\EvaluationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
    public function new(EntityManagerInterface $em, Request $request, $id)
    {
        $id = (int) $id;
        if ($id) {
            $evaluation = $em->getRepository(Evaluation::class)->find($id);

            dd($evaluation);
        } else {
            $evaluation = new Evaluation();
        }
        $form = $this->createForm(EvaluationType::class, $evaluation);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($evaluation);
            $em->flush();
            return $this->redirectToRoute('app_eval');
        }
        return $this->render('eval/form.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
