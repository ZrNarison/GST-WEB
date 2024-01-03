<?php

namespace App\Controller;

use App\Entity\Box;
use App\Form\BoxType;
use App\Form\JiramaType;
use App\Form\EditBoxType;
use App\Form\EditClientType;
use App\Form\EditJiramaType;
use App\Form\EmplacementType;
use App\Repository\BoxRepository;
use App\Repository\ClientRepository;
use App\Repository\JiramaRepository;
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

    #[Route('/Box-edit{slug}', name:'editbox')]
    public function Editbox(string $slug,BoxRepository $Box,Request $request,$page=0)
    {
        $limite =9;
        $SelectOldBox= $Box ->findOneBy(['id'=>$slug]);
        $Box= $Box->findBy([],[],$limite,0);
        $form = $this -> createForm(EditBoxType::class,$SelectOldBox);
        $form ->handleRequest($request);
        if($form->isSubmitted()){
            $manager = $this -> getDoctrine()->getManager();
            $manager -> persist($SelectOldBox);
            $manager -> flush(); 
            // $this->addFlash(
            //     "success",
            //     "Le Box N° <strong> {$SelectOldBox->getNum()}</strong> à été bien modifier !"
            // );
            return $this->redirectToRoute('Adbox'); 
        }
        return $this->render('edit/Adtrano.html.twig', [
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
            // $NumNewSite = $Oldsite->getSitue();
            // if($NumNewSite != $NumOldsite)
            // {
                $manager = $this -> getDoctrine()->getManager();
                $manager -> persist($Oldsite);
                $manager -> flush(); 
                // $this->addFlash(
                //     "success",
                //     "L'emplacement <strong> {$Oldsite->getSitue()}</strong> à été bien modifier !"
                // );
                return $this->redirectToRoute('Site'); 
            // }else{
            //     $this->addFlash(
            //         "",
            //         "<h2> L'emplacement <strong> {$Oldsite->getSitue()}</strong> son déjà dans la liste !</h2>"
            //     );
                
        }
        return $this->render('home/AdEmplacement.html.twig', [
            "site"=>$site,
            'form'=> $form->createView()
        ]);
    }

    #[Route('/Jirama{jiro}', name:'jiroedit')]
    public function Editjirama(string $jiro,JiramaRepository $Jiro,Request $request)
    {
        $limite = 10;
        $OldJiro= $Jiro ->findOneBy(['id'=>$jiro]);
        $form = $this -> createForm(EditJiramaType::class,$OldJiro);
        $form ->handleRequest($request);
        if($form->isSubmitted()){
            $manager = $this -> getDoctrine()->getManager();
            $manager -> persist($OldJiro);
            $manager -> flush(); 
            // $this->addFlash(
            //     "success",
            //     "Le jirama à été bien modifier !"
            // );
            return $this->redirectToRoute('JiramaBox'); 
        }
        $Jirama=$Jiro->findBy([],[],$limite,0);
        return $this->render('edit/AdJirama.html.twig', [
            "Jirama"=>$Jirama,
            "OldJiro"=>$OldJiro,
            'form'=> $form->createView()
        ]);
    }


    #[Route('/Client{slug}', name:'ClientEdit')]
    public function Editclient(string $slug,ClientRepository $Client,Request $request)
    {
        $limite = 10;
        $OldClient= $Client ->findOneBy(['Slug'=>$slug]);
        $form = $this -> createForm(EditClientType::class,$OldClient);
        $form ->handleRequest($request);
        if($form->isSubmitted()){
            $manager = $this -> getDoctrine()->getManager();
            $manager -> persist($OldClient);
            $manager -> flush(); 
            // $this->addFlash(
            //     "success",
            //     "Le jirama à été bien modifier !"
            // );
            return $this->redirectToRoute('ListeClient'); 
        }
        return $this->render('edit/AdClient.html.twig', [
            "OldClient"=>$OldClient,
            'form'=> $form->createView()
        ]);
    }

}
