<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210215155451 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tdicdta (id INT AUTO_INCREMENT NOT NULL, usr_ins_id INT NOT NULL, usr_upd_id INT DEFAULT NULL, tabnam VARCHAR(30) NOT NULL, chpnam VARCHAR(30) NOT NULL, typ VARCHAR(10) DEFAULT NULL, lng VARCHAR(5) DEFAULT NULL, dat_ins DATE NOT NULL, dat_upd DATE DEFAULT NULL, INDEX IDX_95A7A51BE85F52E7 (usr_ins_id), INDEX IDX_95A7A51B8E55D6C2 (usr_upd_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tdicdta ADD CONSTRAINT FK_95A7A51BE85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tdicdta ADD CONSTRAINT FK_95A7A51B8E55D6C2 FOREIGN KEY (usr_upd_id) REFERENCES tuser (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE tdicdta');
    }
}
