<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231214175952 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client ADD box_id INT NOT NULL');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455D8177B3F FOREIGN KEY (box_id) REFERENCES box (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C7440455D8177B3F ON client (box_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455D8177B3F');
        $this->addSql('DROP INDEX UNIQ_C7440455D8177B3F ON client');
        $this->addSql('ALTER TABLE client DROP box_id');
    }
}
