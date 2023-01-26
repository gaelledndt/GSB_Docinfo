<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230120140648 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE care_summary ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE care_summary ADD CONSTRAINT FK_8E49F856A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8E49F856A76ED395 ON care_summary (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE care_summary DROP FOREIGN KEY FK_8E49F856A76ED395');
        $this->addSql('DROP INDEX UNIQ_8E49F856A76ED395 ON care_summary');
        $this->addSql('ALTER TABLE care_summary DROP user_id');
    }
}
