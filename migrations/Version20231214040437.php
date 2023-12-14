<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231214040437 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE box DROP FOREIGN KEY FK_8A9483A8DB1308C');
        $this->addSql('DROP INDEX IDX_8A9483A8DB1308C ON box');
        $this->addSql('ALTER TABLE box ADD client_id INT NOT NULL, DROP client_box_id');
        $this->addSql('ALTER TABLE box ADD CONSTRAINT FK_8A9483A19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('CREATE INDEX IDX_8A9483A19EB6921 ON box (client_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE box DROP FOREIGN KEY FK_8A9483A19EB6921');
        $this->addSql('DROP INDEX IDX_8A9483A19EB6921 ON box');
        $this->addSql('ALTER TABLE box ADD client_box_id INT DEFAULT NULL, DROP client_id');
        $this->addSql('ALTER TABLE box ADD CONSTRAINT FK_8A9483A8DB1308C FOREIGN KEY (client_box_id) REFERENCES client (id)');
        $this->addSql('CREATE INDEX IDX_8A9483A8DB1308C ON box (client_box_id)');
    }
}
