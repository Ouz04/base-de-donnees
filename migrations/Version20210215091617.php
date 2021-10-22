<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210215091617 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tarticle (id INT AUTO_INCREMENT NOT NULL, usr_ins_id INT NOT NULL, usr_upd_id INT DEFAULT NULL, cod VARCHAR(20) NOT NULL, lib_crt_fr VARCHAR(255) NOT NULL, lib_lng_fr LONGTEXT DEFAULT NULL, lib_crt_en VARCHAR(255) DEFAULT NULL, lib_lng_en LONGTEXT DEFAULT NULL, cod_ean VARCHAR(30) DEFAULT NULL, pds INT DEFAULT NULL, pds_unt VARCHAR(10) NOT NULL, vlm DOUBLE PRECISION DEFAULT NULL, vlm_unt VARCHAR(10) DEFAULT NULL, cpc_enc DOUBLE PRECISION DEFAULT NULL, cpc_enc_unt VARCHAR(10) DEFAULT NULL, cod_tva INT DEFAULT NULL, dat_msrv DATE DEFAULT NULL, ref_adx VARCHAR(20) DEFAULT NULL, ref_ctr VARCHAR(20) DEFAULT NULL, lib01_adx VARCHAR(255) DEFAULT NULL, lnk_fch_ctr VARCHAR(255) DEFAULT NULL, xac TINYINT(1) NOT NULL, dat_fin_xac DATE DEFAULT NULL, dat_ins DATETIME NOT NULL, dat_upd DATETIME DEFAULT NULL, INDEX IDX_D26E911BE85F52E7 (usr_ins_id), INDEX IDX_D26E911B8E55D6C2 (usr_upd_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tarticle ADD CONSTRAINT FK_D26E911BE85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tarticle ADD CONSTRAINT FK_D26E911B8E55D6C2 FOREIGN KEY (usr_upd_id) REFERENCES tuser (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE tarticle');
    }
}
