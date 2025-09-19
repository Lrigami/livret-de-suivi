<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250919121533 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE booklet_period DROP FOREIGN KEY FK_E86A4661EC8B7ADE');
        $this->addSql('ALTER TABLE booklet_period DROP FOREIGN KEY FK_E86A4661668144B3');
        $this->addSql('ALTER TABLE booklet_period ADD id INT AUTO_INCREMENT NOT NULL, ADD content LONGTEXT DEFAULT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE booklet_period ADD CONSTRAINT FK_E86A4661EC8B7ADE FOREIGN KEY (period_id) REFERENCES period (id)');
        $this->addSql('ALTER TABLE booklet_period ADD CONSTRAINT FK_E86A4661668144B3 FOREIGN KEY (booklet_id) REFERENCES booklet (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE booklet_period MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE booklet_period DROP FOREIGN KEY FK_E86A4661668144B3');
        $this->addSql('ALTER TABLE booklet_period DROP FOREIGN KEY FK_E86A4661EC8B7ADE');
        $this->addSql('DROP INDEX `PRIMARY` ON booklet_period');
        $this->addSql('ALTER TABLE booklet_period DROP id, DROP content');
        $this->addSql('ALTER TABLE booklet_period ADD CONSTRAINT FK_E86A4661668144B3 FOREIGN KEY (booklet_id) REFERENCES booklet (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE booklet_period ADD CONSTRAINT FK_E86A4661EC8B7ADE FOREIGN KEY (period_id) REFERENCES period (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE booklet_period ADD PRIMARY KEY (booklet_id, period_id)');
    }
}
