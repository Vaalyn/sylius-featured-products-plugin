<?php

declare(strict_types=1);

namespace VaaChar\SyliusFeaturedProductsPlugin\Entity;

interface HasFeaturedProductInterface
{
    public function getFeaturedProduct(): ?FeaturedProductInterface;

    public function setFeaturedProduct(?FeaturedProductInterface $featuredProduct): self;
}
