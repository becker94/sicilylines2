<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230313132524 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE liaison ADD secteur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE liaison ADD CONSTRAINT FK_225AC379F7E4405 FOREIGN KEY (secteur_id) REFERENCES secteur (id)');
        $this->addSql('CREATE INDEX IDX_225AC379F7E4405 ON liaison (secteur_id)');
        $this->addSql('ALTER TABLE reservation ADD client_id INT DEFAULT NULL, ADD traversee_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495519EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955ED2BB15B FOREIGN KEY (traversee_id) REFERENCES traversee (id)');
        $this->addSql('CREATE INDEX IDX_42C8495519EB6921 ON reservation (client_id)');
        $this->addSql('CREATE INDEX IDX_42C84955ED2BB15B ON reservation (traversee_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE liaison DROP FOREIGN KEY FK_225AC379F7E4405');
        $this->addSql('DROP INDEX IDX_225AC379F7E4405 ON liaison');
        $this->addSql('ALTER TABLE liaison DROP secteur_id');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C8495519EB6921');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955ED2BB15B');
        $this->addSql('DROP INDEX IDX_42C8495519EB6921 ON reservation');
        $this->addSql('DROP INDEX IDX_42C84955ED2BB15B ON reservation');
        $this->addSql('ALTER TABLE reservation DROP client_id, DROP traversee_id');
    }
}
