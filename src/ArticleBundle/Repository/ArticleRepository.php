<?php

namespace ArticleBundle\Repository;

/**
 * ArticleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ArticleRepository extends \Doctrine\ORM\EntityRepository
{
    public function findMost3Shared()
    {
        $q=$this->getEntityManager()->createQuery("select v from ArticleBundle:Article v 
              ORDER BY v.share DESC  ")->setMaxResults(3);
        return $q->getResult();
    }
    public function findMost3Recent()
    {
        $q=$this->getEntityManager()->createQuery("select v FROM  ArticleBundle:Article v 
 ORDER BY v.date DESC  ")->setMaxResults(4);
        return $q->getResult();
    }
    public function findMostRecent()
    {
        $q=$this->getEntityManager()->createQuery("select v FROM  ArticleBundle:Article v 
 ORDER BY v.date DESC  ")->setMaxResults(1);
        return $q->getResult();
    }

   public function findTrendingSix()
    {
        $q=$this->getEntityManager()->createQuery("select v FROM  ArticleBundle:Article v 
 ORDER BY v.views DESC  ")->setMaxResults(6);
        return $q->getResult();

    }
    public function find8Aarticles()
    {
        $q=$this->getEntityManager()->createQuery("select v FROM  ArticleBundle:Article v 
 ORDER BY v.date DESC  ")->setMaxResults(8);
        return $q->getResult();
    }
    public function findMost4Recent()
    {
        $q=$this->getEntityManager()->createQuery("select v FROM  ArticleBundle:Article v 
 ORDER BY v.date DESC  ")->setMaxResults(5);
        return $q->getResult();
    }

    public function  findPopularArticles()
    {
        $q=$this->getEntityManager()->createQuery("select v FROM  ArticleBundle:Article v 
 ORDER BY v.share DESC  ")->setMaxResults(4);
        return $q->getResult();
    }
        public function findArticlesinCategory($idCat)
        {
            $q=$this->getEntityManager()->createQuery("select v FROM  ArticleBundle:Article v 
     where v.category= :idCat ")->setParameter('idCat', $idCat)->setMaxResults(8);
            return $q->getResult();
        }
    public function find4Categories()
    {
        $q=$this->getEntityManager()->createQuery("select v FROM  ArticleBundle:Article v 
     where v.category= :idCat ")->setParameter('idCat', $idCat)->setMaxResults(8);
        return $q->getResult();
    }

    public function findEntitiesByString($str){
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p
                FROM ArticleBundle:Article p
                WHERE p.title LIKE :str'
            )
            ->setParameter('str', '%'.$str.'%')
            ->getResult();
    }
}
