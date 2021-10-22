<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210520123858 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tdictab (id INT AUTO_INCREMENT NOT NULL, usr_ins_id INT DEFAULT NULL, usr_upd_id INT DEFAULT NULL, tabnam VARCHAR(30) NOT NULL, dsg VARCHAR(100) NOT NULL, dat_ins DATETIME NOT NULL, dat_upd DATETIME DEFAULT NULL, INDEX IDX_273DB1C5E85F52E7 (usr_ins_id), INDEX IDX_273DB1C58E55D6C2 (usr_upd_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tdictab ADD CONSTRAINT FK_273DB1C5E85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tdictab ADD CONSTRAINT FK_273DB1C58E55D6C2 FOREIGN KEY (usr_upd_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE titgficpst ADD clr_tab_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE titgficpst ADD CONSTRAINT FK_EE74C1BC642B9886 FOREIGN KEY (clr_tab_id) REFERENCES tdictab (id)');
        $this->addSql('CREATE INDEX IDX_EE74C1BC642B9886 ON titgficpst (clr_tab_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE titgficpst DROP FOREIGN KEY FK_EE74C1BC642B9886');
        $this->addSql('DROP TABLE tdictab');
        $this->addSql('DROP INDEX IDX_EE74C1BC642B9886 ON titgficpst');
        $this->addSql('ALTER TABLE titgficpst DROP clr_tab_id');
    }
}
