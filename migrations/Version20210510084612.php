<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210510084612 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tconnexion (id INT AUTO_INCREMENT NOT NULL, usr_ins_id INT DEFAULT NULL, ip VARCHAR(20) NOT NULL, env_pc VARCHAR(255) DEFAULT NULL, dat_ins DATE NOT NULL, INDEX IDX_694AA0A6E85F52E7 (usr_ins_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tconnexion ADD CONSTRAINT FK_694AA0A6E85F52E7 FOREIGN KEY (usr_ins_id) REFERENCES tuser (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE tconnexion');
    }
}
