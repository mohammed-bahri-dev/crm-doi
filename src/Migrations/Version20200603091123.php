<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200603091123 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ca_entity ADD privileged_contact_id INT DEFAULT NULL, CHANGE partner_status_id partner_status_id INT DEFAULT NULL, CHANGE type_of_ca_entity_id type_of_ca_entity_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ca_entity ADD CONSTRAINT FK_F5D1757FDD62B42F FOREIGN KEY (privileged_contact_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_F5D1757FDD62B42F ON ca_entity (privileged_contact_id)');
        $this->addSql('ALTER TABLE event CHANGE type_of_event_id type_of_event_id INT DEFAULT NULL, CHANGE organizer_id organizer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE event_project CHANGE project_status_id project_status_id INT DEFAULT NULL, CHANGE type_of_event_project_id type_of_event_project_id INT DEFAULT NULL, CHANGE person_id person_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE participation_event CHANGE event_id event_id INT DEFAULT NULL, CHANGE participant_id participant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE project CHANGE technology_id technology_id INT DEFAULT NULL, CHANGE type_of_project_id type_of_project_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE question CHANGE person_id person_id INT DEFAULT NULL, CHANGE technology_id technology_id INT DEFAULT NULL, CHANGE event_id event_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE technology CHANGE expert_id expert_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE ca_entity_id ca_entity_id INT DEFAULT NULL, CHANGE preferred_contact_id preferred_contact_id INT DEFAULT NULL, CHANGE phone phone VARCHAR(255) DEFAULT NULL, CHANGE mobile mobile VARCHAR(255) DEFAULT NULL, CHANGE address address VARCHAR(255) DEFAULT NULL, CHANGE contact_mode contact_mode VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ca_entity DROP FOREIGN KEY FK_F5D1757FDD62B42F');
        $this->addSql('DROP INDEX IDX_F5D1757FDD62B42F ON ca_entity');
        $this->addSql('ALTER TABLE ca_entity DROP privileged_contact_id, CHANGE partner_status_id partner_status_id INT DEFAULT NULL, CHANGE type_of_ca_entity_id type_of_ca_entity_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE event CHANGE type_of_event_id type_of_event_id INT DEFAULT NULL, CHANGE organizer_id organizer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE event_project CHANGE project_status_id project_status_id INT DEFAULT NULL, CHANGE type_of_event_project_id type_of_event_project_id INT DEFAULT NULL, CHANGE person_id person_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE participation_event CHANGE event_id event_id INT DEFAULT NULL, CHANGE participant_id participant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE project CHANGE technology_id technology_id INT DEFAULT NULL, CHANGE type_of_project_id type_of_project_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE question CHANGE person_id person_id INT DEFAULT NULL, CHANGE technology_id technology_id INT DEFAULT NULL, CHANGE event_id event_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE technology CHANGE expert_id expert_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE ca_entity_id ca_entity_id INT DEFAULT NULL, CHANGE preferred_contact_id preferred_contact_id INT DEFAULT NULL, CHANGE phone phone VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE mobile mobile VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE address address VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE contact_mode contact_mode VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
