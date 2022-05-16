<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220516215303 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX id_ouevre_id ON episode');
        $this->addSql('ALTER TABLE favorie DROP FOREIGN KEY FK_7DE77163937CE00D');
        $this->addSql('DROP INDEX IDX_7DE77163937CE00D ON favorie');
        $this->addSql('ALTER TABLE favorie CHANGE ouevre_id episode_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE favorie ADD CONSTRAINT FK_7DE77163362B62A0 FOREIGN KEY (episode_id) REFERENCES episode (id)');
        $this->addSql('CREATE INDEX IDX_7DE77163362B62A0 ON favorie (episode_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE UNIQUE INDEX id_ouevre_id ON episode (id_ouevre_id, numero_episode)');
        $this->addSql('ALTER TABLE favorie DROP FOREIGN KEY FK_7DE77163362B62A0');
        $this->addSql('DROP INDEX IDX_7DE77163362B62A0 ON favorie');
        $this->addSql('ALTER TABLE favorie CHANGE episode_id ouevre_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE favorie ADD CONSTRAINT FK_7DE77163937CE00D FOREIGN KEY (ouevre_id) REFERENCES ouevre (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_7DE77163937CE00D ON favorie (ouevre_id)');
    }
}
