<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200917081558 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `stored` ADD articles_id INT DEFAULT NULL, ADD storages_id INT DEFAULT NULL, DROP id_storage, DROP id_article');
        $this->addSql('ALTER TABLE `stored` ADD CONSTRAINT FK_5643F90B1EBAF6CC FOREIGN KEY (articles_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE `stored` ADD CONSTRAINT FK_5643F90B1722EBBA FOREIGN KEY (storages_id) REFERENCES storage (id)');
        $this->addSql('CREATE INDEX IDX_5643F90B1EBAF6CC ON `stored` (articles_id)');
        $this->addSql('CREATE INDEX IDX_5643F90B1722EBBA ON `stored` (storages_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `stored` DROP FOREIGN KEY FK_5643F90B1EBAF6CC');
        $this->addSql('ALTER TABLE `stored` DROP FOREIGN KEY FK_5643F90B1722EBBA');
        $this->addSql('DROP INDEX IDX_5643F90B1EBAF6CC ON `stored`');
        $this->addSql('DROP INDEX IDX_5643F90B1722EBBA ON `stored`');
        $this->addSql('ALTER TABLE `stored` ADD id_storage INT NOT NULL, ADD id_article INT NOT NULL, DROP articles_id, DROP storages_id');
    }
}
