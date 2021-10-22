<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210324164853 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        // $this->addSql('ALTER TABLE tartmdl DROP FOREIGN KEY FK_2436A87E76B9589F');
        // $this->addSql('CREATE TABLE tmodele (id INT AUTO_INCREMENT NOT NULL, usr_ins_id INT DEFAULT NULL, usr_upd_id INT DEFAULT NULL, cod VARCHAR(30) NOT NULL, nom VARCHAR(255) NOT NULL, dat_ins DATETIME NOT NULL, dat_upd DATETIME DEFAULT NULL, x_act TINYINT(1) NOT NULL, INDEX IDX_248B0FBDE85F52E7 (usr_ins_id), INDEX IDX_248B0FBD8E55D6C2 (usr_upd_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        // $this->addSql('ALTER TABLE tmodele ADD CONSTRAINT FK_248B0FBDE85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES tuser (id)');
        // $this->addSql('ALTER TABLE tmodele ADD CONSTRAINT FK_248B0FBD8E55D6C2 FOREIGN KEY (usr_upd_id) REFERENCES tuser (id)');
        // $this->addSql('DROP TABLE tmdlimp');
        // $this->addSql('DROP INDEX IDX_2436A87E76B9589F ON tartmdl');
        // $this->addSql('ALTER TABLE tartmdl CHANGE clr_mdlimp_id clr_mdl_id INT DEFAULT NULL');
        // $this->addSql('ALTER TABLE tartmdl ADD CONSTRAINT FK_2436A87E68CD3396 FOREIGN KEY (clr_mdl_id) REFERENCES tmodele (id)');
        // $this->addSql('CREATE INDEX IDX_2436A87E68CD3396 ON tartmdl (clr_mdl_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        // $this->addSql('ALTER TABLE tartmdl DROP FOREIGN KEY FK_2436A87E68CD3396');
        // $this->addSql('CREATE TABLE tmdlimp (id INT AUTO_INCREMENT NOT NULL, usr_ins_id INT DEFAULT NULL, usr_upd_id INT DEFAULT NULL, cod VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, dat_ins DATETIME NOT NULL, dat_upd DATETIME DEFAULT NULL, x_act TINYINT(1) NOT NULL, INDEX IDX_EB333A8D8E55D6C2 (usr_upd_id), INDEX IDX_EB333A8DE85F52E7 (usr_ins_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        // $this->addSql('ALTER TABLE tmdlimp ADD CONSTRAINT FK_EB333A8D8E55D6C2 FOREIGN KEY (usr_upd_id) REFERENCES tuser (id)');
        // $this->addSql('ALTER TABLE tmdlimp ADD CONSTRAINT FK_EB333A8DE85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES tuser (id)');
        // $this->addSql('DROP TABLE tmodele');
        // $this->addSql('DROP INDEX IDX_2436A87E68CD3396 ON tartmdl');
        // $this->addSql('ALTER TABLE tartmdl CHANGE clr_mdl_id clr_mdlimp_id INT DEFAULT NULL');
        // $this->addSql('ALTER TABLE tartmdl ADD CONSTRAINT FK_2436A87E76B9589F FOREIGN KEY (clr_mdlimp_id) REFERENCES tmdlimp (id)');
        // $this->addSql('CREATE INDEX IDX_2436A87E76B9589F ON tartmdl (clr_mdlimp_id)');
    }
}
