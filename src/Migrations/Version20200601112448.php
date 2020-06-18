<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200601112448 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ca_entity ADD partner_status_id INT DEFAULT NULL, ADD type_of_ca_entity_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ca_entity ADD CONSTRAINT FK_F5D1757F40209BA9 FOREIGN KEY (partner_status_id) REFERENCES partner_status (id)');
        $this->addSql('ALTER TABLE ca_entity ADD CONSTRAINT FK_F5D1757F8D117400 FOREIGN KEY (type_of_ca_entity_id) REFERENCES type_of_ca_entity (id)');
        $this->addSql('CREATE INDEX IDX_F5D1757F40209BA9 ON ca_entity (partner_status_id)');
        $this->addSql('CREATE INDEX IDX_F5D1757F8D117400 ON ca_entity (type_of_ca_entity_id)');
        $this->addSql('ALTER TABLE user CHANGE ca_entity_id ca_entity_id INT DEFAULT NULL, CHANGE phone phone VARCHAR(255) DEFAULT NULL, CHANGE mobile mobile VARCHAR(255) DEFAULT NULL, CHANGE address address VARCHAR(255) DEFAULT NULL, CHANGE contact_mode contact_mode VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ca_entity DROP FOREIGN KEY FK_F5D1757F40209BA9');
        $this->addSql('ALTER TABLE ca_entity DROP FOREIGN KEY FK_F5D1757F8D117400');
        $this->addSql('DROP INDEX IDX_F5D1757F40209BA9 ON ca_entity');
        $this->addSql('DROP INDEX IDX_F5D1757F8D117400 ON ca_entity');
        $this->addSql('ALTER TABLE ca_entity DROP partner_status_id, DROP type_of_ca_entity_id');
        $this->addSql('ALTER TABLE user CHANGE ca_entity_id ca_entity_id INT DEFAULT NULL, CHANGE phone phone VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE mobile mobile VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE address address VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE contact_mode contact_mode VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
