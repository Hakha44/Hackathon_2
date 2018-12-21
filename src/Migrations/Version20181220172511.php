<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181220172511 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE sondage (id INT AUTO_INCREMENT NOT NULL, formulaire_id INT NOT NULL, response LONGTEXT DEFAULT NULL, satisfaction INT DEFAULT NULL, date_envoi DATETIME DEFAULT NULL, INDEX IDX_7579C89F5053569B (formulaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sondage_event (sondage_id INT NOT NULL, event_id INT NOT NULL, INDEX IDX_C0CEA41ABAF4AE56 (sondage_id), INDEX IDX_C0CEA41A71F7E88B (event_id), PRIMARY KEY(sondage_id, event_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sondage_participant (sondage_id INT NOT NULL, participant_id INT NOT NULL, INDEX IDX_3C6B217FBAF4AE56 (sondage_id), INDEX IDX_3C6B217F9D1C3019 (participant_id), PRIMARY KEY(sondage_id, participant_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sondage ADD CONSTRAINT FK_7579C89F5053569B FOREIGN KEY (formulaire_id) REFERENCES form_builder (id)');
        $this->addSql('ALTER TABLE sondage_event ADD CONSTRAINT FK_C0CEA41ABAF4AE56 FOREIGN KEY (sondage_id) REFERENCES sondage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sondage_event ADD CONSTRAINT FK_C0CEA41A71F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sondage_participant ADD CONSTRAINT FK_3C6B217FBAF4AE56 FOREIGN KEY (sondage_id) REFERENCES sondage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sondage_participant ADD CONSTRAINT FK_3C6B217F9D1C3019 FOREIGN KEY (participant_id) REFERENCES participant (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sondage_event DROP FOREIGN KEY FK_C0CEA41ABAF4AE56');
        $this->addSql('ALTER TABLE sondage_participant DROP FOREIGN KEY FK_3C6B217FBAF4AE56');
        $this->addSql('DROP TABLE sondage');
        $this->addSql('DROP TABLE sondage_event');
        $this->addSql('DROP TABLE sondage_participant');
    }
}
