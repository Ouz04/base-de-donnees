<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210214182329 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, ref VARCHAR(20) NOT NULL, cod_ean VARCHAR(20) DEFAULT NULL, pds INT DEFAULT NULL, pds_unt VARCHAR(10) DEFAULT NULL, vlm INT DEFAULT NULL, vlm_unt VARCHAR(10) DEFAULT NULL, cpc_enc INT DEFAULT NULL, cod_tva INT DEFAULT NULL, dat_msrv DATE DEFAULT NULL, ref_adx VARCHAR(20) DEFAULT NULL, ref_ctr VARCHAR(30) DEFAULT NULL, lib_crt VARCHAR(255) NOT NULL, liblng LONGTEXT DEFAULT NULL, lib_crt_en VARCHAR(255) DEFAULT NULL, lib_lng_en LONGTEXT DEFAULT NULL, lib01_adx VARCHAR(255) DEFAULT NULL, lnk_fch_ctr VARCHAR(255) DEFAULT NULL, xac TINYINT(1) NOT NULL, dat_fin_xac DATE DEFAULT NULL, dat_ins DATETIME NOT NULL, dat_upd DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE article');
    }
}
