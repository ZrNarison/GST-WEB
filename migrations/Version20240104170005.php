<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240104170005 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD user_role_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6498E0E3CA6 FOREIGN KEY (user_role_id) REFERENCES role (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6498E0E3CA6 ON user (user_role_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6498E0E3CA6');
        $this->addSql('DROP INDEX UNIQ_8D93D6498E0E3CA6 ON user');
        $this->addSql('ALTER TABLE user DROP user_role_id');
    }
}
