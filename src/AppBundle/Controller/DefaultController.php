<?php

namespace AppBundle\Controller;

use ArticleBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request , $formIsSubmitted)
    {
        $formIsSubmitted=0 ;
        // replace this example code with whatever you need
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
        $form=$this->createForm('ArticleBundle\Form\UserType',$user) ;
        $form->handleRequest($request) ;
        if($form->isSubmitted() && $form->isValid())
        {
            $formIsSubmitted=1 ;
            $em=$this->getDoctrine()->getManager() ;
            $em->persist($user) ;
            $em->flush() ;
            return $this->redirectToRoute('homepage');
        }
        $em=$this->getDoctrine()->getManager() ;
        $categories=$em->getRepository('ArticleBundle:Category')->findAll();
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'categories'=>$categories,
            'formIsSubmitted'=>$formIsSubmitted ,
            'form'=>$form->createView() ,
        ]);
    }
}
