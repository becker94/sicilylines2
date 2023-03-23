<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230316150849 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE liaison DROP FOREIGN KEY FK_225AC3776E92A9C');
        $this->addSql('DROP INDEX IDX_225AC3776E92A9C ON liaison');
        $this->addSql('ALTER TABLE liaison ADD port_arrive_id INT DEFAULT NULL, CHANGE port_id port_depart_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE liaison ADD CONSTRAINT FK_225AC3794C9CCD3 FOREIGN KEY (port_depart_id) REFERENCES port (id)');
        $this->addSql('ALTER TABLE liaison ADD CONSTRAINT FK_225AC37CEC9B4D0 FOREIGN KEY (port_arrive_id) REFERENCES port (id)');
        $this->addSql('CREATE INDEX IDX_225AC3794C9CCD3 ON liaison (port_depart_id)');
        $this->addSql('CREATE INDEX IDX_225AC37CEC9B4D0 ON liaison (port_arrive_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE liaison DROP FOREIGN KEY FK_225AC3794C9CCD3');
        $this->addSql('ALTER TABLE liaison DROP FOREIGN KEY FK_225AC37CEC9B4D0');
        $this->addSql('DROP INDEX IDX_225AC3794C9CCD3 ON liaison');
        $this->addSql('DROP INDEX IDX_225AC37CEC9B4D0 ON liaison');
        $this->addSql('ALTER TABLE liaison ADD port_id INT DEFAULT NULL, DROP port_depart_id, DROP port_arrive_id');
        $this->addSql('ALTER TABLE liaison ADD CONSTRAINT FK_225AC3776E92A9C FOREIGN KEY (port_id) REFERENCES port (id)');
        $this->addSql('CREATE INDEX IDX_225AC3776E92A9C ON liaison (port_id)');
    }
}
