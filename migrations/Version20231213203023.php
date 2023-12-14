<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231213203023 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE box (id INT AUTO_INCREMENT NOT NULL, log VARCHAR(255) NOT NULL, sec DOUBLE PRECISION NOT NULL, emplacement VARCHAR(255) NOT NULL, num VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE jirama (id INT AUTO_INCREMENT NOT NULL, jir_box_id INT NOT NULL, pres_date DATE NOT NULL, val_index DOUBLE PRECISION NOT NULL, fact_date DATE NOT NULL, consomation DOUBLE PRECISION NOT NULL, INDEX IDX_EE4A158787B21E1F (jir_box_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE jirama ADD CONSTRAINT FK_EE4A158787B21E1F FOREIGN KEY (jir_box_id) REFERENCES box (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE jirama DROP FOREIGN KEY FK_EE4A158787B21E1F');
        $this->addSql('DROP TABLE box');
        $this->addSql('DROP TABLE jirama');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
