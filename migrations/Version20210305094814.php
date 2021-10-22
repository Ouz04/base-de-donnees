<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210305094814 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE torganisation ADD clr_bpt_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE torganisation ADD CONSTRAINT FK_E80DA44B9956CF71 FOREIGN KEY (clr_bpt_id) REFERENCES tbpartner (id)');
        $this->addSql('CREATE INDEX IDX_E80DA44B9956CF71 ON torganisation (clr_bpt_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE torganisation DROP FOREIGN KEY FK_E80DA44B9956CF71');
        $this->addSql('DROP INDEX IDX_E80DA44B9956CF71 ON torganisation');
        $this->addSql('ALTER TABLE torganisation DROP clr_bpt_id');
    }
}
