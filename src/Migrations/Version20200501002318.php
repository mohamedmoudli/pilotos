<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200501002318 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE category_stake_internal DROP FOREIGN KEY FK_E81E0894D603F97F');
        $this->addSql('DROP TABLE type_enjeu');
        $this->addSql('ALTER TABLE access_token CHANGE user_id user_id INT DEFAULT NULL, CHANGE expires_at expires_at INT DEFAULT NULL, CHANGE scope scope VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE salt salt VARCHAR(255) DEFAULT NULL, CHANGE last_login last_login DATETIME DEFAULT NULL, CHANGE confirmation_token confirmation_token VARCHAR(180) DEFAULT NULL, CHANGE password_requested_at password_requested_at DATETIME DEFAULT NULL, CHANGE reset_token reset_token VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE refresh_token CHANGE user_id user_id INT DEFAULT NULL, CHANGE expires_at expires_at INT DEFAULT NULL, CHANGE scope scope VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE action_plan CHANGE exigency_interested_party_id exigency_interested_party_id INT DEFAULT NULL, CHANGE risk_id risk_id INT DEFAULT NULL, CHANGE opportunity_id opportunity_id INT DEFAULT NULL, CHANGE opportunity_reevalution_id opportunity_reevalution_id INT DEFAULT NULL, CHANGE historical_risk_id historical_risk_id INT DEFAULT NULL, CHANGE historical_opportunity_id historical_opportunity_id INT DEFAULT NULL, CHANGE objective_id objective_id INT DEFAULT NULL, CHANGE historical_objective_id historical_objective_id INT DEFAULT NULL, CHANGE description description VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE auth_code CHANGE user_id user_id INT DEFAULT NULL, CHANGE expires_at expires_at INT DEFAULT NULL, CHANGE scope scope VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE categorye_interested_party CHANGE nombre nombre INT DEFAULT NULL');
        $this->addSql('DROP INDEX IDX_E81E0894D603F97F ON category_stake_internal');
        $this->addSql('ALTER TABLE category_stake_internal ADD type_stake_id INT DEFAULT NULL, DROP type_enjeu_id');
        $this->addSql('ALTER TABLE category_stake_internal ADD CONSTRAINT FK_E81E08942A971B6E FOREIGN KEY (type_stake_id) REFERENCES type_stake (id)');
        $this->addSql('CREATE INDEX IDX_E81E08942A971B6E ON category_stake_internal (type_stake_id)');
        $this->addSql('ALTER TABLE historical_interseted_party CHANGE poids poids INT DEFAULT NULL');
        $this->addSql('ALTER TABLE historical_objective CHANGE time1 time1 VARCHAR(255) DEFAULT NULL, CHANGE time2 time2 VARCHAR(255) DEFAULT NULL, CHANGE time3 time3 VARCHAR(255) DEFAULT NULL, CHANGE time4 time4 VARCHAR(255) DEFAULT NULL, CHANGE time2020 time2020 VARCHAR(255) DEFAULT NULL, CHANGE time2021 time2021 VARCHAR(255) DEFAULT NULL, CHANGE predefined_indicator predefined_indicator VARCHAR(255) DEFAULT NULL, CHANGE advancement advancement DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE interseted_party CHANGE `load` `load` INT DEFAULT NULL, CHANGE power power INT DEFAULT NULL, CHANGE influence influence INT DEFAULT NULL, CHANGE interest interest INT DEFAULT NULL');
        $this->addSql('ALTER TABLE objective CHANGE predefined_indicator predefined_indicator VARCHAR(255) DEFAULT NULL, CHANGE advancement advancement DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE opportunity CHANGE strategic_reevaluation_id strategic_reevaluation_id INT DEFAULT NULL, CHANGE process_lie_reevaluation_id process_lie_reevaluation_id INT DEFAULT NULL, CHANGE state_opportunity_reevaluation_id state_opportunity_reevaluation_id INT DEFAULT NULL, CHANGE short_term short_term VARCHAR(255) DEFAULT NULL, CHANGE medium_term medium_term VARCHAR(255) DEFAULT NULL, CHANGE long_term long_term VARCHAR(255) DEFAULT NULL, CHANGE consistency consistency VARCHAR(255) DEFAULT NULL, CHANGE alignment alignment VARCHAR(255) DEFAULT NULL, CHANGE presence presence VARCHAR(255) DEFAULT NULL, CHANGE skills skills VARCHAR(255) DEFAULT NULL, CHANGE continuity continuity VARCHAR(255) DEFAULT NULL, CHANGE gain gain VARCHAR(255) DEFAULT NULL, CHANGE effort_reevaluation effort_reevaluation INT DEFAULT NULL, CHANGE advantage_reevaluation advantage_reevaluation INT DEFAULT NULL, CHANGE load_reevaluation load_reevaluation INT DEFAULT NULL, CHANGE decision_reevaluation decision_reevaluation VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE risk CHANGE short_term short_term VARCHAR(255) DEFAULT NULL, CHANGE medium_term medium_term VARCHAR(255) DEFAULT NULL, CHANGE long_term long_term VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE stake CHANGE category_stake_internal_id category_stake_internal_id INT DEFAULT NULL, CHANGE category_stake_external_id category_stake_external_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE type_stake CHANGE nom_type name_type VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE type_enjeu (id INT AUTO_INCREMENT NOT NULL, nom_type VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE access_token CHANGE user_id user_id INT DEFAULT NULL, CHANGE expires_at expires_at INT DEFAULT NULL, CHANGE scope scope VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE action_plan CHANGE exigency_interested_party_id exigency_interested_party_id INT DEFAULT NULL, CHANGE risk_id risk_id INT DEFAULT NULL, CHANGE opportunity_id opportunity_id INT DEFAULT NULL, CHANGE opportunity_reevalution_id opportunity_reevalution_id INT DEFAULT NULL, CHANGE historical_risk_id historical_risk_id INT DEFAULT NULL, CHANGE historical_opportunity_id historical_opportunity_id INT DEFAULT NULL, CHANGE objective_id objective_id INT DEFAULT NULL, CHANGE historical_objective_id historical_objective_id INT DEFAULT NULL, CHANGE description description VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE auth_code CHANGE user_id user_id INT DEFAULT NULL, CHANGE expires_at expires_at INT DEFAULT NULL, CHANGE scope scope VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE category_stake_internal DROP FOREIGN KEY FK_E81E08942A971B6E');
        $this->addSql('DROP INDEX IDX_E81E08942A971B6E ON category_stake_internal');
        $this->addSql('ALTER TABLE category_stake_internal ADD type_enjeu_id INT DEFAULT NULL, DROP type_stake_id');
        $this->addSql('ALTER TABLE category_stake_internal ADD CONSTRAINT FK_E81E0894D603F97F FOREIGN KEY (type_enjeu_id) REFERENCES type_enjeu (id)');
        $this->addSql('CREATE INDEX IDX_E81E0894D603F97F ON category_stake_internal (type_enjeu_id)');
        $this->addSql('ALTER TABLE categorye_interested_party CHANGE nombre nombre INT DEFAULT NULL');
        $this->addSql('ALTER TABLE historical_interseted_party CHANGE poids poids INT DEFAULT NULL');
        $this->addSql('ALTER TABLE historical_objective CHANGE time1 time1 VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE time2 time2 VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE time3 time3 VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE time4 time4 VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE time2020 time2020 VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE time2021 time2021 VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE predefined_indicator predefined_indicator VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE advancement advancement DOUBLE PRECISION DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE interseted_party CHANGE `load` `load` INT DEFAULT NULL, CHANGE power power INT DEFAULT NULL, CHANGE influence influence INT DEFAULT NULL, CHANGE interest interest INT DEFAULT NULL');
        $this->addSql('ALTER TABLE objective CHANGE predefined_indicator predefined_indicator VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE advancement advancement DOUBLE PRECISION DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE opportunity CHANGE strategic_reevaluation_id strategic_reevaluation_id INT DEFAULT NULL, CHANGE process_lie_reevaluation_id process_lie_reevaluation_id INT DEFAULT NULL, CHANGE state_opportunity_reevaluation_id state_opportunity_reevaluation_id INT DEFAULT NULL, CHANGE short_term short_term VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE medium_term medium_term VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE long_term long_term VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE consistency consistency VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE alignment alignment VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE presence presence VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE skills skills VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE continuity continuity VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE gain gain VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE effort_reevaluation effort_reevaluation INT DEFAULT NULL, CHANGE advantage_reevaluation advantage_reevaluation INT DEFAULT NULL, CHANGE load_reevaluation load_reevaluation INT DEFAULT NULL, CHANGE decision_reevaluation decision_reevaluation VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE refresh_token CHANGE user_id user_id INT DEFAULT NULL, CHANGE expires_at expires_at INT DEFAULT NULL, CHANGE scope scope VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE risk CHANGE short_term short_term VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE medium_term medium_term VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE long_term long_term VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE stake CHANGE category_stake_internal_id category_stake_internal_id INT DEFAULT NULL, CHANGE category_stake_external_id category_stake_external_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE type_stake CHANGE name_type nom_type VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE salt salt VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE last_login last_login DATETIME DEFAULT \'NULL\', CHANGE confirmation_token confirmation_token VARCHAR(180) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE password_requested_at password_requested_at DATETIME DEFAULT \'NULL\', CHANGE reset_token reset_token VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
