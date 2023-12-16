<?php

namespace App\Controller;

use App\Entity\Box;
use App\Repository\BoxRepository;
use App\Repository\ClientRepository;
use App\Repository\JiramaRepository;
use App\Repository\EmplacementRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DeleteController extends AbstractController
{
    #[Route('/deleteBox{slug}', name: 'delbox')]
    public function deletebox(string $slug,BoxRepository $Box,ClientRepository $Client,JiramaRepository $jirama): Response
    {
        
        $client= $Client->findBy(['Box'=>$slug]);
        $jirama= $jirama->findBy(['JirBox'=>$slug]);
        $SelectOneBox= $Box->findOneBy(['id'=>$slug]);
        $Box= $Box->findAll();
        dd($SelectOneBox,$client,$jirama);
        return $this->render('home/Adtrano.html.twig', [
            "Box"=>$Box,
            'form'=> $form->createView()
        ]);
    }

    #[Route('/deleteEmplacement{siteid}', name: 'delsite')]
    public function delsite(string $siteid,BoxRepository $Box,EmplacementRepository $emplacement): Response
    {
        
        $emplacement= $emplacement->findBy(['id'=>$siteid]);
        $jirama= $jirama->findBy(['JirBox'=>$siteid]);
        $SelectOneemplacement= $emplacement->findOneBy(['id'=>$siteid]);
        $Box= $Box->findAll();
        dd($SelectOneemplacement,$client,$jirama);
        return $this->render('home/Adtrano.html.twig', [
            "Box"=>$Box,
            'form'=> $form->createView()
        ]);
    }
}
