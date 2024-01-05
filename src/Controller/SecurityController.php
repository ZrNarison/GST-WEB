<?php

namespace App\Controller;

use App\Entity\PasswordUpdate;
use App\Form\ResetPasswordType;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    #[Route('/Connexion', name: 'login')]
    #[Route('/login')]
    public function login(AuthenticationUtils $verify){
        $err =$verify->getLastAuthenticationError();
        $username=$verify->getLastUsername();
        return $this->render('security/index.html.twig', [
            'MesErreur'=>$err!==null,
            'uti'=>$username
        ]);
    }

    #[Route('/Reinitialisation', name: 'reset')]
    public function reset(Request $request,UserRepository $user,UserPasswordEncoderInterface $encoder)
    {   
        $modpass = new PasswordUpdate();
        $form=$this->createForm(ResetPasswordType::class, $modpass);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
            $newmail=$form->get('mail')->getData();
            
            $User=$user->findOneBy(["mail"=>$newmail]);
            $oldUser=$user->findOneBy(["mail"=>$newmail]);
        if($oldUser == null )
        {
            //Afficher une erreur
            $this->addFlash(
                "danger","L'email que vous avez introduit n'est pas votre adresse !");
            return $this->redirectToRoute("reset");
        }else{
            //Modifier le code 
            $oldmail=$User->getMail();
            $newPassword = $modpass->getnewPassword();
            $hash = $encoder -> encodePassword($User,$newPassword);
            $User->setHash($hash);
            $Manager = $this -> getDoctrine()->getManager();
            $Manager -> persist($User);            
            $Manager -> flush();
        }
        //Retourner vers l'accueil
        return $this->redirectToRoute("login_account");    
    }
        return $this->render("login/passwordreset.html.twig",[
            "form"=> $form->createView()
        ]);
    }

    #[Route('/exit', name: 'exit')]
    public function logout(): Response
    {
        return $this->render('security/index.html.twig', [
            'controller_name' => 'SecurityController',
        ]);
    }
}
