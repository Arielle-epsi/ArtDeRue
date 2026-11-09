<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261107184754 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE artistes (id INT AUTO_INCREMENT NOT NULL, pseudonyme VARCHAR(100) NOT NULL, nom_reel VARCHAR(100) DEFAULT NULL, bio LONGTEXT DEFAULT NULL, nationalite VARCHAR(100) DEFAULT NULL, UNIQUE INDEX UNIQ_FDF1943F1FE3BDAF (pseudonyme), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE benevoles (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, prenom VARCHAR(100) NOT NULL, email VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_ABBC518E7927C74 (email), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE lieux (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, adresse VARCHAR(200) DEFAULT NULL, quartier VARCHAR(50) DEFAULT NULL, latitude NUMERIC(9, 7) DEFAULT NULL, longitude NUMERIC(9, 7) DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE oeuvres (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(50) NOT NULL, date_creation DATETIME NOT NULL, description LONGTEXT DEFAULT NULL, est_detruite TINYINT DEFAULT 0 NOT NULL, lieu_id INT NOT NULL, oeuvre_recouverte_id INT DEFAULT NULL, INDEX IDX_413EEE3E6AB213CC (lieu_id), INDEX IDX_413EEE3EEAFC6390 (oeuvre_recouverte_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE oeuvres_artistes (oeuvres_id INT NOT NULL, artistes_id INT NOT NULL, INDEX IDX_9FC0FA8A4928CE22 (oeuvres_id), INDEX IDX_9FC0FA8A96E1EAF4 (artistes_id), PRIMARY KEY (oeuvres_id, artistes_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE oeuvres_techniques (oeuvres_id INT NOT NULL, techniques_id INT NOT NULL, INDEX IDX_29BAF1064928CE22 (oeuvres_id), INDEX IDX_29BAF1063563B213 (techniques_id), PRIMARY KEY (oeuvres_id, techniques_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE photos (id INT AUTO_INCREMENT NOT NULL, date_prise_vue DATETIME NOT NULL, nom_fichier VARCHAR(255) NOT NULL, etat_oeuvre VARCHAR(500) DEFAULT NULL, oeuvre_id INT NOT NULL, benevole_id INT NOT NULL, INDEX IDX_876E0D988194DE8 (oeuvre_id), INDEX IDX_876E0D9E77B7C09 (benevole_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE techniques (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_1A0285956C6E55B5 (nom), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750 (queue_name, available_at, delivered_at, id), PRIMARY KEY (id))');
        $this->addSql('ALTER TABLE oeuvres ADD CONSTRAINT FK_413EEE3E6AB213CC FOREIGN KEY (lieu_id) REFERENCES lieux (id)');
        $this->addSql('ALTER TABLE oeuvres ADD CONSTRAINT FK_413EEE3EEAFC6390 FOREIGN KEY (oeuvre_recouverte_id) REFERENCES oeuvres (id)');
        $this->addSql('ALTER TABLE oeuvres_artistes ADD CONSTRAINT FK_9FC0FA8A4928CE22 FOREIGN KEY (oeuvres_id) REFERENCES oeuvres (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE oeuvres_artistes ADD CONSTRAINT FK_9FC0FA8A96E1EAF4 FOREIGN KEY (artistes_id) REFERENCES artistes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE oeuvres_techniques ADD CONSTRAINT FK_29BAF1064928CE22 FOREIGN KEY (oeuvres_id) REFERENCES oeuvres (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE oeuvres_techniques ADD CONSTRAINT FK_29BAF1063563B213 FOREIGN KEY (techniques_id) REFERENCES techniques (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE photos ADD CONSTRAINT FK_876E0D988194DE8 FOREIGN KEY (oeuvre_id) REFERENCES oeuvres (id)');
        $this->addSql('ALTER TABLE photos ADD CONSTRAINT FK_876E0D9E77B7C09 FOREIGN KEY (benevole_id) REFERENCES benevoles (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE oeuvres DROP FOREIGN KEY FK_413EEE3E6AB213CC');
        $this->addSql('ALTER TABLE oeuvres DROP FOREIGN KEY FK_413EEE3EEAFC6390');
        $this->addSql('ALTER TABLE oeuvres_artistes DROP FOREIGN KEY FK_9FC0FA8A4928CE22');
        $this->addSql('ALTER TABLE oeuvres_artistes DROP FOREIGN KEY FK_9FC0FA8A96E1EAF4');
        $this->addSql('ALTER TABLE oeuvres_techniques DROP FOREIGN KEY FK_29BAF1064928CE22');
        $this->addSql('ALTER TABLE oeuvres_techniques DROP FOREIGN KEY FK_29BAF1063563B213');
        $this->addSql('ALTER TABLE photos DROP FOREIGN KEY FK_876E0D988194DE8');
        $this->addSql('ALTER TABLE photos DROP FOREIGN KEY FK_876E0D9E77B7C09');
        $this->addSql('DROP TABLE artistes');
        $this->addSql('DROP TABLE benevoles');
        $this->addSql('DROP TABLE lieux');
        $this->addSql('DROP TABLE oeuvres');
        $this->addSql('DROP TABLE oeuvres_artistes');
        $this->addSql('DROP TABLE oeuvres_techniques');
        $this->addSql('DROP TABLE photos');
        $this->addSql('DROP TABLE techniques');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
