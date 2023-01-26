<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230125182156 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE test_results ADD care_summary_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE test_results ADD CONSTRAINT FK_43E230DCDD15053D FOREIGN KEY (care_summary_id) REFERENCES care_summary (id)');
        $this->addSql('CREATE INDEX IDX_43E230DCDD15053D ON test_results (care_summary_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE test_results DROP FOREIGN KEY FK_43E230DCDD15053D');
        $this->addSql('DROP INDEX IDX_43E230DCDD15053D ON test_results');
        $this->addSql('ALTER TABLE test_results DROP care_summary_id');
    }
}
