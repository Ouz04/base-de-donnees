<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210423224401 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        //   $this->addSql('DROP INDEX IDX_D26E911B1D6A7E42 ON tarticle');
        // $this->addSql('CREATE INDEX IDX_D26E911B8477C417 ON tarticle (ref_ctr)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        // $this->addSql('DROP INDEX IDX_D26E911B8477C417 ON tarticle');
        // $this->addSql('CREATE INDEX IDX_D26E911B1D6A7E42 ON tarticle (cod)');
    }
}
