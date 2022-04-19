<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220328084749 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F0816422BA59D');
        $this->addSql('DROP INDEX idx_c35f0816422ba59d ON adresse');
        $this->addSql('CREATE INDEX IDX_C35F0816E7A1254A ON adresse (contact_id)');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F0816422BA59D FOREIGN KEY (contact_id) REFERENCES contact (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F0816E7A1254A');
        $this->addSql('DROP INDEX idx_c35f0816e7a1254a ON adresse');
        $this->addSql('CREATE INDEX IDX_C35F0816422BA59D ON adresse (contact_id)');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F0816E7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id)');
    }
}
