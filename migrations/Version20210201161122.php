<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210201161122 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE achat (id INT AUTO_INCREMENT NOT NULL, typereglement_id INT DEFAULT NULL, user_id INT DEFAULT NULL, prix_achat INT NOT NULL, created_at DATETIME NOT NULL, with_authentificated TINYINT(1) DEFAULT NULL, statut VARCHAR(255) NOT NULL, INDEX IDX_26A984567FE3147E (typereglement_id), INDEX IDX_26A98456A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie_produit (id INT AUTO_INCREMENT NOT NULL, libelle_cat VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commandes (id INT AUTO_INCREMENT NOT NULL, solutions_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, telephone INT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_35D4282C93DC645E (solutions_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE devis (id INT AUTO_INCREMENT NOT NULL, sujet VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, telephone INT NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ligne_achat (id INT AUTO_INCREMENT NOT NULL, achat_id INT DEFAULT NULL, produit_id INT DEFAULT NULL, quantite INT NOT NULL, prix_total INT NOT NULL, INDEX IDX_25056E66FE95D117 (achat_id), INDEX IDX_25056E66F347EFB (produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE newsletter_inscriptions (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, categorieproduit_id INT DEFAULT NULL, nom_produit VARCHAR(255) NOT NULL, prix VARCHAR(255) NOT NULL, caracteristiques VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_29A5EC27EFF7D0E1 (categorieproduit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE services (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE solutions (id INT AUTO_INCREMENT NOT NULL, type_solutions_id INT NOT NULL, libelle VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_A90F77E149FDE5B (type_solutions_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE supports (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, message VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_reglement (id INT AUTO_INCREMENT NOT NULL, type_reglement VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_solutions (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, created_at DATETIME NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, pays VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, first_login DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE achat ADD CONSTRAINT FK_26A984567FE3147E FOREIGN KEY (typereglement_id) REFERENCES type_reglement (id)');
        $this->addSql('ALTER TABLE achat ADD CONSTRAINT FK_26A98456A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT FK_35D4282C93DC645E FOREIGN KEY (solutions_id) REFERENCES solutions (id)');
        $this->addSql('ALTER TABLE ligne_achat ADD CONSTRAINT FK_25056E66FE95D117 FOREIGN KEY (achat_id) REFERENCES achat (id)');
        $this->addSql('ALTER TABLE ligne_achat ADD CONSTRAINT FK_25056E66F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27EFF7D0E1 FOREIGN KEY (categorieproduit_id) REFERENCES categorie_produit (id)');
        $this->addSql('ALTER TABLE solutions ADD CONSTRAINT FK_A90F77E149FDE5B FOREIGN KEY (type_solutions_id) REFERENCES type_solutions (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ligne_achat DROP FOREIGN KEY FK_25056E66FE95D117');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27EFF7D0E1');
        $this->addSql('ALTER TABLE ligne_achat DROP FOREIGN KEY FK_25056E66F347EFB');
        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY FK_35D4282C93DC645E');
        $this->addSql('ALTER TABLE achat DROP FOREIGN KEY FK_26A984567FE3147E');
        $this->addSql('ALTER TABLE solutions DROP FOREIGN KEY FK_A90F77E149FDE5B');
        $this->addSql('ALTER TABLE achat DROP FOREIGN KEY FK_26A98456A76ED395');
        $this->addSql('DROP TABLE achat');
        $this->addSql('DROP TABLE categorie_produit');
        $this->addSql('DROP TABLE commandes');
        $this->addSql('DROP TABLE devis');
        $this->addSql('DROP TABLE ligne_achat');
        $this->addSql('DROP TABLE newsletter_inscriptions');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE services');
        $this->addSql('DROP TABLE solutions');
        $this->addSql('DROP TABLE supports');
        $this->addSql('DROP TABLE type_reglement');
        $this->addSql('DROP TABLE type_solutions');
        $this->addSql('DROP TABLE users');
    }
}
