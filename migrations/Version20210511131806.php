<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210511131806 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tclient ADD clr_pys_id INT DEFAULT NULL, CHANGE lie_dit lieu_dit VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE tclient ADD CONSTRAINT FK_F3CD8EB0478F3629 FOREIGN KEY (clr_pys_id) REFERENCES tpays (id)');
        $this->addSql('CREATE INDEX IDX_F3CD8EB0478F3629 ON tclient (clr_pys_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tclient DROP FOREIGN KEY FK_F3CD8EB0478F3629');
        $this->addSql('DROP INDEX IDX_F3CD8EB0478F3629 ON tclient');
        $this->addSql('ALTER TABLE tclient DROP clr_pys_id, CHANGE lieu_dit lie_dit VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
