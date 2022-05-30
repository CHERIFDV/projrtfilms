<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220528153254 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE role ADD acteurs_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE role ADD CONSTRAINT FK_57698A6A71A27AFC FOREIGN KEY (acteurs_id) REFERENCES acteur (id)');
        $this->addSql('CREATE INDEX IDX_57698A6A71A27AFC ON role (acteurs_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE role DROP FOREIGN KEY FK_57698A6A71A27AFC');
        $this->addSql('DROP INDEX IDX_57698A6A71A27AFC ON role');
        $this->addSql('ALTER TABLE role DROP acteurs_id');
    }
}
