<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210316152710 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        //  $this->addSql('ALTER TABLE tgritarett DROP FOREIGN KEY FK_7381470337ACF82A');
        // $this->addSql('DROP INDEX IDX_7381470337ACF82A ON tgritarett');
        // $this->addSql('ALTER TABLE tgritarett CHANGE typ_ori_gta_id clr_tog_id INT DEFAULT NULL');
        // $this->addSql('ALTER TABLE tgritarett ADD CONSTRAINT FK_73814703ECC5D6D5 FOREIGN KEY (clr_tog_id) REFERENCES ttyporigta (id)');
        // $this->addSql('CREATE INDEX IDX_73814703ECC5D6D5 ON tgritarett (clr_tog_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        // $this->addSql('ALTER TABLE tgritarett DROP FOREIGN KEY FK_73814703ECC5D6D5');
        //  $this->addSql('DROP INDEX IDX_73814703ECC5D6D5 ON tgritarett');
        // $this->addSql('ALTER TABLE tgritarett CHANGE clr_tog_id typ_ori_gta_id INT DEFAULT NULL');
        // $this->addSql('ALTER TABLE tgritarett ADD CONSTRAINT FK_7381470337ACF82A FOREIGN KEY (typ_ori_gta_id) REFERENCES ttyporigta (id)');
        // $this->addSql('CREATE INDEX IDX_7381470337ACF82A ON tgritarett (typ_ori_gta_id)');
    }
}
