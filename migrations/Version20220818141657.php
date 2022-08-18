<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220818141657 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE producent ADD collector_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE producent ADD CONSTRAINT FK_ECEFFD43670BAFFE FOREIGN KEY (collector_id) REFERENCES collectors (id)');
        $this->addSql('CREATE INDEX IDX_ECEFFD43670BAFFE ON producent (collector_id)');
        $this->addSql('ALTER TABLE series ADD collectors_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE series ADD CONSTRAINT FK_3A10012DBD136991 FOREIGN KEY (collectors_id) REFERENCES collectors (id)');
        $this->addSql('CREATE INDEX IDX_3A10012DBD136991 ON series (collectors_id)');
        $this->addSql('ALTER TABLE stars ADD collectors_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE stars ADD CONSTRAINT FK_11DC02CBD136991 FOREIGN KEY (collectors_id) REFERENCES collectors (id)');
        $this->addSql('CREATE INDEX IDX_11DC02CBD136991 ON stars (collectors_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE producent DROP FOREIGN KEY FK_ECEFFD43670BAFFE');
        $this->addSql('DROP INDEX IDX_ECEFFD43670BAFFE ON producent');
        $this->addSql('ALTER TABLE producent DROP collector_id');
        $this->addSql('ALTER TABLE series DROP FOREIGN KEY FK_3A10012DBD136991');
        $this->addSql('DROP INDEX IDX_3A10012DBD136991 ON series');
        $this->addSql('ALTER TABLE series DROP collectors_id');
        $this->addSql('ALTER TABLE stars DROP FOREIGN KEY FK_11DC02CBD136991');
        $this->addSql('DROP INDEX IDX_11DC02CBD136991 ON stars');
        $this->addSql('ALTER TABLE stars DROP collectors_id');
    }
}
