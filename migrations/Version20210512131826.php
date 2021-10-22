<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210512131826 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        //       $this->addSql('CREATE TABLE tuploadett (id INT AUTO_INCREMENT NOT NULL, usr_ins_id INT DEFAULT NULL, filename VARCHAR(255) NOT NULL, dat_ins DATETIME NOT NULL, INDEX IDX_FDC9FF35E85F52E7 (usr_ins_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        //      $this->addSql('CREATE TABLE tuploadpst (id INT AUTO_INCREMENT NOT NULL, clr_upload_id INT DEFAULT NULL, row VARCHAR(255) DEFAULT NULL, nb_row INT NOT NULL, INDEX IDX_A8650869558249F3 (clr_upload_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        //       $this->addSql('ALTER TABLE tuploadett ADD CONSTRAINT FK_FDC9FF35E85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES tuser (id)');
        //$this->addSql('ALTER TABLE tuploadpst ADD CONSTRAINT FK_A8650869558249F3 FOREIGN KEY (clr_upload_id) REFERENCES tuploadett (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tuploadpst DROP FOREIGN KEY FK_A8650869558249F3');
        $this->addSql('DROP TABLE tuploadett');
        $this->addSql('DROP TABLE tuploadpst');
    }
}
