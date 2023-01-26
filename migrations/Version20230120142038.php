<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230120142038 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE care_summary ADD gender_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE care_summary ADD CONSTRAINT FK_8E49F856708A0E0 FOREIGN KEY (gender_id) REFERENCES gender (id)');
        $this->addSql('CREATE INDEX IDX_8E49F856708A0E0 ON care_summary (gender_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE care_summary DROP FOREIGN KEY FK_8E49F856708A0E0');
        $this->addSql('DROP INDEX IDX_8E49F856708A0E0 ON care_summary');
        $this->addSql('ALTER TABLE care_summary DROP gender_id');
    }
}
