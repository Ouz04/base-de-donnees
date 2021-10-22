<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210510141417 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tclient ADD clr_cml_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tclient ADD CONSTRAINT FK_F3CD8EB05FD73097 FOREIGN KEY (clr_cml_id) REFERENCES tcommercial (id)');
        $this->addSql('CREATE INDEX IDX_F3CD8EB05FD73097 ON tclient (clr_cml_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tclient DROP FOREIGN KEY FK_F3CD8EB05FD73097');
        $this->addSql('DROP INDEX IDX_F3CD8EB05FD73097 ON tclient');
        $this->addSql('ALTER TABLE tclient DROP clr_cml_id');
    }
}
