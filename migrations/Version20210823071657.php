<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210823071657 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article_rechercheb (id INT AUTO_INCREMENT NOT NULL, clr_ctg_id INT DEFAULT NULL, clr_ctr_id INT DEFAULT NULL, art_cod VARCHAR(255) DEFAULT NULL, INDEX IDX_D26CFDC6E5264265 (clr_ctg_id), INDEX IDX_D26CFDC682E1E5C8 (clr_ctr_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tart_adx (id INT AUTO_INCREMENT NOT NULL, cod VARCHAR(30) NOT NULL, lib01_adx VARCHAR(255) NOT NULL, lib02_adx VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tcli_org (id INT AUTO_INCREMENT NOT NULL, clr_cli_id INT DEFAULT NULL, clr_org_id INT DEFAULT NULL, usr_ins_id INT DEFAULT NULL, usr_upd_id INT DEFAULT NULL, dat_ins DATETIME NOT NULL, dat_upd DATETIME DEFAULT NULL, INDEX IDX_248B0005569E915 (clr_cli_id), INDEX IDX_248B0001DA477BE (clr_org_id), INDEX IDX_248B000E85F52E7 (usr_ins_id), INDEX IDX_248B0008E55D6C2 (usr_upd_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tsocgpe (id INT AUTO_INCREMENT NOT NULL, usr_ins_id INT NOT NULL, usr_upd_id INT DEFAULT NULL, cod VARCHAR(10) NOT NULL, dsg VARCHAR(255) NOT NULL, dat_ins DATETIME NOT NULL, dat_upd DATETIME DEFAULT NULL, x_act TINYINT(1) NOT NULL, INDEX IDX_6573DDDCE85F52E7 (usr_ins_id), INDEX IDX_6573DDDC8E55D6C2 (usr_upd_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tsocgpt (id INT AUTO_INCREMENT NOT NULL, usr_ins_id INT NOT NULL, usr_upd_id INT DEFAULT NULL, cod VARCHAR(10) NOT NULL, dsg VARCHAR(255) NOT NULL, dat_ins DATETIME NOT NULL, dat_upd DATETIME DEFAULT NULL, x_act TINYINT(1) NOT NULL, INDEX IDX_FC3FD2EE85F52E7 (usr_ins_id), INDEX IDX_FC3FD2E8E55D6C2 (usr_upd_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE upload (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, usr_ins_id INT DEFAULT NULL, usr_upd_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, full_name VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, dat_ins DATETIME DEFAULT NULL, dat_upd DATETIME DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, token VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D649E85F52E7 (usr_ins_id), INDEX IDX_8D93D6498E55D6C2 (usr_upd_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article_rechercheb ADD CONSTRAINT FK_D26CFDC6E5264265 FOREIGN KEY (clr_ctg_id) REFERENCES tcategorie (id)');
        $this->addSql('ALTER TABLE article_rechercheb ADD CONSTRAINT FK_D26CFDC682E1E5C8 FOREIGN KEY (clr_ctr_id) REFERENCES tconstructeur (id)');
        $this->addSql('ALTER TABLE tcli_org ADD CONSTRAINT FK_248B0005569E915 FOREIGN KEY (clr_cli_id) REFERENCES tclient (id)');
        $this->addSql('ALTER TABLE tcli_org ADD CONSTRAINT FK_248B0001DA477BE FOREIGN KEY (clr_org_id) REFERENCES torganisation (id)');
        $this->addSql('ALTER TABLE tcli_org ADD CONSTRAINT FK_248B000E85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tcli_org ADD CONSTRAINT FK_248B0008E55D6C2 FOREIGN KEY (usr_upd_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tsocgpe ADD CONSTRAINT FK_6573DDDCE85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tsocgpe ADD CONSTRAINT FK_6573DDDC8E55D6C2 FOREIGN KEY (usr_upd_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tsocgpt ADD CONSTRAINT FK_FC3FD2EE85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tsocgpt ADD CONSTRAINT FK_FC3FD2E8E55D6C2 FOREIGN KEY (usr_upd_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649E85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6498E55D6C2 FOREIGN KEY (usr_upd_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE tclient ADD clr_soc_id INT DEFAULT NULL, ADD clr_socgpe_id INT DEFAULT NULL, ADD clr_socgpt_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tclient ADD CONSTRAINT FK_F3CD8EB07EA2713A FOREIGN KEY (clr_soc_id) REFERENCES tsociete (id)');
        $this->addSql('ALTER TABLE tclient ADD CONSTRAINT FK_F3CD8EB07C24382D FOREIGN KEY (clr_socgpe_id) REFERENCES tsocgpe (id)');
        $this->addSql('ALTER TABLE tclient ADD CONSTRAINT FK_F3CD8EB0948108D7 FOREIGN KEY (clr_socgpt_id) REFERENCES tsocgpt (id)');
        $this->addSql('CREATE INDEX IDX_F3CD8EB07EA2713A ON tclient (clr_soc_id)');
        $this->addSql('CREATE INDEX IDX_F3CD8EB07C24382D ON tclient (clr_socgpe_id)');
        $this->addSql('CREATE INDEX IDX_F3CD8EB0948108D7 ON tclient (clr_socgpt_id)');
        $this->addSql('ALTER TABLE tsociete ADD x_ext TINYINT(1) NOT NULL, ADD x_act TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tclient DROP FOREIGN KEY FK_F3CD8EB07C24382D');
        $this->addSql('ALTER TABLE tclient DROP FOREIGN KEY FK_F3CD8EB0948108D7');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649E85F52E7');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6498E55D6C2');
        $this->addSql('DROP TABLE article_rechercheb');
        $this->addSql('DROP TABLE tart_adx');
        $this->addSql('DROP TABLE tcli_org');
        $this->addSql('DROP TABLE tsocgpe');
        $this->addSql('DROP TABLE tsocgpt');
        $this->addSql('DROP TABLE upload');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE tclient DROP FOREIGN KEY FK_F3CD8EB07EA2713A');
        $this->addSql('DROP INDEX IDX_F3CD8EB07EA2713A ON tclient');
        $this->addSql('DROP INDEX IDX_F3CD8EB07C24382D ON tclient');
        $this->addSql('DROP INDEX IDX_F3CD8EB0948108D7 ON tclient');
        $this->addSql('ALTER TABLE tclient DROP clr_soc_id, DROP clr_socgpe_id, DROP clr_socgpt_id');
        $this->addSql('ALTER TABLE tsociete DROP x_ext, DROP x_act');
    }
}
