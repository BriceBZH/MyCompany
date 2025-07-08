<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250701141109 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE invoice (id INT AUTO_INCREMENT NOT NULL, client_id_id INT NOT NULL, quote_id_id INT DEFAULT NULL, date_created DATE NOT NULL, due_date DATE NOT NULL, status VARCHAR(255) NOT NULL, total_ht DOUBLE PRECISION NOT NULL, total_ttc DOUBLE PRECISION NOT NULL, total_tva DOUBLE PRECISION NOT NULL, INDEX IDX_90651744DC2902E0 (client_id_id), UNIQUE INDEX UNIQ_9065174472BB1336 (quote_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invoice_item (id INT AUTO_INCREMENT NOT NULL, invoice_id_id INT NOT NULL, description VARCHAR(255) NOT NULL, quantity DOUBLE PRECISION NOT NULL, unit_price DOUBLE PRECISION NOT NULL, tax_rate DOUBLE PRECISION NOT NULL, INDEX IDX_1DDE477B429ECEE2 (invoice_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment (id INT AUTO_INCREMENT NOT NULL, invoice_id_id INT NOT NULL, payment_method_id INT NOT NULL, amount DOUBLE PRECISION NOT NULL, date DATE NOT NULL, note VARCHAR(255) NOT NULL, INDEX IDX_6D28840D429ECEE2 (invoice_id_id), INDEX IDX_6D28840D5AA1164F (payment_method_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment_method (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quote (id INT AUTO_INCREMENT NOT NULL, client_id_id INT NOT NULL, date_created DATE NOT NULL, date_valid DATE NOT NULL, status VARCHAR(255) NOT NULL, total_ht DOUBLE PRECISION DEFAULT NULL, total_ttc DOUBLE PRECISION DEFAULT NULL, total_tva DOUBLE PRECISION DEFAULT NULL, INDEX IDX_6B71CBF4DC2902E0 (client_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quote_item (id INT AUTO_INCREMENT NOT NULL, quote_id_id INT NOT NULL, description VARCHAR(255) NOT NULL, quantity DOUBLE PRECISION NOT NULL, unit_price DOUBLE PRECISION NOT NULL, tax_rate DOUBLE PRECISION NOT NULL, INDEX IDX_8DFC7A9472BB1336 (quote_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE invoice ADD CONSTRAINT FK_90651744DC2902E0 FOREIGN KEY (client_id_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE invoice ADD CONSTRAINT FK_9065174472BB1336 FOREIGN KEY (quote_id_id) REFERENCES quote (id)');
        $this->addSql('ALTER TABLE invoice_item ADD CONSTRAINT FK_1DDE477B429ECEE2 FOREIGN KEY (invoice_id_id) REFERENCES invoice (id)');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840D429ECEE2 FOREIGN KEY (invoice_id_id) REFERENCES invoice (id)');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840D5AA1164F FOREIGN KEY (payment_method_id) REFERENCES payment_method (id)');
        $this->addSql('ALTER TABLE quote ADD CONSTRAINT FK_6B71CBF4DC2902E0 FOREIGN KEY (client_id_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE quote_item ADD CONSTRAINT FK_8DFC7A9472BB1336 FOREIGN KEY (quote_id_id) REFERENCES quote (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE invoice DROP FOREIGN KEY FK_90651744DC2902E0');
        $this->addSql('ALTER TABLE invoice DROP FOREIGN KEY FK_9065174472BB1336');
        $this->addSql('ALTER TABLE invoice_item DROP FOREIGN KEY FK_1DDE477B429ECEE2');
        $this->addSql('ALTER TABLE payment DROP FOREIGN KEY FK_6D28840D429ECEE2');
        $this->addSql('ALTER TABLE payment DROP FOREIGN KEY FK_6D28840D5AA1164F');
        $this->addSql('ALTER TABLE quote DROP FOREIGN KEY FK_6B71CBF4DC2902E0');
        $this->addSql('ALTER TABLE quote_item DROP FOREIGN KEY FK_8DFC7A9472BB1336');
        $this->addSql('DROP TABLE invoice');
        $this->addSql('DROP TABLE invoice_item');
        $this->addSql('DROP TABLE payment');
        $this->addSql('DROP TABLE payment_method');
        $this->addSql('DROP TABLE quote');
        $this->addSql('DROP TABLE quote_item');
    }
}
