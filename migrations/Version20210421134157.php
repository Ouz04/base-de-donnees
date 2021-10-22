<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210421134157 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tgritarpst ADD clr_cotorg_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tgritarpst ADD CONSTRAINT FK_262DB05F4E07C19A FOREIGN KEY (clr_cotorg_id) REFERENCES tcotorg (id)');
        $this->addSql('CREATE INDEX IDX_262DB05F4E07C19A ON tgritarpst (clr_cotorg_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tgritarpst DROP FOREIGN KEY FK_262DB05F4E07C19A');
        $this->addSql('DROP INDEX IDX_262DB05F4E07C19A ON tgritarpst');
        $this->addSql('ALTER TABLE tgritarpst DROP clr_cotorg_id');
    }
}
