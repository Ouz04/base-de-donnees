<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210513075343 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE titgficett (id INT AUTO_INCREMENT NOT NULL, usr_ins_id INT DEFAULT NULL, clr_tif_id INT DEFAULT NULL, nom_fic VARCHAR(255) NOT NULL, nb_enr INT NOT NULL, cmt LONGTEXT DEFAULT NULL, dat_ins DATETIME NOT NULL, INDEX IDX_BBD836E0E85F52E7 (usr_ins_id), INDEX IDX_BBD836E0DB394410 (clr_tif_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE titgficpst (id INT AUTO_INCREMENT NOT NULL, clr_typstt_id INT DEFAULT NULL, enr LONGTEXT DEFAULT NULL, num INT NOT NULL, nb_col INT NOT NULL, INDEX IDX_EE74C1BC71C53DAC (clr_typstt_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ttypitgfic (id INT AUTO_INCREMENT NOT NULL, usr_ins_id INT DEFAULT NULL, usr_upd_id INT DEFAULT NULL, cod VARCHAR(10) NOT NULL, dsg VARCHAR(50) NOT NULL, dat_ins DATETIME NOT NULL, dat_upd DATETIME DEFAULT NULL, INDEX IDX_47960564E85F52E7 (usr_ins_id), INDEX IDX_479605648E55D6C2 (usr_upd_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ttypstt (id INT AUTO_INCREMENT NOT NULL, usr_ins_id INT DEFAULT NULL, usr_upd_id INT DEFAULT NULL, cod VARCHAR(10) NOT NULL, dsg VARCHAR(50) NOT NULL, dat_ins DATETIME NOT NULL, dat_upd DATETIME DEFAULT NULL, INDEX IDX_C089996DE85F52E7 (usr_ins_id), INDEX IDX_C089996D8E55D6C2 (usr_upd_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE titgficett ADD CONSTRAINT FK_BBD836E0E85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE titgficett ADD CONSTRAINT FK_BBD836E0DB394410 FOREIGN KEY (clr_tif_id) REFERENCES ttypitgfic (id)');
        $this->addSql('ALTER TABLE titgficpst ADD CONSTRAINT FK_EE74C1BC71C53DAC FOREIGN KEY (clr_typstt_id) REFERENCES ttypstt (id)');
        $this->addSql('ALTER TABLE ttypitgfic ADD CONSTRAINT FK_47960564E85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE ttypitgfic ADD CONSTRAINT FK_479605648E55D6C2 FOREIGN KEY (usr_upd_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE ttypstt ADD CONSTRAINT FK_C089996DE85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE ttypstt ADD CONSTRAINT FK_C089996D8E55D6C2 FOREIGN KEY (usr_upd_id) REFERENCES tuser (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE titgficett DROP FOREIGN KEY FK_BBD836E0DB394410');
        $this->addSql('ALTER TABLE titgficpst DROP FOREIGN KEY FK_EE74C1BC71C53DAC');
        $this->addSql('DROP TABLE titgficett');
        $this->addSql('DROP TABLE titgficpst');
        $this->addSql('DROP TABLE ttypitgfic');
        $this->addSql('DROP TABLE ttypstt');
    }
}
