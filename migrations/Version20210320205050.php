<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210320205050 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tctgiceniv ADD clr_ctgiceprec_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tctgiceniv ADD CONSTRAINT FK_AD4CAB07DEF8C499 FOREIGN KEY (clr_ctgiceprec_id) REFERENCES tctgiceniv (id)');
        $this->addSql('CREATE INDEX IDX_AD4CAB07DEF8C499 ON tctgiceniv (clr_ctgiceprec_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tctgiceniv DROP FOREIGN KEY FK_AD4CAB07DEF8C499');
        $this->addSql('DROP INDEX IDX_AD4CAB07DEF8C499 ON tctgiceniv');
        $this->addSql('ALTER TABLE tctgiceniv DROP clr_ctgiceprec_id');
    }
}
