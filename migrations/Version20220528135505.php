<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220528135505 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE role_acteur (role_id INT NOT NULL, acteur_id INT NOT NULL, INDEX IDX_41DC32D3D60322AC (role_id), INDEX IDX_41DC32D3DA6F574A (acteur_id), PRIMARY KEY(role_id, acteur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE role_acteur ADD CONSTRAINT FK_41DC32D3D60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE role_acteur ADD CONSTRAINT FK_41DC32D3DA6F574A FOREIGN KEY (acteur_id) REFERENCES acteur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE acteur DROP FOREIGN KEY FK_EAFAD362D60322AC');
        $this->addSql('DROP INDEX IDX_EAFAD362D60322AC ON acteur');
        $this->addSql('ALTER TABLE acteur DROP role_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE role_acteur');
        $this->addSql('ALTER TABLE acteur ADD role_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE acteur ADD CONSTRAINT FK_EAFAD362D60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_EAFAD362D60322AC ON acteur (role_id)');
    }
}
