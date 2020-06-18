<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200601144019 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE participation_event (id INT AUTO_INCREMENT NOT NULL, event_id INT DEFAULT NULL, participant_id INT DEFAULT NULL, INDEX IDX_3472872C71F7E88B (event_id), INDEX IDX_3472872C9D1C3019 (participant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project (id INT AUTO_INCREMENT NOT NULL, technology_id INT DEFAULT NULL, type_of_project_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_2FB3D0EE4235D463 (technology_id), INDEX IDX_2FB3D0EE8FD4693C (type_of_project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project_status (id INT AUTO_INCREMENT NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_of_project (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE participation_event ADD CONSTRAINT FK_3472872C71F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE participation_event ADD CONSTRAINT FK_3472872C9D1C3019 FOREIGN KEY (participant_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EE4235D463 FOREIGN KEY (technology_id) REFERENCES technology (id)');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EE8FD4693C FOREIGN KEY (type_of_project_id) REFERENCES type_of_project (id)');
        $this->addSql('ALTER TABLE ca_entity CHANGE partner_status_id partner_status_id INT DEFAULT NULL, CHANGE type_of_ca_entity_id type_of_ca_entity_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE ca_entity_id ca_entity_id INT DEFAULT NULL, CHANGE phone phone VARCHAR(255) DEFAULT NULL, CHANGE mobile mobile VARCHAR(255) DEFAULT NULL, CHANGE address address VARCHAR(255) DEFAULT NULL, CHANGE contact_mode contact_mode VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE event CHANGE type_of_event_id type_of_event_id INT DEFAULT NULL, CHANGE organizer_id organizer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE question CHANGE person_id person_id INT DEFAULT NULL, CHANGE technology_id technology_id INT DEFAULT NULL, CHANGE event_id event_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE technology CHANGE expert_id expert_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EE8FD4693C');
        $this->addSql('DROP TABLE participation_event');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE project_status');
        $this->addSql('DROP TABLE type_of_project');
        $this->addSql('ALTER TABLE ca_entity CHANGE partner_status_id partner_status_id INT DEFAULT NULL, CHANGE type_of_ca_entity_id type_of_ca_entity_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE event CHANGE type_of_event_id type_of_event_id INT DEFAULT NULL, CHANGE organizer_id organizer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE question CHANGE person_id person_id INT DEFAULT NULL, CHANGE technology_id technology_id INT DEFAULT NULL, CHANGE event_id event_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE technology CHANGE expert_id expert_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE ca_entity_id ca_entity_id INT DEFAULT NULL, CHANGE phone phone VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE mobile mobile VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE address address VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE contact_mode contact_mode VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
