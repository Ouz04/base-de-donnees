<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210510144711 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        //  $this->addSql('ALTER TABLE tbpartner ADD clr_pys_id INT DEFAULT NULL');
        //    $this->addSql('ALTER TABLE tbpartner ADD CONSTRAINT FK_75CFC0D9478F3629 FOREIGN KEY (clr_pys_id) REFERENCES tpays (id)');
        //  $this->addSql('CREATE INDEX IDX_75CFC0D9478F3629 ON tbpartner (clr_pys_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        //   $this->addSql('ALTER TABLE tbpartner DROP FOREIGN KEY FK_75CFC0D9478F3629');
        //   $this->addSql('DROP INDEX IDX_75CFC0D9478F3629 ON tbpartner');
        //  $this->addSql('ALTER TABLE tbpartner ADD cod_pays VARCHAR(3) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, DROP clr_pys_id');
    }
}
