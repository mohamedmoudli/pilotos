<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200430030223 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE opportunite DROP FOREIGN KEY FK_97889F9816F1D647');
        $this->addSql('ALTER TABLE risque DROP FOREIGN KEY FK_20230D24E3932B14');
        $this->addSql('ALTER TABLE partieinteresse DROP FOREIGN KEY FK_B4C6910BE4DDA634');
        $this->addSql('ALTER TABLE enjeu DROP FOREIGN KEY FK_31ACDBB73DAA5F4');
        $this->addSql('ALTER TABLE enjeu DROP FOREIGN KEY FK_31ACDBB7CD0277BA');
        $this->addSql('ALTER TABLE opportunite DROP FOREIGN KEY FK_97889F9839DFE470');
        $this->addSql('ALTER TABLE opportunite DROP FOREIGN KEY FK_97889F98BBD37F1D');
        $this->addSql('ALTER TABLE risque DROP FOREIGN KEY FK_20230D24BE5E62FF');
        $this->addSql('ALTER TABLE plan_de_action DROP FOREIGN KEY FK_ECC023A3314295E6');
        $this->addSql('ALTER TABLE plan_de_action DROP FOREIGN KEY FK_ECC023A3D7402350');
        $this->addSql('ALTER TABLE plan_de_action DROP FOREIGN KEY FK_ECC023A3634CA502');
        $this->addSql('ALTER TABLE plan_de_action DROP FOREIGN KEY FK_ECC023A31DBF6F5B');
        $this->addSql('ALTER TABLE plan_de_action DROP FOREIGN KEY FK_ECC023A329EBB489');
        $this->addSql('ALTER TABLE plan_de_action DROP FOREIGN KEY FK_ECC023A380FBB128');
        $this->addSql('ALTER TABLE opportunite DROP FOREIGN KEY FK_97889F985C2FE0A');
        $this->addSql('ALTER TABLE opportunite DROP FOREIGN KEY FK_97889F98CAFA8B58');
        $this->addSql('ALTER TABLE risque DROP FOREIGN KEY FK_20230D24A55629DC');
        $this->addSql('ALTER TABLE plan_de_action DROP FOREIGN KEY FK_ECC023A34ECC2413');
        $this->addSql('ALTER TABLE opportunite DROP FOREIGN KEY FK_97889F98F3B05ABD');
        $this->addSql('ALTER TABLE opportunite DROP FOREIGN KEY FK_97889F98F7BE4EEE');
        $this->addSql('ALTER TABLE risque DROP FOREIGN KEY FK_20230D2422D953E0');
        $this->addSql('DROP TABLE categorie_opportunite');
        $this->addSql('DROP TABLE categorie_risque');
        $this->addSql('DROP TABLE categoriepi');
        $this->addSql('DROP TABLE categories_enjeu_externe');
        $this->addSql('DROP TABLE categories_enjeu_interne');
        $this->addSql('DROP TABLE enjeu');
        $this->addSql('DROP TABLE etat_opportunite');
        $this->addSql('DROP TABLE etat_risque');
        $this->addSql('DROP TABLE exigencepi');
        $this->addSql('DROP TABLE historique_objective');
        $this->addSql('DROP TABLE historique_opportunite');
        $this->addSql('DROP TABLE historique_pi');
        $this->addSql('DROP TABLE historique_risque');
        $this->addSql('DROP TABLE opportunite');
        $this->addSql('DROP TABLE partieinteresse');
        $this->addSql('DROP TABLE plan_de_action');
        $this->addSql('DROP TABLE processus');
        $this->addSql('DROP TABLE risque');
        $this->addSql('DROP TABLE strategique_opportunite');
        $this->addSql('DROP TABLE strategique_risque');
        $this->addSql('ALTER TABLE access_token CHANGE user_id user_id INT DEFAULT NULL, CHANGE expires_at expires_at INT DEFAULT NULL, CHANGE scope scope VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE action_plan CHANGE exigency_interested_party_id exigency_interested_party_id INT DEFAULT NULL, CHANGE risk_id risk_id INT DEFAULT NULL, CHANGE opportunity_id opportunity_id INT DEFAULT NULL, CHANGE opportunity_reevalution_id opportunity_reevalution_id INT DEFAULT NULL, CHANGE historical_risk_id historical_risk_id INT DEFAULT NULL, CHANGE historical_opportunity_id historical_opportunity_id INT DEFAULT NULL, CHANGE objective_id objective_id INT DEFAULT NULL, CHANGE historical_objective_id historical_objective_id INT DEFAULT NULL, CHANGE description description VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE auth_code CHANGE user_id user_id INT DEFAULT NULL, CHANGE expires_at expires_at INT DEFAULT NULL, CHANGE scope scope VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE categorye_interested_party CHANGE nombre nombre INT DEFAULT NULL');
        $this->addSql('ALTER TABLE category_stake_internal CHANGE type_enjeu_id type_enjeu_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE historical_interseted_party CHANGE poids poids INT DEFAULT NULL');
        $this->addSql('ALTER TABLE historical_objective CHANGE time1 time1 VARCHAR(255) DEFAULT NULL, CHANGE time2 time2 VARCHAR(255) DEFAULT NULL, CHANGE time3 time3 VARCHAR(255) DEFAULT NULL, CHANGE time4 time4 VARCHAR(255) DEFAULT NULL, CHANGE time2020 time2020 VARCHAR(255) DEFAULT NULL, CHANGE time2021 time2021 VARCHAR(255) DEFAULT NULL, CHANGE predefined_indicator predefined_indicator VARCHAR(255) DEFAULT NULL, CHANGE advancement advancement DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE interseted_party CHANGE `load` `load` INT DEFAULT NULL, CHANGE power power INT DEFAULT NULL, CHANGE influence influence INT DEFAULT NULL, CHANGE interest interest INT DEFAULT NULL');
        $this->addSql('ALTER TABLE objective CHANGE indicateur_predefini indicateur_predefini VARCHAR(255) DEFAULT NULL, CHANGE avencement avencement DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE opportunity CHANGE strategic_reevaluation_id strategic_reevaluation_id INT DEFAULT NULL, CHANGE process_lie_reevaluation_id process_lie_reevaluation_id INT DEFAULT NULL, CHANGE state_opportunity_reevaluation_id state_opportunity_reevaluation_id INT DEFAULT NULL, CHANGE short_term short_term VARCHAR(255) DEFAULT NULL, CHANGE medium_term medium_term VARCHAR(255) DEFAULT NULL, CHANGE long_term long_term VARCHAR(255) DEFAULT NULL, CHANGE consistency consistency VARCHAR(255) DEFAULT NULL, CHANGE alignment alignment VARCHAR(255) DEFAULT NULL, CHANGE presence presence VARCHAR(255) DEFAULT NULL, CHANGE skills skills VARCHAR(255) DEFAULT NULL, CHANGE continuity continuity VARCHAR(255) DEFAULT NULL, CHANGE gain gain VARCHAR(255) DEFAULT NULL, CHANGE effort_reevaluation effort_reevaluation INT DEFAULT NULL, CHANGE advantage_reevaluation advantage_reevaluation INT DEFAULT NULL, CHANGE load_reevaluation load_reevaluation INT DEFAULT NULL, CHANGE decision_reevaluation decision_reevaluation VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE refresh_token CHANGE user_id user_id INT DEFAULT NULL, CHANGE expires_at expires_at INT DEFAULT NULL, CHANGE scope scope VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE risk CHANGE short_term short_term VARCHAR(255) DEFAULT NULL, CHANGE medium_term medium_term VARCHAR(255) DEFAULT NULL, CHANGE long_term long_term VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE stake CHANGE category_stake_internal_id category_stake_internal_id INT DEFAULT NULL, CHANGE category_stake_external_id category_stake_external_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE salt salt VARCHAR(255) DEFAULT NULL, CHANGE last_login last_login DATETIME DEFAULT NULL, CHANGE confirmation_token confirmation_token VARCHAR(180) DEFAULT NULL, CHANGE password_requested_at password_requested_at DATETIME DEFAULT NULL, CHANGE reset_token reset_token VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE categorie_opportunite (id INT AUTO_INCREMENT NOT NULL, nom_categorie VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE categorie_risque (id INT AUTO_INCREMENT NOT NULL, nom_categorie VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE categoriepi (id INT AUTO_INCREMENT NOT NULL, nomcat VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, nombre INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE categories_enjeu_externe (id INT AUTO_INCREMENT NOT NULL, nom_categorie VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE categories_enjeu_interne (id INT AUTO_INCREMENT NOT NULL, nom_categories VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, type_enjeu_id INT DEFAULT NULL, INDEX IDX_278F0F78D603F97F (type_enjeu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE enjeu (id INT AUTO_INCREMENT NOT NULL, categories_enjeu_id INT DEFAULT NULL, categories_enjeu_externe_id INT DEFAULT NULL, description VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_31ACDBB73DAA5F4 (categories_enjeu_externe_id), INDEX IDX_31ACDBB7CD0277BA (categories_enjeu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE etat_opportunite (id INT AUTO_INCREMENT NOT NULL, nom_etat_opportunite VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE etat_risque (id INT AUTO_INCREMENT NOT NULL, nom_etat_risque VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE exigencepi (id INT AUTO_INCREMENT NOT NULL, etat_de_confirmite VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, commantaire VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE historique_objective (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, temps1 VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, temps2 VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, temps3 VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, temps4 VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, temps2020 VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, temps2021 VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, indicateur_predefini VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, indicateur_performance VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, objective_attendre VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, etat_initial VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, etat_actuel_indicateur VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, avencement DOUBLE PRECISION DEFAULT \'NULL\', etat_actuel VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, commentaire VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date DATE NOT NULL, enjeux VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, processlie VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE historique_opportunite (id INT AUTO_INCREMENT NOT NULL, etat VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, commentaire VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE historique_pi (id INT AUTO_INCREMENT NOT NULL, nom_pi LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, poids INT DEFAULT NULL, date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE historique_risque (id INT AUTO_INCREMENT NOT NULL, criticite INT NOT NULL, decision VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, strategique VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, processlie VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, etat_risque VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, commentaires VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date_enregistrement DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE opportunite (id INT AUTO_INCREMENT NOT NULL, stategique_id INT NOT NULL, process_lie_id INT NOT NULL, categorie_opportunite_id INT NOT NULL, strategique_evaluation_id INT DEFAULT NULL, process_lie_reevaluation_id INT DEFAULT NULL, etatopportunite_id INT NOT NULL, etatopportunite_reevaluation_id INT DEFAULT NULL, description VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, court_term VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, moyen_term VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, long_term VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, date_identification VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, coherence VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, allignement VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, presence VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, competences VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, continute VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, gain VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, efforts INT NOT NULL, aventages INT NOT NULL, poids INT NOT NULL, decision VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, effort_reevaluation INT DEFAULT NULL, aventage_reevaluation INT DEFAULT NULL, poids_reevaluation INT DEFAULT NULL, decision_reevaluation VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, commentaire VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_97889F985C2FE0A (process_lie_id), INDEX IDX_97889F98CAFA8B58 (process_lie_reevaluation_id), INDEX IDX_97889F9816F1D647 (categorie_opportunite_id), INDEX IDX_97889F9839DFE470 (etatopportunite_id), INDEX IDX_97889F98F7BE4EEE (stategique_id), INDEX IDX_97889F98F3B05ABD (strategique_evaluation_id), INDEX IDX_97889F98BBD37F1D (etatopportunite_reevaluation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE partieinteresse (id INT AUTO_INCREMENT NOT NULL, categories_pi_id INT NOT NULL, nom_pi LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, poids INT DEFAULT NULL, pouvoir INT DEFAULT NULL, influence INT DEFAULT NULL, interet INT DEFAULT NULL, INDEX IDX_B4C6910BE4DDA634 (categories_pi_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE plan_de_action (id INT AUTO_INCREMENT NOT NULL, exigencepi_id INT DEFAULT NULL, risque_id INT DEFAULT NULL, opportunite_id INT DEFAULT NULL, opportunite_reevalution_id INT DEFAULT NULL, historique_risque_id INT DEFAULT NULL, historique_opportunite_id INT DEFAULT NULL, historique_objective_id INT DEFAULT NULL, action INT NOT NULL, date_debut_panifie VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, delai VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, respensable VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, realisateur VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, consulter VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, avencement VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, critere_de_cloture VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, preuve_de_cloture VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, critaire_efficacite VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, etat_de_efficacite VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, etat_actuel VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, origine VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, objective_id INT DEFAULT NULL, commentaire VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, INDEX IDX_ECC023A34ECC2413 (risque_id), INDEX IDX_ECC023A31DBF6F5B (historique_risque_id), INDEX IDX_ECC023A3D7402350 (historique_objective_id), INDEX IDX_ECC023A380FBB128 (opportunite_id), INDEX IDX_ECC023A3634CA502 (historique_opportunite_id), INDEX IDX_ECC023A3314295E6 (exigencepi_id), INDEX IDX_ECC023A329EBB489 (opportunite_reevalution_id), INDEX IDX_ECC023A373484933 (objective_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE processus (id INT AUTO_INCREMENT NOT NULL, processus VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, indicateur_performance VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, pilote VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE risque (id INT AUTO_INCREMENT NOT NULL, processus_id INT NOT NULL, categorie_risque_id INT NOT NULL, strategique_risque_id INT NOT NULL, etat_risque_id INT NOT NULL, description VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, causes VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, censequence VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, gravite INT NOT NULL, probabilite INT NOT NULL, detectabilite INT NOT NULL, criticite INT NOT NULL, decision VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, court_term VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, moyen_term VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, long_term VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, date_identification VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, commentaire VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_20230D24E3932B14 (categorie_risque_id), INDEX IDX_20230D2422D953E0 (strategique_risque_id), INDEX IDX_20230D24A55629DC (processus_id), INDEX IDX_20230D24BE5E62FF (etat_risque_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE strategique_opportunite (id INT AUTO_INCREMENT NOT NULL, nom_strategique VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE strategique_risque (id INT AUTO_INCREMENT NOT NULL, nom_srategique VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE enjeu ADD CONSTRAINT FK_31ACDBB73DAA5F4 FOREIGN KEY (categories_enjeu_externe_id) REFERENCES categories_enjeu_externe (id)');
        $this->addSql('ALTER TABLE enjeu ADD CONSTRAINT FK_31ACDBB7CD0277BA FOREIGN KEY (categories_enjeu_id) REFERENCES categories_enjeu_interne (id)');
        $this->addSql('ALTER TABLE opportunite ADD CONSTRAINT FK_97889F9816F1D647 FOREIGN KEY (categorie_opportunite_id) REFERENCES categorie_opportunite (id)');
        $this->addSql('ALTER TABLE opportunite ADD CONSTRAINT FK_97889F9839DFE470 FOREIGN KEY (etatopportunite_id) REFERENCES etat_opportunite (id)');
        $this->addSql('ALTER TABLE opportunite ADD CONSTRAINT FK_97889F985C2FE0A FOREIGN KEY (process_lie_id) REFERENCES processus (id)');
        $this->addSql('ALTER TABLE opportunite ADD CONSTRAINT FK_97889F98BBD37F1D FOREIGN KEY (etatopportunite_reevaluation_id) REFERENCES etat_opportunite (id)');
        $this->addSql('ALTER TABLE opportunite ADD CONSTRAINT FK_97889F98CAFA8B58 FOREIGN KEY (process_lie_reevaluation_id) REFERENCES processus (id)');
        $this->addSql('ALTER TABLE opportunite ADD CONSTRAINT FK_97889F98F3B05ABD FOREIGN KEY (strategique_evaluation_id) REFERENCES strategique_opportunite (id)');
        $this->addSql('ALTER TABLE opportunite ADD CONSTRAINT FK_97889F98F7BE4EEE FOREIGN KEY (stategique_id) REFERENCES strategique_opportunite (id)');
        $this->addSql('ALTER TABLE partieinteresse ADD CONSTRAINT FK_B4C6910BE4DDA634 FOREIGN KEY (categories_pi_id) REFERENCES categoriepi (id)');
        $this->addSql('ALTER TABLE plan_de_action ADD CONSTRAINT FK_ECC023A31DBF6F5B FOREIGN KEY (historique_risque_id) REFERENCES historique_risque (id)');
        $this->addSql('ALTER TABLE plan_de_action ADD CONSTRAINT FK_ECC023A329EBB489 FOREIGN KEY (opportunite_reevalution_id) REFERENCES opportunite (id)');
        $this->addSql('ALTER TABLE plan_de_action ADD CONSTRAINT FK_ECC023A3314295E6 FOREIGN KEY (exigencepi_id) REFERENCES exigencepi (id)');
        $this->addSql('ALTER TABLE plan_de_action ADD CONSTRAINT FK_ECC023A34ECC2413 FOREIGN KEY (risque_id) REFERENCES risque (id)');
        $this->addSql('ALTER TABLE plan_de_action ADD CONSTRAINT FK_ECC023A3634CA502 FOREIGN KEY (historique_opportunite_id) REFERENCES historique_opportunite (id)');
        $this->addSql('ALTER TABLE plan_de_action ADD CONSTRAINT FK_ECC023A380FBB128 FOREIGN KEY (opportunite_id) REFERENCES opportunite (id)');
        $this->addSql('ALTER TABLE plan_de_action ADD CONSTRAINT FK_ECC023A3D7402350 FOREIGN KEY (historique_objective_id) REFERENCES historique_objective (id)');
        $this->addSql('ALTER TABLE risque ADD CONSTRAINT FK_20230D2422D953E0 FOREIGN KEY (strategique_risque_id) REFERENCES strategique_risque (id)');
        $this->addSql('ALTER TABLE risque ADD CONSTRAINT FK_20230D24A55629DC FOREIGN KEY (processus_id) REFERENCES processus (id)');
        $this->addSql('ALTER TABLE risque ADD CONSTRAINT FK_20230D24BE5E62FF FOREIGN KEY (etat_risque_id) REFERENCES etat_risque (id)');
        $this->addSql('ALTER TABLE risque ADD CONSTRAINT FK_20230D24E3932B14 FOREIGN KEY (categorie_risque_id) REFERENCES categorie_risque (id)');
        $this->addSql('ALTER TABLE access_token CHANGE user_id user_id INT DEFAULT NULL, CHANGE expires_at expires_at INT DEFAULT NULL, CHANGE scope scope VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE action_plan CHANGE exigency_interested_party_id exigency_interested_party_id INT DEFAULT NULL, CHANGE risk_id risk_id INT DEFAULT NULL, CHANGE opportunity_id opportunity_id INT DEFAULT NULL, CHANGE opportunity_reevalution_id opportunity_reevalution_id INT DEFAULT NULL, CHANGE historical_risk_id historical_risk_id INT DEFAULT NULL, CHANGE historical_opportunity_id historical_opportunity_id INT DEFAULT NULL, CHANGE objective_id objective_id INT DEFAULT NULL, CHANGE historical_objective_id historical_objective_id INT DEFAULT NULL, CHANGE description description VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE auth_code CHANGE user_id user_id INT DEFAULT NULL, CHANGE expires_at expires_at INT DEFAULT NULL, CHANGE scope scope VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE category_stake_internal CHANGE type_enjeu_id type_enjeu_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE categorye_interested_party CHANGE nombre nombre INT DEFAULT NULL');
        $this->addSql('ALTER TABLE historical_interseted_party CHANGE poids poids INT DEFAULT NULL');
        $this->addSql('ALTER TABLE historical_objective CHANGE time1 time1 VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE time2 time2 VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE time3 time3 VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE time4 time4 VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE time2020 time2020 VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE time2021 time2021 VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE predefined_indicator predefined_indicator VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE advancement advancement DOUBLE PRECISION DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE interseted_party CHANGE `load` `load` INT DEFAULT NULL, CHANGE power power INT DEFAULT NULL, CHANGE influence influence INT DEFAULT NULL, CHANGE interest interest INT DEFAULT NULL');
        $this->addSql('ALTER TABLE objective CHANGE indicateur_predefini indicateur_predefini VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE avencement avencement DOUBLE PRECISION DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE opportunity CHANGE strategic_reevaluation_id strategic_reevaluation_id INT DEFAULT NULL, CHANGE process_lie_reevaluation_id process_lie_reevaluation_id INT DEFAULT NULL, CHANGE state_opportunity_reevaluation_id state_opportunity_reevaluation_id INT DEFAULT NULL, CHANGE short_term short_term VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE medium_term medium_term VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE long_term long_term VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE consistency consistency VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE alignment alignment VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE presence presence VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE skills skills VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE continuity continuity VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE gain gain VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE effort_reevaluation effort_reevaluation INT DEFAULT NULL, CHANGE advantage_reevaluation advantage_reevaluation INT DEFAULT NULL, CHANGE load_reevaluation load_reevaluation INT DEFAULT NULL, CHANGE decision_reevaluation decision_reevaluation VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE refresh_token CHANGE user_id user_id INT DEFAULT NULL, CHANGE expires_at expires_at INT DEFAULT NULL, CHANGE scope scope VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE risk CHANGE short_term short_term VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE medium_term medium_term VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE long_term long_term VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE stake CHANGE category_stake_internal_id category_stake_internal_id INT DEFAULT NULL, CHANGE category_stake_external_id category_stake_external_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE salt salt VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE last_login last_login DATETIME DEFAULT \'NULL\', CHANGE confirmation_token confirmation_token VARCHAR(180) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE password_requested_at password_requested_at DATETIME DEFAULT \'NULL\', CHANGE reset_token reset_token VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
