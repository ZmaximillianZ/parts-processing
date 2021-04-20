<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210407191516 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE brigade_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE detail_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE equipment_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE process_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE technological_map_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tool_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE worker_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE worker_equipment_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE brigade (id INT NOT NULL, work_shift INT DEFAULT NULL, type INT DEFAULT NULL, status INT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE detail (id INT NOT NULL, process_id INT DEFAULT NULL, status INT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2E067F937EC2F574 ON detail (process_id)');
        $this->addSql('CREATE TABLE equipment (id INT NOT NULL, process_id INT DEFAULT NULL, accurancy DOUBLE PRECISION DEFAULT NULL, type INT DEFAULT NULL, status INT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D338D5837EC2F574 ON equipment (process_id)');
        $this->addSql('CREATE TABLE process (id INT NOT NULL, technological_map_id INT DEFAULT NULL, equipment_id INT DEFAULT NULL, time INT DEFAULT NULL, qualification DOUBLE PRECISION DEFAULT NULL, type INT DEFAULT NULL, status INT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_861D189675DF0836 ON process (technological_map_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_861D1896517FE9FE ON process (equipment_id)');
        $this->addSql('CREATE TABLE process_tool (process_id INT NOT NULL, tool_id INT NOT NULL, PRIMARY KEY(process_id, tool_id))');
        $this->addSql('CREATE INDEX IDX_CF1AECE47EC2F574 ON process_tool (process_id)');
        $this->addSql('CREATE INDEX IDX_CF1AECE48F7B22CC ON process_tool (tool_id)');
        $this->addSql('CREATE TABLE technological_map (id INT NOT NULL, name VARCHAR(128) DEFAULT NULL, x DOUBLE PRECISION DEFAULT NULL, y DOUBLE PRECISION DEFAULT NULL, z DOUBLE PRECISION DEFAULT NULL, weight DOUBLE PRECISION DEFAULT NULL, material_grade VARCHAR(6) DEFAULT NULL, tolerance DOUBLE PRECISION DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE tool (id INT NOT NULL, processes_id INT DEFAULT NULL, name VARCHAR(32) DEFAULT NULL, type INT DEFAULT NULL, status INT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_20F33ED1C5B6BE5E ON tool (processes_id)');
        $this->addSql('CREATE TABLE worker (id INT NOT NULL, person_id INT DEFAULT NULL, brigade_id INT DEFAULT NULL, position VARCHAR(6) DEFAULT NULL, qualification DOUBLE PRECISION DEFAULT NULL, is_quilification BOOLEAN DEFAULT NULL, status INT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9FB2BF62217BBB47 ON worker (person_id)');
        $this->addSql('CREATE INDEX IDX_9FB2BF62539A88F2 ON worker (brigade_id)');
        $this->addSql('CREATE TABLE worker_equipment (id INT NOT NULL, worker_id INT DEFAULT NULL, equipment_id INT DEFAULT NULL, qualification DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_513878906B20BA36 ON worker_equipment (worker_id)');
        $this->addSql('CREATE INDEX IDX_51387890517FE9FE ON worker_equipment (equipment_id)');
        $this->addSql('ALTER TABLE detail ADD CONSTRAINT FK_2E067F937EC2F574 FOREIGN KEY (process_id) REFERENCES process (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE equipment ADD CONSTRAINT FK_D338D5837EC2F574 FOREIGN KEY (process_id) REFERENCES process (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE process ADD CONSTRAINT FK_861D189675DF0836 FOREIGN KEY (technological_map_id) REFERENCES technological_map (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE process ADD CONSTRAINT FK_861D1896517FE9FE FOREIGN KEY (equipment_id) REFERENCES equipment (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE process_tool ADD CONSTRAINT FK_CF1AECE47EC2F574 FOREIGN KEY (process_id) REFERENCES process (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE process_tool ADD CONSTRAINT FK_CF1AECE48F7B22CC FOREIGN KEY (tool_id) REFERENCES tool (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tool ADD CONSTRAINT FK_20F33ED1C5B6BE5E FOREIGN KEY (processes_id) REFERENCES process (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE worker ADD CONSTRAINT FK_9FB2BF62217BBB47 FOREIGN KEY (person_id) REFERENCES main_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE worker ADD CONSTRAINT FK_9FB2BF62539A88F2 FOREIGN KEY (brigade_id) REFERENCES brigade (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE worker_equipment ADD CONSTRAINT FK_513878906B20BA36 FOREIGN KEY (worker_id) REFERENCES worker (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE worker_equipment ADD CONSTRAINT FK_51387890517FE9FE FOREIGN KEY (equipment_id) REFERENCES equipment (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE main_user ADD person_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE main_user ADD CONSTRAINT FK_6D20E42B217BBB47 FOREIGN KEY (person_id) REFERENCES worker (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6D20E42B217BBB47 ON main_user (person_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
    }
}
