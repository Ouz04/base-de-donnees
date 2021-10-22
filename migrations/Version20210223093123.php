<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210223093123 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE taction (id INT AUTO_INCREMENT NOT NULL, usr_ins_id INT NOT NULL, usr_upd_id INT DEFAULT NULL, clr_rol_id INT DEFAULT NULL, cod VARCHAR(20) NOT NULL, dsg VARCHAR(255) NOT NULL, dsg_lng VARCHAR(255) DEFAULT NULL, dat_ins DATETIME NOT NULL, dat_upd DATETIME DEFAULT NULL, rng_aff INT DEFAULT NULL, INDEX IDX_73450677E85F52E7 (usr_ins_id), INDEX IDX_734506778E55D6C2 (usr_upd_id), INDEX IDX_73450677ED9DB2C9 (clr_rol_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trole (id INT AUTO_INCREMENT NOT NULL, usr_ins_id INT NOT NULL, usr_upd_id INT DEFAULT NULL, cod VARCHAR(20) NOT NULL, dsg VARCHAR(255) NOT NULL, dat_ins DATETIME NOT NULL, dat_upd DATETIME DEFAULT NULL, INDEX IDX_BC5DE464E85F52E7 (usr_ins_id), INDEX IDX_BC5DE4648E55D6C2 (usr_upd_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE taction ADD CONSTRAINT FK_73450677E85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE taction ADD CONSTRAINT FK_734506778E55D6C2 FOREIGN KEY (usr_upd_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE taction ADD CONSTRAINT FK_73450677ED9DB2C9 FOREIGN KEY (clr_rol_id) REFERENCES trole (id)');
        $this->addSql('ALTER TABLE trole ADD CONSTRAINT FK_BC5DE464E85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE trole ADD CONSTRAINT FK_BC5DE4648E55D6C2 FOREIGN KEY (usr_upd_id) REFERENCES tuser (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE taction DROP FOREIGN KEY FK_73450677ED9DB2C9');
        $this->addSql('DROP TABLE taction');
        $this->addSql('DROP TABLE trole');
    }
}
