<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210312144955 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE torganisation ADD clr_cml_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE torganisation ADD CONSTRAINT FK_E80DA44B5FD73097 FOREIGN KEY (clr_cml_id) REFERENCES tcommercial (id)');
        $this->addSql('CREATE INDEX IDX_E80DA44B5FD73097 ON torganisation (clr_cml_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE torganisation DROP FOREIGN KEY FK_E80DA44B5FD73097');
        $this->addSql('DROP INDEX IDX_E80DA44B5FD73097 ON torganisation');
        $this->addSql('ALTER TABLE torganisation DROP clr_cml_id');
    }
}
