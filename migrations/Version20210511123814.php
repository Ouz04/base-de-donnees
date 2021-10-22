<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210511123814 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tcotcli (id INT AUTO_INCREMENT NOT NULL, clr_cot_id INT DEFAULT NULL, clr_cli_id INT DEFAULT NULL, usr_ins_id INT NOT NULL, usr_upd_id INT DEFAULT NULL, dat_deb DATE NOT NULL, dat_fin DATE NOT NULL, dat_ins DATETIME NOT NULL, dat_upd DATETIME DEFAULT NULL, INDEX IDX_43A309CBB0BA1C87 (clr_cot_id), INDEX IDX_43A309CB5569E915 (clr_cli_id), INDEX IDX_43A309CBE85F52E7 (usr_ins_id), INDEX IDX_43A309CB8E55D6C2 (usr_upd_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tcotcli ADD CONSTRAINT FK_43A309CBB0BA1C87 FOREIGN KEY (clr_cot_id) REFERENCES tcotation (id)');
        $this->addSql('ALTER TABLE tcotcli ADD CONSTRAINT FK_43A309CB5569E915 FOREIGN KEY (clr_cli_id) REFERENCES tclient (id)');
        $this->addSql('ALTER TABLE tcotcli ADD CONSTRAINT FK_43A309CBE85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tcotcli ADD CONSTRAINT FK_43A309CB8E55D6C2 FOREIGN KEY (usr_upd_id) REFERENCES tuser (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE tcotcli');
    }
}
