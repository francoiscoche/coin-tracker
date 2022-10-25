<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221022093530 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Suppression des champs pour les refaire avec les bons type (bigint)';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE currency DROP market_cap, DROP total_volume');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE currency ADD market_cap INT DEFAULT NULL, ADD total_volume INT DEFAULT NULL');
    }
}
