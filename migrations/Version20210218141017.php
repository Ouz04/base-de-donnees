<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210218141017 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tclient (id INT AUTO_INCREMENT NOT NULL, clr_bpt_id INT DEFAULT NULL, usr_ins_id INT NOT NULL, usr_upd_id INT DEFAULT NULL, cod VARCHAR(20) NOT NULL, rso VARCHAR(50) NOT NULL, dat_ins DATETIME NOT NULL, dat_upd DATETIME DEFAULT NULL, INDEX IDX_F3CD8EB09956CF71 (clr_bpt_id), INDEX IDX_F3CD8EB0E85F52E7 (usr_ins_id), INDEX IDX_F3CD8EB08E55D6C2 (usr_upd_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tfournisseur (id INT AUTO_INCREMENT NOT NULL, clr_bpt_id INT DEFAULT NULL, usr_ins_id INT NOT NULL, usr_upd_id INT DEFAULT NULL, cod VARCHAR(20) NOT NULL, rso VARCHAR(50) NOT NULL, datins DATETIME NOT NULL, dat_upd DATETIME DEFAULT NULL, INDEX IDX_180073A9956CF71 (clr_bpt_id), INDEX IDX_180073AE85F52E7 (usr_ins_id), INDEX IDX_180073A8E55D6C2 (usr_upd_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tclient ADD CONSTRAINT FK_F3CD8EB09956CF71 FOREIGN KEY (clr_bpt_id) REFERENCES tbpartner (id)');
        $this->addSql('ALTER TABLE tclient ADD CONSTRAINT FK_F3CD8EB0E85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tclient ADD CONSTRAINT FK_F3CD8EB08E55D6C2 FOREIGN KEY (usr_upd_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tfournisseur ADD CONSTRAINT FK_180073A9956CF71 FOREIGN KEY (clr_bpt_id) REFERENCES tbpartner (id)');
        $this->addSql('ALTER TABLE tfournisseur ADD CONSTRAINT FK_180073AE85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tfournisseur ADD CONSTRAINT FK_180073A8E55D6C2 FOREIGN KEY (usr_upd_id) REFERENCES tuser (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE tclient');
        $this->addSql('DROP TABLE tfournisseur');
    }
}
