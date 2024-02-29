<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240229075646 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE individu (id INT AUTO_INCREMENT NOT NULL, typeindividu_id INT NOT NULL, classe_id INT NOT NULL, numero_matricule VARCHAR(20) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, adresse VARCHAR(255) DEFAULT NULL, telephone VARCHAR(50) DEFAULT NULL, INDEX IDX_5EE42FCE36434675 (typeindividu_id), INDEX IDX_5EE42FCE8F5EA509 (classe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE individu ADD CONSTRAINT FK_5EE42FCE36434675 FOREIGN KEY (typeindividu_id) REFERENCES type_individu (id)');
        $this->addSql('ALTER TABLE individu ADD CONSTRAINT FK_5EE42FCE8F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
        $this->addSql('ALTER TABLE type_individu CHANGE code code VARCHAR(10) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE individu DROP FOREIGN KEY FK_5EE42FCE36434675');
        $this->addSql('ALTER TABLE individu DROP FOREIGN KEY FK_5EE42FCE8F5EA509');
        $this->addSql('DROP TABLE individu');
        $this->addSql('ALTER TABLE type_individu CHANGE code code VARCHAR(20) NOT NULL');
    }
}
