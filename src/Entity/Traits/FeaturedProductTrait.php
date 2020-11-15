<?php

declare(strict_types=1);

namespace VaaChar\SyliusFeaturedProductsPlugin\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use VaaChar\SyliusFeaturedProductsPlugin\Entity\FeaturedProductInterface;

trait FeaturedProductTrait
{
    /**
     * @var FeaturedProductInterface|null
     *
     * @ORM\OneToOne(targetEntity="VaaChar\SyliusFeaturedProductsPlugin\Entity\FeaturedProduct", inversedBy="product", cascade={"all"})
     * @ORM\JoinColumn(name="featured_product_id", referencedColumnName="id")
     */
    protected $featuredProduct;

    public function getFeaturedProduct(): ?FeaturedProductInterface
    {
        return $this->featuredProduct;
    }

    public function setFeaturedProduct(?FeaturedProductInterface $featuredProduct): self
    {
        $this->featuredProduct = $featuredProduct;

        return $this;
    }
}
