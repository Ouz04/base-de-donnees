<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210317152252 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tctgice (id INT AUTO_INCREMENT NOT NULL, usr_ins_id INT DEFAULT NULL, usr_upd_id INT DEFAULT NULL, id_ice INT NOT NULL, niv1 VARCHAR(50) NOT NULL, niv2 VARCHAR(50) DEFAULT NULL, niv3 VARCHAR(50) DEFAULT NULL, niv4 VARCHAR(50) DEFAULT NULL, dat_ins DATETIME DEFAULT NULL, dat_upd DATETIME DEFAULT NULL, INDEX IDX_9586821BE85F52E7 (usr_ins_id), INDEX IDX_9586821B8E55D6C2 (usr_upd_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tmrqice (id INT AUTO_INCREMENT NOT NULL, usr_ins_id INT DEFAULT NULL, usr_upd_id INT DEFAULT NULL, id_ice INT NOT NULL, nom VARCHAR(100) NOT NULL, dat_ins DATETIME DEFAULT NULL, dat_upd DATETIME DEFAULT NULL, INDEX IDX_55BE1E88E85F52E7 (usr_ins_id), INDEX IDX_55BE1E888E55D6C2 (usr_upd_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tctgice ADD CONSTRAINT FK_9586821BE85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tctgice ADD CONSTRAINT FK_9586821B8E55D6C2 FOREIGN KEY (usr_upd_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tmrqice ADD CONSTRAINT FK_55BE1E88E85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tmrqice ADD CONSTRAINT FK_55BE1E888E55D6C2 FOREIGN KEY (usr_upd_id) REFERENCES tuser (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE tctgice');
        $this->addSql('DROP TABLE tmrqice');
    }
}
