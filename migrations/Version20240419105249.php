<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240419105249 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE historisation (id INT AUTO_INCREMENT NOT NULL, les_user_id INT DEFAULT NULL, nbr_user INT NOT NULL, date_historisation DATETIME NOT NULL, INDEX IDX_C74C045779AD68B6 (les_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE historisation ADD CONSTRAINT FK_C74C045779AD68B6 FOREIGN KEY (les_user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE historisation DROP FOREIGN KEY FK_C74C045779AD68B6');
        $this->addSql('DROP TABLE historisation');
    }
}
