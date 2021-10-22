<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210426115245 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tgritarpst ADD clr_artfou_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tgritarpst ADD CONSTRAINT FK_262DB05FC2205009 FOREIGN KEY (clr_artfou_id) REFERENCES tartfou (id)');
        $this->addSql('CREATE INDEX IDX_262DB05FC2205009 ON tgritarpst (clr_artfou_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tgritarpst DROP FOREIGN KEY FK_262DB05FC2205009');
        $this->addSql('DROP INDEX IDX_262DB05FC2205009 ON tgritarpst');
        $this->addSql('ALTER TABLE tgritarpst DROP clr_artfou_id');
    }
}
