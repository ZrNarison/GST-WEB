<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240102113942 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE paramettre (id INT AUTO_INCREMENT NOT NULL, application VARCHAR(255) NOT NULL, representant VARCHAR(255) NOT NULL, localisation VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, responsable VARCHAR(255) NOT NULL, entete VARCHAR(255) NOT NULL, courant DOUBLE PRECISION NOT NULL, sjirama DOUBLE PRECISION NOT NULL, ssp DOUBLE PRECISION NOT NULL, redevence DOUBLE PRECISION NOT NULL, prime_fixe DOUBLE PRECISION NOT NULL, redv DOUBLE PRECISION NOT NULL, consommation DOUBLE PRECISION NOT NULL, tva DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE paramettre');
    }
}
