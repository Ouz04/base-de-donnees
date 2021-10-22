<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210812130431 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tclient ADD clr_famcli_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tclient ADD CONSTRAINT FK_F3CD8EB0AB91D151 FOREIGN KEY (clr_famcli_id) REFERENCES tfamcli (id)');
        $this->addSql('CREATE INDEX IDX_F3CD8EB0AB91D151 ON tclient (clr_famcli_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tclient DROP FOREIGN KEY FK_F3CD8EB0AB91D151');
        $this->addSql('DROP INDEX IDX_F3CD8EB0AB91D151 ON tclient');
        $this->addSql('ALTER TABLE tclient DROP clr_famcli_id');
    }
}
