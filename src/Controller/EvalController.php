<?php

namespace App\Controller;

use App\Entity\Evaluation;
use App\Form\EvaluationType;
use App\Entity\AnneeScolaire;
use App\Entity\LigneEvaluation;
use App\Form\LigneEvaluationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EvalController extends AbstractController
{
    #[Route('/eval', name: 'app_eval')]
    public function index(EntityManagerInterface $em): Response
    {
        $evaluation = $em->getRepository(Evaluation::class)->findAll();

        return $this->render('eval/index.html.twig', [
            'controller_name' => 'EvalController',
            'evaluation' => $evaluation,
        ]);
    }
    #[Route('/eval/delete/{id}', name: 'app_eval_delete')]
    public function delete(EntityManagerInterface $em, $id)
    {
        $evaluation = $em->getRepository(Evaluation::class)->find($id);
        $em->remove($evaluation);
        $em->flush();
        return $this->redirectToRoute('app_eval');
    }

    #[Route('/eval/new/{id}', name: 'app_eval_new')]
    public function  new(Request $request, EntityManagerInterface $em, $id)
    {
        $id = (int) $id;
        if ($id) {
            $evaluation = $em->getRepository(Evaluation::class)->find($id);
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
            'form' => $form,
        ]);
    }

    #[Route('/eval/saisir/{id}', name: 'app_eval_saisir')]
    public function evalSaisir(EntityManagerInterface $em, $id, Request $request)
    {
        $ligneEval = $em->getRepository(LigneEvaluation::class)->find($id);

        // Create a new LigneEvaluation entity
        $ligneEvaluation = new LigneEvaluation();

        // Create the form
        $form = $this->createForm(LigneEvaluationType::class, $ligneEvaluation);

        // Handle the request
        $form->handleRequest($request);

        // Check if the form is submitted and valid
        if ($form->isSubmitted() && $form->isValid()) {
            // Save the LigneEvaluation entity
            $em->persist($ligneEvaluation);
            $em->flush();

            // Redirect or do something else
        }
        return $this->render('saisir_note/index.html.twig', [
            'ligneEval' => $ligneEval,
            'form' => $form
        ]);
    }
}
