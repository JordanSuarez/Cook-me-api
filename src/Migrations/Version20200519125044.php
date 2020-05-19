<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200519125044 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE recipe DROP FOREIGN KEY FK_DA88B13789A882D3');
        $this->addSql('DROP TABLE recipe_type');
        $this->addSql('ALTER TABLE quantity CHANGE number number INT NOT NULL');
        $this->addSql('DROP INDEX IDX_DA88B13789A882D3 ON recipe');
        $this->addSql('ALTER TABLE recipe DROP recipe_type_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE recipe_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX UNIQ_F3C50DF65E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE quantity CHANGE number number DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE recipe ADD recipe_type_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE recipe ADD CONSTRAINT FK_DA88B13789A882D3 FOREIGN KEY (recipe_type_id) REFERENCES recipe_type (id)');
        $this->addSql('CREATE INDEX IDX_DA88B13789A882D3 ON recipe (recipe_type_id)');
    }
}
