<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210624081641 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tservice (id INT AUTO_INCREMENT NOT NULL, usr_ins_id INT DEFAULT NULL, usr_upd_id INT DEFAULT NULL, cod VARCHAR(10) NOT NULL, dsg VARCHAR(100) NOT NULL, dat_ins DATETIME NOT NULL, dat_upd DATETIME DEFAULT NULL, INDEX IDX_31C905AFE85F52E7 (usr_ins_id), INDEX IDX_31C905AF8E55D6C2 (usr_upd_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tservice ADD CONSTRAINT FK_31C905AFE85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tservice ADD CONSTRAINT FK_31C905AF8E55D6C2 FOREIGN KEY (usr_upd_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tuser ADD clr_srv_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tuser ADD CONSTRAINT FK_66A7B847811585A4 FOREIGN KEY (clr_srv_id) REFERENCES tservice (id)');
        $this->addSql('CREATE INDEX IDX_66A7B847811585A4 ON tuser (clr_srv_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tuser DROP FOREIGN KEY FK_66A7B847811585A4');
        $this->addSql('DROP TABLE tservice');
        $this->addSql('DROP INDEX IDX_66A7B847811585A4 ON tuser');
        $this->addSql('ALTER TABLE tuser DROP clr_srv_id');
    }
}
