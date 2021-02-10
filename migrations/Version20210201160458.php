<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210201160458 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE achat DROP FOREIGN KEY FK_26A9845696A7BB5F');
        $this->addSql('ALTER TABLE produits DROP FOREIGN KEY FK_BE2DDF8CBCF5E72D');
        $this->addSql('ALTER TABLE details DROP FOREIGN KEY FK_72260B8ACD11A2CF');
        $this->addSql('ALTER TABLE ligne_achat DROP FOREIGN KEY FK_25056E66F347EFB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, categorieproduit_id INT DEFAULT NULL, nom_produit VARCHAR(255) NOT NULL, prix VARCHAR(255) NOT NULL, caracteristiques VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_29A5EC27EFF7D0E1 (categorieproduit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27EFF7D0E1 FOREIGN KEY (categorieproduit_id) REFERENCES categorie_produit (id)');
        $this->addSql('DROP TABLE acheteur');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE details');
        $this->addSql('DROP TABLE produits');
        $this->addSql('DROP INDEX IDX_26A9845696A7BB5F ON achat');
        $this->addSql('DROP INDEX IDX_26A98456ED04CB14 ON achat');
        $this->addSql('ALTER TABLE achat ADD typereglement_id INT DEFAULT NULL, ADD user_id INT DEFAULT NULL, ADD with_authentificated TINYINT(1) DEFAULT NULL, DROP acheteur_id, DROP type_reglement_id');
        $this->addSql('ALTER TABLE achat ADD CONSTRAINT FK_26A984567FE3147E FOREIGN KEY (typereglement_id) REFERENCES type_reglement (id)');
        $this->addSql('ALTER TABLE achat ADD CONSTRAINT FK_26A98456A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_26A984567FE3147E ON achat (typereglement_id)');
        $this->addSql('CREATE INDEX IDX_26A98456A76ED395 ON achat (user_id)');
        $this->addSql('ALTER TABLE ligne_achat DROP FOREIGN KEY FK_25056E66F347EFB');
        $this->addSql('ALTER TABLE ligne_achat ADD CONSTRAINT FK_25056E66F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE users ADD nom VARCHAR(255) NOT NULL, ADD prenom VARCHAR(255) NOT NULL, ADD pays VARCHAR(255) NOT NULL, ADD ville VARCHAR(255) NOT NULL, ADD adresse VARCHAR(255) NOT NULL, ADD telephone VARCHAR(255) NOT NULL, ADD first_login DATE DEFAULT NULL, DROP name, DROP email_verified');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ligne_achat DROP FOREIGN KEY FK_25056E66F347EFB');
        $this->addSql('CREATE TABLE acheteur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, prenom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, pays VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ville VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, adresse VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, telephone VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, libelle_cat VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE details (id INT AUTO_INCREMENT NOT NULL, achat_id INT DEFAULT NULL, produits_id INT DEFAULT NULL, quantite INT NOT NULL, prix_total INT NOT NULL, INDEX IDX_72260B8AFE95D117 (achat_id), INDEX IDX_72260B8ACD11A2CF (produits_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE produits (id INT AUTO_INCREMENT NOT NULL, categorie_id INT DEFAULT NULL, nom_produit VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, prix VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, caracteristiques VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, image VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_BE2DDF8CBCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE details ADD CONSTRAINT FK_72260B8ACD11A2CF FOREIGN KEY (produits_id) REFERENCES produits (id)');
        $this->addSql('ALTER TABLE details ADD CONSTRAINT FK_72260B8AFE95D117 FOREIGN KEY (achat_id) REFERENCES achat (id)');
        $this->addSql('ALTER TABLE produits ADD CONSTRAINT FK_BE2DDF8CBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categories (id)');
        $this->addSql('DROP TABLE produit');
        $this->addSql('ALTER TABLE achat DROP FOREIGN KEY FK_26A984567FE3147E');
        $this->addSql('ALTER TABLE achat DROP FOREIGN KEY FK_26A98456A76ED395');
        $this->addSql('DROP INDEX IDX_26A984567FE3147E ON achat');
        $this->addSql('DROP INDEX IDX_26A98456A76ED395 ON achat');
        $this->addSql('ALTER TABLE achat ADD acheteur_id INT DEFAULT NULL, ADD type_reglement_id INT DEFAULT NULL, DROP typereglement_id, DROP user_id, DROP with_authentificated');
        $this->addSql('ALTER TABLE achat ADD CONSTRAINT FK_26A9845696A7BB5F FOREIGN KEY (acheteur_id) REFERENCES acheteur (id)');
        $this->addSql('CREATE INDEX IDX_26A9845696A7BB5F ON achat (acheteur_id)');
        $this->addSql('CREATE INDEX IDX_26A98456ED04CB14 ON achat (type_reglement_id)');
        $this->addSql('ALTER TABLE ligne_achat DROP FOREIGN KEY FK_25056E66F347EFB');
        $this->addSql('ALTER TABLE ligne_achat ADD CONSTRAINT FK_25056E66F347EFB FOREIGN KEY (produit_id) REFERENCES produits (id)');
        $this->addSql('ALTER TABLE users ADD name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD email_verified VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP nom, DROP prenom, DROP pays, DROP ville, DROP adresse, DROP telephone, DROP first_login');
    }
}
