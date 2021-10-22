<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210604082944 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tarttrfadx (id INT AUTO_INCREMENT NOT NULL, clr_art_id INT DEFAULT NULL, usr_ins_id INT DEFAULT NULL, usr_upd_id INT DEFAULT NULL, cod VARCHAR(30) NOT NULL, x_trf TINYINT(1) DEFAULT NULL, dat_ins DATETIME NOT NULL, dat_upd DATETIME DEFAULT NULL, INDEX IDX_BAD418BB6502EEBF (clr_art_id), INDEX IDX_BAD418BBE85F52E7 (usr_ins_id), INDEX IDX_BAD418BB8E55D6C2 (usr_upd_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tarttrfadx ADD CONSTRAINT FK_BAD418BB6502EEBF FOREIGN KEY (clr_art_id) REFERENCES tarticle (id)');
        $this->addSql('ALTER TABLE tarttrfadx ADD CONSTRAINT FK_BAD418BBE85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tarttrfadx ADD CONSTRAINT FK_BAD418BB8E55D6C2 FOREIGN KEY (usr_upd_id) REFERENCES tuser (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE tarttrfadx');
    }
}
