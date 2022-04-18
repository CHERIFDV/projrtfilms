<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220416133927 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE abonnement (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(25) NOT NULL, price INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', deleted_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE acteur (id INT AUTO_INCREMENT NOT NULL, role_id INT DEFAULT NULL, nom VARCHAR(25) NOT NULL, prenom VARCHAR(25) NOT NULL, email VARCHAR(25) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', deleted_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_EAFAD362D60322AC (role_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE avis (id INT AUTO_INCREMENT NOT NULL, episode_id INT DEFAULT NULL, user_id INT DEFAULT NULL, nb_etoil INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', deleted_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_8F91ABF0362B62A0 (episode_id), INDEX IDX_8F91ABF0A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, categorie VARCHAR(25) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', deleted_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commenter (id INT AUTO_INCREMENT NOT NULL, episode_id INT DEFAULT NULL, user_id INT DEFAULT NULL, message VARCHAR(255) NOT NULL, nb_like INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', deleted_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_AB751D0A362B62A0 (episode_id), INDEX IDX_AB751D0AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE episode (id INT AUTO_INCREMENT NOT NULL, id_ouevre_id INT DEFAULT NULL, pay_id INT DEFAULT NULL, titre VARCHAR(25) NOT NULL, duree TIME NOT NULL, resume VARCHAR(255) NOT NULL, realise VARCHAR(25) NOT NULL, url VARCHAR(255) NOT NULL, nb_view INT NOT NULL, langue VARCHAR(25) NOT NULL, numero_episode INT NOT NULL, image LONGTEXT NOT NULL, nb_commenter INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', deleted_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_DDAA1CDA13495C2A (id_ouevre_id), INDEX IDX_DDAA1CDA918501AB (pay_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE episode_categorie (episode_id INT NOT NULL, categorie_id INT NOT NULL, INDEX IDX_F7BF400D362B62A0 (episode_id), INDEX IDX_F7BF400DBCF5E72D (categorie_id), PRIMARY KEY(episode_id, categorie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE favorie (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, ouevre_id INT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', deleted_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7DE77163A76ED395 (user_id), INDEX IDX_7DE77163937CE00D (ouevre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE like_commenter (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, commenter_id INT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', deleted_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_83D59168A76ED395 (user_id), INDEX IDX_83D59168B4D5A9E2 (commenter_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE like_repondre (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, repondre_id INT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', deleted_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_545B56CCA76ED395 (user_id), INDEX IDX_545B56CC5D693660 (repondre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ouevre (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(25) NOT NULL, nb_parite INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', deleted_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pay (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(25) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', deleted_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rapport (id INT AUTO_INCREMENT NOT NULL, id_episode_id INT DEFAULT NULL, id_user_id INT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', deleted_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_BE34A09C93A1E277 (id_episode_id), INDEX IDX_BE34A09C79F37AE5 (id_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE repondre (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, commenter_id INT DEFAULT NULL, message VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', deleted_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_F66FAAF4A76ED395 (user_id), INDEX IDX_F66FAAF4B4D5A9E2 (commenter_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, nom_de_role VARCHAR(25) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', deleted_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, abonnement_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(25) NOT NULL, prenom VARCHAR(25) NOT NULL, image VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', deleted_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D649F1D74413 (abonnement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE acteur ADD CONSTRAINT FK_EAFAD362D60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF0362B62A0 FOREIGN KEY (episode_id) REFERENCES episode (id)');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF0A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE commenter ADD CONSTRAINT FK_AB751D0A362B62A0 FOREIGN KEY (episode_id) REFERENCES episode (id)');
        $this->addSql('ALTER TABLE commenter ADD CONSTRAINT FK_AB751D0AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE episode ADD CONSTRAINT FK_DDAA1CDA13495C2A FOREIGN KEY (id_ouevre_id) REFERENCES ouevre (id)');
        $this->addSql('ALTER TABLE episode ADD CONSTRAINT FK_DDAA1CDA918501AB FOREIGN KEY (pay_id) REFERENCES pay (id)');
        $this->addSql('ALTER TABLE episode_categorie ADD CONSTRAINT FK_F7BF400D362B62A0 FOREIGN KEY (episode_id) REFERENCES episode (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE episode_categorie ADD CONSTRAINT FK_F7BF400DBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE favorie ADD CONSTRAINT FK_7DE77163A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE favorie ADD CONSTRAINT FK_7DE77163937CE00D FOREIGN KEY (ouevre_id) REFERENCES ouevre (id)');
        $this->addSql('ALTER TABLE like_commenter ADD CONSTRAINT FK_83D59168A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE like_commenter ADD CONSTRAINT FK_83D59168B4D5A9E2 FOREIGN KEY (commenter_id) REFERENCES commenter (id)');
        $this->addSql('ALTER TABLE like_repondre ADD CONSTRAINT FK_545B56CCA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE like_repondre ADD CONSTRAINT FK_545B56CC5D693660 FOREIGN KEY (repondre_id) REFERENCES rapport (id)');
        $this->addSql('ALTER TABLE rapport ADD CONSTRAINT FK_BE34A09C93A1E277 FOREIGN KEY (id_episode_id) REFERENCES episode (id)');
        $this->addSql('ALTER TABLE rapport ADD CONSTRAINT FK_BE34A09C79F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE repondre ADD CONSTRAINT FK_F66FAAF4A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE repondre ADD CONSTRAINT FK_F66FAAF4B4D5A9E2 FOREIGN KEY (commenter_id) REFERENCES commenter (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649F1D74413 FOREIGN KEY (abonnement_id) REFERENCES abonnement (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649F1D74413');
        $this->addSql('ALTER TABLE episode_categorie DROP FOREIGN KEY FK_F7BF400DBCF5E72D');
        $this->addSql('ALTER TABLE like_commenter DROP FOREIGN KEY FK_83D59168B4D5A9E2');
        $this->addSql('ALTER TABLE repondre DROP FOREIGN KEY FK_F66FAAF4B4D5A9E2');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF0362B62A0');
        $this->addSql('ALTER TABLE commenter DROP FOREIGN KEY FK_AB751D0A362B62A0');
        $this->addSql('ALTER TABLE episode_categorie DROP FOREIGN KEY FK_F7BF400D362B62A0');
        $this->addSql('ALTER TABLE rapport DROP FOREIGN KEY FK_BE34A09C93A1E277');
        $this->addSql('ALTER TABLE episode DROP FOREIGN KEY FK_DDAA1CDA13495C2A');
        $this->addSql('ALTER TABLE favorie DROP FOREIGN KEY FK_7DE77163937CE00D');
        $this->addSql('ALTER TABLE episode DROP FOREIGN KEY FK_DDAA1CDA918501AB');
        $this->addSql('ALTER TABLE like_repondre DROP FOREIGN KEY FK_545B56CC5D693660');
        $this->addSql('ALTER TABLE acteur DROP FOREIGN KEY FK_EAFAD362D60322AC');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF0A76ED395');
        $this->addSql('ALTER TABLE commenter DROP FOREIGN KEY FK_AB751D0AA76ED395');
        $this->addSql('ALTER TABLE favorie DROP FOREIGN KEY FK_7DE77163A76ED395');
        $this->addSql('ALTER TABLE like_commenter DROP FOREIGN KEY FK_83D59168A76ED395');
        $this->addSql('ALTER TABLE like_repondre DROP FOREIGN KEY FK_545B56CCA76ED395');
        $this->addSql('ALTER TABLE rapport DROP FOREIGN KEY FK_BE34A09C79F37AE5');
        $this->addSql('ALTER TABLE repondre DROP FOREIGN KEY FK_F66FAAF4A76ED395');
        $this->addSql('DROP TABLE abonnement');
        $this->addSql('DROP TABLE acteur');
        $this->addSql('DROP TABLE avis');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE commenter');
        $this->addSql('DROP TABLE episode');
        $this->addSql('DROP TABLE episode_categorie');
        $this->addSql('DROP TABLE favorie');
        $this->addSql('DROP TABLE like_commenter');
        $this->addSql('DROP TABLE like_repondre');
        $this->addSql('DROP TABLE ouevre');
        $this->addSql('DROP TABLE pay');
        $this->addSql('DROP TABLE rapport');
        $this->addSql('DROP TABLE repondre');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
