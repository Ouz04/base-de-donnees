<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210317100902 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tcotorg (id INT AUTO_INCREMENT NOT NULL, clr_cot_id INT DEFAULT NULL, clr_org_id INT DEFAULT NULL, usr_ins_id INT DEFAULT NULL, usr_upd_id INT DEFAULT NULL, dat_ins DATETIME NOT NULL, dat_upd DATETIME DEFAULT NULL, INDEX IDX_7940E277B0BA1C87 (clr_cot_id), INDEX IDX_7940E2771DA477BE (clr_org_id), INDEX IDX_7940E277E85F52E7 (usr_ins_id), INDEX IDX_7940E2778E55D6C2 (usr_upd_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tcotorg ADD CONSTRAINT FK_7940E277B0BA1C87 FOREIGN KEY (clr_cot_id) REFERENCES tcotation (id)');
        $this->addSql('ALTER TABLE tcotorg ADD CONSTRAINT FK_7940E2771DA477BE FOREIGN KEY (clr_org_id) REFERENCES torganisation (id)');
        $this->addSql('ALTER TABLE tcotorg ADD CONSTRAINT FK_7940E277E85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tcotorg ADD CONSTRAINT FK_7940E2778E55D6C2 FOREIGN KEY (usr_upd_id) REFERENCES tuser (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE tcotorg');
    }
}
