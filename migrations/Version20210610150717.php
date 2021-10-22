<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210610150717 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tarticle ADD clr_ahr_adx_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tarticle ADD CONSTRAINT FK_D26E911BEC9E5C7B FOREIGN KEY (clr_ahr_adx_id) REFERENCES ttabpstadx (id)');
        $this->addSql('CREATE INDEX IDX_D26E911BEC9E5C7B ON tarticle (clr_ahr_adx_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tarticle DROP FOREIGN KEY FK_D26E911BEC9E5C7B');
        $this->addSql('DROP INDEX IDX_D26E911BEC9E5C7B ON tarticle');
        $this->addSql('ALTER TABLE tarticle DROP clr_ahr_adx_id');
    }
}
