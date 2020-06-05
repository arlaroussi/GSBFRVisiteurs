<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191130074919 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE frais_forfait (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(30) NOT NULL, montant NUMERIC(5, 2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etat (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ligne_frais_hors_forfait (id INT AUTO_INCREMENT NOT NULL, visiteur_id INT NOT NULL, mois_id INT NOT NULL, libelle VARCHAR(30) NOT NULL, date DATE NOT NULL, montant NUMERIC(10, 2) NOT NULL, UNIQUE INDEX UNIQ_EC01626D7F72333D (visiteur_id), UNIQUE INDEX UNIQ_EC01626DFA0749B8 (mois_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fiche_frais (id INT AUTO_INCREMENT NOT NULL, visiteur_id INT NOT NULL, etat_id INT NOT NULL, mois VARCHAR(10) NOT NULL, nb_justificatifs INT NOT NULL, montant_valide NUMERIC(10, 2) NOT NULL, date_modif DATE NOT NULL, INDEX IDX_5FC0A6A77F72333D (visiteur_id), INDEX IDX_5FC0A6A7D5E86FF (etat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ligne_frais_forfait (id INT AUTO_INCREMENT NOT NULL, visiteur_id INT NOT NULL, frais_forfait_id INT NOT NULL, mois VARCHAR(30) NOT NULL, quantite INT NOT NULL, INDEX IDX_BD293ECF7F72333D (visiteur_id), UNIQUE INDEX UNIQ_BD293ECF7B70375E (frais_forfait_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE visiteur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(30) NOT NULL, prenom VARCHAR(30) NOT NULL, login VARCHAR(30) NOT NULL, mdp VARCHAR(30) NOT NULL, adresse VARCHAR(30) NOT NULL, cp VARCHAR(5) NOT NULL, ville VARCHAR(30) NOT NULL, date_embauche DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ligne_frais_hors_forfait ADD CONSTRAINT FK_EC01626D7F72333D FOREIGN KEY (visiteur_id) REFERENCES fiche_frais (id)');
        $this->addSql('ALTER TABLE ligne_frais_hors_forfait ADD CONSTRAINT FK_EC01626DFA0749B8 FOREIGN KEY (mois_id) REFERENCES fiche_frais (id)');
        $this->addSql('ALTER TABLE fiche_frais ADD CONSTRAINT FK_5FC0A6A77F72333D FOREIGN KEY (visiteur_id) REFERENCES visiteur (id)');
        $this->addSql('ALTER TABLE fiche_frais ADD CONSTRAINT FK_5FC0A6A7D5E86FF FOREIGN KEY (etat_id) REFERENCES etat (id)');
        $this->addSql('ALTER TABLE ligne_frais_forfait ADD CONSTRAINT FK_BD293ECF7F72333D FOREIGN KEY (visiteur_id) REFERENCES visiteur (id)');
        $this->addSql('ALTER TABLE ligne_frais_forfait ADD CONSTRAINT FK_BD293ECF7B70375E FOREIGN KEY (frais_forfait_id) REFERENCES frais_forfait (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ligne_frais_forfait DROP FOREIGN KEY FK_BD293ECF7B70375E');
        $this->addSql('ALTER TABLE fiche_frais DROP FOREIGN KEY FK_5FC0A6A7D5E86FF');
        $this->addSql('ALTER TABLE ligne_frais_hors_forfait DROP FOREIGN KEY FK_EC01626D7F72333D');
        $this->addSql('ALTER TABLE ligne_frais_hors_forfait DROP FOREIGN KEY FK_EC01626DFA0749B8');
        $this->addSql('ALTER TABLE fiche_frais DROP FOREIGN KEY FK_5FC0A6A77F72333D');
        $this->addSql('ALTER TABLE ligne_frais_forfait DROP FOREIGN KEY FK_BD293ECF7F72333D');
        $this->addSql('DROP TABLE frais_forfait');
        $this->addSql('DROP TABLE etat');
        $this->addSql('DROP TABLE ligne_frais_hors_forfait');
        $this->addSql('DROP TABLE fiche_frais');
        $this->addSql('DROP TABLE ligne_frais_forfait');
        $this->addSql('DROP TABLE visiteur');
    }
}
