<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230120142855 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE care_summary_allergenic (care_summary_id INT NOT NULL, allergenic_id INT NOT NULL, INDEX IDX_BEA4AC78DD15053D (care_summary_id), INDEX IDX_BEA4AC7857F3B171 (allergenic_id), PRIMARY KEY(care_summary_id, allergenic_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE care_summary_allergenic ADD CONSTRAINT FK_BEA4AC78DD15053D FOREIGN KEY (care_summary_id) REFERENCES care_summary (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE care_summary_allergenic ADD CONSTRAINT FK_BEA4AC7857F3B171 FOREIGN KEY (allergenic_id) REFERENCES allergenic (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE care_summary_allergenic DROP FOREIGN KEY FK_BEA4AC78DD15053D');
        $this->addSql('ALTER TABLE care_summary_allergenic DROP FOREIGN KEY FK_BEA4AC7857F3B171');
        $this->addSql('DROP TABLE care_summary_allergenic');
    }
}
