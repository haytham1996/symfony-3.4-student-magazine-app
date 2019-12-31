<?php

namespace ArticleBundle\Controller;

use ArticleBundle\Entity\Article;
use http\Env\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ArticleBundle\Controller\ArticleController;
use ArticleBundle\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {    $em = $this->getDoctrine()->getManager();

        $articles= $em->getRepository('ArticleBundle:Article')->findMost3Viewed();
        return $this->render('@Article/Default/index.html.twig', array(
            'articles' => $articles,


        ));


    }



    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $requestString = $request->get('q');
        $articles =  $em->getRepository('ArticleBundle:Article')->findEntitiesByString($requestString);
        if(!$articles) {
            $result['articles']['error'] = "article Not found :( ";
        } else {
            $result['articles'] = $this->getRealEntities($articles);
        }
        return new Response(json_encode($result));
    }
    public function getRealEntities($articles){
        foreach ($articles as $articles){
            $realEntities[$articles->getId()] = [$articles->displayCover(),$articles->getTitle()];
        }
        return $realEntities;
    }
}
