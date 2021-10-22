<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210812133650 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tarticle ADD clr_ctgiceniv1_id INT DEFAULT NULL, ADD clr_ctgiceniv2_id INT DEFAULT NULL, ADD clr_ctgiceniv3_id INT DEFAULT NULL, ADD clr_ctgiceniv4_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tarticle ADD CONSTRAINT FK_D26E911BC64CFB29 FOREIGN KEY (clr_ctgiceniv1_id) REFERENCES tctgiceniv (id)');
        $this->addSql('ALTER TABLE tarticle ADD CONSTRAINT FK_D26E911BD4F954C7 FOREIGN KEY (clr_ctgiceniv2_id) REFERENCES tctgiceniv (id)');
        $this->addSql('ALTER TABLE tarticle ADD CONSTRAINT FK_D26E911B6C4533A2 FOREIGN KEY (clr_ctgiceniv3_id) REFERENCES tctgiceniv (id)');
        $this->addSql('ALTER TABLE tarticle ADD CONSTRAINT FK_D26E911BF1920B1B FOREIGN KEY (clr_ctgiceniv4_id) REFERENCES tctgiceniv (id)');
        $this->addSql('CREATE INDEX IDX_D26E911BC64CFB29 ON tarticle (clr_ctgiceniv1_id)');
        $this->addSql('CREATE INDEX IDX_D26E911BD4F954C7 ON tarticle (clr_ctgiceniv2_id)');
        $this->addSql('CREATE INDEX IDX_D26E911B6C4533A2 ON tarticle (clr_ctgiceniv3_id)');
        $this->addSql('CREATE INDEX IDX_D26E911BF1920B1B ON tarticle (clr_ctgiceniv4_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tarticle DROP FOREIGN KEY FK_D26E911BC64CFB29');
        $this->addSql('ALTER TABLE tarticle DROP FOREIGN KEY FK_D26E911BD4F954C7');
        $this->addSql('ALTER TABLE tarticle DROP FOREIGN KEY FK_D26E911B6C4533A2');
        $this->addSql('ALTER TABLE tarticle DROP FOREIGN KEY FK_D26E911BF1920B1B');
        $this->addSql('DROP INDEX IDX_D26E911BC64CFB29 ON tarticle');
        $this->addSql('DROP INDEX IDX_D26E911BD4F954C7 ON tarticle');
        $this->addSql('DROP INDEX IDX_D26E911B6C4533A2 ON tarticle');
        $this->addSql('DROP INDEX IDX_D26E911BF1920B1B ON tarticle');
        $this->addSql('ALTER TABLE tarticle DROP clr_ctgiceniv1_id, DROP clr_ctgiceniv2_id, DROP clr_ctgiceniv3_id, DROP clr_ctgiceniv4_id');
    }
}
