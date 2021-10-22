<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210304095402 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD usr_ins_id INT DEFAULT NULL, ADD usr_upd_id INT DEFAULT NULL, ADD dat_ins DATETIME DEFAULT NULL, ADD dat_upd DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649E85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6498E55D6C2 FOREIGN KEY (usr_upd_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649E85F52E7 ON user (usr_ins_id)');
        $this->addSql('CREATE INDEX IDX_8D93D6498E55D6C2 ON user (usr_upd_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649E85F52E7');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6498E55D6C2');
        $this->addSql('DROP INDEX IDX_8D93D649E85F52E7 ON user');
        $this->addSql('DROP INDEX IDX_8D93D6498E55D6C2 ON user');
        $this->addSql('ALTER TABLE user DROP usr_ins_id, DROP usr_upd_id, DROP dat_ins, DROP dat_upd');
    }
}
