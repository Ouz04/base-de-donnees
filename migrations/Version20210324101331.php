<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210324101331 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tart_mdlimp (id INT AUTO_INCREMENT NOT NULL, clr_art_id INT DEFAULT NULL, clr_mdlimp_id INT DEFAULT NULL, usr_ins_id INT DEFAULT NULL, usr_upd_id INT DEFAULT NULL, dat_ins DATETIME NOT NULL, dat_upd DATETIME DEFAULT NULL, INDEX IDX_56F3037F6502EEBF (clr_art_id), INDEX IDX_56F3037F76B9589F (clr_mdlimp_id), INDEX IDX_56F3037FE85F52E7 (usr_ins_id), INDEX IDX_56F3037F8E55D6C2 (usr_upd_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tmdlimp (id INT AUTO_INCREMENT NOT NULL, usr_ins_id INT DEFAULT NULL, usr_upd_id INT DEFAULT NULL, cod VARCHAR(30) NOT NULL, nom VARCHAR(255) NOT NULL, dat_ins DATETIME NOT NULL, dat_upd DATETIME DEFAULT NULL, x_act TINYINT(1) NOT NULL, INDEX IDX_EB333A8DE85F52E7 (usr_ins_id), INDEX IDX_EB333A8D8E55D6C2 (usr_upd_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tart_mdlimp ADD CONSTRAINT FK_56F3037F6502EEBF FOREIGN KEY (clr_art_id) REFERENCES tarticle (id)');
        $this->addSql('ALTER TABLE tart_mdlimp ADD CONSTRAINT FK_56F3037F76B9589F FOREIGN KEY (clr_mdlimp_id) REFERENCES tmdlimp (id)');
        $this->addSql('ALTER TABLE tart_mdlimp ADD CONSTRAINT FK_56F3037FE85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tart_mdlimp ADD CONSTRAINT FK_56F3037F8E55D6C2 FOREIGN KEY (usr_upd_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tmdlimp ADD CONSTRAINT FK_EB333A8DE85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tmdlimp ADD CONSTRAINT FK_EB333A8D8E55D6C2 FOREIGN KEY (usr_upd_id) REFERENCES tuser (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tart_mdlimp DROP FOREIGN KEY FK_56F3037F76B9589F');
        $this->addSql('DROP TABLE tart_mdlimp');
        $this->addSql('DROP TABLE tmdlimp');
    }
}
