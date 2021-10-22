<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210316162250 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tartcpd (id INT AUTO_INCREMENT NOT NULL, clr_artaas_id INT DEFAULT NULL, clr_typcpd_id INT DEFAULT NULL, clr_artase_id INT DEFAULT NULL, usr_ins_id INT DEFAULT NULL, usr_upd_id INT DEFAULT NULL, dat_ins DATETIME NOT NULL, dat_upd DATETIME DEFAULT NULL, INDEX IDX_EDDDA13457E810C (clr_artaas_id), INDEX IDX_EDDDA13D78ACE68 (clr_typcpd_id), INDEX IDX_EDDDA132A2C4DAD (clr_artase_id), INDEX IDX_EDDDA13E85F52E7 (usr_ins_id), INDEX IDX_EDDDA138E55D6C2 (usr_upd_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ttypcpd (id INT AUTO_INCREMENT NOT NULL, usr_ins_id INT DEFAULT NULL, usr_upd_id INT DEFAULT NULL, cod VARCHAR(10) NOT NULL, dsg VARCHAR(100) NOT NULL, dat_ins DATETIME NOT NULL, dat_upd DATETIME DEFAULT NULL, INDEX IDX_A574EF7DE85F52E7 (usr_ins_id), INDEX IDX_A574EF7D8E55D6C2 (usr_upd_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tartcpd ADD CONSTRAINT FK_EDDDA13457E810C FOREIGN KEY (clr_artaas_id) REFERENCES tarticle (id)');
        $this->addSql('ALTER TABLE tartcpd ADD CONSTRAINT FK_EDDDA13D78ACE68 FOREIGN KEY (clr_typcpd_id) REFERENCES ttypcpd (id)');
        $this->addSql('ALTER TABLE tartcpd ADD CONSTRAINT FK_EDDDA132A2C4DAD FOREIGN KEY (clr_artase_id) REFERENCES tarticle (id)');
        $this->addSql('ALTER TABLE tartcpd ADD CONSTRAINT FK_EDDDA13E85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tartcpd ADD CONSTRAINT FK_EDDDA138E55D6C2 FOREIGN KEY (usr_upd_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE ttypcpd ADD CONSTRAINT FK_A574EF7DE85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE ttypcpd ADD CONSTRAINT FK_A574EF7D8E55D6C2 FOREIGN KEY (usr_upd_id) REFERENCES tuser (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tartcpd DROP FOREIGN KEY FK_EDDDA13D78ACE68');
        $this->addSql('DROP TABLE tartcpd');
        $this->addSql('DROP TABLE ttypcpd');
    }
}
