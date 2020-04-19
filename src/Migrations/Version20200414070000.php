<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200414070000 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE categories_enjeu_externe (id INT AUTO_INCREMENT NOT NULL, nom_categorie VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE enjeu_faiblesse');
        $this->addSql('DROP TABLE enjeu_force');
        $this->addSql('ALTER TABLE access_token CHANGE user_id user_id INT DEFAULT NULL, CHANGE expires_at expires_at INT DEFAULT NULL, CHANGE scope scope VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE auth_code CHANGE user_id user_id INT DEFAULT NULL, CHANGE expires_at expires_at INT DEFAULT NULL, CHANGE scope scope VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE categoriepi CHANGE nombre nombre INT DEFAULT NULL');
        $this->addSql('ALTER TABLE enjeu ADD categories_enjeu_externe_id INT NOT NULL');
        $this->addSql('ALTER TABLE enjeu ADD CONSTRAINT FK_31ACDBB73DAA5F4 FOREIGN KEY (categories_enjeu_externe_id) REFERENCES categories_enjeu_externe (id)');
        $this->addSql('CREATE INDEX IDX_31ACDBB73DAA5F4 ON enjeu (categories_enjeu_externe_id)');
        $this->addSql('ALTER TABLE historique_pi CHANGE poids poids INT DEFAULT NULL');
        $this->addSql('ALTER TABLE partieinteresse CHANGE poids poids INT DEFAULT NULL, CHANGE pouvoir pouvoir INT DEFAULT NULL, CHANGE influence influence INT DEFAULT NULL, CHANGE interet interet INT DEFAULT NULL');
        $this->addSql('ALTER TABLE plan_de_action CHANGE exigencepi_id exigencepi_id INT DEFAULT NULL, CHANGE risque_id risque_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE processus CHANGE risque_id risque_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE refresh_token CHANGE user_id user_id INT DEFAULT NULL, CHANGE expires_at expires_at INT DEFAULT NULL, CHANGE scope scope VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE risque CHANGE court_term court_term VARCHAR(255) DEFAULT NULL, CHANGE moyen_term moyen_term VARCHAR(255) DEFAULT NULL, CHANGE long_term long_term VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE reset_token reset_token VARCHAR(255) DEFAULT NULL, CHANGE confirmation_token confirmation_token VARCHAR(180) DEFAULT NULL, CHANGE password_requested_at password_requested_at DATETIME DEFAULT NULL, CHANGE salt salt VARCHAR(255) DEFAULT NULL, CHANGE last_login last_login DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE enjeu DROP FOREIGN KEY FK_31ACDBB73DAA5F4');
        $this->addSql('CREATE TABLE enjeu_faiblesse (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, type VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE enjeu_force (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, type VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE categories_enjeu_externe');
        $this->addSql('ALTER TABLE access_token CHANGE user_id user_id INT DEFAULT NULL, CHANGE expires_at expires_at INT DEFAULT NULL, CHANGE scope scope VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE auth_code CHANGE user_id user_id INT DEFAULT NULL, CHANGE expires_at expires_at INT DEFAULT NULL, CHANGE scope scope VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE categoriepi CHANGE nombre nombre INT DEFAULT NULL');
        $this->addSql('DROP INDEX IDX_31ACDBB73DAA5F4 ON enjeu');
        $this->addSql('ALTER TABLE enjeu DROP categories_enjeu_externe_id');
        $this->addSql('ALTER TABLE historique_pi CHANGE poids poids INT DEFAULT NULL');
        $this->addSql('ALTER TABLE partieinteresse CHANGE poids poids INT DEFAULT NULL, CHANGE pouvoir pouvoir INT DEFAULT NULL, CHANGE influence influence INT DEFAULT NULL, CHANGE interet interet INT DEFAULT NULL');
        $this->addSql('ALTER TABLE plan_de_action CHANGE exigencepi_id exigencepi_id INT DEFAULT NULL, CHANGE risque_id risque_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE processus CHANGE risque_id risque_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE refresh_token CHANGE user_id user_id INT DEFAULT NULL, CHANGE expires_at expires_at INT DEFAULT NULL, CHANGE scope scope VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE risque CHANGE court_term court_term VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE moyen_term moyen_term VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE long_term long_term VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE salt salt VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE last_login last_login DATETIME DEFAULT \'NULL\', CHANGE confirmation_token confirmation_token VARCHAR(180) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE password_requested_at password_requested_at DATETIME DEFAULT \'NULL\', CHANGE reset_token reset_token VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
