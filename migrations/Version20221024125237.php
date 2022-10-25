<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221024125237 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bookmark ADD id_currency_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bookmark ADD CONSTRAINT FK_DA62921D20364C81 FOREIGN KEY (id_currency_id) REFERENCES currency (id)');
        $this->addSql('CREATE INDEX IDX_DA62921D20364C81 ON bookmark (id_currency_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bookmark DROP FOREIGN KEY FK_DA62921D20364C81');
        $this->addSql('DROP INDEX IDX_DA62921D20364C81 ON bookmark');
        $this->addSql('ALTER TABLE bookmark DROP id_currency_id');
    }
}
