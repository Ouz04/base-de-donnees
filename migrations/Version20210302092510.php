<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210302092510 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tartcot (id INT AUTO_INCREMENT NOT NULL, clr_art_id INT DEFAULT NULL, clt_cot_id INT DEFAULT NULL, usr_ins_id INT DEFAULT NULL, usr_upd_id INT NOT NULL, dat_ins DATETIME NOT NULL, dat_upd DATETIME DEFAULT NULL, prx DOUBLE PRECISION NOT NULL, INDEX IDX_DE30C4E96502EEBF (clr_art_id), INDEX IDX_DE30C4E976D51500 (clt_cot_id), INDEX IDX_DE30C4E9E85F52E7 (usr_ins_id), INDEX IDX_DE30C4E98E55D6C2 (usr_upd_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tartcot ADD CONSTRAINT FK_DE30C4E96502EEBF FOREIGN KEY (clr_art_id) REFERENCES tarticle (id)');
        $this->addSql('ALTER TABLE tartcot ADD CONSTRAINT FK_DE30C4E976D51500 FOREIGN KEY (clt_cot_id) REFERENCES tcotation (id)');
        $this->addSql('ALTER TABLE tartcot ADD CONSTRAINT FK_DE30C4E9E85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tartcot ADD CONSTRAINT FK_DE30C4E98E55D6C2 FOREIGN KEY (usr_upd_id) REFERENCES tuser (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE tartcot');
    }
}
