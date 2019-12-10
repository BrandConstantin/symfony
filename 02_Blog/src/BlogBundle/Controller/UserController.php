<?php

namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use BlogBundle\Entity\User;
use BlogBundle\Form\UserType;

class UserController extends Controller
{
    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get("security.authentication_utils");
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        //creamos formulario
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if($form->isValid()){
            $status = "Usuario registrado correctamente";
        }else{
            $status = "No te has registrado correctamente";
        }

        return $this->render('BlogBundle:User:login.html.twig', array(
            "error"=>$error,
            "last_username"=>$lastUsername,
            "form"=>$form->createView()
        ));
    }
}