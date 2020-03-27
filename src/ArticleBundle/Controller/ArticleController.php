<?php

namespace ArticleBundle\Controller;

use ArticleBundle\Entity\Article;
use ArticleBundle\Entity\Category;
use ArticleBundle\Entity\User;
use ArticleBundle\Form\UserType;

use Symfony\Component\BrowserKit ;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\Date;

class ArticleController extends Controller
{
    public function indexAction(Request $request)
    {     $user=new User();
        $em = $this->getDoctrine()->getManager();

        $articles= $em->getRepository('ArticleBundle:Article')->findMost3Recent();
        $latestArticle=$articles[0] ;
         unset($articles[0]);
         $topArticles = $em->getRepository('ArticleBundle:Article')->findMost3Shared();
         $sixTrendingsArticles=$em->getRepository('ArticleBundle:Article')->findTrendingSix();
         $articlesList=$em->getRepository('ArticleBundle:Article')->find8Aarticles();
         $recentArticles=$em->getRepository('ArticleBundle:Article')->findMost4Recent();
         $popularArticles=$em->getRepository('ArticleBundle:Article')->findPopularArticles();
        $categories=$em->getRepository('ArticleBundle:Category')->findAll();
        $date= new Date();

        /*  return $this->render('base.html.twig', array(
              'categories' => $categories,
          ));*/
       /* foreach ($articles as $key=>$value)
        {
            $value->setCover(base64_encode(stream_get_contents($value->getCover())));
        }*/





        $form=$this->createFormBuilder($user) ;
        $form=$this->createForm('ArticleBundle\Form\UserType',$user) ;
        $form->handleRequest($request) ;
        if($form->isSubmitted() && $form->isValid())
        {
            $em=$this->getDoctrine()->getManager() ;
            $em->persist($user) ;
            $em->flush() ;
            return $this->redirectToRoute('article_homepage');
        }



        return $this->render('@Article/Default/index.html.twig', array(
            'articles' => $articles,
            'latestArticle'=>$latestArticle,
            'topArticles'=>$topArticles,
            'sixTrending'=>$sixTrendingsArticles,
            'articlesList'=>$articlesList,
            'recentArticles'=>$recentArticles ,
            'popularArticles'=>$popularArticles,
          'categories'=>$categories,
            'form'=>$form->createView() ,
            'form2'=>$form->createView(),
            'date'=>$date ,


        ));
    }

    public function showArticleAction(Article $article , Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('ArticleBundle:Category')->findAll();
        $images=$em->getRepository('ArticleBundle:Images')->findImagesByArticle($article->getId());
        $image1=$images[0] ;
     //   $image2=$images[1];
       // $image3=$images[2];
        $recentArticles=$em->getRepository('ArticleBundle:Article')->findMost4Recent();
        $popularArticles=$em->getRepository('ArticleBundle:Article')->findPopularArticles();

        $user=new User();
        $form=$this->createFormBuilder($user) ;

        $form=$this->createForm('ArticleBundle\Form\UserType',$user) ;
        $form->handleRequest($request) ;
        if($form->isSubmitted() && $form->isValid())
        {
            $em=$this->getDoctrine()->getManager() ;
            $em->persist($user) ;
            $em->flush() ;
            return $this->redirectToRoute('show_article', ['id' => $article->getId()]);
        }


        return $this->render('@Article/Default/showArticle.html.twig', array(
            'article' => $article,
            'categories'=>$categories,
            'image1'=>$image1,
               // 'image2'=>$image2,
           // 'image3'=>$image3,
            'recentArticles'=>$recentArticles ,
            'popularArticles'=>$popularArticles,
            'form'=>$form->createView(),

        ));
    }
    public function showCategoryAction(Category $category , Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $articlesInCategory=$em->getRepository('ArticleBundle:Article')->findArticlesinCategory($category->getId());
        $categories = $em->getRepository('ArticleBundle:Category')->findAll();

        $recentArticles=$em->getRepository('ArticleBundle:Article')->findMost4Recent();
        $popularArticles=$em->getRepository('ArticleBundle:Article')->findPopularArticles();



        $user=new User();
        $form=$this->createFormBuilder($user) ;

        $form=$this->createForm('ArticleBundle\Form\UserType',$user) ;
        $form->handleRequest($request) ;
        if($form->isSubmitted() && $form->isValid())
        {
            $em=$this->getDoctrine()->getManager() ;
            $em->persist($user) ;
            $em->flush() ;
            return $this->redirectToRoute('show_category', ['id' => $category->getId()]);
        }


        return $this->render('@Article/Default/showCategory.html.twig', array(

            'category'=>$category,
            'categories'=>$categories,
            'recentArticles'=>$recentArticles ,
            'popularArticles'=>$popularArticles,
            'articlesInCategory'=>$articlesInCategory,
            'form'=>$form->createView(),

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
            $realEntities[$articles->getId()] = [$articles->displayCover(),$articles->getTitle() , $articles->getAuthor()];
        }
        return $realEntities;
    }
}
