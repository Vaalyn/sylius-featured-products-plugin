<?php

declare(strict_types=1);

namespace VaaChar\SyliusFeaturedProductsPlugin\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201115183502 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Create featured product tables and add product relation.';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE vaachar_sylius_featured_products (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vaachar_sylius_featured_product_channels (featured_product_id INT NOT NULL, channel_id INT NOT NULL, INDEX IDX_3C7A73A39B67981F (featured_product_id), INDEX IDX_3C7A73A372F5A1AA (channel_id), PRIMARY KEY(featured_product_id, channel_id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE vaachar_sylius_featured_product_channels ADD CONSTRAINT FK_3C7A73A39B67981F FOREIGN KEY (featured_product_id) REFERENCES vaachar_sylius_featured_products (id)');
        $this->addSql('ALTER TABLE vaachar_sylius_featured_product_channels ADD CONSTRAINT FK_3C7A73A372F5A1AA FOREIGN KEY (channel_id) REFERENCES sylius_channel (id)');
        $this->addSql('ALTER TABLE sylius_product ADD featured_product_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sylius_product ADD CONSTRAINT FK_677B9B749B67981F FOREIGN KEY (featured_product_id) REFERENCES vaachar_sylius_featured_products (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_677B9B749B67981F ON sylius_product (featured_product_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sylius_product DROP FOREIGN KEY FK_677B9B749B67981F');
        $this->addSql('ALTER TABLE vaachar_sylius_featured_product_channels DROP FOREIGN KEY FK_3C7A73A39B67981F');
        $this->addSql('DROP TABLE vaachar_sylius_featured_products');
        $this->addSql('DROP TABLE vaachar_sylius_featured_product_channels');
        $this->addSql('DROP INDEX UNIQ_677B9B749B67981F ON sylius_product');
        $this->addSql('ALTER TABLE sylius_product DROP featured_product_id');
    }
}
