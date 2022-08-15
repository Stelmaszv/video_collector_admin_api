<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220815132253 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE series ADD producent_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE series ADD CONSTRAINT FK_3A10012D853A965C FOREIGN KEY (producent_id) REFERENCES producent (id)');
        $this->addSql('CREATE INDEX IDX_3A10012D853A965C ON series (producent_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE series DROP FOREIGN KEY FK_3A10012D853A965C');
        $this->addSql('DROP INDEX IDX_3A10012D853A965C ON series');
        $this->addSql('ALTER TABLE series DROP producent_id');
    }
}
