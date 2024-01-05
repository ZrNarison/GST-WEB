<?php

namespace App\Controller;

use App\Entity\Box;
use App\Entity\Role;
use App\Form\BoxType;
use App\Entity\Client;
use App\Entity\Filtre;
use App\Entity\Jirama;
use App\Form\RoleType;
use App\Form\ClientType;
use App\Form\FilterType;
use App\Form\JiramaType;
use Cocur\Slugify\Slugify;
use App\Entity\Emplacement;
use App\Form\ParamettreType;
use App\Form\EmplacementType;
use App\Form\ClientFiltreType;
use App\Repository\BoxRepository;
use App\Repository\RoleRepository;
use App\Repository\ClientRepository;
use App\Repository\JiramaRepository;
use Doctrine\Persistence\ObjectManager;
use App\Repository\ParamettreRepository;
use App\Repository\EmplacementRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    #[Security("is_granted('ROLE_USER') or is_granted('ROLE_SUPERADMIN')or is_granted('ROLE_ADMIN')")]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/AdBox', name:'Adbox')]
    #[Security("is_granted('ROLE_USER') or is_granted('ROLE_SUPERADMIN')")]
    public function Adtrano(BoxRepository $Box,Request $request,$page=0)
    {
        $box = new Box();
        $limite =9;
        $form = $this -> createForm(BoxType::class,$box);
        $form ->handleRequest($request);
        if($form->isSubmitted()){
            $CountBox=count($Box->findBy(["Num"=>$box->getNum()]));
            if($CountBox < 1){
                $manager = $this -> getDoctrine()->getManager();
                $manager -> persist($box);
                $manager -> flush(); 
                // $this->addFlash(
                //     "success",
                //     "Le Box N° <strong> {$box->getNum()}</strong> à été bien enregistré !"
                // );
                return $this->redirectToRoute('Adbox'); 
            }else{
                $this->addFlash("","<h2>Le Box N° <strong> {$box->getNum()}</strong> sont déjà enregistré !</h2>");
            }
        }
        $Box= $Box->findBy([],[],$limite,0);
        return $this->render('home/Adtrano.html.twig', [
            "Box"=>$Box,
            'form'=> $form->createView()
        ]);
    }


    #[Route('/AdJiramaBox', name:'JiramaBox')]
    #[Security("is_granted('ROLE_USER') or is_granted('ROLE_SUPERADMIN')")]
    public function AdJirama(JiramaRepository $Jirama, Request $request, $page=0)
    {
        $limite = 7;
        $jirama = new Jirama();
        $Box = new Filtre (); 
        $filtre = $this -> createForm(FilterType::class,$Box);
        $form = $this -> createForm(JiramaType::class,$jirama);
        $form ->handleRequest($request);
        $filtre ->handleRequest($request);
        foreach($Jirama as $oldJirama){
            $NumOldoldJirama = $oldJirama->getNum();
        }
        if($form->isSubmitted()){
            $Slug = $form->get('JirBox')->getData()."-".($form->get('PresDate')->getData())->Format("d-m-Y")."-".$form->get('ValIndex')->getData()."-".($form->get('FactDate')->getData())->Format("d-m-Y")."-".$form->get('Consomation')->getData();
            $Verify = count($Old=$Jirama->findBy(['Slug'=>$Slug]));
            if($Verify < 1){
                $OneOld=($Jirama->findBy(['JirBox'=>$jirama->getJirBox() ]));
                foreach($OneOld as $OneOld){}
                $verDate=$OneOld->getFactDate();
                
                if($jirama->getPresDate()  == $verDate){
                    if($jirama->getPresDate()  < $jirama->getFactDate()){
                        $manager = $this -> getDoctrine()->getManager();
                        $jirama->setSlug($Slug);
                        $manager -> persist($jirama);
                        $manager -> flush(); 
                        return $this->redirectToRoute('JiramaBox');
                    }else{$this->addFlash("","<h2>Le facture jirama du Box <strong> {$jirama->getJirBox()}</strong> du {$jirama->getPresDate()->Format("d-m-Y")} au {$jirama->getFactDate()->Format("d-m-Y")} est incorrect, merci de verifié la date du rélévé!</h2>");};
            }else{$this->addFlash("","<h2>Le facture jirama du Box <strong> {$jirama->getJirBox()}</strong> du {$jirama->getPresDate()->Format("d-m-Y")} au {$jirama->getFactDate()->Format("d-m-Y")} est incorrect, merci de verifié la date du rélévé!</h2>");};
                
            }else{$this->addFlash("","<h2>Le facture jirama du Box <strong> {$jirama->getJirBox()}</strong> du {$jirama->getPresDate()->Format("d-m-Y")} au {$jirama->getFactDate()->Format("d-m-Y")} sont déjà enregistré !</h2>");}
        }
        if($filtre->isSubmitted()){
            $Datebox=($filtre->get('DateFilter')->getData())->getFactDate();
            $Jirama =$Jirama->findBy(['FactDate'=> $Datebox]);
            return $this->render('home/AdJirama.html.twig', [
                "Jirama"=>$Jirama,
                'form'=> $form->createView(),
                'filtre'=> $filtre->createView()
            ]);
        }
        $Jirama=$Jirama->findBy([],[],$limite,0);    
        return $this->render('home/AdJirama.html.twig', [
            "Jirama"=>$Jirama,
            'form'=> $form->createView(),
            'filtre'=> $filtre->createView()
        ]);
    }

    #[Route('/AdClient', name:'Client')]
    #[Security("is_granted('ROLE_USER') or is_granted('ROLE_SUPERADMIN')")]
    public function AdClient( Request $request,ClientRepository $BoxClient)
    {
        $client = new Client();
        $Box = new Box();
        $form = $this -> createForm(ClientType::class,$client);
        $form ->handleRequest($request);
        if($form->isSubmitted()){
            $Slugify = new Slugify();
            $dtDlv=($client->getDateNaissance())->format("d-m-Y");
            $verBClient= count($bClient=$BoxClient->findBy(['Box'=>$client->getBox()]));
            $SlugClient=$Slugify->slugify($client->getFname().'-'.$dtDlv.'-'.$client->getFilliationMere());
            $NewSlug=$Slugify->slugify($SlugClient.'-'.$client->getBox());
            $VerClient = count($ClientBox=$BoxClient->findBy( ['Slug'=>$NewSlug]));
            $VerinfoClient = count($ClientBox=$BoxClient->findBy( ['SlugClient'=>$SlugClient]));
            $manager = $this -> getDoctrine()->getManager();
            if($verBClient > 0){
                $this->addFlash("","<h2>Le Box <strong> {$client->getBox()}</strong> son déjà occupé !</h2>");
            }elseif($VerinfoClient  < 1){
                $client ->setSlug($NewSlug)
                        ->setSlugClient($SlugClient);
                $manager -> persist($client);
                $manager -> flush();
            }elseif($VerClient < 1){
                $client ->setSlug($NewSlug)
                        ->setSlugClient($SlugClient);
                $manager -> persist($client);
                $manager -> flush();
                return $this->redirectToRoute('Client'); 
            }else{
                $this->addFlash("","<h2>Le client dans le Box <strong> {$client->getBox()}</strong> dont son nom est <strong> {Uppercase($client->getSlug())}</strong> son déjà enregistré !</h2>");
            }
        }    
        return $this->render('home/AdClient.html.twig', [
            'form'=> $form->createView()
        ]);
    }
    #[Route('/Liste/Client', name:'ListeClient')]
    #[Security("is_granted('ROLE_USER') or is_granted('ROLE_SUPERADMIN')")]
    public function ListeClient(BoxRepository $box,ClientRepository $client, Request $request,$page=0)
    {
        $limite =15;
        $Box = new Filtre (); 
        $form = $this -> createForm(ClientFiltreType::class,$Box);
        $form ->handleRequest($request);
        if($form->isSubmitted()){
            $box=($box->findOneBy(['Num'=> $Box->getBox()]))->getid();
            $client=$client->findBy(['Box'=> $box]);
            return $this->render('base/listeClient.html.twig', [
                "client"=>$client,
                'form'=> $form->createView()
            ]);
        }
        $client=$client->findBy([],[],$limite,0);    
        return $this->render('base/listeClient.html.twig', [
            "client"=>$client,
            'form'=> $form->createView()
        ]);
    }

    #[Route('/AdEmplacement', name:'Site')]
    #[Security("is_granted('ROLE_USER') or is_granted('ROLE_SUPERADMIN')")]
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
                return $this->redirectToRoute('Site'); 
            }else{
                $this->addFlash("","<h2>L'emplacement <strong> {$emplacement->getSitue()}</strong> son déjà dans la liste !</h2>");
            }
            
        }    
        return $this->render('home/AdEmplacement.html.twig', [
            'site'=> $site,
            'form'=> $form->createView()
        ]);
    }

    #[Route('/AdRole', name:'Role')]
    #[Security("is_granted('ROLE_USER') or is_granted('ROLE_SUPERADMIN')")]
    public function AdRole(RoleRepository $Role, Request $request)
    {
        $role = new Role();
        $manager = $this -> getDoctrine()->getManager();
        $form = $this -> createForm(RoleType::class,$role);
        $form ->handleRequest($request);
        if($form->isSubmitted()){
            $Slugify = new Slugify();
            $Slug = $Slugify->Slugify($role->getTitle());
            $CountSlug = count($Role->findBy(["Slug"=>$Slug]));
            if($CountSlug  < 1){
                $role->setSlug($Slug);
                $manager -> persist($role);
                $manager -> flush();
                return $this->redirectToRoute('Role'); 
            }else{$this->addFlash("","<h2>Le rôle <strong> {$role->getTitle()}</strong> son déjà dans la liste !</h2>");}
        }
        $Role=$Role->findAll();    
        return $this->render('home/AdRole.html.twig', [
            "Role"=>$Role,
            'form'=> $form->createView()
        ]);
    }

    #[Route('/AdParamettre', name:'Paramettre')]
    #[Security("is_granted('ROLE_USER') or is_granted('ROLE_SUPERADMIN')")]
    public function AdParamettre(ParamettreRepository $Paramettre, Request $request)
    {
        $paramettre = $Paramettre->findAll();
        foreach($paramettre as $paramettre){};
        $form = $this -> createForm(ParamettreType::class,$paramettre);
        $form ->handleRequest($request);
        if($form->isSubmitted()){
            $manager = $this -> getDoctrine()->getManager();
            $manager -> persist($paramettre);
            $manager -> flush();
            return $this->redirectToRoute('Paramettre'); 
        }    
        return $this->render('home/AdParamettre.html.twig', [
            "paramettre"=>$paramettre,
            'form'=> $form->createView()
        ]);
    }
}
