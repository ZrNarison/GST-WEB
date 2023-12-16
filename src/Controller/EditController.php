<?php

namespace App\Controller;

use App\Entity\Box;
use App\Form\BoxType;
use App\Form\EmplacementType;
use App\Repository\BoxRepository;
use App\Repository\EmplacementRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EditController extends AbstractController
{
    #[Route('/edit', name: 'app_edit')]
    public function index(): Response
    {
        return $this->render('edit/index.html.twig', [
            'controller_name' => 'EditController',
        ]);
    }

    #[Route('/Box-edit{slugbox}', name:'editbox')]
    public function Editbox(string $slugbox,BoxRepository $Box,Request $request)
    {
        
        $SelectOldBox= $Box ->findOneBy(['id'=>$slugbox]);
        $Box= $Box->findAll();
        $form = $this -> createForm(BoxType::class,$SelectOldBox);
        $form ->handleRequest($request);
        foreach($Box as $oldbox){
            $NumOldBox = $oldbox->getNum();
        }
        if($form->isSubmitted()){
            $NumNewBox = $SelectOldBox->getNum();
            if($NumNewBox != $NumOldBox)
            {
                $manager = $this -> getDoctrine()->getManager();
                $manager -> persist($SelectOldBox);
                $manager -> flush(); 
                $this->addFlash(
                    "success",
                    "Le Box N° <strong> {$SelectOldBox->getNum()}</strong> à été bien modifier !"
                );
                return $this->redirectToRoute('Adbox'); 
            }else{
                $this->addFlash(
                    "danger",
                    "Le Box N° <strong> {$SelectOldBox->getNum()}</strong> son déjà dans la liste !"
                );
            }
        }
        return $this->render('home/Adtrano.html.twig', [
            "Box"=>$Box,
            'form'=> $form->createView()
        ]);
    }

    #[Route('/Emplacement{siteid}edit', name:'siteedit')]
    public function EditSite(string $siteid,EmplacementRepository $Site,Request $request)
    {
        
        $Oldsite= $Site ->findOneBy(['id'=>$siteid]);
        $form = $this -> createForm(EmplacementType::class,$Oldsite);
        $form ->handleRequest($request);
        $site= $Site->findAll();
        $NumOldsite = $Oldsite->getSitue();
        if($form->isSubmitted()){
            $NumNewSite = $Oldsite->getSitue();
            if($NumNewSite != $NumOldsite)
            {
                $manager = $this -> getDoctrine()->getManager();
                $manager -> persist($Oldsite);
                $manager -> flush(); 
                $this->addFlash(
                    "success",
                    "L'emplacement <strong> {$Oldsite->getSitue()}</strong> à été bien modifier !"
                );
                return $this->redirectToRoute('Adbox'); 
            }else{
                $this->addFlash(
                    "danger",
                    "L'emplacement <strong> {$Oldsite->getSitue()}</strong> son déjà dans la liste !"
                );
                return $this->render('home/AdEmplacement.html.twig', [
                    "site"=>$site,
                    'form'=> $form->createView()
                ]);
            }
        }
        return $this->render('home/AdEmplacement.html.twig', [
            "site"=>$site,
            'form'=> $form->createView()
        ]);
    }

}
