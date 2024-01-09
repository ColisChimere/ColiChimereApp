<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240109092026 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_login DROP FOREIGN KEY FK_48CA3048FB88E14F');
        $this->addSql('DROP TABLE user_login');
        $this->addSql('ALTER TABLE client_adress DROP FOREIGN KEY FK_94A8C0DFB88E14F');
        $this->addSql('DROP INDEX IDX_94A8C0DFB88E14F ON client_adress');
        $this->addSql('ALTER TABLE client_adress CHANGE utilisateur_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE client_adress ADD CONSTRAINT FK_94A8C0DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_94A8C0DA76ED395 ON client_adress (user_id)');
        $this->addSql('ALTER TABLE preference DROP FOREIGN KEY FK_5D69B053FB88E14F');
        $this->addSql('DROP INDEX IDX_5D69B053FB88E14F ON preference');
        $this->addSql('ALTER TABLE preference CHANGE utilisateur_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE preference ADD CONSTRAINT FK_5D69B053A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_5D69B053A76ED395 ON preference (user_id)');
        $this->addSql('ALTER TABLE user ADD pseudo VARCHAR(255) NOT NULL, ADD roles JSON NOT NULL, ADD password VARCHAR(255) NOT NULL, ADD is_verified TINYINT(1) NOT NULL, CHANGE email email VARCHAR(180) NOT NULL, CHANGE num_tel num_tel VARCHAR(25) DEFAULT NULL, CHANGE type_user type_user VARCHAR(2) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D64986CC499D ON user (pseudo)');
        $this->addSql('ALTER TABLE user_connexion DROP FOREIGN KEY FK_938B7478FB88E14F');
        $this->addSql('DROP INDEX IDX_938B7478FB88E14F ON user_connexion');
        $this->addSql('ALTER TABLE user_connexion CHANGE utilisateur_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE user_connexion ADD CONSTRAINT FK_938B7478A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_938B7478A76ED395 ON user_connexion (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_login (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT NOT NULL, identifian VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, mot_de_passe VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX UNIQ_48CA3048FB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE user_login ADD CONSTRAINT FK_48CA3048FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE user_connexion DROP FOREIGN KEY FK_938B7478A76ED395');
        $this->addSql('DROP INDEX IDX_938B7478A76ED395 ON user_connexion');
        $this->addSql('ALTER TABLE user_connexion CHANGE user_id utilisateur_id INT NOT NULL');
        $this->addSql('ALTER TABLE user_connexion ADD CONSTRAINT FK_938B7478FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_938B7478FB88E14F ON user_connexion (utilisateur_id)');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74 ON user');
        $this->addSql('DROP INDEX UNIQ_8D93D64986CC499D ON user');
        $this->addSql('ALTER TABLE user DROP pseudo, DROP roles, DROP password, DROP is_verified, CHANGE email email VARCHAR(255) NOT NULL, CHANGE num_tel num_tel VARCHAR(255) DEFAULT NULL, CHANGE type_user type_user VARCHAR(1) NOT NULL');
        $this->addSql('ALTER TABLE client_adress DROP FOREIGN KEY FK_94A8C0DA76ED395');
        $this->addSql('DROP INDEX IDX_94A8C0DA76ED395 ON client_adress');
        $this->addSql('ALTER TABLE client_adress CHANGE user_id utilisateur_id INT NOT NULL');
        $this->addSql('ALTER TABLE client_adress ADD CONSTRAINT FK_94A8C0DFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_94A8C0DFB88E14F ON client_adress (utilisateur_id)');
        $this->addSql('ALTER TABLE preference DROP FOREIGN KEY FK_5D69B053A76ED395');
        $this->addSql('DROP INDEX IDX_5D69B053A76ED395 ON preference');
        $this->addSql('ALTER TABLE preference CHANGE user_id utilisateur_id INT NOT NULL');
        $this->addSql('ALTER TABLE preference ADD CONSTRAINT FK_5D69B053FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_5D69B053FB88E14F ON preference (utilisateur_id)');
    }
}
