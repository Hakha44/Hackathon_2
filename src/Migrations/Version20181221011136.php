<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181221011136 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE contact_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE relation (id INT AUTO_INCREMENT NOT NULL, event_id INT NOT NULL, participant_id INT NOT NULL, contact_type_id INT NOT NULL, name_contact VARCHAR(255) DEFAULT NULL, INDEX IDX_6289474971F7E88B (event_id), INDEX IDX_628947499D1C3019 (participant_id), INDEX IDX_628947495F63AD12 (contact_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE relation ADD CONSTRAINT FK_6289474971F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE relation ADD CONSTRAINT FK_628947499D1C3019 FOREIGN KEY (participant_id) REFERENCES participant (id)');
        $this->addSql('ALTER TABLE relation ADD CONSTRAINT FK_628947495F63AD12 FOREIGN KEY (contact_type_id) REFERENCES contact_type (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE relation DROP FOREIGN KEY FK_628947495F63AD12');
        $this->addSql('DROP TABLE contact_type');
        $this->addSql('DROP TABLE relation');
    }
}
