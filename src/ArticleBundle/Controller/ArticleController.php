<?php

namespace ArticleBundle\Controller;

use ArticleBundle\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ArticleController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $articles= $em->getRepository('ArticleBundle:Article')->findMost3Recent();
        $latestArticle=$articles[0] ;
         unset($articles[0]);
         $topArticles = $em->getRepository('ArticleBundle:Article')->findMost3Shared();
         $sixTrendingsArticles=$em->getRepository('ArticleBundle:Article')->findTrendingSix();
         $articlesList=$em->getRepository('ArticleBundle:Article')->find8Aarticles();
         $recentArticles=$em->getRepository('ArticleBundle:Article')->findMost4Recent();

        return $this->render('@Article/Default/index.html.twig', array(
            'articles' => $articles,
            'latestArticle'=>$latestArticle,
            'topArticles'=>$topArticles,
            'sixTrending'=>$sixTrendingsArticles,
            'articlesList'=>$articlesList,
            'recentArticles'=>$recentArticles ,


        ));
    }

    public function showArticleAction(Article $article)
    {
        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('ArticleBundle:Category')->findAll();
        return $this->render('@Article/Default/showArticle.html.twig', array(
            'article' => $article,
            'categories'=>$categories,
        ));
    }
}
