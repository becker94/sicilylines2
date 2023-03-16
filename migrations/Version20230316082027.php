<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230316082027 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie_bateau (id INT AUTO_INCREMENT NOT NULL, categorie_id INT DEFAULT NULL, bateau_id INT DEFAULT NULL, nb_max INT NOT NULL, INDEX IDX_20421A63BCF5E72D (categorie_id), INDEX IDX_20421A63A9706509 (bateau_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipement_bateau (id INT AUTO_INCREMENT NOT NULL, bateau_id INT DEFAULT NULL, equipement_id INT DEFAULT NULL, quantite INT NOT NULL, INDEX IDX_F0F14295A9706509 (bateau_id), INDEX IDX_F0F14295806F0F5C (equipement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation_type (id INT AUTO_INCREMENT NOT NULL, reservation_id INT DEFAULT NULL, type_id INT DEFAULT NULL, nombre INT NOT NULL, INDEX IDX_9AE79A41B83297E7 (reservation_id), INDEX IDX_9AE79A41C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categorie_bateau ADD CONSTRAINT FK_20421A63BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE categorie_bateau ADD CONSTRAINT FK_20421A63A9706509 FOREIGN KEY (bateau_id) REFERENCES bateau (id)');
        $this->addSql('ALTER TABLE equipement_bateau ADD CONSTRAINT FK_F0F14295A9706509 FOREIGN KEY (bateau_id) REFERENCES bateau (id)');
        $this->addSql('ALTER TABLE equipement_bateau ADD CONSTRAINT FK_F0F14295806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipement (id)');
        $this->addSql('ALTER TABLE reservation_type ADD CONSTRAINT FK_9AE79A41B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id)');
        $this->addSql('ALTER TABLE reservation_type ADD CONSTRAINT FK_9AE79A41C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('DROP TABLE participer');
        $this->addSql('DROP TABLE contenir');
        $this->addSql('DROP TABLE proposer');
        $this->addSql('ALTER TABLE liaison ADD secteur_id INT DEFAULT NULL, ADD port_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE liaison ADD CONSTRAINT FK_225AC379F7E4405 FOREIGN KEY (secteur_id) REFERENCES secteur (id)');
        $this->addSql('ALTER TABLE liaison ADD CONSTRAINT FK_225AC3776E92A9C FOREIGN KEY (port_id) REFERENCES port (id)');
        $this->addSql('CREATE INDEX IDX_225AC379F7E4405 ON liaison (secteur_id)');
        $this->addSql('CREATE INDEX IDX_225AC3776E92A9C ON liaison (port_id)');
        $this->addSql('ALTER TABLE reservation ADD client_id INT DEFAULT NULL, ADD traversee_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495519EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955ED2BB15B FOREIGN KEY (traversee_id) REFERENCES traversee (id)');
        $this->addSql('CREATE INDEX IDX_42C8495519EB6921 ON reservation (client_id)');
        $this->addSql('CREATE INDEX IDX_42C84955ED2BB15B ON reservation (traversee_id)');
        $this->addSql('ALTER TABLE tarifer ADD periode_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tarifer ADD CONSTRAINT FK_6904C4FFF384C1CF FOREIGN KEY (periode_id) REFERENCES periode (id)');
        $this->addSql('CREATE INDEX IDX_6904C4FFF384C1CF ON tarifer (periode_id)');
        $this->addSql('ALTER TABLE traversee ADD liaison_id INT DEFAULT NULL, ADD bateau_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE traversee ADD CONSTRAINT FK_B688F501ED31185 FOREIGN KEY (liaison_id) REFERENCES liaison (id)');
        $this->addSql('ALTER TABLE traversee ADD CONSTRAINT FK_B688F501A9706509 FOREIGN KEY (bateau_id) REFERENCES bateau (id)');
        $this->addSql('CREATE INDEX IDX_B688F501ED31185 ON traversee (liaison_id)');
        $this->addSql('CREATE INDEX IDX_B688F501A9706509 ON traversee (bateau_id)');
        $this->addSql('ALTER TABLE type ADD categorie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE type ADD CONSTRAINT FK_8CDE5729BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_8CDE5729BCF5E72D ON type (categorie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE participer (id INT AUTO_INCREMENT NOT NULL, nombre INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE contenir (id INT AUTO_INCREMENT NOT NULL, nb_max INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE proposer (id INT AUTO_INCREMENT NOT NULL, quantite INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE categorie_bateau DROP FOREIGN KEY FK_20421A63BCF5E72D');
        $this->addSql('ALTER TABLE categorie_bateau DROP FOREIGN KEY FK_20421A63A9706509');
        $this->addSql('ALTER TABLE equipement_bateau DROP FOREIGN KEY FK_F0F14295A9706509');
        $this->addSql('ALTER TABLE equipement_bateau DROP FOREIGN KEY FK_F0F14295806F0F5C');
        $this->addSql('ALTER TABLE reservation_type DROP FOREIGN KEY FK_9AE79A41B83297E7');
        $this->addSql('ALTER TABLE reservation_type DROP FOREIGN KEY FK_9AE79A41C54C8C93');
        $this->addSql('DROP TABLE categorie_bateau');
        $this->addSql('DROP TABLE equipement_bateau');
        $this->addSql('DROP TABLE reservation_type');
        $this->addSql('ALTER TABLE tarifer DROP FOREIGN KEY FK_6904C4FFF384C1CF');
        $this->addSql('DROP INDEX IDX_6904C4FFF384C1CF ON tarifer');
        $this->addSql('ALTER TABLE tarifer DROP periode_id');
        $this->addSql('ALTER TABLE type DROP FOREIGN KEY FK_8CDE5729BCF5E72D');
        $this->addSql('DROP INDEX IDX_8CDE5729BCF5E72D ON type');
        $this->addSql('ALTER TABLE type DROP categorie_id');
        $this->addSql('ALTER TABLE traversee DROP FOREIGN KEY FK_B688F501ED31185');
        $this->addSql('ALTER TABLE traversee DROP FOREIGN KEY FK_B688F501A9706509');
        $this->addSql('DROP INDEX IDX_B688F501ED31185 ON traversee');
        $this->addSql('DROP INDEX IDX_B688F501A9706509 ON traversee');
        $this->addSql('ALTER TABLE traversee DROP liaison_id, DROP bateau_id');
        $this->addSql('ALTER TABLE liaison DROP FOREIGN KEY FK_225AC379F7E4405');
        $this->addSql('ALTER TABLE liaison DROP FOREIGN KEY FK_225AC3776E92A9C');
        $this->addSql('DROP INDEX IDX_225AC379F7E4405 ON liaison');
        $this->addSql('DROP INDEX IDX_225AC3776E92A9C ON liaison');
        $this->addSql('ALTER TABLE liaison DROP secteur_id, DROP port_id');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C8495519EB6921');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955ED2BB15B');
        $this->addSql('DROP INDEX IDX_42C8495519EB6921 ON reservation');
        $this->addSql('DROP INDEX IDX_42C84955ED2BB15B ON reservation');
        $this->addSql('ALTER TABLE reservation DROP client_id, DROP traversee_id');
    }
}
