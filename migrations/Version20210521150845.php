<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210521150845 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tficstrett (id INT AUTO_INCREMENT NOT NULL, usr_ins_id INT DEFAULT NULL, usr_upd_id INT DEFAULT NULL, cod VARCHAR(20) NOT NULL, dsg VARCHAR(255) NOT NULL, dat_ins DATETIME DEFAULT NULL, dat_upd DATETIME DEFAULT NULL, INDEX IDX_545E0939E85F52E7 (usr_ins_id), INDEX IDX_545E09398E55D6C2 (usr_upd_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tficstrpst (id INT AUTO_INCREMENT NOT NULL, clr_ficstr_id INT DEFAULT NULL, usr_ins_id INT DEFAULT NULL, usr_upd_id INT DEFAULT NULL, chp VARCHAR(20) NOT NULL, dsg VARCHAR(50) NOT NULL, typ VARCHAR(10) DEFAULT NULL, lng INT DEFAULT NULL, frm VARCHAR(100) DEFAULT NULL, dat_ins DATETIME NOT NULL, dat_upd DATETIME DEFAULT NULL, INDEX IDX_1F2FE65FC15BFFF (clr_ficstr_id), INDEX IDX_1F2FE65E85F52E7 (usr_ins_id), INDEX IDX_1F2FE658E55D6C2 (usr_upd_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tficstrett ADD CONSTRAINT FK_545E0939E85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tficstrett ADD CONSTRAINT FK_545E09398E55D6C2 FOREIGN KEY (usr_upd_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tficstrpst ADD CONSTRAINT FK_1F2FE65FC15BFFF FOREIGN KEY (clr_ficstr_id) REFERENCES tficstrett (id)');
        $this->addSql('ALTER TABLE tficstrpst ADD CONSTRAINT FK_1F2FE65E85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tficstrpst ADD CONSTRAINT FK_1F2FE658E55D6C2 FOREIGN KEY (usr_upd_id) REFERENCES tuser (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tficstrpst DROP FOREIGN KEY FK_1F2FE65FC15BFFF');
        $this->addSql('DROP TABLE tficstrett');
        $this->addSql('DROP TABLE tficstrpst');
    }
}
