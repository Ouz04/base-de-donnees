<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210511131041 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tclient ADD rso VARCHAR(50) DEFAULT NULL, ADD cplt_nom VARCHAR(50) DEFAULT NULL, ADD adr VARCHAR(50) DEFAULT NULL, ADD cplt_adr VARCHAR(50) DEFAULT NULL, ADD lie_dit VARCHAR(50) DEFAULT NULL, ADD cp VARCHAR(20) NOT NULL, ADD lclt VARCHAR(50) NOT NULL, ADD ctc VARCHAR(50) DEFAULT NULL, ADD mail VARCHAR(100) DEFAULT NULL, ADD tel_bur VARCHAR(20) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tclient DROP rso, DROP cplt_nom, DROP adr, DROP cplt_adr, DROP lie_dit, DROP cp, DROP lclt, DROP ctc, DROP mail, DROP tel_bur');
    }
}
