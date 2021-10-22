<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210823141040 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tartfou ADD clr_cot_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tartfou ADD CONSTRAINT FK_AFFC3694B0BA1C87 FOREIGN KEY (clr_cot_id) REFERENCES tcotation (id)');
        $this->addSql('CREATE INDEX IDX_AFFC3694B0BA1C87 ON tartfou (clr_cot_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tartfou DROP FOREIGN KEY FK_AFFC3694B0BA1C87');
        $this->addSql('DROP INDEX IDX_AFFC3694B0BA1C87 ON tartfou');
        $this->addSql('ALTER TABLE tartfou DROP clr_cot_id');
    }
}
