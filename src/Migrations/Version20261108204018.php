<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261108204018 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE oeuvres_artistes DROP FOREIGN KEY `FK_9FC0FA8A96E1EAF4`');
        $this->addSql('ALTER TABLE oeuvres_artistes ADD CONSTRAINT FK_9FC0FA8A96E1EAF4 FOREIGN KEY (artistes_id) REFERENCES artistes (id) ON DELETE RESTRICT');
        $this->addSql('ALTER TABLE oeuvres_techniques DROP FOREIGN KEY `FK_29BAF1063563B213`');
        $this->addSql('ALTER TABLE oeuvres_techniques ADD CONSTRAINT FK_29BAF1063563B213 FOREIGN KEY (techniques_id) REFERENCES techniques (id) ON DELETE RESTRICT');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE oeuvres_artistes DROP FOREIGN KEY FK_9FC0FA8A96E1EAF4');
        $this->addSql('ALTER TABLE oeuvres_artistes ADD CONSTRAINT `FK_9FC0FA8A96E1EAF4` FOREIGN KEY (artistes_id) REFERENCES artistes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE oeuvres_techniques DROP FOREIGN KEY FK_29BAF1063563B213');
        $this->addSql('ALTER TABLE oeuvres_techniques ADD CONSTRAINT `FK_29BAF1063563B213` FOREIGN KEY (techniques_id) REFERENCES techniques (id) ON DELETE CASCADE');
    }
}
