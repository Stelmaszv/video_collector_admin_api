<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220809134520 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_collector ADD collector_id INT NOT NULL');
        $this->addSql('ALTER TABLE user_collector ADD CONSTRAINT FK_CE3B78A8670BAFFE FOREIGN KEY (collector_id) REFERENCES collectors (id)');
        $this->addSql('CREATE INDEX IDX_CE3B78A8670BAFFE ON user_collector (collector_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_collector DROP FOREIGN KEY FK_CE3B78A8670BAFFE');
        $this->addSql('DROP INDEX IDX_CE3B78A8670BAFFE ON user_collector');
        $this->addSql('ALTER TABLE user_collector DROP collector_id');
    }
}
