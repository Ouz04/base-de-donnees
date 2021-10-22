<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210305124317 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tcmlusr (id INT AUTO_INCREMENT NOT NULL, clr_cml_id INT DEFAULT NULL, clr_usr_id INT DEFAULT NULL, usr_ins_id INT DEFAULT NULL, usr_upd_id INT DEFAULT NULL, dat_deb DATE NOT NULL, dat_fin DATE DEFAULT NULL, dat_ins DATETIME NOT NULL, dat_upd DATETIME DEFAULT NULL, INDEX IDX_F35A3D6B5FD73097 (clr_cml_id), INDEX IDX_F35A3D6BE54ED85E (clr_usr_id), INDEX IDX_F35A3D6BE85F52E7 (usr_ins_id), INDEX IDX_F35A3D6B8E55D6C2 (usr_upd_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tcmlusr ADD CONSTRAINT FK_F35A3D6B5FD73097 FOREIGN KEY (clr_cml_id) REFERENCES tcommercial (id)');
        $this->addSql('ALTER TABLE tcmlusr ADD CONSTRAINT FK_F35A3D6BE54ED85E FOREIGN KEY (clr_usr_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tcmlusr ADD CONSTRAINT FK_F35A3D6BE85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tcmlusr ADD CONSTRAINT FK_F35A3D6B8E55D6C2 FOREIGN KEY (usr_upd_id) REFERENCES tuser (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE tcmlusr');
    }
}
