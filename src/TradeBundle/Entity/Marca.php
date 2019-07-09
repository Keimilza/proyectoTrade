<?php

namespace TradeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Table(name="marca")
 * @ORM\Entity(repositoryClass="TradeBundle\Repository\MarcaRepository")
 */
class Marca
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=100)
     */
    private $description;

    /**
     * One Marca has One Product.
     * @OneToOne(targetEntity="Product", mappedBy="marca")
     * 
     */
    private $product;

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
     * Set description
     *
     * @param string $description
     *
     * @return Marca
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

     /**
     * Set product
     *
     * @param \TradeBundle\Entity\Product $product
     *
     * @return Marca
     */
    public function setProduct(\TradeBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \TradeBundle\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }

}
