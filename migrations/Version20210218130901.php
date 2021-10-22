<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210218130901 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tbpartner (id INT AUTO_INCREMENT NOT NULL, usr_ins_id INT NOT NULL, usr_upd_id INT DEFAULT NULL, nom_soc VARCHAR(50) DEFAULT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) DEFAULT NULL, cplt_nom VARCHAR(50) DEFAULT NULL, cplt_adr VARCHAR(50) DEFAULT NULL, num_rue VARCHAR(50) DEFAULT NULL, cplt_num_rue VARCHAR(10) DEFAULT NULL, nom_rue VARCHAR(50) DEFAULT NULL, lieu_dit VARCHAR(50) DEFAULT NULL, cp VARCHAR(20) DEFAULT NULL, lclt VARCHAR(50) DEFAULT NULL, cp_cdx VARCHAR(10) DEFAULT NULL, lclt_cdx VARCHAR(50) DEFAULT NULL, cod_pays VARCHAR(3) DEFAULT NULL, dat_ins DATETIME NOT NULL, dat_upd DATETIME DEFAULT NULL, INDEX IDX_75CFC0D9E85F52E7 (usr_ins_id), INDEX IDX_75CFC0D98E55D6C2 (usr_upd_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tsite (id INT AUTO_INCREMENT NOT NULL, usr_ins_id INT NOT NULL, usr_upd_id INT NOT NULL, cod VARCHAR(10) NOT NULL, dsg VARCHAR(255) NOT NULL, dat_ins DATETIME NOT NULL, dat_upd DATETIME DEFAULT NULL, INDEX IDX_827767EAE85F52E7 (usr_ins_id), INDEX IDX_827767EA8E55D6C2 (usr_upd_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tsociete (id INT AUTO_INCREMENT NOT NULL, usr_ins_id INT NOT NULL, usr_upd_id INT DEFAULT NULL, cod VARCHAR(10) NOT NULL, dsg VARCHAR(255) NOT NULL, dat_ins DATETIME NOT NULL, dat_upd DATETIME DEFAULT NULL, INDEX IDX_C931A2C0E85F52E7 (usr_ins_id), INDEX IDX_C931A2C08E55D6C2 (usr_upd_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tbpartner ADD CONSTRAINT FK_75CFC0D9E85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tbpartner ADD CONSTRAINT FK_75CFC0D98E55D6C2 FOREIGN KEY (usr_upd_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tsite ADD CONSTRAINT FK_827767EAE85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tsite ADD CONSTRAINT FK_827767EA8E55D6C2 FOREIGN KEY (usr_upd_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tsociete ADD CONSTRAINT FK_C931A2C0E85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tsociete ADD CONSTRAINT FK_C931A2C08E55D6C2 FOREIGN KEY (usr_upd_id) REFERENCES tuser (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE tbpartner');
        $this->addSql('DROP TABLE tsite');
        $this->addSql('DROP TABLE tsociete');
    }
}
