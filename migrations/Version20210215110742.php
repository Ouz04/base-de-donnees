<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210215110742 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tcategorie ADD usr_ins_id INT NOT NULL, ADD usr_upd_id INT DEFAULT NULL, ADD dat_ins DATETIME NOT NULL, ADD dat_upd DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE tcategorie ADD CONSTRAINT FK_B35C8F0EE85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tcategorie ADD CONSTRAINT FK_B35C8F0E8E55D6C2 FOREIGN KEY (usr_upd_id) REFERENCES tuser (id)');
        $this->addSql('CREATE INDEX IDX_B35C8F0EE85F52E7 ON tcategorie (usr_ins_id)');
        $this->addSql('CREATE INDEX IDX_B35C8F0E8E55D6C2 ON tcategorie (usr_upd_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tcategorie DROP FOREIGN KEY FK_B35C8F0EE85F52E7');
        $this->addSql('ALTER TABLE tcategorie DROP FOREIGN KEY FK_B35C8F0E8E55D6C2');
        $this->addSql('DROP INDEX IDX_B35C8F0EE85F52E7 ON tcategorie');
        $this->addSql('DROP INDEX IDX_B35C8F0E8E55D6C2 ON tcategorie');
        $this->addSql('ALTER TABLE tcategorie DROP usr_ins_id, DROP usr_upd_id, DROP dat_ins, DROP dat_upd');
    }
}
