<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220528154114 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE episode_role');
        $this->addSql('ALTER TABLE role ADD episode_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE role ADD CONSTRAINT FK_57698A6A362B62A0 FOREIGN KEY (episode_id) REFERENCES episode (id)');
        $this->addSql('CREATE INDEX IDX_57698A6A362B62A0 ON role (episode_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE episode_role (episode_id INT NOT NULL, role_id INT NOT NULL, INDEX IDX_33BF164A362B62A0 (episode_id), INDEX IDX_33BF164AD60322AC (role_id), PRIMARY KEY(episode_id, role_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE episode_role ADD CONSTRAINT FK_33BF164A362B62A0 FOREIGN KEY (episode_id) REFERENCES episode (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE episode_role ADD CONSTRAINT FK_33BF164AD60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE role DROP FOREIGN KEY FK_57698A6A362B62A0');
        $this->addSql('DROP INDEX IDX_57698A6A362B62A0 ON role');
        $this->addSql('ALTER TABLE role DROP episode_id');
    }
}
