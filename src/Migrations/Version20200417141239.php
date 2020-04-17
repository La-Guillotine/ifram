<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200417141239 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE bioagresseur CHANGE type type VARCHAR(40) DEFAULT NULL, CHANGE periodesrisques periodesrisques VARCHAR(50) DEFAULT NULL, CHANGE symptomes symptomes VARCHAR(255) DEFAULT NULL, CHANGE stadesensible stadesensible VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE observation CHANGE coordonnees coordonnees VARCHAR(70) DEFAULT NULL');
        $this->addSql('ALTER TABLE plante CHANGE descriptif descriptif VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE ravageur DROP FOREIGN KEY FK_DB11E526D65163A3');
        $this->addSql('DROP INDEX IDX_DB11E526D65163A3 ON ravageur');
        $this->addSql('ALTER TABLE ravageur DROP bioagresseur_id');
        $this->addSql('ALTER TABLE traitement CHANGE type type VARCHAR(40) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE bioagresseur CHANGE type type VARCHAR(40) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE periodesrisques periodesrisques VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE symptomes symptomes VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE stadesensible stadesensible VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE observation CHANGE coordonnees coordonnees VARCHAR(70) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE plante CHANGE descriptif descriptif VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE ravageur ADD bioagresseur_id INT NOT NULL');
        $this->addSql('ALTER TABLE ravageur ADD CONSTRAINT FK_DB11E526D65163A3 FOREIGN KEY (bioagresseur_id) REFERENCES bioagresseur (id)');
        $this->addSql('CREATE INDEX IDX_DB11E526D65163A3 ON ravageur (bioagresseur_id)');
        $this->addSql('ALTER TABLE traitement CHANGE type type VARCHAR(40) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
