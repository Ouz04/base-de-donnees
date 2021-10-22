<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210420072752 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tcotation ADD clr_fou_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tcotation ADD CONSTRAINT FK_B709F05A58CBEA51 FOREIGN KEY (clr_fou_id) REFERENCES tfournisseur (id)');
        $this->addSql('CREATE INDEX IDX_B709F05A58CBEA51 ON tcotation (clr_fou_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tcotation DROP FOREIGN KEY FK_B709F05A58CBEA51');
        $this->addSql('DROP INDEX IDX_B709F05A58CBEA51 ON tcotation');
        $this->addSql('ALTER TABLE tcotation DROP clr_fou_id');
    }
}
