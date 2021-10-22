<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210217105113 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tarticle CHANGE xsit_web01 x_sit_web01 TINYINT(1) DEFAULT NULL, CHANGE dat_ins_sit_web01 dat_sit_web01_ins DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tarticle CHANGE x_sit_web01 xsit_web01 TINYINT(1) DEFAULT NULL, CHANGE dat_sit_web01_ins dat_ins_sit_web01 DATETIME DEFAULT NULL');
    }
}
