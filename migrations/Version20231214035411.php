<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231214035411 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, pseudo VARCHAR(255) NOT NULL, mdp VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE box DROP FOREIGN KEY FK_8A9483AC801C912');
        $this->addSql('DROP INDEX IDX_8A9483AC801C912 ON box');
        $this->addSql('ALTER TABLE box ADD client_box_id INT DEFAULT NULL, DROP box_client_id');
        $this->addSql('ALTER TABLE box ADD CONSTRAINT FK_8A9483A8DB1308C FOREIGN KEY (client_box_id) REFERENCES client (id)');
        $this->addSql('CREATE INDEX IDX_8A9483A8DB1308C ON box (client_box_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE box DROP FOREIGN KEY FK_8A9483A8DB1308C');
        $this->addSql('DROP INDEX IDX_8A9483A8DB1308C ON box');
        $this->addSql('ALTER TABLE box ADD box_client_id INT NOT NULL, DROP client_box_id');
        $this->addSql('ALTER TABLE box ADD CONSTRAINT FK_8A9483AC801C912 FOREIGN KEY (box_client_id) REFERENCES client (id)');
        $this->addSql('CREATE INDEX IDX_8A9483AC801C912 ON box (box_client_id)');
    }
}
