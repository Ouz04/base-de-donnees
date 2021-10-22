<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210318094123 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tctgicearb (id INT AUTO_INCREMENT NOT NULL, clr_niv1_id INT DEFAULT NULL, clr_niv2_id INT DEFAULT NULL, clr_niv3_id INT DEFAULT NULL, clr_niv4_id INT DEFAULT NULL, usr_ins_id INT DEFAULT NULL, usr_upd_id INT DEFAULT NULL, id_ice INT NOT NULL, dat_ins DATETIME DEFAULT NULL, dat_upd DATETIME DEFAULT NULL, INDEX IDX_15FCF3DD684E50B1 (clr_niv1_id), INDEX IDX_15FCF3DD7AFBFF5F (clr_niv2_id), INDEX IDX_15FCF3DDC247983A (clr_niv3_id), INDEX IDX_15FCF3DD5F90A083 (clr_niv4_id), INDEX IDX_15FCF3DDE85F52E7 (usr_ins_id), INDEX IDX_15FCF3DD8E55D6C2 (usr_upd_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tctgicearb ADD CONSTRAINT FK_15FCF3DD684E50B1 FOREIGN KEY (clr_niv1_id) REFERENCES tctgiceniv (id)');
        $this->addSql('ALTER TABLE tctgicearb ADD CONSTRAINT FK_15FCF3DD7AFBFF5F FOREIGN KEY (clr_niv2_id) REFERENCES tctgiceniv (id)');
        $this->addSql('ALTER TABLE tctgicearb ADD CONSTRAINT FK_15FCF3DDC247983A FOREIGN KEY (clr_niv3_id) REFERENCES tctgiceniv (id)');
        $this->addSql('ALTER TABLE tctgicearb ADD CONSTRAINT FK_15FCF3DD5F90A083 FOREIGN KEY (clr_niv4_id) REFERENCES tctgiceniv (id)');
        $this->addSql('ALTER TABLE tctgicearb ADD CONSTRAINT FK_15FCF3DDE85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tctgicearb ADD CONSTRAINT FK_15FCF3DD8E55D6C2 FOREIGN KEY (usr_upd_id) REFERENCES tuser (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE tctgicearb');
    }
}
