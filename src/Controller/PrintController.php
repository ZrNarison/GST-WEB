<?php

namespace App\Controller;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Service\NumberConverter;
use App\Repository\ClientRepository;
use App\Repository\JiramaRepository;
use App\Repository\ParamettreRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PrintController extends AbstractController
{
    #[Route('facture{slug}/print', name: 'app_print')]
    public function index(string $slug, ClientRepository $Client,JiramaRepository $Jirama,ParamettreRepository $Params)
    {
        $NbLettre = new NumberConverter();
        $jiramabox= $Jirama->findOneBy(['Slug'=>$slug]);
        $param= $Params->findAll();
        // $Numbox=$jiramabox->getJirBox();
        $clientBox = $Client->findOneBy(['id'=>$jiramabox->getJirBox()]);
        $valnet = ($jiramabox->getConsomation() - $jiramabox->getValIndex())* 250;
        $Net=$NbLettre->numberToWord($valnet);
        foreach ($param as $param) {

        }
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($pdfOptions);
        // dd($jiramabox,$clientBox);
        $html =$this->renderView('print/index.html.twig', [
            'jirama' => $jiramabox,
            'client' => $clientBox,
            'param' => $param,
            'Net' => $Net,
            'valnet' => $valnet,
        ]);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("FACTURE JIRAMA DU BOX ".$jiramabox->getJirBox()." DOIT A ".mb_strtoupper($clientBox->getFname())." ".$clientBox->getLname()." DU ".$jiramabox->getFactDate()->Format("d-m-Y")." .pdf", [
            "Attachment" => true
        ]);
    }
}
