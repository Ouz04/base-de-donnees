<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210319134809 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        // $this->addSql('ALTER TABLE tarticle DROP FOREIGN KEY FK_D26E911B75956079');
        // $this->addSql('DROP INDEX IDX_D26E911B75956079 ON tarticle');
        // $this->addSql('ALTER TABLE tarticle CHANGE clr_icemrq_id clr_mrqice_id INT DEFAULT NULL');
        // $this->addSql('ALTER TABLE tarticle ADD CONSTRAINT FK_D26E911B129384F1 FOREIGN KEY (clr_mrqice_id) REFERENCES tmrqice (id)');
        // $this->addSql('CREATE INDEX IDX_D26E911B129384F1 ON tarticle (clr_mrqice_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        // $this->addSql('ALTER TABLE tarticle DROP FOREIGN KEY FK_D26E911B129384F1');
        // $this->addSql('DROP INDEX IDX_D26E911B129384F1 ON tarticle');
        // $this->addSql('ALTER TABLE tarticle CHANGE clr_mrqice_id clr_icemrq_id INT DEFAULT NULL');
        // $this->addSql('ALTER TABLE tarticle ADD CONSTRAINT FK_D26E911B75956079 FOREIGN KEY (clr_icemrq_id) REFERENCES tmrqice (id)');
        // $this->addSql('CREATE INDEX IDX_D26E911B75956079 ON tarticle (clr_icemrq_id)');
    }
}
