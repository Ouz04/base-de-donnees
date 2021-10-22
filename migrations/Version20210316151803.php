<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210316151803 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article_rechercheb (id INT AUTO_INCREMENT NOT NULL, clr_ctg_id INT DEFAULT NULL, clr_ctr_id INT DEFAULT NULL, art_cod VARCHAR(255) DEFAULT NULL, INDEX IDX_D26CFDC6E5264265 (clr_ctg_id), INDEX IDX_D26CFDC682E1E5C8 (clr_ctr_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ttyporigta (id INT AUTO_INCREMENT NOT NULL, usr_ins_id INT DEFAULT NULL, usr_upd_id INT DEFAULT NULL, cod VARCHAR(10) NOT NULL, dsg VARCHAR(50) NOT NULL, dat_ins DATETIME NOT NULL, dat_upd DATETIME DEFAULT NULL, INDEX IDX_EEF003EDE85F52E7 (usr_ins_id), INDEX IDX_EEF003ED8E55D6C2 (usr_upd_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article_rechercheb ADD CONSTRAINT FK_D26CFDC6E5264265 FOREIGN KEY (clr_ctg_id) REFERENCES tcategorie (id)');
        $this->addSql('ALTER TABLE article_rechercheb ADD CONSTRAINT FK_D26CFDC682E1E5C8 FOREIGN KEY (clr_ctr_id) REFERENCES tconstructeur (id)');
        $this->addSql('ALTER TABLE ttyporigta ADD CONSTRAINT FK_EEF003EDE85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE ttyporigta ADD CONSTRAINT FK_EEF003ED8E55D6C2 FOREIGN KEY (usr_upd_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tgritarett ADD typ_ori_gta_id INT DEFAULT NULL, ADD cmt VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE tgritarett ADD CONSTRAINT FK_7381470337ACF82A FOREIGN KEY (typ_ori_gta_id) REFERENCES ttyporigta (id)');
        $this->addSql('CREATE INDEX IDX_7381470337ACF82A ON tgritarett (typ_ori_gta_id)');
        $this->addSql('ALTER TABLE tgritarpst ADD cod_cot VARCHAR(50) DEFAULT NULL, ADD cod_ctt VARCHAR(50) DEFAULT NULL, ADD x_bpu TINYINT(1) NOT NULL, ADD x_dvs TINYINT(1) NOT NULL, ADD cmt VARCHAR(255) DEFAULT NULL, ADD cod_art_cli VARCHAR(50) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tgritarett DROP FOREIGN KEY FK_7381470337ACF82A');
        $this->addSql('DROP TABLE article_rechercheb');
        $this->addSql('DROP TABLE ttyporigta');
        $this->addSql('DROP INDEX IDX_7381470337ACF82A ON tgritarett');
        $this->addSql('ALTER TABLE tgritarett DROP typ_ori_gta_id, DROP cmt');
        $this->addSql('ALTER TABLE tgritarpst DROP cod_cot, DROP cod_ctt, DROP x_bpu, DROP x_dvs, DROP cmt, DROP cod_art_cli');
    }
}
