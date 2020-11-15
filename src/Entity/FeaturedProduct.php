<?php

declare(strict_types=1);

namespace VaaChar\SyliusFeaturedProductsPlugin\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Channel\Model\ChannelInterface;
use Sylius\Component\Product\Model\ProductInterface;
use Sylius\Component\Resource\Model\ResourceInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="vaachar_sylius_featured_products")
 */
class FeaturedProduct implements ResourceInterface, FeaturedProductInterface
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     *
     * @var int
     */
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity="Sylius\Component\Core\Model\ProductInterface", mappedBy="featuredProduct")
     *
     * @var ProductInterface
     */
    protected $product;

    /**
     * @ORM\ManyToMany(targetEntity="Sylius\Component\Core\Model\ChannelInterface")
     * @ORM\JoinTable(name="vaachar_sylius_featured_product_channels",
     *     joinColumns={@ORM\JoinColumn(name="featured_product_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="channel_id", referencedColumnName="id")}
     * )
     *
     * @var Collection|ChannelInterface[]
     */
    protected $channels;

    public function __construct()
    {
        $this->channels = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduct(): ProductInterface
    {
        return $this->product;
    }

    public function setProduct(ProductInterface $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getChannels(): Collection
    {
        return $this->channels;
    }

    public function addChannel(ChannelInterface $channel): self
    {
        if (!$this->hasChannel($channel)) {
            $this->channels->add($channel);
        }

        return $this;
    }

    public function removeChannel(ChannelInterface $channel): self
    {
        if ($this->hasChannel($channel)) {
            $this->channels->removeElement($channel);
        }

        return $this;
    }

    public function hasChannel(ChannelInterface $channel): bool
    {
        return $this->channels->contains($channel);
    }
}
