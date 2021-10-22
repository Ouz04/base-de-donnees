<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210303200927 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tcotation DROP FOREIGN KEY FK_B709F05A8E55D6C2');
        $this->addSql('ALTER TABLE tcotation DROP FOREIGN KEY FK_B709F05AE85F52E7');
        $this->addSql('ALTER TABLE tcotation CHANGE clr_org_id clr_org_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tcotation ADD CONSTRAINT FK_B709F05A8E55D6C2 FOREIGN KEY (usr_upd_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE tcotation ADD CONSTRAINT FK_B709F05AE85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tcotation DROP FOREIGN KEY FK_B709F05AE85F52E7');
        $this->addSql('ALTER TABLE tcotation DROP FOREIGN KEY FK_B709F05A8E55D6C2');
        $this->addSql('ALTER TABLE tcotation CHANGE clr_org_id clr_org_id INT NOT NULL');
        $this->addSql('ALTER TABLE tcotation ADD CONSTRAINT FK_B709F05AE85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tcotation ADD CONSTRAINT FK_B709F05A8E55D6C2 FOREIGN KEY (usr_upd_id) REFERENCES tuser (id)');
    }
}
