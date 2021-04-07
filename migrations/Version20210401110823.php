<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210401110823 extends AbstractMigration
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
        $this->addSql('CREATE TABLE main_user (id INT NOT NULL, auth_key VARCHAR(32) NOT NULL, password_hash VARCHAR(255) NOT NULL, password_reset_token VARCHAR(255) DEFAULT \'NULL\', created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT \'NULL\', updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT \'NULL\', user_name VARCHAR(32) NOT NULL, first_name VARCHAR(32) NOT NULL, last_name VARCHAR(32) NOT NULL, middle_name VARCHAR(32) DEFAULT \'NULL\', email VARCHAR(255) NOT NULL, status INT NOT NULL, PRIMARY KEY(id))');
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
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SCHEMA hdb_catalog');
        $this->addSql('CREATE SCHEMA hdb_views');
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
        $this->addSql('DROP TABLE main_user');
    }
}
