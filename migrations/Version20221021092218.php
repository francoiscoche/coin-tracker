<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221021092218 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bookmark ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bookmark ADD CONSTRAINT FK_DA62921DA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_DA62921DA76ED395 ON bookmark (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bookmark DROP FOREIGN KEY FK_DA62921DA76ED395');
        $this->addSql('DROP INDEX IDX_DA62921DA76ED395 ON bookmark');
        $this->addSql('ALTER TABLE bookmark DROP user_id');
    }
}
