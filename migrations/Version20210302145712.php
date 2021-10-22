<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210302145712 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tcotation ADD clr_org_id INT NOT NULL');
        $this->addSql('ALTER TABLE tcotation ADD CONSTRAINT FK_B709F05A1DA477BE FOREIGN KEY (clr_org_id) REFERENCES torganisation (id)');
        $this->addSql('CREATE INDEX IDX_B709F05A1DA477BE ON tcotation (clr_org_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tcotation DROP FOREIGN KEY FK_B709F05A1DA477BE');
        $this->addSql('DROP INDEX IDX_B709F05A1DA477BE ON tcotation');
        $this->addSql('ALTER TABLE tcotation DROP clr_org_id');
    }
}
