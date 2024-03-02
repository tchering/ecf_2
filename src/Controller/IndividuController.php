<?php

namespace App\Controller;

use App\Entity\Individu;
use App\Form\IndividuType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IndividuController extends AbstractController
{
    #[Route('/individu', name: 'app_individu')]
    public function index(EntityManagerInterface $em): Response
    {
        $individus = $em->getRepository(Individu::class)->findAll();
        return $this->render('individu/index.html.twig', [
            'controller_name' => 'IndividuController',
            'individus' => $individus
        ]);
    }

    #[Route('/individu/add/{id}', name: 'app_individu_add')]
    public function add(EntityManagerInterface $em, Request $request, $id)
    {
        $id =  (int) $id;
        if ($id) {
            $individu = $em->getRepository(Individu::class)->find($id);
        } else {
            $individu = new Individu();
        }
        $form = $this->createForm(IndividuType::class, $individu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($individu);
            $em->flush();
            return $this->redirectToRoute('app_individu');
        }
        return $this->render('individu/form.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/individu/delete/{id}', name: 'app_individu_delete')]
    public function delete(EntityManagerInterface $em, $id)
    {
        $individu = $em->getRepository(Individu::class)->find($id);
        $em->remove($individu);
        $em->flush();
        return $this->redirectToRoute('app_individu');
    }
}
