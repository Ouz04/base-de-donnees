<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210312142846 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE torganisation ADD rso VARCHAR(50) DEFAULT NULL, ADD cplt_nom VARCHAR(50) DEFAULT NULL, ADD adr VARCHAR(50) NOT NULL, ADD cplt_adr VARCHAR(50) DEFAULT NULL, ADD lieu_dit VARCHAR(50) DEFAULT NULL, ADD cp VARCHAR(10) NOT NULL, ADD lclt VARCHAR(50) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE torganisation DROP rso, DROP cplt_nom, DROP adr, DROP cplt_adr, DROP lieu_dit, DROP cp, DROP lclt');
    }
}
