<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230320150349 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `option` ADD product_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `option` ADD CONSTRAINT FK_5A8600B04584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_5A8600B04584665A ON `option` (product_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `option` DROP FOREIGN KEY FK_5A8600B04584665A');
        $this->addSql('DROP INDEX IDX_5A8600B04584665A ON `option`');
        $this->addSql('ALTER TABLE `option` DROP product_id');
    }
}
