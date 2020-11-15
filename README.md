<p align="center">
    <a href="https://sylius.com" target="_blank">
        <img src="https://demo.sylius.com/assets/shop/img/logo.png" />
    </a>
</p>

<h1 align="center">Sylius Featured Products Plugin</h1>

<p align="center">Plugin to configure products that should be featured in a channel.</p>

## Quickstart Installation

1. Require plugin via Composer
```
composer require vaachar/sylius-featured-products-plugin
```
2. Inlcude config.yaml in `_sylius.yaml`
```
- { resource: "@SyliusFeaturedProductsPlugin/Resources/config/config.yaml" }
```

3. Use trait and add interface to `src/Entity/Product/Product.php`
```
class Product extends BaseProduct implements HasFeaturedProductInterface
{
    use FeaturedProductTrait;

    ...
}
```

4. Execute migrations
```
bin/console doctrine:migrations:migrate
```

5. Use twig macro to add featured products to a page
```
{{ sylius_render_featured_products() }}
```

**Example:**
```
<h2 class="ui huge horizontal section divider inverted header">{{ 'sylius_featured_products_plugin.ui.featured_products'|trans }}</h2>

<div {{ sylius_test_html_attribute('featured-products') }}>
    {{ sylius_render_featured_products() }}
</div>
<div class="ui hidden divider"></div>
```
