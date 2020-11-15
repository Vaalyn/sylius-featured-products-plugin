<?php

declare(strict_types=1);

namespace VaaChar\SyliusFeaturedProductsPlugin\Menu;

use Sylius\Bundle\AdminBundle\Event\ProductMenuBuilderEvent;

class AdminProductFormMenuListener
{
    public function addItems(ProductMenuBuilderEvent $event): void
    {
        $menu = $event->getMenu();

        $menu->addChild('featured_product')
            ->setAttribute('template', '@SyliusFeaturedProductsPlugin/Admin/Product/Tab/_featuredProduct.html.twig')
            ->setLabel('sylius_featured_products_plugin.ui.featured');
    }
}
