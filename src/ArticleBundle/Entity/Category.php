<?php

namespace ArticleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="ArticleBundle\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_articles", type="integer", nullable=true)
     */
    private $nbArticles;
    /**
     * @var string
     *
     * @ORM\Column(name="cover", type="string")
     */
    private $cover;
    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string")
     */
    private $color;

    /**
     * @var string
     *
     * @ORM\Column(name="css_class", type="string")
     */
    private $cssClass;

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * @return string
     */



    public function getCssClassTwo()
    {
        return $this->CssClassTwo;
    }

    /**
     * @param string $CssClassTwo
     */
    public function setCssClassTwo($CssClassTwo)
    {
        $this->CssClassTwo = $CssClassTwo;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="css_class_two", type="string")
     */
    private $CssClassTwo;

    /**
     * @return string
     */
    public function getCssClass()
    {
        return $this->cssClass;
    }

    /**
     * @param string $cssClass
     */
    public function setCssClass($cssClass)
    {
        $this->cssClass = $cssClass;
    }



    /**
     * @return string
     */
    public function getCover()
    {
        return $this->cover;
    }

    /**
     * @param string $cover
     */
    public function setCover($cover)
    {
        $this->cover = $cover;
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set nbArticles
     *
     * @param integer $nbArticles
     *
     * @return Category
     */
    public function setNbArticles($nbArticles)
    {
        $this->nbArticles = $nbArticles;

        return $this;
    }

    /**
     * Get nbArticles
     *
     * @return integer
     */
    public function getNbArticles()
    {
        return $this->nbArticles;
    }

    /**
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param string $color
     */
    public function setColor($color)
    {
        $this->color = $color;
    }

}
