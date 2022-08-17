<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220817081135 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE movies_stars (movies_id INT NOT NULL, stars_id INT NOT NULL, INDEX IDX_7AFFE22D53F590A4 (movies_id), INDEX IDX_7AFFE22DFFEAC122 (stars_id), PRIMARY KEY(movies_id, stars_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE movies_stars ADD CONSTRAINT FK_7AFFE22D53F590A4 FOREIGN KEY (movies_id) REFERENCES movies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE movies_stars ADD CONSTRAINT FK_7AFFE22DFFEAC122 FOREIGN KEY (stars_id) REFERENCES stars (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE movies_stars DROP FOREIGN KEY FK_7AFFE22D53F590A4');
        $this->addSql('ALTER TABLE movies_stars DROP FOREIGN KEY FK_7AFFE22DFFEAC122');
        $this->addSql('DROP TABLE movies_stars');
    }
}
