<?php

namespace App\Controller;

use App\Entity\Individu;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IndividuController extends AbstractController
{
    #[Route('/individu', name: 'app_individu')]
    public function index(): Response
    {
        return $this->render('individu/index.html.twig', [
            'controller_name' => 'IndividuController',
        ]);
    }

    #[Route('/individu/add/{id}',name:'app_individu_add')]
    public function add(EntityManagerInterface $em, Request $request,$id){
        $individu = $em->getRepository(Individu::class)->find($id);
        $id =  (int) $id;
        if($id==0){
            $individu = new Individu();
        } else {

        }
        return $this->render('individu/form.html.twig',[

        ]);
    }
}
