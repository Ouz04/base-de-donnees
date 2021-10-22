<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210812134649 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tarticle DROP FOREIGN KEY FK_D26E911BC64CFB29');
        $this->addSql('ALTER TABLE tarticle DROP FOREIGN KEY FK_D26E911BD4F954C7');
        $this->addSql('ALTER TABLE tarticle ADD CONSTRAINT FK_D26E911BC64CFB29 FOREIGN KEY (clr_ctgiceniv1_id) REFERENCES tctgice (id)');
        $this->addSql('ALTER TABLE tarticle ADD CONSTRAINT FK_D26E911BD4F954C7 FOREIGN KEY (clr_ctgiceniv2_id) REFERENCES tctgice (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tarticle DROP FOREIGN KEY FK_D26E911BC64CFB29');
        $this->addSql('ALTER TABLE tarticle DROP FOREIGN KEY FK_D26E911BD4F954C7');
        $this->addSql('ALTER TABLE tarticle ADD CONSTRAINT FK_D26E911BC64CFB29 FOREIGN KEY (clr_ctgiceniv1_id) REFERENCES tctgiceniv (id)');
        $this->addSql('ALTER TABLE tarticle ADD CONSTRAINT FK_D26E911BD4F954C7 FOREIGN KEY (clr_ctgiceniv2_id) REFERENCES tctgiceniv (id)');
    }
}
