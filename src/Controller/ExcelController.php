<?php

namespace App\Controller;

use App\Entity\Individu;
use App\Entity\Evaluation;
use App\Entity\LigneEvaluation;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ExcelController extends AbstractController
{
    #[Route('/excel', name: 'app_excel')]
    public function index(): Response
    {
        return $this->render('excel/index.html.twig', [
            'controller_name' => 'ExcelController',
        ]);
    }

    #[Route('/excel/import/', name: 'app_evaluation_import')]

    public function import(Request $request, EntityManagerInterface $em)
    {
        $file = $request->files->get('file');
        if (empty($file)) {
            return new Response('No file uploaded', Response::HTTP_BAD_REQUEST);
        }
        $spreadsheet = IOFactory::load($file);
        $worksheet = $spreadsheet->getActiveSheet();
        foreach ($worksheet->getRowIterator() as $row) {
            $cells = $row->getCellIterator();
            $cells->setIterateOnlyExistingCells(false); // This loops through all cells, even if a cell value is not set.
            $data = [];
            foreach ($cells as $cell) {
                $data[] = $cell->getValue();
            }

            // Skip rows where the numero cell is empty
            if (empty($data[0])) {
                continue;
            }

            $evaluation = new Evaluation();
            $evaluation->setNumero($data[2]);

            $individu = new Individu();
            $individu->setNom($data[3]);
            $individu->setPrenom($data[4]);

            $ligneEvaluation = new LigneEvaluation();
            $ligneEvaluation->setEvaluation($evaluation);
            $ligneEvaluation->setIndividu($individu);
            $ligneEvaluation->setNote($data[0]);
            $ligneEvaluation->setAppreciation($data[1]);

            $em->persist($ligneEvaluation);
        }
        $em->flush();

        return new Response('File imported successfully');
    }
}
