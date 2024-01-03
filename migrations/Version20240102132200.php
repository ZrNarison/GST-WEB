<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240102132200 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE jirama DROP FOREIGN KEY FK_EE4A158787B21E1F');
        $this->addSql('ALTER TABLE jirama ADD CONSTRAINT FK_EE4A158787B21E1F FOREIGN KEY (jir_box_id) REFERENCES client (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE jirama DROP FOREIGN KEY FK_EE4A158787B21E1F');
        $this->addSql('ALTER TABLE jirama ADD CONSTRAINT FK_EE4A158787B21E1F FOREIGN KEY (jir_box_id) REFERENCES box (id)');
    }
}
