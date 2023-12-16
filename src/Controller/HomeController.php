<?php

namespace App\Controller;

use App\Entity\Box;
use App\Entity\Role;
use App\Form\BoxType;
use App\Entity\Client;
use App\Entity\Jirama;
use App\Form\RoleType;
use App\Form\ClientType;
use App\Form\JiramaType;
use Cocur\Slugify\Slugify;
use App\Entity\Emplacement;
use App\Form\EmplacementType;
use App\Repository\BoxRepository;
use App\Repository\RoleRepository;
use App\Repository\JiramaRepository;
use Doctrine\Persistence\ObjectManager;
use App\Repository\EmplacementRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/AdBox', name:'Adbox')]
    public function Adtrano(BoxRepository $Box,Request $request,$page=0)
    {
        $box = new Box();
        $limite =10;
        $form = $this -> createForm(BoxType::class,$box);
        $form ->handleRequest($request);
        if($form->isSubmitted()){
            $CountBox=count($Box->findBy(["Num"=>$box->getNum()]));
            if($CountBox != 1)
            {
                $manager = $this -> getDoctrine()->getManager();
                $manager -> persist($box);
                $manager -> flush(); 
                $this->addFlash(
                    "success",
                    "Le Box N° <strong> {$box->getNum()}</strong> à été bien enregistré !"
                );
                return $this->redirectToRoute('Adbox'); 
            }
        }
        $Box= $Box->findBy([],[],$limite,0);
        return $this->render('home/Adtrano.html.twig', [
            "Box"=>$Box,
            'form'=> $form->createView()
        ]);
    }


    #[Route('/AdJiramaBox', name:'JiramaBox')]
    public function AdJirama(JiramaRepository $Jirama, Request $request, $page=1)
    {
        $limite = 10;
        $jirama = new Jirama();
        $form = $this -> createForm(JiramaType::class,$jirama);
        $form ->handleRequest($request);
        foreach($Jirama as $oldJirama){
            $NumOldoldJirama = $oldJirama->getNum();
        }
        if($form->isSubmitted()){
            $manager = $this -> getDoctrine()->getManager();
            $manager -> persist($jirama);
            $manager -> flush(); 
            $this->addFlash(
                "success",
                "Le facture jirama du Box <strong> {$jirama->getJirBox()}</strong> à été bien enregistré !"
            );
            return $this->redirectToRoute('JiramaBox'); 
        }
        $Jirama=$Jirama->findBy([],[],$limite,0);    
        return $this->render('home/AdJirama.html.twig', [
            "Jirama"=>$Jirama,
            'form'=> $form->createView()
        ]);
    }

    #[Route('/AdClient', name:'Client')]
    public function AdClient( Request $request)
    {
        $client = new Client();
        $form = $this -> createForm(ClientType::class,$client);
        $form ->handleRequest($request);
        if($form->isSubmitted()){
            $Slugify = new Slugify();
            $dtDlv=($client->getDateDelivrance())->format("d-m-Y");
            $Slug=$Slugify->slugify($client->getFname().'-'.$dtDlv.'-'.$client->getFilliationMere().'-'.$client->getBox());
            $manager = $this -> getDoctrine()->getManager();
            $client->setSlug($Slug);
            // dd($client);
            $manager -> persist($client);
            $manager -> flush(); 
            $this->addFlash(
                "success",
                "Le client dans le Box <strong> {$client->getBox()}</strong> dont son nom est <strong> {$client->getSlug()}</strong> à été bien enregistré !"
            );
            return $this->redirectToRoute('Client'); 
        }    
        return $this->render('home/AdClient.html.twig', [
            'form'=> $form->createView()
        ]);
    }
    #[Route('/Liste/Client', name:'ListeClient')]
    public function ListeClient(ClientRepository $client)
    {
        $client=$client->findAll();
        // $form = $this -> createForm(SearchClientType::class,$role);
        // $form ->handleRequest($request);
        // if($form->isSubmitted()){
        //     $Slugify = new Slugify();
        //     $Slug = $Slugify->Slugify($role->getTitle());
        //     $manager = $this -> getDoctrine()->getManager();
        //     $role->setSlug($Slug);
        //     $manager -> persist($role);
        //     $manager -> flush(); 
        //     $this->addFlash(
        //         "success",
        //         "Le nouveau rôle d'utilisateur dont <strong> {$role->getTitle()}</strong> à été bien enregistré !"
        //     );
        //     return $this->redirectToRoute('Role'); 
        // }    
        return $this->render('base/listeClient.html.twig', [
            "client"=>$client
        ]);
    }

    #[Route('/AdEmplacement', name:'Site')]
    public function AdSite(EmplacementRepository $Site, Request $request)
    {
        $emplacement = new Emplacement();
        $site=$Site->findAll();
        $form = $this -> createForm(EmplacementType::class,$emplacement);
        $form ->handleRequest($request);
        if($form->isSubmitted()){
            $CountSite=count($Site->findBy(["Situe"=>mb_strtoupper($emplacement->getSitue())]));
            if($CountSite != 1)
            {
                $Slugify = new Slugify();
                $Slug=$Slugify->slugify($emplacement->getSitue());
                $manager = $this -> getDoctrine()->getManager();
                $emplacement->setSlug($Slug);
                $manager -> persist($emplacement);
                $manager -> flush(); 
                $this->addFlash(
                    "success",
                    "Bien enregistré !"
                );
                return $this->redirectToRoute('Site'); 
            }
            
        }    
        return $this->render('home/AdEmplacement.html.twig', [
            'site'=> $site,
            'form'=> $form->createView()
        ]);
    }

    #[Route('/AdRole', name:'Role')]
    public function AdRole(RoleRepository $Role, Request $request)
    {
        $role = new Role();
        $Role=$Role->findAll();
        $form = $this -> createForm(RoleType::class,$role);
        $form ->handleRequest($request);
        if($form->isSubmitted()){
            $Slugify = new Slugify();
            $Slug = $Slugify->Slugify($role->getTitle());
            $manager = $this -> getDoctrine()->getManager();
            $role->setSlug($Slug);
            $manager -> persist($role);
            $manager -> flush(); 
            $this->addFlash(
                "success",
                "Le nouveau rôle d'utilisateur dont <strong> {$role->getTitle()}</strong> à été bien enregistré !"
            );
            return $this->redirectToRoute('Role'); 
        }    
        return $this->render('home/AdRole.html.twig', [
            "Role"=>$Role,
            'form'=> $form->createView()
        ]);
    }
}
