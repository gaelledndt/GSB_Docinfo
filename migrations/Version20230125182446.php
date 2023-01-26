<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230125182446 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE test_results ADD test_result_type_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE test_results ADD CONSTRAINT FK_43E230DCD839F67A FOREIGN KEY (test_result_type_id) REFERENCES test_result_type (id)');
        $this->addSql('CREATE INDEX IDX_43E230DCD839F67A ON test_results (test_result_type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE test_results DROP FOREIGN KEY FK_43E230DCD839F67A');
        $this->addSql('DROP INDEX IDX_43E230DCD839F67A ON test_results');
        $this->addSql('ALTER TABLE test_results DROP test_result_type_id');
    }
}
