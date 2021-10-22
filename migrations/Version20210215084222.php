<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210215084222 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article ADD usr_ins_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66E85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES tuser (id)');
        $this->addSql('CREATE INDEX IDX_23A0E66E85F52E7 ON article (usr_ins_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66E85F52E7');
        $this->addSql('DROP INDEX IDX_23A0E66E85F52E7 ON article');
        $this->addSql('ALTER TABLE article DROP usr_ins_id');
    }
}
