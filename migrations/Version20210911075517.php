<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210911075517 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE facture_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE facture (id INT NOT NULL, emmetteur_id INT NOT NULL, désignation VARCHAR(255) NOT NULL, description TEXT NOT NULL, prix_ht DOUBLE PRECISION NOT NULL, prix_ttc DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_FE8664106389A352 ON facture (emmetteur_id)');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE8664106389A352 FOREIGN KEY (emmetteur_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE facture_id_seq CASCADE');
        $this->addSql('DROP TABLE facture');
    }
}
