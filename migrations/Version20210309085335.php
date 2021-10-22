<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210309085335 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        // $this->addSql('ALTER TABLE tartcot DROP FOREIGN KEY FK_DE30C4E976D51500');
        // $this->addSql('DROP INDEX IDX_DE30C4E976D51500 ON tartcot');
        // $this->addSql('ALTER TABLE tartcot CHANGE clt_cot_id clr_cot_id INT DEFAULT NULL');
        // $this->addSql('ALTER TABLE tartcot ADD CONSTRAINT FK_DE30C4E9B0BA1C87 FOREIGN KEY (clr_cot_id) REFERENCES tcotation (id)');
        // $this->addSql('CREATE INDEX IDX_DE30C4E9B0BA1C87 ON tartcot (clr_cot_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        // $this->addSql('ALTER TABLE tartcot DROP FOREIGN KEY FK_DE30C4E9B0BA1C87');
        // $this->addSql('DROP INDEX IDX_DE30C4E9B0BA1C87 ON tartcot');
        // $this->addSql('ALTER TABLE tartcot CHANGE clr_cot_id clt_cot_id INT DEFAULT NULL');
        // $this->addSql('ALTER TABLE tartcot ADD CONSTRAINT FK_DE30C4E976D51500 FOREIGN KEY (clt_cot_id) REFERENCES tcotation (id)');
        // $this->addSql('CREATE INDEX IDX_DE30C4E976D51500 ON tartcot (clt_cot_id)');
    }
}
