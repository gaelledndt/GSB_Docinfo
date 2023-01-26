<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230120142536 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prescription ADD care_summary_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE prescription ADD CONSTRAINT FK_1FBFB8D9DD15053D FOREIGN KEY (care_summary_id) REFERENCES care_summary (id)');
        $this->addSql('CREATE INDEX IDX_1FBFB8D9DD15053D ON prescription (care_summary_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prescription DROP FOREIGN KEY FK_1FBFB8D9DD15053D');
        $this->addSql('DROP INDEX IDX_1FBFB8D9DD15053D ON prescription');
        $this->addSql('ALTER TABLE prescription DROP care_summary_id');
    }
}
