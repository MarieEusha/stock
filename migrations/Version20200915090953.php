<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200915090953 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP id_article');
        $this->addSql('ALTER TABLE storage DROP id_storage');
        $this->addSql('ALTER TABLE user DROP id_user');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article ADD id_article INT NOT NULL');
        $this->addSql('ALTER TABLE storage ADD id_storage INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD id_user INT NOT NULL');
    }
}
