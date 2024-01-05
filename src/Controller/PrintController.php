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
    #[Security("is_granted('ROLE_USER') or is_granted('ROLE_SUPERADMIN')")]
    public function index(string $slug, ClientRepository $Client,JiramaRepository $Jirama,ParamettreRepository $Params)
    {
        $NbLettre = new NumberConverter();
        $jiramabox= $Jirama->findOneBy(['Slug'=>$slug]);
        $param = $Params->findAll();
        // $Numbox=$jiramabox->getJirBox();
        $clientBox = $Client->findOneBy(['id'=>$jiramabox->getJirBox()]);
        foreach ($param as $param) {}
        $valnet = ($jiramabox->getConsomation() - $jiramabox->getValIndex());
        $taxe=((($param->getSJirama()+$param->getSSP()+$param->getTva())* $valnet*100)/ ($param->getConsommation()))/100;
        $NetPayer = ($taxe + $param->getPrimeFixe()+$valnet);
        $coutNet= ($param->getCourant() * $valnet)+$param->getPrimeFixe();
        $Net=$NbLettre->numberToWord($NetPayer);
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($pdfOptions);
        $html =$this->renderView('print/index.html.twig', [
            'jirama' => $jiramabox,
            'client' => $clientBox,
            'param' => $param,
            'Net' => $Net,
            'taxe' => $taxe,
            'NetPayer' => $NetPayer,
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
