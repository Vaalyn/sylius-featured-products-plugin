<?php

declare(strict_types=1);

namespace VaaChar\SyliusFeaturedProductsPlugin\Form;

use Sylius\Bundle\ProductBundle\Form\Type\ProductType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;
use VaaChar\SyliusFeaturedProductsPlugin\Form\Type\FeatureType;

class ProductTypeExtension extends AbstractTypeExtension
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('featuredProduct', FeatureType::class, [
            'label' => false,
        ]);
    }

    public static function getExtendedTypes(): iterable
    {
        yield ProductType::class;
    }
}
