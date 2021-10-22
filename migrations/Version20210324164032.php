<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210324164032 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tartmdl (id INT AUTO_INCREMENT NOT NULL, clr_art_id INT DEFAULT NULL, clr_mdlimp_id INT DEFAULT NULL, usr_ins_id INT DEFAULT NULL, usr_upd_id INT DEFAULT NULL, dat_ins DATETIME NOT NULL, dat_upd DATETIME DEFAULT NULL, INDEX IDX_2436A87E6502EEBF (clr_art_id), INDEX IDX_2436A87E76B9589F (clr_mdlimp_id), INDEX IDX_2436A87EE85F52E7 (usr_ins_id), INDEX IDX_2436A87E8E55D6C2 (usr_upd_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tartmdl ADD CONSTRAINT FK_2436A87E6502EEBF FOREIGN KEY (clr_art_id) REFERENCES tarticle (id)');
        $this->addSql('ALTER TABLE tartmdl ADD CONSTRAINT FK_2436A87E76B9589F FOREIGN KEY (clr_mdlimp_id) REFERENCES tmdlimp (id)');
        $this->addSql('ALTER TABLE tartmdl ADD CONSTRAINT FK_2436A87EE85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tartmdl ADD CONSTRAINT FK_2436A87E8E55D6C2 FOREIGN KEY (usr_upd_id) REFERENCES tuser (id)');
        $this->addSql('DROP TABLE tartmdlimp');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tartmdlimp (id INT AUTO_INCREMENT NOT NULL, clr_art_id INT DEFAULT NULL, clr_mdlimp_id INT DEFAULT NULL, usr_ins_id INT DEFAULT NULL, usr_upd_id INT DEFAULT NULL, dat_ins DATETIME NOT NULL, dat_upd DATETIME DEFAULT NULL, INDEX IDX_CF1AAB6D76B9589F (clr_mdlimp_id), INDEX IDX_CF1AAB6D8E55D6C2 (usr_upd_id), INDEX IDX_CF1AAB6D6502EEBF (clr_art_id), INDEX IDX_CF1AAB6DE85F52E7 (usr_ins_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE tartmdlimp ADD CONSTRAINT FK_CF1AAB6D6502EEBF FOREIGN KEY (clr_art_id) REFERENCES tarticle (id)');
        $this->addSql('ALTER TABLE tartmdlimp ADD CONSTRAINT FK_CF1AAB6D76B9589F FOREIGN KEY (clr_mdlimp_id) REFERENCES tmdlimp (id)');
        $this->addSql('ALTER TABLE tartmdlimp ADD CONSTRAINT FK_CF1AAB6D8E55D6C2 FOREIGN KEY (usr_upd_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tartmdlimp ADD CONSTRAINT FK_CF1AAB6DE85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES tuser (id)');
        $this->addSql('DROP TABLE tartmdl');
    }
}
