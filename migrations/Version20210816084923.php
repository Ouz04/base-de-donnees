<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210816084923 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tarticle DROP chptest');
        $this->addSql('ALTER TABLE tarticle ADD CONSTRAINT FK_D26E911BC64CFB29 FOREIGN KEY (clr_ctgiceniv1_id) REFERENCES tctgiceniv (id)');
        $this->addSql('ALTER TABLE tarticle ADD CONSTRAINT FK_D26E911BD4F954C7 FOREIGN KEY (clr_ctgiceniv2_id) REFERENCES tctgiceniv (id)');
        $this->addSql('ALTER TABLE tgritarett ADD clr_cli_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tgritarett ADD CONSTRAINT FK_738147035569E915 FOREIGN KEY (clr_cli_id) REFERENCES tclient (id)');
        $this->addSql('CREATE INDEX IDX_738147035569E915 ON tgritarett (clr_cli_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tarticle DROP FOREIGN KEY FK_D26E911BC64CFB29');
        $this->addSql('ALTER TABLE tarticle DROP FOREIGN KEY FK_D26E911BD4F954C7');
        $this->addSql('ALTER TABLE tarticle ADD chptest VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE tgritarett DROP FOREIGN KEY FK_738147035569E915');
        $this->addSql('DROP INDEX IDX_738147035569E915 ON tgritarett');
        $this->addSql('ALTER TABLE tgritarett DROP clr_cli_id');
    }
}
