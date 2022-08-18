<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220818141034 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE movies ADD colector_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE movies ADD CONSTRAINT FK_C61EED30C9B84F41 FOREIGN KEY (colector_id) REFERENCES collectors (id)');
        $this->addSql('CREATE INDEX IDX_C61EED30C9B84F41 ON movies (colector_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE movies DROP FOREIGN KEY FK_C61EED30C9B84F41');
        $this->addSql('DROP INDEX IDX_C61EED30C9B84F41 ON movies');
        $this->addSql('ALTER TABLE movies DROP colector_id');
    }
}
