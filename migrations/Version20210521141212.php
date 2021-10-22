<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210521141212 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        //  $this->addSql('ALTER TABLE tflxett DROP FOREIGN KEY FK_FB88D522B304206A');
        //  $this->addSql('DROP INDEX IDX_FB88D522B304206A ON tflxett');
        //   $this->addSql('ALTER TABLE tflxett CHANGE per_id clr_per_id INT DEFAULT NULL');
        //   $this->addSql('ALTER TABLE tflxett ADD CONSTRAINT FK_FB88D5225A232BCF FOREIGN KEY (clr_per_id) REFERENCES tperiodicite (id)');
        //    $this->addSql('CREATE INDEX IDX_FB88D5225A232BCF ON tflxett (clr_per_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        //   $this->addSql('ALTER TABLE tflxett DROP FOREIGN KEY FK_FB88D5225A232BCF');
        //  $this->addSql('DROP INDEX IDX_FB88D5225A232BCF ON tflxett');
        //   $this->addSql('ALTER TABLE tflxett CHANGE clr_per_id per_id INT DEFAULT NULL');
        //   $this->addSql('ALTER TABLE tflxett ADD CONSTRAINT FK_FB88D522B304206A FOREIGN KEY (per_id) REFERENCES tperiodicite (id)');
        //    $this->addSql('CREATE INDEX IDX_FB88D522B304206A ON tflxett (per_id)');
    }
}
