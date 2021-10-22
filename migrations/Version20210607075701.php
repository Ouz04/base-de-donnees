<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210607075701 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_D26E911BDC7BFDC5 ON tarticle');
        $this->addSql('DROP INDEX IDX_D26E911BFC4F8B99 ON tarticle');
        $this->addSql('DROP INDEX IDX_D26E911BCECE522B ON tarticle');
        $this->addSql('ALTER TABLE tarticle ADD clr_sit_stk01_adx_id INT DEFAULT NULL, ADD clr_sit_stk02_adx_id INT DEFAULT NULL, ADD clr_sit_prp_adx_id INT DEFAULT NULL, DROP clr_sit_stk01_id, DROP clr_sit_stk02_id, DROP clr_sit_prp_id');
        $this->addSql('ALTER TABLE tarticle ADD CONSTRAINT FK_D26E911B45BD0955 FOREIGN KEY (clr_sit_stk01_adx_id) REFERENCES tsite (id)');
        $this->addSql('ALTER TABLE tarticle ADD CONSTRAINT FK_D26E911BCB320EB6 FOREIGN KEY (clr_sit_stk02_adx_id) REFERENCES tsite (id)');
        $this->addSql('ALTER TABLE tarticle ADD CONSTRAINT FK_D26E911BB7798512 FOREIGN KEY (clr_famniv1_adx_id) REFERENCES tfamartadx (id)');
        $this->addSql('ALTER TABLE tarticle ADD CONSTRAINT FK_D26E911B39F682F1 FOREIGN KEY (clr_famniv2_adx_id) REFERENCES tfamartadx (id)');
        $this->addSql('ALTER TABLE tarticle ADD CONSTRAINT FK_D26E911BF55C826F FOREIGN KEY (clr_famniv3_adx_id) REFERENCES tfamartadx (id)');
        $this->addSql('ALTER TABLE tarticle ADD CONSTRAINT FK_D26E911B145E7E92 FOREIGN KEY (clr_sit_prp_adx_id) REFERENCES tsite (id)');
        $this->addSql('CREATE INDEX IDX_D26E911B45BD0955 ON tarticle (clr_sit_stk01_adx_id)');
        $this->addSql('CREATE INDEX IDX_D26E911BCB320EB6 ON tarticle (clr_sit_stk02_adx_id)');
        $this->addSql('CREATE INDEX IDX_D26E911B145E7E92 ON tarticle (clr_sit_prp_adx_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tarticle DROP FOREIGN KEY FK_D26E911B45BD0955');
        $this->addSql('ALTER TABLE tarticle DROP FOREIGN KEY FK_D26E911BCB320EB6');
        $this->addSql('ALTER TABLE tarticle DROP FOREIGN KEY FK_D26E911BB7798512');
        $this->addSql('ALTER TABLE tarticle DROP FOREIGN KEY FK_D26E911B39F682F1');
        $this->addSql('ALTER TABLE tarticle DROP FOREIGN KEY FK_D26E911BF55C826F');
        $this->addSql('ALTER TABLE tarticle DROP FOREIGN KEY FK_D26E911B145E7E92');
        $this->addSql('DROP INDEX IDX_D26E911B45BD0955 ON tarticle');
        $this->addSql('DROP INDEX IDX_D26E911BCB320EB6 ON tarticle');
        $this->addSql('DROP INDEX IDX_D26E911B145E7E92 ON tarticle');
        $this->addSql('ALTER TABLE tarticle ADD clr_sit_stk01_id INT DEFAULT NULL, ADD clr_sit_stk02_id INT DEFAULT NULL, ADD clr_sit_prp_id INT DEFAULT NULL, DROP clr_sit_stk01_adx_id, DROP clr_sit_stk02_adx_id, DROP clr_sit_prp_adx_id');
        $this->addSql('CREATE INDEX IDX_D26E911BDC7BFDC5 ON tarticle (clr_sit_stk01_id)');
        $this->addSql('CREATE INDEX IDX_D26E911BFC4F8B99 ON tarticle (clr_sit_prp_id)');
        $this->addSql('CREATE INDEX IDX_D26E911BCECE522B ON tarticle (clr_sit_stk02_id)');
    }
}
