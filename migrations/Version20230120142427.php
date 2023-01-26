<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230120142427 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE health_status ADD care_summary_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE health_status ADD CONSTRAINT FK_EA8D99DD15053D FOREIGN KEY (care_summary_id) REFERENCES care_summary (id)');
        $this->addSql('CREATE INDEX IDX_EA8D99DD15053D ON health_status (care_summary_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE health_status DROP FOREIGN KEY FK_EA8D99DD15053D');
        $this->addSql('DROP INDEX IDX_EA8D99DD15053D ON health_status');
        $this->addSql('ALTER TABLE health_status DROP care_summary_id');
    }
}
