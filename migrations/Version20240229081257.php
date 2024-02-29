<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240229081257 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ligne_evaluation (id INT AUTO_INCREMENT NOT NULL, evaluation_id INT NOT NULL, individu_id INT NOT NULL, note NUMERIC(10, 2) NOT NULL, appreciation LONGTEXT DEFAULT NULL, INDEX IDX_F08F4B68456C5646 (evaluation_id), INDEX IDX_F08F4B68480B6028 (individu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ligne_evaluation ADD CONSTRAINT FK_F08F4B68456C5646 FOREIGN KEY (evaluation_id) REFERENCES evaluation (id)');
        $this->addSql('ALTER TABLE ligne_evaluation ADD CONSTRAINT FK_F08F4B68480B6028 FOREIGN KEY (individu_id) REFERENCES individu (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ligne_evaluation DROP FOREIGN KEY FK_F08F4B68456C5646');
        $this->addSql('ALTER TABLE ligne_evaluation DROP FOREIGN KEY FK_F08F4B68480B6028');
        $this->addSql('DROP TABLE ligne_evaluation');
    }
}
