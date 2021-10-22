<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210623153353 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE article_rechercheb');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article_rechercheb (id INT AUTO_INCREMENT NOT NULL, clr_ctg_id INT DEFAULT NULL, clr_ctr_id INT DEFAULT NULL, art_cod VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_D26CFDC682E1E5C8 (clr_ctr_id), INDEX IDX_D26CFDC6E5264265 (clr_ctg_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE article_rechercheb ADD CONSTRAINT FK_D26CFDC682E1E5C8 FOREIGN KEY (clr_ctr_id) REFERENCES tconstructeur (id)');
        $this->addSql('ALTER TABLE article_rechercheb ADD CONSTRAINT FK_D26CFDC6E5264265 FOREIGN KEY (clr_ctg_id) REFERENCES tcategorie (id)');
    }
}
