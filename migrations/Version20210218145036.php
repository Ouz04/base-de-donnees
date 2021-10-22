<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210218145036 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tartfou (id INT AUTO_INCREMENT NOT NULL, clr_art_id INT NOT NULL, clr_fou_id INT NOT NULL, usr_ins_id INT NOT NULL, usr_upd_id INT DEFAULT NULL, dat_ins DATETIME NOT NULL, dat_upd DATETIME DEFAULT NULL, INDEX IDX_AFFC36946502EEBF (clr_art_id), INDEX IDX_AFFC369458CBEA51 (clr_fou_id), INDEX IDX_AFFC3694E85F52E7 (usr_ins_id), INDEX IDX_AFFC36948E55D6C2 (usr_upd_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tprxach (id INT AUTO_INCREMENT NOT NULL, clp_art_id INT NOT NULL, clp_fou_id INT NOT NULL, usr_ins_id INT NOT NULL, usr_upd_id INT DEFAULT NULL, clp_cndt INT NOT NULL, clp_dat DATE NOT NULL, pht DOUBLE PRECISION NOT NULL, pec DOUBLE PRECISION DEFAULT NULL, pso DOUBLE PRECISION DEFAULT NULL, dat_ins DATETIME NOT NULL, dat_upd DATETIME DEFAULT NULL, INDEX IDX_E75C6D422727E9C2 (clp_art_id), INDEX IDX_E75C6D421AEEED2C (clp_fou_id), INDEX IDX_E75C6D42E85F52E7 (usr_ins_id), INDEX IDX_E75C6D428E55D6C2 (usr_upd_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tartfou ADD CONSTRAINT FK_AFFC36946502EEBF FOREIGN KEY (clr_art_id) REFERENCES tarticle (id)');
        $this->addSql('ALTER TABLE tartfou ADD CONSTRAINT FK_AFFC369458CBEA51 FOREIGN KEY (clr_fou_id) REFERENCES tfournisseur (id)');
        $this->addSql('ALTER TABLE tartfou ADD CONSTRAINT FK_AFFC3694E85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tartfou ADD CONSTRAINT FK_AFFC36948E55D6C2 FOREIGN KEY (usr_upd_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tprxach ADD CONSTRAINT FK_E75C6D422727E9C2 FOREIGN KEY (clp_art_id) REFERENCES tarticle (id)');
        $this->addSql('ALTER TABLE tprxach ADD CONSTRAINT FK_E75C6D421AEEED2C FOREIGN KEY (clp_fou_id) REFERENCES tfournisseur (id)');
        $this->addSql('ALTER TABLE tprxach ADD CONSTRAINT FK_E75C6D42E85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tprxach ADD CONSTRAINT FK_E75C6D428E55D6C2 FOREIGN KEY (usr_upd_id) REFERENCES tuser (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE tartfou');
        $this->addSql('DROP TABLE tprxach');
    }
}
