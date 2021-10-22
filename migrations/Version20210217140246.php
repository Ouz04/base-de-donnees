<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210217140246 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tarticle DROP FOREIGN KEY FK_D26E911B1B8E1A1');
        $this->addSql('ALTER TABLE tarticle DROP FOREIGN KEY FK_D26E911BC0149C0');
        $this->addSql('DROP INDEX IDX_D26E911BC0149C0 ON tarticle');
        $this->addSql('DROP INDEX IDX_D26E911B1B8E1A1 ON tarticle');
        $this->addSql('DROP INDEX IDX_cod ON tarticle');
        $this->addSql('ALTER TABLE tarticle ADD clr_ctr_id INT DEFAULT NULL, ADD clr_ctg_id INT DEFAULT NULL, DROP cod_ctr_id, DROP ctg_id');
        $this->addSql('ALTER TABLE tarticle ADD CONSTRAINT FK_D26E911B82E1E5C8 FOREIGN KEY (clr_ctr_id) REFERENCES tconstructeur (id)');
        $this->addSql('ALTER TABLE tarticle ADD CONSTRAINT FK_D26E911BE5264265 FOREIGN KEY (clr_ctg_id) REFERENCES tcategorie (id)');
        $this->addSql('CREATE INDEX IDX_D26E911B82E1E5C8 ON tarticle (clr_ctr_id)');
        $this->addSql('CREATE INDEX IDX_D26E911BE5264265 ON tarticle (clr_ctg_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tarticle DROP FOREIGN KEY FK_D26E911B82E1E5C8');
        $this->addSql('ALTER TABLE tarticle DROP FOREIGN KEY FK_D26E911BE5264265');
        $this->addSql('DROP INDEX IDX_D26E911B82E1E5C8 ON tarticle');
        $this->addSql('DROP INDEX IDX_D26E911BE5264265 ON tarticle');
        $this->addSql('ALTER TABLE tarticle ADD cod_ctr_id INT DEFAULT NULL, ADD ctg_id INT DEFAULT NULL, DROP clr_ctr_id, DROP clr_ctg_id');
        $this->addSql('ALTER TABLE tarticle ADD CONSTRAINT FK_D26E911B1B8E1A1 FOREIGN KEY (cod_ctr_id) REFERENCES tconstructeur (id)');
        $this->addSql('ALTER TABLE tarticle ADD CONSTRAINT FK_D26E911BC0149C0 FOREIGN KEY (ctg_id) REFERENCES tcategorie (id)');
        $this->addSql('CREATE INDEX IDX_D26E911BC0149C0 ON tarticle (ctg_id)');
        $this->addSql('CREATE INDEX IDX_D26E911B1B8E1A1 ON tarticle (cod_ctr_id)');
        $this->addSql('CREATE INDEX IDX_cod ON tarticle (cod)');
    }
}
