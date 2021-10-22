<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210301194359 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tcotation (id INT AUTO_INCREMENT NOT NULL, usr_ins_id INT DEFAULT NULL, usr_upd_id INT DEFAULT NULL, cod VARCHAR(50) NOT NULL, dsg VARCHAR(255) NOT NULL, dat_deb DATE NOT NULL, dat_fin DATE DEFAULT NULL, dat_ins DATETIME NOT NULL, dat_upd DATETIME DEFAULT NULL, INDEX IDX_B709F05AE85F52E7 (usr_ins_id), INDEX IDX_B709F05A8E55D6C2 (usr_upd_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tcotation ADD CONSTRAINT FK_B709F05AE85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tcotation ADD CONSTRAINT FK_B709F05A8E55D6C2 FOREIGN KEY (usr_upd_id) REFERENCES tuser (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE tcotation');
    }
}
