<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200412234850 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE risque (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(255) NOT NULL, causes VARCHAR(255) NOT NULL, censequence VARCHAR(255) NOT NULL, gravite INT NOT NULL, probabilite INT NOT NULL, detectabilite INT NOT NULL, criticite INT NOT NULL, decision VARCHAR(255) NOT NULL, court_term VARCHAR(255) DEFAULT NULL, moyen_term VARCHAR(255) DEFAULT NULL, long_term VARCHAR(255) DEFAULT NULL, date_identification DATE NOT NULL, strategique VARCHAR(255) NOT NULL, etat_risque VARCHAR(255) NOT NULL, commentaire VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE access_token CHANGE user_id user_id INT DEFAULT NULL, CHANGE expires_at expires_at INT DEFAULT NULL, CHANGE scope scope VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE auth_code CHANGE user_id user_id INT DEFAULT NULL, CHANGE expires_at expires_at INT DEFAULT NULL, CHANGE scope scope VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE categoriepi CHANGE nombre nombre INT DEFAULT NULL');
        $this->addSql('ALTER TABLE historique_pi CHANGE poids poids INT DEFAULT NULL');
        $this->addSql('ALTER TABLE partieinteresse CHANGE poids poids INT DEFAULT NULL, CHANGE pouvoir pouvoir INT DEFAULT NULL, CHANGE influence influence INT DEFAULT NULL, CHANGE interet interet INT DEFAULT NULL');
        $this->addSql('ALTER TABLE plan_de_action ADD risque_id INT DEFAULT NULL, CHANGE exigencepi_id exigencepi_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE plan_de_action ADD CONSTRAINT FK_ECC023A34ECC2413 FOREIGN KEY (risque_id) REFERENCES risque (id)');
        $this->addSql('CREATE INDEX IDX_ECC023A34ECC2413 ON plan_de_action (risque_id)');
        $this->addSql('ALTER TABLE processus ADD risque_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE processus ADD CONSTRAINT FK_EEEA8C1D4ECC2413 FOREIGN KEY (risque_id) REFERENCES risque (id)');
        $this->addSql('CREATE INDEX IDX_EEEA8C1D4ECC2413 ON processus (risque_id)');
        $this->addSql('ALTER TABLE refresh_token CHANGE user_id user_id INT DEFAULT NULL, CHANGE expires_at expires_at INT DEFAULT NULL, CHANGE scope scope VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE reset_token reset_token VARCHAR(255) DEFAULT NULL, CHANGE confirmation_token confirmation_token VARCHAR(180) DEFAULT NULL, CHANGE password_requested_at password_requested_at DATETIME DEFAULT NULL, CHANGE salt salt VARCHAR(255) DEFAULT NULL, CHANGE last_login last_login DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE plan_de_action DROP FOREIGN KEY FK_ECC023A34ECC2413');
        $this->addSql('ALTER TABLE processus DROP FOREIGN KEY FK_EEEA8C1D4ECC2413');
        $this->addSql('DROP TABLE risque');
        $this->addSql('ALTER TABLE access_token CHANGE user_id user_id INT DEFAULT NULL, CHANGE expires_at expires_at INT DEFAULT NULL, CHANGE scope scope VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE auth_code CHANGE user_id user_id INT DEFAULT NULL, CHANGE expires_at expires_at INT DEFAULT NULL, CHANGE scope scope VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE categoriepi CHANGE nombre nombre INT DEFAULT NULL');
        $this->addSql('ALTER TABLE historique_pi CHANGE poids poids INT DEFAULT NULL');
        $this->addSql('ALTER TABLE partieinteresse CHANGE poids poids INT DEFAULT NULL, CHANGE pouvoir pouvoir INT DEFAULT NULL, CHANGE influence influence INT DEFAULT NULL, CHANGE interet interet INT DEFAULT NULL');
        $this->addSql('DROP INDEX IDX_ECC023A34ECC2413 ON plan_de_action');
        $this->addSql('ALTER TABLE plan_de_action DROP risque_id, CHANGE exigencepi_id exigencepi_id INT NOT NULL');
        $this->addSql('DROP INDEX IDX_EEEA8C1D4ECC2413 ON processus');
        $this->addSql('ALTER TABLE processus DROP risque_id');
        $this->addSql('ALTER TABLE refresh_token CHANGE user_id user_id INT DEFAULT NULL, CHANGE expires_at expires_at INT DEFAULT NULL, CHANGE scope scope VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE salt salt VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE last_login last_login DATETIME DEFAULT \'NULL\', CHANGE confirmation_token confirmation_token VARCHAR(180) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE password_requested_at password_requested_at DATETIME DEFAULT \'NULL\', CHANGE reset_token reset_token VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
