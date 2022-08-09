<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220809130642 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE collectors ADD user_collector_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE collectors ADD CONSTRAINT FK_64AA1945E7C7D3FC FOREIGN KEY (user_collector_id) REFERENCES user_collector (id)');
        $this->addSql('CREATE INDEX IDX_64AA1945E7C7D3FC ON collectors (user_collector_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE collectors DROP FOREIGN KEY FK_64AA1945E7C7D3FC');
        $this->addSql('DROP INDEX IDX_64AA1945E7C7D3FC ON collectors');
        $this->addSql('ALTER TABLE collectors DROP user_collector_id');
    }
}
