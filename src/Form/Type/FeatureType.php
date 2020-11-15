<?php

declare(strict_types=1);

namespace VaaChar\SyliusFeaturedProductsPlugin\Form\Type;

use Sylius\Bundle\ChannelBundle\Form\Type\ChannelChoiceType;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\FormBuilderInterface;

class FeatureType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('channels', ChannelChoiceType::class, [
            'required' => true,
            'multiple' => true,
            'expanded' => true,
            'label' => 'sylius_featured_products_plugin.form.product.channels',
        ]);
    }
}
