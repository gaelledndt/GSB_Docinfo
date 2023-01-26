<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230120142235 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE health_status ADD status_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE health_status ADD CONSTRAINT FK_EA8D996BF700BD FOREIGN KEY (status_id) REFERENCES status (id)');
        $this->addSql('CREATE INDEX IDX_EA8D996BF700BD ON health_status (status_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE health_status DROP FOREIGN KEY FK_EA8D996BF700BD');
        $this->addSql('DROP INDEX IDX_EA8D996BF700BD ON health_status');
        $this->addSql('ALTER TABLE health_status DROP status_id');
    }
}
