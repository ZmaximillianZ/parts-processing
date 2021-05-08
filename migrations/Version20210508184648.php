<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210508184648 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('CREATE SEQUENCE worker_quipment_detail_process_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE worker_quipment_detail_process (id INT NOT NULL, worker_equipment_id INT DEFAULT NULL, detail_id INT DEFAULT NULL, time INT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B4FC46E454B636F1 ON worker_quipment_detail_process (worker_equipment_id)');
        $this->addSql('CREATE INDEX IDX_B4FC46E4D8D003BB ON worker_quipment_detail_process (detail_id)');
        $this->addSql('ALTER TABLE worker_quipment_detail_process ADD CONSTRAINT FK_B4FC46E454B636F1 FOREIGN KEY (worker_equipment_id) REFERENCES worker_equipment (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE worker_quipment_detail_process ADD CONSTRAINT FK_B4FC46E4D8D003BB FOREIGN KEY (detail_id) REFERENCES detail (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE detail DROP CONSTRAINT fk_2e067f937ec2f574');
        $this->addSql('DROP INDEX idx_2e067f937ec2f574');
        $this->addSql('ALTER TABLE detail DROP process_id');
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('DROP SEQUENCE worker_quipment_detail_process_id_seq CASCADE');
        $this->addSql('DROP TABLE worker_quipment_detail_process');
        $this->addSql('ALTER TABLE detail ADD process_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE detail ALTER created_at DROP DEFAULT');
        $this->addSql('ALTER TABLE detail ADD CONSTRAINT fk_2e067f937ec2f574 FOREIGN KEY (process_id) REFERENCES process (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_2e067f937ec2f574 ON detail (process_id)');
    }
}
