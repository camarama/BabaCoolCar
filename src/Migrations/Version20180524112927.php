<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180524112927 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE membre ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE modele CHANGE marque_id marque_id INT NOT NULL');
        $this->addSql('ALTER TABLE vehicule CHANGE marque_id marque_id INT NOT NULL, CHANGE membre_id membre_id INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE membre DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE modele CHANGE marque_id marque_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vehicule CHANGE membre_id membre_id INT DEFAULT NULL, CHANGE marque_id marque_id INT DEFAULT NULL');
    }
}
