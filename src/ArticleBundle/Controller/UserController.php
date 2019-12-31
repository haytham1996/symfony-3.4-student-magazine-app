<?php

namespace ArticleBundle\Controller;

use ArticleBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    /**
     * @Route("/home")
     * @Method("POST")
     */
    public function newAction(Request $request)
    {
       $user= new User();
       /*
       if($request->isMethod('POST') ) {
           $user->setMail($request->get('mail')) ;
           $em=$this->getDoctrine()->getManager() ;
           $em->persist($user) ;
           $em-> flush();
           var_dump($user);
           return $this->render('@Article/Default/index.html.twig');
       }*/

       $form=$this->createFormBuilder($user) ;
       $form->add('mail')->add('save', SubmitType::class)->getForm();
       $form->handleRequest($request) ;
       if($form->isValid() && $form->isSubmitted())
       {
           $em=$this->getDoctrine()->getManager() ;
           $em->persist($user) ;
           $em->flush() ;
           return $this->redirectToRoute('homepage');
       }
       return $this->render('@Article/Default/index.html.twig' , array($form->createView())) ;


    }
    /**
     * @Route("/home")
     * @Method("POST")
     */
    public function newsletterAction(Request $request)
    {
        $user= new User();
        /*
        if($request->isMethod('POST') ) {
            $user->setMail($request->get('mail')) ;
            $em=$this->getDoctrine()->getManager() ;
            $em->persist($user) ;
            $em-> flush();
            var_dump($user);
            return $this->render('@Article/Default/index.html.twig');
        }*/

        $form=$this->createFormBuilder($user) ;
        $form->handleRequest($request) ;
        if($form->isSubmitted() && $form->isValid())
        {
            $em=$this->getDoctrine()->getManager() ;
            $em->persist($user) ;
            $em->flush() ;
            return $this->redirectToRoute('homepage');
        }
        return $this->render('base.html.twig' , array(
            'form'=>$form->createView())) ;


    }



}
