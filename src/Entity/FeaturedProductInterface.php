<?php

declare(strict_types=1);

namespace VaaChar\SyliusFeaturedProductsPlugin\Entity;

use Doctrine\Common\Collections\Collection;
use Sylius\Component\Channel\Model\ChannelInterface;
use Sylius\Component\Product\Model\ProductInterface;

interface FeaturedProductInterface
{
    public function getId(): ?int;

    public function getProduct(): ProductInterface;

    public function setProduct(ProductInterface $product): self;

    public function getChannels(): Collection;

    public function addChannel(ChannelInterface $channel): self;

    public function removeChannel(ChannelInterface $channel): self;

    public function hasChannel(ChannelInterface $channel): bool;
}
