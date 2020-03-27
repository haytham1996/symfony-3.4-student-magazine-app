<?php

namespace ArticleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Validator\Constraints\Date;

class CategoryController extends Controller
{
    public function  indexAction()
    {
        $em=$this->getDoctrine()->getManager();
        $categories=$em->getRepository('ArticleBundle:Category')->findAll();


        return $this->render('base.html.twig', array(
            'categories' => $categories,

        ));
    }
}
