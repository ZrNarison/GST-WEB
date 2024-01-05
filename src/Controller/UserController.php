<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Form\EditUserType;
use App\Form\PhtoUserType;
use App\Form\PhotoUserType;
use App\Entity\PasswordUpdate;
use App\Form\UpdatePasswordType;
use App\Repository\UserRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    #[Route('/Utilisateur', name: 'user')]
    #[Security("is_granted('ROLE_USER') or is_granted('ROLE_SUPERADMIN')")]
    public function user(UserRepository $User, Request $request,UserPasswordEncoderInterface $encoder): Response
    {
        $user = new User();
        $manager = $this -> getDoctrine()->getManager();
        $form = $this -> createForm(UserType::class,$user);
        $form ->handleRequest($request);
        if($form->isSubmitted()){
            $OldRole = count($User->findBy(["userRole"=>$user->getUserRole()]));
            if($OldRole < 1){
                $directory=$this->getParameter('uploads_directory');
                $image=$form->get('Photo')->getData();;
                $filename=md5(uniqid()).'.'. $image->guessExtension();
                $hash=$encoder->encodePassword($user,$user->getMDP());
                $user->setPhoto($filename)->setMDP($hash);
                $image->move($directory,$filename); 
                $manager -> persist($user);   
                $manager -> flush();
            }else{$this->addFlash("","<h2>Une autre utilsateur son déjà enregistré entant que <strong> {$user->getuserRole()}</strong>, il est impossible d'inscrire à nouveau. Merci de contacter votre WebMaster !</h2>");}
        }
        $User=$User->findAll(); 
        return $this->render('user/index.html.twig', [
            "User"=>$User,
            'controller_name' => 'UserController',
            'form'=> $form->createView()
        ]);
    }

    #[Route('/Edit-Mon-Profil', name: 'Moduser')]
    public function moduser(Request $request): Response
    {
        $user=$this->getUser();
        $form=$this->createForm(EditUserType::class, $user);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
            $mng = $this -> getDoctrine()->getManager();
            $mng -> persist($user);
            $mng -> flush();
            return $this->redirectToRoute("app_home");
        }
        return $this->render("user/User.html.twig",[
            "form"=> $form->createView(),
            'user' => $user
        ]);
    }

    #[Route('/Edit-password', name: 'ModPass')]
    public function modpass(Request $request,UserPasswordEncoderInterface $encoder): Response
    {
        $modpass = new PasswordUpdate();
        $user=$this->getUser();
        $form=$this->createForm(UpdatePasswordType::class, $modpass);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
            $d=$form->get('oldPassword')->getData();
            // dump($d);die;
            // Vérifier que l'ancien mot de pass soit la même qu'avec le formulaire
            if(!password_verify($modpass->getOldPassword(),$user->getMdp()))
            {
                $d->addError(new FormError("Le mot de pass que vous avez taper n'est pas votre mot de pass actuel !"));
            }else{
                //Modifier le code 
                $newPassword = $modpass->getnewPassword();
                $hash = $encoder -> encodePassword($user,$newPassword);
                $user->setMDP($hash);
                $Manager = $this -> getDoctrine()->getManager();
                $Manager -> persist($user);            
                $Manager -> flush();
                $this->addFlash( "","Votre mot de pass a été modifier avec succés !"); 
            }
            return $this->redirectToRoute("app_home");
        }
        return $this->render("user/User.html.twig",[
            "form"=> $form->createView(),
            'user' => $user
        ]);
    }


    #[Route('/Edit-photo', name: 'ModImage')]
    public function modphoto(UserRepository $user, Request $rqt)
    {
        $user = $this->getUser();
        $form=$this->createForm(PhtoUserType::class, $user);
        $form->handleRequest($rqt);
        if($form->isSubmitted()&& $form->isValid()){
            $mng = $this -> getDoctrine()->getManager();
            $fichier = $form->get('Photo')->getData();
            $directory=$this->getParameter('uploads_directory');
            $filename=md5(uniqid()).'.'. $fichier->guessExtension();
            $user->setPhoto($filename)
            ;
            $mng -> persist($user);
            $mng -> persist($user);            
            $fichier->move(
                $directory,
                $filename
            );             
            $mng -> flush();
            return $this->redirectToRoute("app_home");
        }
        return $this->render("user/editphoto.html.twig",[
            "form"=> $form->createView(),
            'user' => $user
        ]);
    }

}
