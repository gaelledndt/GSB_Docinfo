<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230120142710 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prescription_medication ADD prescription_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE prescription_medication ADD CONSTRAINT FK_E2D09A3093DB413D FOREIGN KEY (prescription_id) REFERENCES prescription (id)');
        $this->addSql('CREATE INDEX IDX_E2D09A3093DB413D ON prescription_medication (prescription_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prescription_medication DROP FOREIGN KEY FK_E2D09A3093DB413D');
        $this->addSql('DROP INDEX IDX_E2D09A3093DB413D ON prescription_medication');
        $this->addSql('ALTER TABLE prescription_medication DROP prescription_id');
    }
}
