<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220228134833 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE student MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE student DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE student ADD nsc INT NOT NULL, ADD classroom_id_id INT DEFAULT NULL, DROP id');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF3313BB01DE FOREIGN KEY (classroom_id_id) REFERENCES classroom (id)');
        $this->addSql('CREATE INDEX IDX_B723AF3313BB01DE ON student (classroom_id_id)');
        $this->addSql('ALTER TABLE student ADD PRIMARY KEY (nsc)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE classroom CHANGE name name VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF3313BB01DE');
        $this->addSql('DROP INDEX IDX_B723AF3313BB01DE ON student');
        $this->addSql('ALTER TABLE student ADD id INT AUTO_INCREMENT NOT NULL, DROP nsc, DROP classroom_id_id, CHANGE email email VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
    }
}
