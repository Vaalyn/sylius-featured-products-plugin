<?php

declare(strict_types=1);

namespace VaaChar\SyliusFeaturedProductsPlugin\Twig\Extension;

use Sylius\Component\Core\Model\ChannelInterface;
use Symfony\Component\Templating\EngineInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class RenderFeaturedProductsExtension extends AbstractExtension
{
    /** @var EngineInterface */
    protected $templatingEngine;

    public function __construct(
        EngineInterface $templatingEngine
    ) {
        $this->templatingEngine = $templatingEngine;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction(
                'vaachar_render_featured_products',
                [$this, 'renderFeaturedProducts'],
                ['is_safe' => ['html']
            ]),
        ];
    }

    public function renderFeaturedProducts(
        ChannelInterface $channel,
        int $featuredProductsCount = 4,
        ?string $template = null
    ): string {
        $featuredProducts = [];

        $template = $template ?? '@SyliusFeaturedProductsPlugin/Shop/featuredProducts.html.twig';

        return $this->templatingEngine->render($template, ['featuredProducts' => $featuredProducts]);
    }
}
