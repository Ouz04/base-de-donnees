<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210630091010 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tarttrfsitweb (id INT AUTO_INCREMENT NOT NULL, clr_art_id INT DEFAULT NULL, clr_sitweb_id INT DEFAULT NULL, usr_ins_id INT DEFAULT NULL, usr_upd_id INT DEFAULT NULL, x_trf TINYINT(1) NOT NULL, dat_ins DATETIME NOT NULL, dat_upd DATETIME DEFAULT NULL, INDEX IDX_233F7F176502EEBF (clr_art_id), INDEX IDX_233F7F172E33B13A (clr_sitweb_id), INDEX IDX_233F7F17E85F52E7 (usr_ins_id), INDEX IDX_233F7F178E55D6C2 (usr_upd_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tsitweb (id INT AUTO_INCREMENT NOT NULL, usr_ins_id INT DEFAULT NULL, usr_upd_id INT DEFAULT NULL, cod VARCHAR(20) NOT NULL, dsg VARCHAR(100) NOT NULL, dat_ins DATETIME NOT NULL, dat_upd DATETIME DEFAULT NULL, INDEX IDX_920A979DE85F52E7 (usr_ins_id), INDEX IDX_920A979D8E55D6C2 (usr_upd_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tarttrfsitweb ADD CONSTRAINT FK_233F7F176502EEBF FOREIGN KEY (clr_art_id) REFERENCES tarticle (id)');
        $this->addSql('ALTER TABLE tarttrfsitweb ADD CONSTRAINT FK_233F7F172E33B13A FOREIGN KEY (clr_sitweb_id) REFERENCES tsitweb (id)');
        $this->addSql('ALTER TABLE tarttrfsitweb ADD CONSTRAINT FK_233F7F17E85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tarttrfsitweb ADD CONSTRAINT FK_233F7F178E55D6C2 FOREIGN KEY (usr_upd_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tsitweb ADD CONSTRAINT FK_920A979DE85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tsitweb ADD CONSTRAINT FK_920A979D8E55D6C2 FOREIGN KEY (usr_upd_id) REFERENCES tuser (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tarttrfsitweb DROP FOREIGN KEY FK_233F7F172E33B13A');
        $this->addSql('DROP TABLE tarttrfsitweb');
        $this->addSql('DROP TABLE tsitweb');
    }
}
