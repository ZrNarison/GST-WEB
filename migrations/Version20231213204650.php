<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231213204650 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, fname VARCHAR(255) NOT NULL, lname VARCHAR(255) DEFAULT NULL, date_naissance DATE NOT NULL, lieu_naissance VARCHAR(255) NOT NULL, piece_justificatif VARCHAR(255) NOT NULL, date_delivrance DATE NOT NULL, lieu_delivrance VARCHAR(255) NOT NULL, filliation_pere VARCHAR(255) NOT NULL, filliation_mere VARCHAR(255) NOT NULL, profession VARCHAR(255) NOT NULL, date_vente DATE NOT NULL, caution DOUBLE PRECISION DEFAULT NULL, adresse VARCHAR(255) NOT NULL, telephone DOUBLE PRECISION DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, situation_famille VARCHAR(255) DEFAULT NULL, epous VARCHAR(255) DEFAULT NULL, enfants VARCHAR(255) DEFAULT NULL, nif VARCHAR(255) DEFAULT NULL, stat VARCHAR(255) DEFAULT NULL, rcs VARCHAR(255) DEFAULT NULL, compte_banque VARCHAR(255) DEFAULT NULL, activite VARCHAR(255) NOT NULL, role_activite VARCHAR(255) NOT NULL, nombre_responsable DOUBLE PRECISION NOT NULL, materiel_utiliser VARCHAR(255) DEFAULT NULL, duree_materiel VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE box ADD box_client_id INT NOT NULL');
        $this->addSql('ALTER TABLE box ADD CONSTRAINT FK_8A9483AC801C912 FOREIGN KEY (box_client_id) REFERENCES client (id)');
        $this->addSql('CREATE INDEX IDX_8A9483AC801C912 ON box (box_client_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE box DROP FOREIGN KEY FK_8A9483AC801C912');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP INDEX IDX_8A9483AC801C912 ON box');
        $this->addSql('ALTER TABLE box DROP box_client_id');
    }
}
