<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240412125752 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE command_ec (id INT AUTO_INCREMENT NOT NULL, commande_id INT DEFAULT NULL, etat_commande_id INT DEFAULT NULL, date_heure DATETIME NOT NULL, INDEX IDX_130B23582EA2E54 (commande_id), INDEX IDX_130B235EF9E8683 (etat_commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, relai_depart_id INT NOT NULL, user_cible_id INT DEFAULT NULL, masse INT NOT NULL, large_col INT NOT NULL, long_col INT NOT NULL, hauteur_col INT NOT NULL, INDEX IDX_6EEAA67D7D4455C1 (relai_depart_id), INDEX IDX_6EEAA67D49E3BA09 (user_cible_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etat_commande (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE livraision (id INT AUTO_INCREMENT NOT NULL, operateur_id INT DEFAULT NULL, commande_id INT NOT NULL, date_heure DATETIME NOT NULL, INDEX IDX_E830EF4B3F192FC (operateur_id), UNIQUE INDEX UNIQ_E830EF4B82EA2E54 (commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE occupe (id INT AUTO_INCREMENT NOT NULL, commande_id INT NOT NULL, casier_id INT NOT NULL, arriver DATETIME NOT NULL, sorti DATETIME DEFAULT NULL, INDEX IDX_FFBC0FC682EA2E54 (commande_id), INDEX IDX_FFBC0FC6643911C6 (casier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE command_ec ADD CONSTRAINT FK_130B23582EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE command_ec ADD CONSTRAINT FK_130B235EF9E8683 FOREIGN KEY (etat_commande_id) REFERENCES etat_commande (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D7D4455C1 FOREIGN KEY (relai_depart_id) REFERENCES relai (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D49E3BA09 FOREIGN KEY (user_cible_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE livraision ADD CONSTRAINT FK_E830EF4B3F192FC FOREIGN KEY (operateur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE livraision ADD CONSTRAINT FK_E830EF4B82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE occupe ADD CONSTRAINT FK_FFBC0FC682EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE occupe ADD CONSTRAINT FK_FFBC0FC6643911C6 FOREIGN KEY (casier_id) REFERENCES casier (id)');
        $this->addSql('DROP TABLE `admin`');
        $this->addSql('ALTER TABLE user CHANGE nom nom VARCHAR(255) DEFAULT NULL, CHANGE prenom prenom VARCHAR(255) DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D64986CC499D ON user (pseudo)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `admin` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, roles JSON NOT NULL, password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX UNIQ_880E0D76E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE command_ec DROP FOREIGN KEY FK_130B23582EA2E54');
        $this->addSql('ALTER TABLE command_ec DROP FOREIGN KEY FK_130B235EF9E8683');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D7D4455C1');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D49E3BA09');
        $this->addSql('ALTER TABLE livraision DROP FOREIGN KEY FK_E830EF4B3F192FC');
        $this->addSql('ALTER TABLE livraision DROP FOREIGN KEY FK_E830EF4B82EA2E54');
        $this->addSql('ALTER TABLE occupe DROP FOREIGN KEY FK_FFBC0FC682EA2E54');
        $this->addSql('ALTER TABLE occupe DROP FOREIGN KEY FK_FFBC0FC6643911C6');
        $this->addSql('DROP TABLE command_ec');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE etat_commande');
        $this->addSql('DROP TABLE livraision');
        $this->addSql('DROP TABLE occupe');
        $this->addSql('DROP INDEX UNIQ_8D93D64986CC499D ON user');
        $this->addSql('ALTER TABLE user CHANGE nom nom VARCHAR(255) NOT NULL, CHANGE prenom prenom VARCHAR(255) NOT NULL');
    }
}
