<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220811090909 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE stars (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, dir VARCHAR(255) NOT NULL, show_name VARCHAR(255) DEFAULT NULL, nationality VARCHAR(255) DEFAULT NULL, weight VARCHAR(255) DEFAULT NULL, height VARCHAR(255) DEFAULT NULL, ethnicity VARCHAR(255) DEFAULT NULL, hair_color VARCHAR(255) DEFAULT NULL, date_of_birth DATETIME DEFAULT NULL, avatar VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE stars');
    }
}
