<?php

namespace ArticleBundle\Controller;

use ArticleBundle\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ArticleBundle\Controller\ArticleController;
use ArticleBundle\Repository\ArticleRepository;

class DefaultController extends Controller
{
    public function indexAction()
    {    $em = $this->getDoctrine()->getManager();

        $articles= $em->getRepository('ArticleBundle:Article')->findMost3Viewed();
        return $this->render('@Article/Default/index.html.twig', array(
            'articles' => $articles,


        ));

    }
}
