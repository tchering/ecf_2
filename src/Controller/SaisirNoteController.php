<?php

namespace App\Controller;

use App\Entity\Evaluation;
use App\Entity\LigneEvaluation;
use App\Form\LigneEvaluationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SaisirNoteController extends AbstractController
{
    //! This function index fills the data in saisir evaluation trimestrielle in top table
    #[Route('/saisir/note/{id}', name: 'app_saisir_note')]
    public function index(EntityManagerInterface $em, $id): Response
    {
        $evaluation = $em->getRepository(Evaluation::class)->find($id);
        //!this line is responsible for showing eleve note given by specific formateur
        $lineEvaluations = $em->getRepository(LigneEvaluation::class)->findBy(['evaluation' => $evaluation]);

        return $this->render('saisir_note/index.html.twig', [
            'controller_name' => 'SaisirNoteController',
            'evaluation' => $evaluation,
            'disabled' => 'disabled',
            'ligneEvaluations' => $lineEvaluations
        ]);
    }
    //! This function is to open form and insert the eval id for selected eleve with first note and appreciation.
    #[Route('/saisir/note/choisir/{id}', name: 'app_choisir_eleve')]
    public function choisirEleve(EntityManagerInterface $em, Request $request, $id)
    {
        $id = (int) $id;
        if ($id == 0) {
            $ligneEvaluation = new LigneEvaluation();
        } else {
            $ligneEvaluation = $em->getRepository(LigneEvaluation::class)->find($id);
        }
        $form = $this->createForm(LigneEvaluationType::class, $ligneEvaluation, []);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($ligneEvaluation);
            $em->flush();
            return $this->redirectToRoute('app_saisir_note', [
                'id' => $ligneEvaluation->getEvaluation()->getId()
            ]);
        }
        return $this->render('/saisir_note/form.html.twig', [
            'form' => $form->createView()
        ]);
    }
    //! This function is to open modal with data inside in form modal.
    #[Route('/saisir/modal/{id}', name: 'app_show_modal')]
    public function showModal(EntityManagerInterface $em, Request $request, $id)
    {
        $ligneEvaluation  = $em->getRepository(LigneEvaluation::class)->find($id);



        $rows = [
            'id' => $ligneEvaluation->getId(),
            'evaluation' => $ligneEvaluation->getEvaluation(),
            'note' => $ligneEvaluation->getNote(),
            'appreciation' => $ligneEvaluation->getAppreciation(),
            'nom' => $ligneEvaluation->getIndividu()->getNom(),
            'prenom' => $ligneEvaluation->getIndividu()->getPrenom(),
            'code' => $ligneEvaluation->getEvaluation()->getNumero(),
        ];
        $response = [
            'rows' => $rows
        ];
        echo json_encode($response);
        exit;
    }
    //!This function is to modify note and appreciation from modal.
    #[Route('/saisir/modify/{id}', name: 'app_modify_note')]
    public function modifyNote(EntityManagerInterface $em, Request $request, $id)
    {
        $id = (int) $id;
        if ($id) {
            $ligneEvaluation = $em->getRepository(LigneEvaluation::class)->find($id);
            //!get data from request
            $note = $request->request->get('note');
            $appreciation = $request->request->get('appreciation');

            //! here setter method to update the properties
            $ligneEvaluation->setNote($note);
            $ligneEvaluation->setAppreciation($appreciation);

            $em->persist($ligneEvaluation);
            $em->flush();

            return new JsonResponse(['status' => 'success']);
        }
        //Return if error 
        return new JsonResponse(['status' => 'error', 'message' => 'Something went wrong']);
    }
}
