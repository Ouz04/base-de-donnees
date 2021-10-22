<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210305125047 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tcommercial DROP FOREIGN KEY FK_B0A50B45E54ED85E');
        $this->addSql('DROP INDEX IDX_B0A50B45E54ED85E ON tcommercial');
        $this->addSql('ALTER TABLE tcommercial DROP clr_usr_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tcommercial ADD clr_usr_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tcommercial ADD CONSTRAINT FK_B0A50B45E54ED85E FOREIGN KEY (clr_usr_id) REFERENCES tuser (id)');
        $this->addSql('CREATE INDEX IDX_B0A50B45E54ED85E ON tcommercial (clr_usr_id)');
    }
}
