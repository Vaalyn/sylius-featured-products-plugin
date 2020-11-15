<?php

declare(strict_types=1);

namespace VaaChar\SyliusFeaturedProductsPlugin\Twig\Extension;

use Sylius\Component\Channel\Context\ChannelContextInterface;
use Symfony\Component\Templating\EngineInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use VaaChar\SyliusFeaturedProductsPlugin\Repository\FeaturedProductRepository;

class RenderFeaturedProductsExtension extends AbstractExtension
{
    /** @var FeaturedProductRepository */
    protected $featuredProductRepository;

    /** @var ChannelContextInterface */
    protected $channelContext;

    /** @var EngineInterface */
    protected $templatingEngine;

    public function __construct(
        FeaturedProductRepository $featuredProductRepository,
        ChannelContextInterface $channelContext,
        EngineInterface $templatingEngine
    ) {
        $this->featuredProductRepository = $featuredProductRepository;
        $this->channelContext = $channelContext;
        $this->templatingEngine = $templatingEngine;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction(
                'sylius_render_featured_products',
                [$this, 'renderFeaturedProducts'],
                ['is_safe' => ['html']
            ]),
        ];
    }

    public function renderFeaturedProducts(
        int $featuredProductsCount = 3,
        ?string $template = null
    ): string {
        $channel = $this->channelContext->getChannel();

        $featuredProducts = $this->featuredProductRepository->fetchForChannel(
            $channel,
            $featuredProductsCount
        );

        $template = $template ?? '@SyliusFeaturedProductsPlugin/Shop/featuredProducts.html.twig';

        return $this->templatingEngine->render($template, ['featuredProducts' => $featuredProducts]);
    }
}
