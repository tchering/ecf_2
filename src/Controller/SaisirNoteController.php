<?php

namespace App\Controller;

use App\Entity\Evaluation;
use App\Entity\AnneeScolaire;
use App\Entity\LigneEvaluation;
use App\Form\LigneEvaluationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SaisirNoteController extends AbstractController
{
    #[Route('/saisir/note/', name: 'app_saisir_note')]
    public function index(EntityManagerInterface $em, Request $request): Response
    {
        $ligneEval = $em->getRepository(LigneEvaluation::class)->findAll();

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

        // Render the template and pass the form variable
        return $this->render('saisir_note/index.html.twig', [
            'controller_name' => 'SaisirNoteController',
            'ligneEval' => $ligneEval,
            'form' => $form->createView(), // Pass the form variable to the template
        ]);
    }

    #[Route('/saisir/note/show/{id}', name: 'app_saisir_show')]
    public function show(EntityManagerInterface $em, $id, Request $request)
    {
        $note = $em->getRepository(LigneEvaluation::class)->find($id);

        $form  = $this->createForm(LigneEvaluationType::class, $note);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($note);
            $em->flush();
            return $this->redirectToRoute('app_saisir_note');
        }
        return $this->render('saisir_note/form.html.twig', [
            'note' => $note,
            'form' => $form
        ]);
    }
}
