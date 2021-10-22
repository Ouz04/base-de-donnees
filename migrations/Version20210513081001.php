<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210513081001 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tuploadpst DROP FOREIGN KEY FK_A8650869558249F3');
        $this->addSql('DROP TABLE tuploadett');
        $this->addSql('DROP TABLE tuploadpst');
        $this->addSql('ALTER TABLE titgficpst ADD clr_itgfic_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE titgficpst ADD CONSTRAINT FK_EE74C1BC13938026 FOREIGN KEY (clr_itgfic_id) REFERENCES titgficett (id)');
        $this->addSql('CREATE INDEX IDX_EE74C1BC13938026 ON titgficpst (clr_itgfic_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tuploadett (id INT AUTO_INCREMENT NOT NULL, usr_ins_id INT DEFAULT NULL, filename VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, dat_ins DATETIME NOT NULL, INDEX IDX_FDC9FF35E85F52E7 (usr_ins_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE tuploadpst (id INT AUTO_INCREMENT NOT NULL, clr_upload_id INT DEFAULT NULL, row VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, nb_col INT DEFAULT NULL, INDEX IDX_A8650869558249F3 (clr_upload_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE tuploadett ADD CONSTRAINT FK_FDC9FF35E85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tuploadpst ADD CONSTRAINT FK_A8650869558249F3 FOREIGN KEY (clr_upload_id) REFERENCES tuploadett (id)');
        $this->addSql('ALTER TABLE titgficpst DROP FOREIGN KEY FK_EE74C1BC13938026');
        $this->addSql('DROP INDEX IDX_EE74C1BC13938026 ON titgficpst');
        $this->addSql('ALTER TABLE titgficpst DROP clr_itgfic_id');
    }
}
