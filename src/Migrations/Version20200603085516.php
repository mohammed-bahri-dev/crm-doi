<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200603085516 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE preferred_contact (id INT AUTO_INCREMENT NOT NULL, mode VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ca_entity CHANGE partner_status_id partner_status_id INT DEFAULT NULL, CHANGE type_of_ca_entity_id type_of_ca_entity_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE event CHANGE type_of_event_id type_of_event_id INT DEFAULT NULL, CHANGE organizer_id organizer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE event_project CHANGE project_status_id project_status_id INT DEFAULT NULL, CHANGE type_of_event_project_id type_of_event_project_id INT DEFAULT NULL, CHANGE person_id person_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE participation_event CHANGE event_id event_id INT DEFAULT NULL, CHANGE participant_id participant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE project CHANGE technology_id technology_id INT DEFAULT NULL, CHANGE type_of_project_id type_of_project_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE question CHANGE person_id person_id INT DEFAULT NULL, CHANGE technology_id technology_id INT DEFAULT NULL, CHANGE event_id event_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE technology CHANGE expert_id expert_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD preferred_contact_id INT DEFAULT NULL, CHANGE ca_entity_id ca_entity_id INT DEFAULT NULL, CHANGE phone phone VARCHAR(255) DEFAULT NULL, CHANGE mobile mobile VARCHAR(255) DEFAULT NULL, CHANGE address address VARCHAR(255) DEFAULT NULL, CHANGE contact_mode contact_mode VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6492AAB3863 FOREIGN KEY (preferred_contact_id) REFERENCES preferred_contact (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6492AAB3863 ON user (preferred_contact_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6492AAB3863');
        $this->addSql('DROP TABLE preferred_contact');
        $this->addSql('ALTER TABLE ca_entity CHANGE partner_status_id partner_status_id INT DEFAULT NULL, CHANGE type_of_ca_entity_id type_of_ca_entity_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE event CHANGE type_of_event_id type_of_event_id INT DEFAULT NULL, CHANGE organizer_id organizer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE event_project CHANGE project_status_id project_status_id INT DEFAULT NULL, CHANGE type_of_event_project_id type_of_event_project_id INT DEFAULT NULL, CHANGE person_id person_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE participation_event CHANGE event_id event_id INT DEFAULT NULL, CHANGE participant_id participant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE project CHANGE technology_id technology_id INT DEFAULT NULL, CHANGE type_of_project_id type_of_project_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE question CHANGE person_id person_id INT DEFAULT NULL, CHANGE technology_id technology_id INT DEFAULT NULL, CHANGE event_id event_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE technology CHANGE expert_id expert_id INT DEFAULT NULL');
        $this->addSql('DROP INDEX IDX_8D93D6492AAB3863 ON user');
        $this->addSql('ALTER TABLE user DROP preferred_contact_id, CHANGE ca_entity_id ca_entity_id INT DEFAULT NULL, CHANGE phone phone VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE mobile mobile VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE address address VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE contact_mode contact_mode VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
