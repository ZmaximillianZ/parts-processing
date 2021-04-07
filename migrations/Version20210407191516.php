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
        $this->addSql('ALTER TABLE hdb_catalog.event_invocation_logs DROP CONSTRAINT event_invocation_logs_event_id_fkey');
        $this->addSql('ALTER TABLE hdb_catalog.hdb_allowlist DROP CONSTRAINT hdb_allowlist_collection_name_fkey');
        $this->addSql('ALTER TABLE hdb_catalog.hdb_relationship DROP CONSTRAINT hdb_relationship_table_schema_fkey');
        $this->addSql('ALTER TABLE hdb_catalog.hdb_permission DROP CONSTRAINT hdb_permission_table_schema_fkey');
        $this->addSql('ALTER TABLE hdb_catalog.event_triggers DROP CONSTRAINT event_triggers_schema_name_fkey');
        $this->addSql('ALTER TABLE hdb_catalog.hdb_computed_field DROP CONSTRAINT hdb_computed_field_table_schema_fkey');
        $this->addSql('DROP SEQUENCE hdb_catalog.remote_schemas_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE training_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE person_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE admin_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE result_type_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE training_result_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE field_type_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE result_field_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE brigade_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE detail_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE equipment_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE process_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE technological_map_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tool_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE worker_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE worker_equipment_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE brigade (id INT NOT NULL, work_shift INT DEFAULT NULL, type INT DEFAULT NULL, status INT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT \'NULL\', PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE detail (id INT NOT NULL, process_id INT DEFAULT NULL, status INT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT \'NULL\', PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2E067F937EC2F574 ON detail (process_id)');
        $this->addSql('CREATE TABLE equipment (id INT NOT NULL, process_id INT DEFAULT NULL, accurancy DOUBLE PRECISION DEFAULT NULL, type INT DEFAULT NULL, status INT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT \'NULL\', PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D338D5837EC2F574 ON equipment (process_id)');
        $this->addSql('CREATE TABLE process (id INT NOT NULL, technological_map_id INT DEFAULT NULL, equipment_id INT DEFAULT NULL, time INT DEFAULT NULL, qualification DOUBLE PRECISION DEFAULT NULL, type INT DEFAULT NULL, status INT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT \'NULL\', PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_861D189675DF0836 ON process (technological_map_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_861D1896517FE9FE ON process (equipment_id)');
        $this->addSql('CREATE TABLE process_tool (process_id INT NOT NULL, tool_id INT NOT NULL, PRIMARY KEY(process_id, tool_id))');
        $this->addSql('CREATE INDEX IDX_CF1AECE47EC2F574 ON process_tool (process_id)');
        $this->addSql('CREATE INDEX IDX_CF1AECE48F7B22CC ON process_tool (tool_id)');
        $this->addSql('CREATE TABLE technological_map (id INT NOT NULL, name VARCHAR(128) DEFAULT NULL, x DOUBLE PRECISION DEFAULT NULL, y DOUBLE PRECISION DEFAULT NULL, z DOUBLE PRECISION DEFAULT NULL, weight DOUBLE PRECISION DEFAULT NULL, material_grade VARCHAR(6) DEFAULT NULL, tolerance DOUBLE PRECISION DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT \'NULL\', PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE tool (id INT NOT NULL, processes_id INT DEFAULT NULL, name VARCHAR(32) DEFAULT NULL, type INT DEFAULT NULL, status INT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT \'NULL\', PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_20F33ED1C5B6BE5E ON tool (processes_id)');
        $this->addSql('CREATE TABLE worker (id INT NOT NULL, person_id INT DEFAULT NULL, brigade_id INT DEFAULT NULL, position VARCHAR(6) DEFAULT NULL, qualification DOUBLE PRECISION DEFAULT NULL, is_quilification BOOLEAN DEFAULT NULL, status INT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT \'NULL\', PRIMARY KEY(id))');
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
        $this->addSql('DROP TABLE hdb_catalog.hdb_version');
        $this->addSql('DROP TABLE hdb_catalog.hdb_relationship');
        $this->addSql('DROP TABLE hdb_catalog.hdb_permission');
        $this->addSql('DROP TABLE hdb_catalog.event_triggers');
        $this->addSql('DROP TABLE hdb_catalog.event_log');
        $this->addSql('DROP TABLE hdb_catalog.event_invocation_logs');
        $this->addSql('DROP TABLE hdb_catalog.hdb_function');
        $this->addSql('DROP TABLE hdb_catalog.remote_schemas');
        $this->addSql('DROP TABLE hdb_catalog.hdb_schema_update_event');
        $this->addSql('DROP TABLE hdb_catalog.hdb_query_collection');
        $this->addSql('DROP TABLE hdb_catalog.hdb_allowlist');
        $this->addSql('DROP TABLE hdb_catalog.hdb_table');
        $this->addSql('DROP TABLE hdb_catalog.hdb_computed_field');
        $this->addSql('ALTER TABLE main_user ADD person_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE main_user ALTER created_at SET DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE main_user ALTER updated_at SET DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE main_user ALTER middle_name SET DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE main_user ADD CONSTRAINT FK_6D20E42B217BBB47 FOREIGN KEY (person_id) REFERENCES worker (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6D20E42B217BBB47 ON main_user (person_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SCHEMA hdb_catalog');
        $this->addSql('CREATE SCHEMA hdb_views');
        $this->addSql('ALTER TABLE worker DROP CONSTRAINT FK_9FB2BF62539A88F2');
        $this->addSql('ALTER TABLE process DROP CONSTRAINT FK_861D1896517FE9FE');
        $this->addSql('ALTER TABLE worker_equipment DROP CONSTRAINT FK_51387890517FE9FE');
        $this->addSql('ALTER TABLE detail DROP CONSTRAINT FK_2E067F937EC2F574');
        $this->addSql('ALTER TABLE equipment DROP CONSTRAINT FK_D338D5837EC2F574');
        $this->addSql('ALTER TABLE process_tool DROP CONSTRAINT FK_CF1AECE47EC2F574');
        $this->addSql('ALTER TABLE tool DROP CONSTRAINT FK_20F33ED1C5B6BE5E');
        $this->addSql('ALTER TABLE process DROP CONSTRAINT FK_861D189675DF0836');
        $this->addSql('ALTER TABLE process_tool DROP CONSTRAINT FK_CF1AECE48F7B22CC');
        $this->addSql('ALTER TABLE main_user DROP CONSTRAINT FK_6D20E42B217BBB47');
        $this->addSql('ALTER TABLE worker_equipment DROP CONSTRAINT FK_513878906B20BA36');
        $this->addSql('DROP SEQUENCE brigade_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE detail_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE equipment_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE process_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE technological_map_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tool_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE worker_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE worker_equipment_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE hdb_catalog.remote_schemas_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE training_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE person_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE admin_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE result_type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE training_result_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE field_type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE result_field_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE hdb_catalog.hdb_version (hasura_uuid UUID DEFAULT \'gen_random_uuid()\' NOT NULL, version TEXT NOT NULL, upgraded_on TIMESTAMP(0) WITH TIME ZONE NOT NULL, cli_state JSONB DEFAULT \'{}\' NOT NULL, console_state JSONB DEFAULT \'{}\' NOT NULL, PRIMARY KEY(hasura_uuid))');
        $this->addSql('CREATE TABLE hdb_catalog.hdb_relationship (table_schema TEXT NOT NULL, table_name TEXT NOT NULL, rel_name TEXT NOT NULL, rel_type TEXT DEFAULT NULL, rel_def JSONB NOT NULL, comment TEXT DEFAULT NULL, is_system_defined BOOLEAN DEFAULT \'false\', PRIMARY KEY(table_schema, table_name, rel_name))');
        $this->addSql('CREATE INDEX IDX_86C7A31CE65C449114F53ECD ON hdb_catalog.hdb_relationship (table_schema, table_name)');
        $this->addSql('CREATE TABLE hdb_catalog.hdb_permission (table_schema TEXT NOT NULL, table_name TEXT NOT NULL, role_name TEXT NOT NULL, perm_type TEXT NOT NULL, perm_def JSONB NOT NULL, comment TEXT DEFAULT NULL, is_system_defined BOOLEAN DEFAULT \'false\', PRIMARY KEY(table_schema, table_name, role_name, perm_type))');
        $this->addSql('CREATE INDEX IDX_3A9F8CE6E65C449114F53ECD ON hdb_catalog.hdb_permission (table_schema, table_name)');
        $this->addSql('CREATE TABLE hdb_catalog.event_triggers (name TEXT NOT NULL, schema_name TEXT NOT NULL, table_name TEXT NOT NULL, type TEXT NOT NULL, configuration JSON DEFAULT NULL, comment TEXT DEFAULT NULL, PRIMARY KEY(name))');
        $this->addSql('CREATE INDEX IDX_FE2495C2A5CABFD414F53ECD ON hdb_catalog.event_triggers (schema_name, table_name)');
        $this->addSql('CREATE TABLE hdb_catalog.event_log (id TEXT DEFAULT \'gen_random_uuid()\' NOT NULL, schema_name TEXT NOT NULL, table_name TEXT NOT NULL, trigger_name TEXT NOT NULL, payload JSONB NOT NULL, delivered BOOLEAN DEFAULT \'false\' NOT NULL, error BOOLEAN DEFAULT \'false\' NOT NULL, tries INT DEFAULT 0 NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT \'now()\', locked BOOLEAN DEFAULT \'false\' NOT NULL, next_retry_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, archived BOOLEAN DEFAULT \'false\' NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX event_log_trigger_name_idx ON hdb_catalog.event_log (trigger_name)');
        $this->addSql('CREATE INDEX event_log_delivered_idx ON hdb_catalog.event_log (delivered)');
        $this->addSql('CREATE INDEX event_log_locked_idx ON hdb_catalog.event_log (locked)');
        $this->addSql('CREATE TABLE hdb_catalog.event_invocation_logs (id TEXT DEFAULT \'gen_random_uuid()\' NOT NULL, event_id TEXT DEFAULT NULL, status INT DEFAULT NULL, request JSON DEFAULT NULL, response JSON DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT \'now()\', PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX event_invocation_logs_event_id_idx ON hdb_catalog.event_invocation_logs (event_id)');
        $this->addSql('CREATE TABLE hdb_catalog.hdb_function (function_schema TEXT NOT NULL, function_name TEXT NOT NULL, configuration JSONB DEFAULT \'{}\' NOT NULL, is_system_defined BOOLEAN DEFAULT \'false\', PRIMARY KEY(function_schema, function_name))');
        $this->addSql('CREATE TABLE hdb_catalog.remote_schemas (id BIGSERIAL NOT NULL, name TEXT DEFAULT NULL, definition JSON DEFAULT NULL, comment TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX remote_schemas_name_key ON hdb_catalog.remote_schemas (name)');
        $this->addSql('CREATE TABLE hdb_catalog.hdb_schema_update_event (instance_id UUID NOT NULL, occurred_at TIMESTAMP(0) WITH TIME ZONE DEFAULT \'now()\' NOT NULL)');
        $this->addSql('CREATE TABLE hdb_catalog.hdb_query_collection (collection_name TEXT NOT NULL, collection_defn JSONB NOT NULL, comment TEXT DEFAULT NULL, is_system_defined BOOLEAN DEFAULT \'false\', PRIMARY KEY(collection_name))');
        $this->addSql('CREATE TABLE hdb_catalog.hdb_allowlist (collection_name TEXT DEFAULT NULL)');
        $this->addSql('CREATE UNIQUE INDEX hdb_allowlist_collection_name_key ON hdb_catalog.hdb_allowlist (collection_name)');
        $this->addSql('CREATE TABLE hdb_catalog.hdb_table (table_schema TEXT NOT NULL, table_name TEXT NOT NULL, configuration JSONB DEFAULT NULL, is_system_defined BOOLEAN DEFAULT \'false\', is_enum BOOLEAN DEFAULT \'false\' NOT NULL, PRIMARY KEY(table_schema, table_name))');
        $this->addSql('CREATE TABLE hdb_catalog.hdb_computed_field (table_schema TEXT NOT NULL, table_name TEXT NOT NULL, computed_field_name TEXT NOT NULL, definition JSONB NOT NULL, comment TEXT DEFAULT NULL, PRIMARY KEY(table_schema, table_name, computed_field_name))');
        $this->addSql('CREATE INDEX IDX_C97C1ACE65C449114F53ECD ON hdb_catalog.hdb_computed_field (table_schema, table_name)');
        $this->addSql('ALTER TABLE hdb_catalog.hdb_relationship ADD CONSTRAINT hdb_relationship_table_schema_fkey FOREIGN KEY (table_schema, table_name) REFERENCES hdb_catalog.hdb_table (table_schema, table_name) ON UPDATE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE hdb_catalog.hdb_permission ADD CONSTRAINT hdb_permission_table_schema_fkey FOREIGN KEY (table_schema, table_name) REFERENCES hdb_catalog.hdb_table (table_schema, table_name) ON UPDATE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE hdb_catalog.event_triggers ADD CONSTRAINT event_triggers_schema_name_fkey FOREIGN KEY (schema_name, table_name) REFERENCES hdb_catalog.hdb_table (table_schema, table_name) ON UPDATE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE hdb_catalog.event_invocation_logs ADD CONSTRAINT event_invocation_logs_event_id_fkey FOREIGN KEY (event_id) REFERENCES hdb_catalog.event_log (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE hdb_catalog.hdb_allowlist ADD CONSTRAINT hdb_allowlist_collection_name_fkey FOREIGN KEY (collection_name) REFERENCES hdb_catalog.hdb_query_collection (collection_name) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE hdb_catalog.hdb_computed_field ADD CONSTRAINT hdb_computed_field_table_schema_fkey FOREIGN KEY (table_schema, table_name) REFERENCES hdb_catalog.hdb_table (table_schema, table_name) ON UPDATE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE brigade');
        $this->addSql('DROP TABLE detail');
        $this->addSql('DROP TABLE equipment');
        $this->addSql('DROP TABLE process');
        $this->addSql('DROP TABLE process_tool');
        $this->addSql('DROP TABLE technological_map');
        $this->addSql('DROP TABLE tool');
        $this->addSql('DROP TABLE worker');
        $this->addSql('DROP TABLE worker_equipment');
        $this->addSql('DROP INDEX UNIQ_6D20E42B217BBB47');
        $this->addSql('ALTER TABLE main_user DROP person_id');
        $this->addSql('ALTER TABLE main_user ALTER created_at DROP DEFAULT');
        $this->addSql('ALTER TABLE main_user ALTER updated_at DROP DEFAULT');
        $this->addSql('ALTER TABLE main_user ALTER middle_name DROP DEFAULT');
    }
}
