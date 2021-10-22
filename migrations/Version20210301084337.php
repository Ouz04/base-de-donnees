<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210301084337 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE torganisation ADD clr_cli_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE torganisation ADD CONSTRAINT FK_E80DA44BC77E35A7 FOREIGN KEY (clr_cli_id_id) REFERENCES tclient (id)');
        $this->addSql('CREATE INDEX IDX_E80DA44BC77E35A7 ON torganisation (clr_cli_id_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE torganisation DROP FOREIGN KEY FK_E80DA44BC77E35A7');
        $this->addSql('DROP INDEX IDX_E80DA44BC77E35A7 ON torganisation');
        $this->addSql('ALTER TABLE torganisation DROP clr_cli_id_id');
    }
}
