<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210816085838 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tcotfamcli (id INT AUTO_INCREMENT NOT NULL, clr_cot_id INT DEFAULT NULL, clr_famcli_id INT DEFAULT NULL, usr_ins_id INT DEFAULT NULL, usr_upd_id INT DEFAULT NULL, dat_deb DATE NOT NULL, dat_fin DATE NOT NULL, dat_ins DATETIME NOT NULL, dat_upd DATETIME DEFAULT NULL, INDEX IDX_6C2EA390B0BA1C87 (clr_cot_id), INDEX IDX_6C2EA390AB91D151 (clr_famcli_id), INDEX IDX_6C2EA390E85F52E7 (usr_ins_id), INDEX IDX_6C2EA3908E55D6C2 (usr_upd_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tcotfamcli ADD CONSTRAINT FK_6C2EA390B0BA1C87 FOREIGN KEY (clr_cot_id) REFERENCES tcotation (id)');
        $this->addSql('ALTER TABLE tcotfamcli ADD CONSTRAINT FK_6C2EA390AB91D151 FOREIGN KEY (clr_famcli_id) REFERENCES tfamcli (id)');
        $this->addSql('ALTER TABLE tcotfamcli ADD CONSTRAINT FK_6C2EA390E85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tcotfamcli ADD CONSTRAINT FK_6C2EA3908E55D6C2 FOREIGN KEY (usr_upd_id) REFERENCES tuser (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE tcotfamcli');
    }
}
