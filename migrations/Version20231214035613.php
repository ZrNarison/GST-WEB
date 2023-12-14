<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231214035613 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE role ADD user_role_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE role ADD CONSTRAINT FK_57698A6A8E0E3CA6 FOREIGN KEY (user_role_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_57698A6A8E0E3CA6 ON role (user_role_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE role DROP FOREIGN KEY FK_57698A6A8E0E3CA6');
        $this->addSql('DROP INDEX UNIQ_57698A6A8E0E3CA6 ON role');
        $this->addSql('ALTER TABLE role DROP user_role_id');
    }
}
