<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220815110054 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE admin (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_880E0D76F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE collectors (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(200) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE movies (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, full_name VARCHAR(255) NOT NULL, dir VARCHAR(255) NOT NULL, src VARCHAR(255) NOT NULL, show_name VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, date_relesed DATE DEFAULT NULL, country VARCHAR(255) DEFAULT NULL, cover VARCHAR(255) DEFAULT NULL, poster VARCHAR(255) DEFAULT NULL, back_cover VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE producent (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, dir VARCHAR(255) NOT NULL, show_name VARCHAR(255) DEFAULT NULL, country VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, avatar VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE series (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, dir VARCHAR(255) NOT NULL, show_name VARCHAR(255) DEFAULT NULL, description LONGTEXT NOT NULL, country VARCHAR(255) DEFAULT NULL, years VARCHAR(255) DEFAULT NULL, avatar VARCHAR(255) DEFAULT NULL, number_of_sezons INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stars (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, dir VARCHAR(255) NOT NULL, show_name VARCHAR(255) DEFAULT NULL, nationality VARCHAR(255) DEFAULT NULL, weight VARCHAR(255) DEFAULT NULL, height VARCHAR(255) DEFAULT NULL, ethnicity VARCHAR(255) DEFAULT NULL, hair_color VARCHAR(255) DEFAULT NULL, date_of_birth DATETIME DEFAULT NULL, avatar VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, place_of_birth VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_collector (id INT AUTO_INCREMENT NOT NULL, collector_id INT NOT NULL, admin_id INT DEFAULT NULL, can_edit TINYINT(1) NOT NULL, can_delete TINYINT(1) NOT NULL, INDEX IDX_CE3B78A8670BAFFE (collector_id), INDEX IDX_CE3B78A8642B8210 (admin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_collector ADD CONSTRAINT FK_CE3B78A8670BAFFE FOREIGN KEY (collector_id) REFERENCES collectors (id)');
        $this->addSql('ALTER TABLE user_collector ADD CONSTRAINT FK_CE3B78A8642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_collector DROP FOREIGN KEY FK_CE3B78A8670BAFFE');
        $this->addSql('ALTER TABLE user_collector DROP FOREIGN KEY FK_CE3B78A8642B8210');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE collectors');
        $this->addSql('DROP TABLE movies');
        $this->addSql('DROP TABLE producent');
        $this->addSql('DROP TABLE series');
        $this->addSql('DROP TABLE stars');
        $this->addSql('DROP TABLE user_collector');
    }
}
