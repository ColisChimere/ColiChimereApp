<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240413164231 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adresse (id INT AUTO_INCREMENT NOT NULL, ville_id INT NOT NULL, rue VARCHAR(500) NOT NULL, num_rue VARCHAR(50) NOT NULL, INDEX IDX_C35F0816A73F0036 (ville_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE casier (id INT AUTO_INCREMENT NOT NULL, model_casier_id INT NOT NULL, relai_id INT NOT NULL, etat_ca VARCHAR(1) NOT NULL, numero VARCHAR(50) NOT NULL, INDEX IDX_3FDF2855DF07855 (model_casier_id), INDEX IDX_3FDF28556931FB1 (relai_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client_adress (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, adresse_id INT NOT NULL, type_adress VARCHAR(1) NOT NULL, INDEX IDX_94A8C0DA76ED395 (user_id), INDEX IDX_94A8C0D4DE7DC5C (adresse_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE model_casier (id INT AUTO_INCREMENT NOT NULL, lidelle VARCHAR(255) NOT NULL, larg_mod_cm INT NOT NULL, haut_mod_cm INT NOT NULL, long_mod_cm INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE preference (id INT AUTO_INCREMENT NOT NULL, type_notifications_id INT DEFAULT NULL, user_id INT NOT NULL, INDEX IDX_5D69B0535AD46130 (type_notifications_id), INDEX IDX_5D69B053A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE relai (id INT AUTO_INCREMENT NOT NULL, adresse_id INT NOT NULL, nom_relai VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_408DF2DD4DE7DC5C (adresse_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_notification (id INT AUTO_INCREMENT NOT NULL, libelle_notification VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, relai_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, pseudo VARCHAR(255) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, num_tel VARCHAR(25) DEFAULT NULL, type_user VARCHAR(2) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D64956931FB1 (relai_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_connexion (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, tokken VARCHAR(255) NOT NULL, date_creation DATETIME NOT NULL, date_utilisation DATETIME NOT NULL, INDEX IDX_938B7478A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ville (id INT AUTO_INCREMENT NOT NULL, nom_ville VARCHAR(255) NOT NULL, code_postal VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F0816A73F0036 FOREIGN KEY (ville_id) REFERENCES ville (id)');
        $this->addSql('ALTER TABLE casier ADD CONSTRAINT FK_3FDF2855DF07855 FOREIGN KEY (model_casier_id) REFERENCES model_casier (id)');
        $this->addSql('ALTER TABLE casier ADD CONSTRAINT FK_3FDF28556931FB1 FOREIGN KEY (relai_id) REFERENCES relai (id)');
        $this->addSql('ALTER TABLE client_adress ADD CONSTRAINT FK_94A8C0DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE client_adress ADD CONSTRAINT FK_94A8C0D4DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id)');
        $this->addSql('ALTER TABLE preference ADD CONSTRAINT FK_5D69B0535AD46130 FOREIGN KEY (type_notifications_id) REFERENCES type_notification (id)');
        $this->addSql('ALTER TABLE preference ADD CONSTRAINT FK_5D69B053A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE relai ADD CONSTRAINT FK_408DF2DD4DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64956931FB1 FOREIGN KEY (relai_id) REFERENCES relai (id)');
        $this->addSql('ALTER TABLE user_connexion ADD CONSTRAINT FK_938B7478A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F0816A73F0036');
        $this->addSql('ALTER TABLE casier DROP FOREIGN KEY FK_3FDF2855DF07855');
        $this->addSql('ALTER TABLE casier DROP FOREIGN KEY FK_3FDF28556931FB1');
        $this->addSql('ALTER TABLE client_adress DROP FOREIGN KEY FK_94A8C0DA76ED395');
        $this->addSql('ALTER TABLE client_adress DROP FOREIGN KEY FK_94A8C0D4DE7DC5C');
        $this->addSql('ALTER TABLE preference DROP FOREIGN KEY FK_5D69B0535AD46130');
        $this->addSql('ALTER TABLE preference DROP FOREIGN KEY FK_5D69B053A76ED395');
        $this->addSql('ALTER TABLE relai DROP FOREIGN KEY FK_408DF2DD4DE7DC5C');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64956931FB1');
        $this->addSql('ALTER TABLE user_connexion DROP FOREIGN KEY FK_938B7478A76ED395');
        $this->addSql('DROP TABLE adresse');
        $this->addSql('DROP TABLE casier');
        $this->addSql('DROP TABLE client_adress');
        $this->addSql('DROP TABLE model_casier');
        $this->addSql('DROP TABLE preference');
        $this->addSql('DROP TABLE relai');
        $this->addSql('DROP TABLE type_notification');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_connexion');
        $this->addSql('DROP TABLE ville');
    }
}
