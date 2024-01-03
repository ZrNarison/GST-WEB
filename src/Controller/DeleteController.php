<?php

namespace App\Controller;

use App\Entity\Box;
use App\Form\BoxType;
use App\Repository\BoxRepository;
use App\Repository\ClientRepository;
use App\Repository\JiramaRepository;
use Doctrine\Persistence\ObjectManager;
use App\Repository\EmplacementRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DeleteController extends AbstractController
{
    #[Route('/deleteBox{slug}', name: 'delbox')]
    public function deletebox(string $slug,BoxRepository $Box,ClientRepository $Client,JiramaRepository $jirama,Request $request,$page=0): Response
    {
        $manager = $this -> getDoctrine()->getManager();
        $SelectOneBox= $Box->findOneBy(['id'=>$slug]);
        $manager->remove($SelectOneBox);
        $manager->flush();
        return $this->redirectToRoute('Adbox'); 
    }

    #[Route('/deleteEmplacement{siteid}', name: 'delsite')]
    public function delsite(string $siteid,BoxRepository $Box,EmplacementRepository $emplacement): Response
    {
        
        $emplacement= $emplacement->findOneBy(['id'=>$siteid]);
        $manager = $this -> getDoctrine()->getManager();
        $manager->remove($emplacement);
        $manager->flush();
        return $this->redirectToRoute('Site'); 
    }

    #[Route('/deletejirama{jiroid}', name: 'deljirama')]
    public function deljiro(string $jiroid,JiramaRepository $jirama,EmplacementRepository $emplacement): Response
    {
        
        $jirama= $jirama->findOneBy(['id'=>$jiroid]);
        $manager = $this -> getDoctrine()->getManager();
        $manager->remove($jirama);
        $manager->flush();
        return $this->redirectToRoute('JiramaBox');
    }

    #[Route('/deleteClient{Slug}', name: 'delClient')]
    public function delclient(string $Slug,ClientRepository $Client,JiramaRepository $jirama): Response
    {
        
        $OldClient= $Client->findOneBy(['id'=>$Slug]);
        $VerJirama=count($Factjirama= $jirama->findBy(['JirBox'=>$Slug]));
        // dd($VerJirama);
        if($VerJirama < 1 ){
            // dd( 'Mois de 1');
            $manager = $this -> getDoctrine()->getManager();
            $manager->remove($OldClient);
            $manager->flush();
        }else{
            $this->addFlash(
                    "",
                    "<h2>Impossible de supprimer le client, car il avait une autre !</h2>"
                );
        }
        return $this->redirectToRoute('ListeClient');
    }
}
