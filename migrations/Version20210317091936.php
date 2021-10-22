<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210317091936 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE torganisation ADD clr_pys_id INT DEFAULT NULL, DROP pys');
        $this->addSql('ALTER TABLE torganisation ADD CONSTRAINT FK_E80DA44B478F3629 FOREIGN KEY (clr_pys_id) REFERENCES tpays (id)');
        $this->addSql('CREATE INDEX IDX_E80DA44B478F3629 ON torganisation (clr_pys_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE torganisation DROP FOREIGN KEY FK_E80DA44B478F3629');
        $this->addSql('DROP INDEX IDX_E80DA44B478F3629 ON torganisation');
        $this->addSql('ALTER TABLE torganisation ADD pys VARCHAR(10) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP clr_pys_id');
    }
}
