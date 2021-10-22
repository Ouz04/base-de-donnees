<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210521153314 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tflxett ADD clr_ficstr_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tflxett ADD CONSTRAINT FK_FB88D522FC15BFFF FOREIGN KEY (clr_ficstr_id) REFERENCES tficstrett (id)');
        $this->addSql('CREATE INDEX IDX_FB88D522FC15BFFF ON tflxett (clr_ficstr_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tflxett DROP FOREIGN KEY FK_FB88D522FC15BFFF');
        $this->addSql('DROP INDEX IDX_FB88D522FC15BFFF ON tflxett');
        $this->addSql('ALTER TABLE tflxett DROP clr_ficstr_id');
    }
}
