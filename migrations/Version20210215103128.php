<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210215103128 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tarticle ADD x_adx TINYINT(1) DEFAULT NULL, ADD dat_adx_ins DATETIME DEFAULT NULL, ADD xsit_web01 TINYINT(1) DEFAULT NULL, ADD dat_ins_sit_web01 DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tarticle DROP x_adx, DROP dat_adx_ins, DROP xsit_web01, DROP dat_ins_sit_web01');
    }
}
