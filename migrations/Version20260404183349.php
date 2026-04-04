<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260404183349 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire ADD livre_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commentaire ADD utilisateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC37D925CB FOREIGN KEY (livre_id) REFERENCES livre (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES "user" (id)');
        $this->addSql('CREATE INDEX IDX_67F068BC37D925CB ON commentaire (livre_id)');
        $this->addSql('CREATE INDEX IDX_67F068BCFB88E14F ON commentaire (utilisateur_id)');
        $this->addSql('ALTER TABLE livre ADD langue_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE livre ADD auteur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE livre ADD categorie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE livre DROP auteur');
        $this->addSql('ALTER TABLE livre DROP langue');
        $this->addSql('ALTER TABLE livre ADD CONSTRAINT FK_AC634F992AADBACD FOREIGN KEY (langue_id) REFERENCES langue (id)');
        $this->addSql('ALTER TABLE livre ADD CONSTRAINT FK_AC634F9960BB6FE6 FOREIGN KEY (auteur_id) REFERENCES auteur (id)');
        $this->addSql('ALTER TABLE livre ADD CONSTRAINT FK_AC634F99BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_AC634F992AADBACD ON livre (langue_id)');
        $this->addSql('CREATE INDEX IDX_AC634F9960BB6FE6 ON livre (auteur_id)');
        $this->addSql('CREATE INDEX IDX_AC634F99BCF5E72D ON livre (categorie_id)');
        $this->addSql('ALTER TABLE reservation ADD livre_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation ADD utilisateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495537D925CB FOREIGN KEY (livre_id) REFERENCES livre (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES "user" (id)');
        $this->addSql('CREATE INDEX IDX_42C8495537D925CB ON reservation (livre_id)');
        $this->addSql('CREATE INDEX IDX_42C84955FB88E14F ON reservation (utilisateur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire DROP CONSTRAINT FK_67F068BC37D925CB');
        $this->addSql('ALTER TABLE commentaire DROP CONSTRAINT FK_67F068BCFB88E14F');
        $this->addSql('DROP INDEX IDX_67F068BC37D925CB');
        $this->addSql('DROP INDEX IDX_67F068BCFB88E14F');
        $this->addSql('ALTER TABLE commentaire DROP livre_id');
        $this->addSql('ALTER TABLE commentaire DROP utilisateur_id');
        $this->addSql('ALTER TABLE livre DROP CONSTRAINT FK_AC634F992AADBACD');
        $this->addSql('ALTER TABLE livre DROP CONSTRAINT FK_AC634F9960BB6FE6');
        $this->addSql('ALTER TABLE livre DROP CONSTRAINT FK_AC634F99BCF5E72D');
        $this->addSql('DROP INDEX IDX_AC634F992AADBACD');
        $this->addSql('DROP INDEX IDX_AC634F9960BB6FE6');
        $this->addSql('DROP INDEX IDX_AC634F99BCF5E72D');
        $this->addSql('ALTER TABLE livre ADD auteur VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE livre ADD langue VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE livre DROP langue_id');
        $this->addSql('ALTER TABLE livre DROP auteur_id');
        $this->addSql('ALTER TABLE livre DROP categorie_id');
        $this->addSql('ALTER TABLE reservation DROP CONSTRAINT FK_42C8495537D925CB');
        $this->addSql('ALTER TABLE reservation DROP CONSTRAINT FK_42C84955FB88E14F');
        $this->addSql('DROP INDEX IDX_42C8495537D925CB');
        $this->addSql('DROP INDEX IDX_42C84955FB88E14F');
        $this->addSql('ALTER TABLE reservation DROP livre_id');
        $this->addSql('ALTER TABLE reservation DROP utilisateur_id');
    }
}
