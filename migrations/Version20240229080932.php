<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240229080932 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE evaluation (id INT AUTO_INCREMENT NOT NULL, trimestre_id INT NOT NULL, individu_id INT DEFAULT NULL, matiere_id INT NOT NULL, college_id INT NOT NULL, numero VARCHAR(20) NOT NULL, date_evaluation DATE NOT NULL, INDEX IDX_1323A575B9DB5D9D (trimestre_id), INDEX IDX_1323A575480B6028 (individu_id), INDEX IDX_1323A575F46CD258 (matiere_id), INDEX IDX_1323A575770124B2 (college_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE evaluation ADD CONSTRAINT FK_1323A575B9DB5D9D FOREIGN KEY (trimestre_id) REFERENCES trimestre (id)');
        $this->addSql('ALTER TABLE evaluation ADD CONSTRAINT FK_1323A575480B6028 FOREIGN KEY (individu_id) REFERENCES individu (id)');
        $this->addSql('ALTER TABLE evaluation ADD CONSTRAINT FK_1323A575F46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id)');
        $this->addSql('ALTER TABLE evaluation ADD CONSTRAINT FK_1323A575770124B2 FOREIGN KEY (college_id) REFERENCES college (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evaluation DROP FOREIGN KEY FK_1323A575B9DB5D9D');
        $this->addSql('ALTER TABLE evaluation DROP FOREIGN KEY FK_1323A575480B6028');
        $this->addSql('ALTER TABLE evaluation DROP FOREIGN KEY FK_1323A575F46CD258');
        $this->addSql('ALTER TABLE evaluation DROP FOREIGN KEY FK_1323A575770124B2');
        $this->addSql('DROP TABLE evaluation');
    }
}
