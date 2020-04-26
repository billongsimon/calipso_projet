<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200426121657 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE page DROP FOREIGN KEY FK_140AB620499475BF');
        $this->addSql('DROP INDEX IDX_140AB620499475BF ON page');
        $this->addSql('ALTER TABLE page ADD page_parent VARCHAR(255) NOT NULL, DROP page_parent_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE page ADD page_parent_id INT DEFAULT NULL, DROP page_parent');
        $this->addSql('ALTER TABLE page ADD CONSTRAINT FK_140AB620499475BF FOREIGN KEY (page_parent_id) REFERENCES page (id)');
        $this->addSql('CREATE INDEX IDX_140AB620499475BF ON page (page_parent_id)');
    }
}
