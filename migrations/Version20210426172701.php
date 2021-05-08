<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210426172701 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs

        $this->addSql('ALTER TABLE equipment DROP CONSTRAINT fk_d338d5837ec2f574');
        $this->addSql('DROP INDEX uniq_d338d5837ec2f574');
        $this->addSql('ALTER TABLE equipment DROP process_id');
        $this->addSql('DROP INDEX uniq_861d1896517fe9fe');
        $this->addSql('CREATE INDEX IDX_861D1896517FE9FE ON process (equipment_id)');
        $this->addSql('ALTER TABLE detail ADD name VARCHAR(128) DEFAULT NULL');
        $this->addSql('ALTER TABLE equipment ADD name VARCHAR(128) DEFAULT NULL');
        $this->addSql('ALTER TABLE process ADD name VARCHAR(128) DEFAULT NULL');
        $this->addSql('ALTER TABLE process ADD parent INT DEFAULT NULL');
        $this->addSql('ALTER TABLE process ADD CONSTRAINT FK_861D18963D8E604F FOREIGN KEY (parent) REFERENCES process (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_861D18963D8E604F ON process (parent)');
        $this->addSql('ALTER TABLE worker ALTER "position" TYPE VARCHAR(64)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_861D1896517FE9FE');
        $this->addSql('CREATE UNIQUE INDEX uniq_861d1896517fe9fe ON process (equipment_id)');
        $this->addSql('ALTER TABLE equipment ADD process_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE equipment ADD CONSTRAINT fk_d338d5837ec2f574 FOREIGN KEY (process_id) REFERENCES process (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX uniq_d338d5837ec2f574 ON equipment (process_id)');
        $this->addSql('ALTER TABLE detail DROP name');
        $this->addSql('ALTER TABLE process DROP name');
        $this->addSql('ALTER TABLE equipment DROP name');
        $this->addSql('ALTER TABLE process DROP CONSTRAINT FK_861D18963D8E604F');
        $this->addSql('DROP INDEX IDX_861D18963D8E604F');
        $this->addSql('ALTER TABLE process DROP parent');
        $this->addSql('ALTER TABLE worker ALTER position TYPE VARCHAR(6)');
    }
}
