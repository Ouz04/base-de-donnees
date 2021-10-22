<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210604144440 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        //  $this->addSql('ALTER TABLE tarticle DROP FOREIGN KEY FK_D26E911BB7798512');
        //   $this->addSql('ALTER TABLE tarticle DROP FOREIGN KEY FK_D26E911B39F682F1');
        //   $this->addSql('ALTER TABLE tarticle DROP FOREIGN KEY FK_D26E911BF55C826F');
        // $this->addSql('CREATE TABLE tfamartadx (id INT AUTO_INCREMENT NOT NULL, usr_ins_id INT DEFAULT NULL, usr_upd_id INT DEFAULT NULL, cod_tab VARCHAR(5) NOT NULL, cod VARCHAR(20) NOT NULL, dsg VARCHAR(100) NOT NULL, x_act TINYINT(1) NOT NULL, dat_ins DATETIME NOT NULL, dat_upd DATETIME DEFAULT NULL, INDEX IDX_77CC969BE85F52E7 (usr_ins_id), INDEX IDX_77CC969B8E55D6C2 (usr_upd_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        // $this->addSql('ALTER TABLE tfamartadx ADD CONSTRAINT FK_77CC969BE85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES tuser (id)');
        //  $this->addSql('ALTER TABLE tfamartadx ADD CONSTRAINT FK_77CC969B8E55D6C2 FOREIGN KEY (usr_upd_id) REFERENCES tuser (id)');
        // $this->addSql('DROP TABLE tfamniv1adx');
        // $this->addSql('DROP TABLE tfamniv2adx');
        // $this->addSql('DROP TABLE tfamniv3adx');
        // $this->addSql('ALTER TABLE tarticle DROP FOREIGN KEY FK_D26E911BCECE522B');
        // $this->addSql('ALTER TABLE tarticle DROP FOREIGN KEY FK_D26E911BDC7BFDC5');
        // $this->addSql('ALTER TABLE tarticle DROP FOREIGN KEY FK_D26E911BFC4F8B99');
        // //   $this->addSql('ALTER TABLE tarticle DROP FOREIGN KEY FK_D26E911B39F682F1');
        // // $this->addSql('ALTER TABLE tarticle DROP FOREIGN KEY FK_D26E911BB7798512');
        // //  $this->addSql('ALTER TABLE tarticle DROP FOREIGN KEY FK_D26E911BF55C826F');
        // $this->addSql('DROP INDEX IDX_D26E911BDC7BFDC5 ON tarticle');
        // $this->addSql('DROP INDEX IDX_D26E911BFC4F8B99 ON tarticle');
        // $this->addSql('DROP INDEX IDX_D26E911BCECE522B ON tarticle');
        // $this->addSql('ALTER TABLE tarticle ADD clr_sit_stk01_adx_id INT DEFAULT NULL, ADD clr_sit_stk02_adx_id INT DEFAULT NULL, ADD clr_sit_prp_adx_id INT DEFAULT NULL, DROP clr_sit_stk01_id, DROP clr_sit_stk02_id, DROP clr_sit_prp_id');
        // $this->addSql('ALTER TABLE tarticle ADD CONSTRAINT FK_D26E911B45BD0955 FOREIGN KEY (clr_sit_stk01_adx_id) REFERENCES tsite (id)');
        // $this->addSql('ALTER TABLE tarticle ADD CONSTRAINT FK_D26E911BCB320EB6 FOREIGN KEY (clr_sit_stk02_adx_id) REFERENCES tsite (id)');
        // $this->addSql('ALTER TABLE tarticle ADD CONSTRAINT FK_D26E911B145E7E92 FOREIGN KEY (clr_sit_prp_adx_id) REFERENCES tsite (id)');
        // $this->addSql('ALTER TABLE tarticle ADD CONSTRAINT FK_D26E911B39F682F1 FOREIGN KEY (clr_famniv2_adx_id) REFERENCES tfamartadx (id)');
        // $this->addSql('ALTER TABLE tarticle ADD CONSTRAINT FK_D26E911BB7798512 FOREIGN KEY (clr_famniv1_adx_id) REFERENCES tfamartadx (id)');
        // $this->addSql('ALTER TABLE tarticle ADD CONSTRAINT FK_D26E911BF55C826F FOREIGN KEY (clr_famniv3_adx_id) REFERENCES tfamartadx (id)');
        // $this->addSql('CREATE INDEX IDX_D26E911B45BD0955 ON tarticle (clr_sit_stk01_adx_id)');
        // $this->addSql('CREATE INDEX IDX_D26E911BCB320EB6 ON tarticle (clr_sit_stk02_adx_id)');
        // $this->addSql('CREATE INDEX IDX_D26E911B145E7E92 ON tarticle (clr_sit_prp_adx_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tarticle DROP FOREIGN KEY FK_D26E911BB7798512');
        $this->addSql('ALTER TABLE tarticle DROP FOREIGN KEY FK_D26E911B39F682F1');
        $this->addSql('ALTER TABLE tarticle DROP FOREIGN KEY FK_D26E911BF55C826F');
        $this->addSql('CREATE TABLE tfamniv1adx (id INT AUTO_INCREMENT NOT NULL, usr_ins_id INT DEFAULT NULL, usr_upd_id INT DEFAULT NULL, cod VARCHAR(10) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, dsg VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, dat_ins DATETIME NOT NULL, dat_upd DATETIME DEFAULT NULL, x_act TINYINT(1) NOT NULL, INDEX IDX_255ED11C8E55D6C2 (usr_upd_id), INDEX IDX_255ED11CE85F52E7 (usr_ins_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE tfamniv2adx (id INT AUTO_INCREMENT NOT NULL, usr_ins_id INT DEFAULT NULL, usr_upd_id INT DEFAULT NULL, cod VARCHAR(10) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, dsg VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, x_act TINYINT(1) NOT NULL, dat_ins DATETIME NOT NULL, dat_upd DATETIME DEFAULT NULL, INDEX IDX_37EB7EF28E55D6C2 (usr_upd_id), INDEX IDX_37EB7EF2E85F52E7 (usr_ins_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE tfamniv3adx (id INT AUTO_INCREMENT NOT NULL, usr_ins_id INT DEFAULT NULL, usr_upd_id INT DEFAULT NULL, cod VARCHAR(10) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, dsg VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, x_act TINYINT(1) NOT NULL, dat_ins DATETIME NOT NULL, dat_upd DATETIME DEFAULT NULL, INDEX IDX_8F5719978E55D6C2 (usr_upd_id), INDEX IDX_8F571997E85F52E7 (usr_ins_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE tfamniv1adx ADD CONSTRAINT FK_255ED11C8E55D6C2 FOREIGN KEY (usr_upd_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tfamniv1adx ADD CONSTRAINT FK_255ED11CE85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tfamniv2adx ADD CONSTRAINT FK_37EB7EF28E55D6C2 FOREIGN KEY (usr_upd_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tfamniv2adx ADD CONSTRAINT FK_37EB7EF2E85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tfamniv3adx ADD CONSTRAINT FK_8F5719978E55D6C2 FOREIGN KEY (usr_upd_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tfamniv3adx ADD CONSTRAINT FK_8F571997E85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES tuser (id)');
        $this->addSql('DROP TABLE tfamartadx');
        $this->addSql('ALTER TABLE tarticle DROP FOREIGN KEY FK_D26E911B45BD0955');
        $this->addSql('ALTER TABLE tarticle DROP FOREIGN KEY FK_D26E911BCB320EB6');
        $this->addSql('ALTER TABLE tarticle DROP FOREIGN KEY FK_D26E911B145E7E92');
        $this->addSql('ALTER TABLE tarticle DROP FOREIGN KEY FK_D26E911BB7798512');
        $this->addSql('ALTER TABLE tarticle DROP FOREIGN KEY FK_D26E911B39F682F1');
        $this->addSql('ALTER TABLE tarticle DROP FOREIGN KEY FK_D26E911BF55C826F');
        $this->addSql('DROP INDEX IDX_D26E911B45BD0955 ON tarticle');
        $this->addSql('DROP INDEX IDX_D26E911BCB320EB6 ON tarticle');
        $this->addSql('DROP INDEX IDX_D26E911B145E7E92 ON tarticle');
        $this->addSql('ALTER TABLE tarticle ADD clr_sit_stk01_id INT DEFAULT NULL, ADD clr_sit_stk02_id INT DEFAULT NULL, ADD clr_sit_prp_id INT DEFAULT NULL, DROP clr_sit_stk01_adx_id, DROP clr_sit_stk02_adx_id, DROP clr_sit_prp_adx_id');
        $this->addSql('ALTER TABLE tarticle ADD CONSTRAINT FK_D26E911BCECE522B FOREIGN KEY (clr_sit_stk02_id) REFERENCES tsite (id)');
        $this->addSql('ALTER TABLE tarticle ADD CONSTRAINT FK_D26E911BDC7BFDC5 FOREIGN KEY (clr_sit_stk01_id) REFERENCES tsite (id)');
        $this->addSql('ALTER TABLE tarticle ADD CONSTRAINT FK_D26E911BFC4F8B99 FOREIGN KEY (clr_sit_prp_id) REFERENCES tsite (id)');
        $this->addSql('ALTER TABLE tarticle ADD CONSTRAINT FK_D26E911BB7798512 FOREIGN KEY (clr_famniv1_adx_id) REFERENCES tfamniv1adx (id)');
        $this->addSql('ALTER TABLE tarticle ADD CONSTRAINT FK_D26E911B39F682F1 FOREIGN KEY (clr_famniv2_adx_id) REFERENCES tfamniv2adx (id)');
        $this->addSql('ALTER TABLE tarticle ADD CONSTRAINT FK_D26E911BF55C826F FOREIGN KEY (clr_famniv3_adx_id) REFERENCES tfamniv3adx (id)');
        $this->addSql('CREATE INDEX IDX_D26E911BDC7BFDC5 ON tarticle (clr_sit_stk01_id)');
        $this->addSql('CREATE INDEX IDX_D26E911BFC4F8B99 ON tarticle (clr_sit_prp_id)');
        $this->addSql('CREATE INDEX IDX_D26E911BCECE522B ON tarticle (clr_sit_stk02_id)');
    }
}
