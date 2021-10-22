<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210215105035 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tcategorie (id INT AUTO_INCREMENT NOT NULL, cod VARCHAR(10) NOT NULL, dsg VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tarticle ADD ctg_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tarticle ADD CONSTRAINT FK_D26E911BC0149C0 FOREIGN KEY (ctg_id) REFERENCES tcategorie (id)');
        $this->addSql('CREATE INDEX IDX_D26E911BC0149C0 ON tarticle (ctg_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tarticle DROP FOREIGN KEY FK_D26E911BC0149C0');
        $this->addSql('DROP TABLE tcategorie');
        $this->addSql('DROP INDEX IDX_D26E911BC0149C0 ON tarticle');
        $this->addSql('ALTER TABLE tarticle DROP ctg_id');
    }
}
