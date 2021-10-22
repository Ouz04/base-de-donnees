<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210228195628 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tgritar (id INT AUTO_INCREMENT NOT NULL, clr_org_id INT DEFAULT NULL, clr_art_id_id INT DEFAULT NULL, usr_ins_id INT DEFAULT NULL, usr_upd_id INT DEFAULT NULL, lib_art VARCHAR(255) NOT NULL, prx_ach DOUBLE PRECISION NOT NULL, prx_vte DOUBLE PRECISION NOT NULL, pec DOUBLE PRECISION NOT NULL, pso DOUBLE PRECISION NOT NULL, dat_deb DATE NOT NULL, dat_fin DATE DEFAULT NULL, datins DATETIME NOT NULL, dat_upd DATETIME NOT NULL, INDEX IDX_C49395F81DA477BE (clr_org_id), INDEX IDX_C49395F886B0C336 (clr_art_id_id), INDEX IDX_C49395F8E85F52E7 (usr_ins_id), INDEX IDX_C49395F88E55D6C2 (usr_upd_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE torganisation (id INT AUTO_INCREMENT NOT NULL, usr_ins_id INT DEFAULT NULL, usr_upd_id INT DEFAULT NULL, cod VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, dat_ins DATETIME NOT NULL, dat_upd DATETIME DEFAULT NULL, INDEX IDX_E80DA44BE85F52E7 (usr_ins_id), INDEX IDX_E80DA44B8E55D6C2 (usr_upd_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tgritar ADD CONSTRAINT FK_C49395F81DA477BE FOREIGN KEY (clr_org_id) REFERENCES torganisation (id)');
        $this->addSql('ALTER TABLE tgritar ADD CONSTRAINT FK_C49395F886B0C336 FOREIGN KEY (clr_art_id_id) REFERENCES tarticle (id)');
        $this->addSql('ALTER TABLE tgritar ADD CONSTRAINT FK_C49395F8E85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tgritar ADD CONSTRAINT FK_C49395F88E55D6C2 FOREIGN KEY (usr_upd_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE torganisation ADD CONSTRAINT FK_E80DA44BE85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE torganisation ADD CONSTRAINT FK_E80DA44B8E55D6C2 FOREIGN KEY (usr_upd_id) REFERENCES tuser (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tgritar DROP FOREIGN KEY FK_C49395F81DA477BE');
        $this->addSql('DROP TABLE tgritar');
        $this->addSql('DROP TABLE torganisation');
    }
}
