<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220809123402 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE collectors_user_collector (collectors_id INT NOT NULL, user_collector_id INT NOT NULL, INDEX IDX_21C57C4EBD136991 (collectors_id), INDEX IDX_21C57C4EE7C7D3FC (user_collector_id), PRIMARY KEY(collectors_id, user_collector_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE collectors_user_collector ADD CONSTRAINT FK_21C57C4EBD136991 FOREIGN KEY (collectors_id) REFERENCES collectors (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE collectors_user_collector ADD CONSTRAINT FK_21C57C4EE7C7D3FC FOREIGN KEY (user_collector_id) REFERENCES user_collector (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE collectors_user_collector DROP FOREIGN KEY FK_21C57C4EBD136991');
        $this->addSql('ALTER TABLE collectors_user_collector DROP FOREIGN KEY FK_21C57C4EE7C7D3FC');
        $this->addSql('DROP TABLE collectors_user_collector');
    }
}
