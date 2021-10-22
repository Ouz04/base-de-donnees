<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210521084656 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tflxett (id INT AUTO_INCREMENT NOT NULL, per_id INT DEFAULT NULL, fou_id INT DEFAULT NULL, usr_ins_id INT DEFAULT NULL, usr_upd_id INT DEFAULT NULL, nom_fic VARCHAR(255) DEFAULT NULL, rpt_fic VARCHAR(255) DEFAULT NULL, cmt VARCHAR(255) DEFAULT NULL, dat_ins DATETIME NOT NULL, dat_upd DATETIME DEFAULT NULL, INDEX IDX_FB88D522B304206A (per_id), INDEX IDX_FB88D522B1ECE1F4 (fou_id), INDEX IDX_FB88D522E85F52E7 (usr_ins_id), INDEX IDX_FB88D5228E55D6C2 (usr_upd_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tflxpst (id INT AUTO_INCREMENT NOT NULL, clr_flx_id INT DEFAULT NULL, usr_ins_id INT DEFAULT NULL, usr_upd_id INT DEFAULT NULL, chp VARCHAR(20) NOT NULL, dsg VARCHAR(100) NOT NULL, typ VARCHAR(3) NOT NULL, lng INT NOT NULL, frm VARCHAR(100) DEFAULT NULL, dat_ins DATETIME NOT NULL, dat_upd DATETIME DEFAULT NULL, INDEX IDX_AE24227EED01485C (clr_flx_id), INDEX IDX_AE24227EE85F52E7 (usr_ins_id), INDEX IDX_AE24227E8E55D6C2 (usr_upd_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tperiodicite (id INT AUTO_INCREMENT NOT NULL, usr_ins_id INT DEFAULT NULL, usr_upd_id INT DEFAULT NULL, cod VARCHAR(3) NOT NULL, dsg VARCHAR(50) NOT NULL, dat_ins DATETIME NOT NULL, dat_upd DATETIME DEFAULT NULL, INDEX IDX_E62354FBE85F52E7 (usr_ins_id), INDEX IDX_E62354FB8E55D6C2 (usr_upd_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ttypfic (id INT AUTO_INCREMENT NOT NULL, usr_ins_id INT DEFAULT NULL, usr_upd_id INT DEFAULT NULL, cod VARCHAR(10) NOT NULL, dsg VARCHAR(50) NOT NULL, spt VARCHAR(3) DEFAULT NULL, ecg VARCHAR(20) DEFAULT NULL, dat_ins DATETIME NOT NULL, dat_upd DATETIME DEFAULT NULL, INDEX IDX_A6DB112DE85F52E7 (usr_ins_id), INDEX IDX_A6DB112D8E55D6C2 (usr_upd_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tflxett ADD CONSTRAINT FK_FB88D522B304206A FOREIGN KEY (per_id) REFERENCES tperiodicite (id)');
        $this->addSql('ALTER TABLE tflxett ADD CONSTRAINT FK_FB88D522B1ECE1F4 FOREIGN KEY (fou_id) REFERENCES tfournisseur (id)');
        $this->addSql('ALTER TABLE tflxett ADD CONSTRAINT FK_FB88D522E85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tflxett ADD CONSTRAINT FK_FB88D5228E55D6C2 FOREIGN KEY (usr_upd_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tflxpst ADD CONSTRAINT FK_AE24227EED01485C FOREIGN KEY (clr_flx_id) REFERENCES tflxett (id)');
        $this->addSql('ALTER TABLE tflxpst ADD CONSTRAINT FK_AE24227EE85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tflxpst ADD CONSTRAINT FK_AE24227E8E55D6C2 FOREIGN KEY (usr_upd_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tperiodicite ADD CONSTRAINT FK_E62354FBE85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tperiodicite ADD CONSTRAINT FK_E62354FB8E55D6C2 FOREIGN KEY (usr_upd_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE ttypfic ADD CONSTRAINT FK_A6DB112DE85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE ttypfic ADD CONSTRAINT FK_A6DB112D8E55D6C2 FOREIGN KEY (usr_upd_id) REFERENCES tuser (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tflxpst DROP FOREIGN KEY FK_AE24227EED01485C');
        $this->addSql('ALTER TABLE tflxett DROP FOREIGN KEY FK_FB88D522B304206A');
        $this->addSql('DROP TABLE tflxett');
        $this->addSql('DROP TABLE tflxpst');
        $this->addSql('DROP TABLE tperiodicite');
        $this->addSql('DROP TABLE ttypfic');
    }
}
