<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210604120954 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tcodctaadx (id INT AUTO_INCREMENT NOT NULL, usr_ins_id INT DEFAULT NULL, usr_upd_id INT DEFAULT NULL, cod VARCHAR(10) NOT NULL, dsg VARCHAR(100) NOT NULL, x_act TINYINT(1) NOT NULL, dat_ins DATETIME NOT NULL, dat_upd DATETIME DEFAULT NULL, INDEX IDX_18067733E85F52E7 (usr_ins_id), INDEX IDX_180677338E55D6C2 (usr_upd_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tfamniv1adx (id INT AUTO_INCREMENT NOT NULL, usr_ins_id INT DEFAULT NULL, usr_upd_id INT DEFAULT NULL, cod VARCHAR(10) NOT NULL, dsg VARCHAR(100) NOT NULL, dat_ins DATETIME NOT NULL, dat_upd DATETIME DEFAULT NULL, x_act TINYINT(1) NOT NULL, INDEX IDX_255ED11CE85F52E7 (usr_ins_id), INDEX IDX_255ED11C8E55D6C2 (usr_upd_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tfamniv2adx (id INT AUTO_INCREMENT NOT NULL, usr_ins_id INT DEFAULT NULL, usr_upd_id INT DEFAULT NULL, cod VARCHAR(10) NOT NULL, dsg VARCHAR(100) NOT NULL, x_act TINYINT(1) NOT NULL, dat_ins DATETIME NOT NULL, dat_upd DATETIME DEFAULT NULL, INDEX IDX_37EB7EF2E85F52E7 (usr_ins_id), INDEX IDX_37EB7EF28E55D6C2 (usr_upd_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tfamniv3adx (id INT AUTO_INCREMENT NOT NULL, usr_ins_id INT DEFAULT NULL, usr_upd_id INT DEFAULT NULL, cod VARCHAR(10) NOT NULL, dsg VARCHAR(100) NOT NULL, x_act TINYINT(1) NOT NULL, dat_ins DATETIME NOT NULL, dat_upd DATETIME DEFAULT NULL, INDEX IDX_8F571997E85F52E7 (usr_ins_id), INDEX IDX_8F5719978E55D6C2 (usr_upd_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ttaxadx (id INT AUTO_INCREMENT NOT NULL, usr_ins_id INT DEFAULT NULL, usr_upd_id INT DEFAULT NULL, cod VARCHAR(10) NOT NULL, dsg VARCHAR(100) NOT NULL, x_act TINYINT(1) NOT NULL, dat_ins DATETIME NOT NULL, dat_upd DATETIME DEFAULT NULL, INDEX IDX_97B44A5E85F52E7 (usr_ins_id), INDEX IDX_97B44A58E55D6C2 (usr_upd_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tcodctaadx ADD CONSTRAINT FK_18067733E85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tcodctaadx ADD CONSTRAINT FK_180677338E55D6C2 FOREIGN KEY (usr_upd_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tfamniv1adx ADD CONSTRAINT FK_255ED11CE85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tfamniv1adx ADD CONSTRAINT FK_255ED11C8E55D6C2 FOREIGN KEY (usr_upd_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tfamniv2adx ADD CONSTRAINT FK_37EB7EF2E85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tfamniv2adx ADD CONSTRAINT FK_37EB7EF28E55D6C2 FOREIGN KEY (usr_upd_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tfamniv3adx ADD CONSTRAINT FK_8F571997E85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tfamniv3adx ADD CONSTRAINT FK_8F5719978E55D6C2 FOREIGN KEY (usr_upd_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE ttaxadx ADD CONSTRAINT FK_97B44A5E85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE ttaxadx ADD CONSTRAINT FK_97B44A58E55D6C2 FOREIGN KEY (usr_upd_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tarticle ADD clr_sit_stk01_id INT DEFAULT NULL, ADD clr_sit_stk02_id INT DEFAULT NULL, ADD clr_apc_adx_id INT DEFAULT NULL, ADD clr_famniv1_adx_id INT DEFAULT NULL, ADD clr_famniv2_adx_id INT DEFAULT NULL, ADD clr_famniv3_adx_id INT DEFAULT NULL, ADD clr_sit_prp_id INT DEFAULT NULL, ADD clr_cod_cta_adx_id INT DEFAULT NULL, ADD clr_niv_tax_adx_id INT DEFAULT NULL, ADD mod_gst_adx VARCHAR(20) DEFAULT NULL');
        $this->addSql('ALTER TABLE tarticle ADD CONSTRAINT FK_D26E911BDC7BFDC5 FOREIGN KEY (clr_sit_stk01_id) REFERENCES tsite (id)');
        $this->addSql('ALTER TABLE tarticle ADD CONSTRAINT FK_D26E911BCECE522B FOREIGN KEY (clr_sit_stk02_id) REFERENCES tsite (id)');
        $this->addSql('ALTER TABLE tarticle ADD CONSTRAINT FK_D26E911B4B978DA7 FOREIGN KEY (clr_apc_adx_id) REFERENCES tsociete (id)');
        $this->addSql('ALTER TABLE tarticle ADD CONSTRAINT FK_D26E911BB7798512 FOREIGN KEY (clr_famniv1_adx_id) REFERENCES tfamniv1adx (id)');
        $this->addSql('ALTER TABLE tarticle ADD CONSTRAINT FK_D26E911B39F682F1 FOREIGN KEY (clr_famniv2_adx_id) REFERENCES tfamniv2adx (id)');
        $this->addSql('ALTER TABLE tarticle ADD CONSTRAINT FK_D26E911BF55C826F FOREIGN KEY (clr_famniv3_adx_id) REFERENCES tfamniv3adx (id)');
        $this->addSql('ALTER TABLE tarticle ADD CONSTRAINT FK_D26E911BFC4F8B99 FOREIGN KEY (clr_sit_prp_id) REFERENCES tsite (id)');
        $this->addSql('ALTER TABLE tarticle ADD CONSTRAINT FK_D26E911BD183020B FOREIGN KEY (clr_cod_cta_adx_id) REFERENCES tcodctaadx (id)');
        $this->addSql('ALTER TABLE tarticle ADD CONSTRAINT FK_D26E911B666E6941 FOREIGN KEY (clr_niv_tax_adx_id) REFERENCES ttaxadx (id)');
        $this->addSql('CREATE INDEX IDX_D26E911BDC7BFDC5 ON tarticle (clr_sit_stk01_id)');
        $this->addSql('CREATE INDEX IDX_D26E911BCECE522B ON tarticle (clr_sit_stk02_id)');
        $this->addSql('CREATE INDEX IDX_D26E911B4B978DA7 ON tarticle (clr_apc_adx_id)');
        $this->addSql('CREATE INDEX IDX_D26E911BB7798512 ON tarticle (clr_famniv1_adx_id)');
        $this->addSql('CREATE INDEX IDX_D26E911B39F682F1 ON tarticle (clr_famniv2_adx_id)');
        $this->addSql('CREATE INDEX IDX_D26E911BF55C826F ON tarticle (clr_famniv3_adx_id)');
        $this->addSql('CREATE INDEX IDX_D26E911BFC4F8B99 ON tarticle (clr_sit_prp_id)');
        $this->addSql('CREATE INDEX IDX_D26E911BD183020B ON tarticle (clr_cod_cta_adx_id)');
        $this->addSql('CREATE INDEX IDX_D26E911B666E6941 ON tarticle (clr_niv_tax_adx_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tarticle DROP FOREIGN KEY FK_D26E911BD183020B');
        $this->addSql('ALTER TABLE tarticle DROP FOREIGN KEY FK_D26E911BB7798512');
        $this->addSql('ALTER TABLE tarticle DROP FOREIGN KEY FK_D26E911B39F682F1');
        $this->addSql('ALTER TABLE tarticle DROP FOREIGN KEY FK_D26E911BF55C826F');
        $this->addSql('ALTER TABLE tarticle DROP FOREIGN KEY FK_D26E911B666E6941');
        $this->addSql('DROP TABLE tcodctaadx');
        $this->addSql('DROP TABLE tfamniv1adx');
        $this->addSql('DROP TABLE tfamniv2adx');
        $this->addSql('DROP TABLE tfamniv3adx');
        $this->addSql('DROP TABLE ttaxadx');
        $this->addSql('ALTER TABLE tarticle DROP FOREIGN KEY FK_D26E911BDC7BFDC5');
        $this->addSql('ALTER TABLE tarticle DROP FOREIGN KEY FK_D26E911BCECE522B');
        $this->addSql('ALTER TABLE tarticle DROP FOREIGN KEY FK_D26E911B4B978DA7');
        $this->addSql('ALTER TABLE tarticle DROP FOREIGN KEY FK_D26E911BFC4F8B99');
        $this->addSql('DROP INDEX IDX_D26E911BDC7BFDC5 ON tarticle');
        $this->addSql('DROP INDEX IDX_D26E911BCECE522B ON tarticle');
        $this->addSql('DROP INDEX IDX_D26E911B4B978DA7 ON tarticle');
        $this->addSql('DROP INDEX IDX_D26E911BB7798512 ON tarticle');
        $this->addSql('DROP INDEX IDX_D26E911B39F682F1 ON tarticle');
        $this->addSql('DROP INDEX IDX_D26E911BF55C826F ON tarticle');
        $this->addSql('DROP INDEX IDX_D26E911BFC4F8B99 ON tarticle');
        $this->addSql('DROP INDEX IDX_D26E911BD183020B ON tarticle');
        $this->addSql('DROP INDEX IDX_D26E911B666E6941 ON tarticle');
        $this->addSql('ALTER TABLE tarticle DROP clr_sit_stk01_id, DROP clr_sit_stk02_id, DROP clr_apc_adx_id, DROP clr_famniv1_adx_id, DROP clr_famniv2_adx_id, DROP clr_famniv3_adx_id, DROP clr_sit_prp_id, DROP clr_cod_cta_adx_id, DROP clr_niv_tax_adx_id, DROP mod_gst_adx');
    }
}
