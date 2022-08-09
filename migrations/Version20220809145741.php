<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220809145741 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_collector ADD admin_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user_collector ADD CONSTRAINT FK_CE3B78A8642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id)');
        $this->addSql('CREATE INDEX IDX_CE3B78A8642B8210 ON user_collector (admin_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_collector DROP FOREIGN KEY FK_CE3B78A8642B8210');
        $this->addSql('DROP INDEX IDX_CE3B78A8642B8210 ON user_collector');
        $this->addSql('ALTER TABLE user_collector DROP admin_id');
    }
}