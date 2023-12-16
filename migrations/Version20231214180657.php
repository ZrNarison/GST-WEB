<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231214180657 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE emplacement (id INT AUTO_INCREMENT NOT NULL, situe VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE box ADD sit_box_id INT NOT NULL');
        $this->addSql('ALTER TABLE box ADD CONSTRAINT FK_8A9483A9A66BDBA FOREIGN KEY (sit_box_id) REFERENCES emplacement (id)');
        $this->addSql('CREATE INDEX IDX_8A9483A9A66BDBA ON box (sit_box_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE box DROP FOREIGN KEY FK_8A9483A9A66BDBA');
        $this->addSql('DROP TABLE emplacement');
        $this->addSql('DROP INDEX IDX_8A9483A9A66BDBA ON box');
        $this->addSql('ALTER TABLE box DROP sit_box_id');
    }
}
