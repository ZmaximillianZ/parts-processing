<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210420173722 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE main_user DROP CONSTRAINT fk_6d20e42b217bbb47');
        $this->addSql('DROP INDEX uniq_6d20e42b217bbb47');
        $this->addSql('ALTER TABLE main_user DROP person_id');
        $this->addSql('ALTER TABLE worker DROP CONSTRAINT fk_9fb2bf62217bbb47');
        $this->addSql('DROP INDEX uniq_9fb2bf62217bbb47');
        $this->addSql('ALTER TABLE worker RENAME COLUMN person_id TO user_id');
        $this->addSql('ALTER TABLE worker ADD CONSTRAINT FK_9FB2BF62A76ED395 FOREIGN KEY (user_id) REFERENCES main_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9FB2BF62A76ED395 ON worker (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
    }
}
