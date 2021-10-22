<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210304102551 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tuser ADD usr_ins_id INT DEFAULT NULL, ADD usr_upd_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tuser ADD CONSTRAINT FK_66A7B847E85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tuser ADD CONSTRAINT FK_66A7B8478E55D6C2 FOREIGN KEY (usr_upd_id) REFERENCES tuser (id)');
        $this->addSql('CREATE INDEX IDX_66A7B847E85F52E7 ON tuser (usr_ins_id)');
        $this->addSql('CREATE INDEX IDX_66A7B8478E55D6C2 ON tuser (usr_upd_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tuser DROP FOREIGN KEY FK_66A7B847E85F52E7');
        $this->addSql('ALTER TABLE tuser DROP FOREIGN KEY FK_66A7B8478E55D6C2');
        $this->addSql('DROP INDEX IDX_66A7B847E85F52E7 ON tuser');
        $this->addSql('DROP INDEX IDX_66A7B8478E55D6C2 ON tuser');
        $this->addSql('ALTER TABLE tuser DROP usr_ins_id, DROP usr_upd_id');
    }
}
