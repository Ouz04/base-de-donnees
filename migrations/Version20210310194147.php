<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210310194147 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tgritarpst (id INT AUTO_INCREMENT NOT NULL, clr_art_id INT DEFAULT NULL, usr_ins_id INT DEFAULT NULL, usr_upd_id INT DEFAULT NULL, clr_gta_id INT NOT NULL, lib_art VARCHAR(255) NOT NULL, prx_ach DOUBLE PRECISION NOT NULL, prx_vte DOUBLE PRECISION NOT NULL, prx_txe DOUBLE PRECISION NOT NULL, prx_txs DOUBLE PRECISION NOT NULL, dat_ins DATETIME NOT NULL, dat_upd DATETIME DEFAULT NULL, INDEX IDX_262DB05F6502EEBF (clr_art_id), INDEX IDX_262DB05FE85F52E7 (usr_ins_id), INDEX IDX_262DB05F8E55D6C2 (usr_upd_id), INDEX IDX_262DB05F5BDC5FAF (clr_gta_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tgritarpst ADD CONSTRAINT FK_262DB05F6502EEBF FOREIGN KEY (clr_art_id) REFERENCES tarticle (id)');
        $this->addSql('ALTER TABLE tgritarpst ADD CONSTRAINT FK_262DB05FE85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tgritarpst ADD CONSTRAINT FK_262DB05F8E55D6C2 FOREIGN KEY (usr_upd_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tgritarpst ADD CONSTRAINT FK_262DB05F5BDC5FAF FOREIGN KEY (clr_gta_id) REFERENCES tgritarett (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE tgritarpst');
    }
}
