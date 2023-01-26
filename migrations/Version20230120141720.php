<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230120141720 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE care_summary ADD doctor_referring_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE care_summary ADD CONSTRAINT FK_8E49F856D148544B FOREIGN KEY (doctor_referring_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_8E49F856D148544B ON care_summary (doctor_referring_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE care_summary DROP FOREIGN KEY FK_8E49F856D148544B');
        $this->addSql('DROP INDEX IDX_8E49F856D148544B ON care_summary');
        $this->addSql('ALTER TABLE care_summary DROP doctor_referring_id');
    }
}
