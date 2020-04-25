<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200425141039 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE quantity (id INT AUTO_INCREMENT NOT NULL, quantity_type_id INT DEFAULT NULL, number DOUBLE PRECISION NOT NULL, INDEX IDX_9FF3163636F84596 (quantity_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recipe_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, UNIQUE INDEX UNIQ_F3C50DF65E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(50) NOT NULL, password VARCHAR(255) NOT NULL, roles JSON NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredient (id INT AUTO_INCREMENT NOT NULL, quantity_id INT DEFAULT NULL, name VARCHAR(30) NOT NULL, description VARCHAR(50) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_6BAF78705E237E06 (name), UNIQUE INDEX UNIQ_6BAF78707E8B4AFC (quantity_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quantity_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(30) NOT NULL, UNIQUE INDEX UNIQ_CBB3390B5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recipe (id INT AUTO_INCREMENT NOT NULL, recipe_type_id INT DEFAULT NULL, name VARCHAR(50) NOT NULL, preparation_time INT DEFAULT NULL, instruction LONGTEXT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_DA88B1375E237E06 (name), INDEX IDX_DA88B13789A882D3 (recipe_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recipes_ingredients (recipe_id INT NOT NULL, ingredient_id INT NOT NULL, INDEX IDX_761206B059D8A214 (recipe_id), INDEX IDX_761206B0933FE08C (ingredient_id), PRIMARY KEY(recipe_id, ingredient_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE quantity ADD CONSTRAINT FK_9FF3163636F84596 FOREIGN KEY (quantity_type_id) REFERENCES quantity_type (id)');
        $this->addSql('ALTER TABLE ingredient ADD CONSTRAINT FK_6BAF78707E8B4AFC FOREIGN KEY (quantity_id) REFERENCES quantity (id)');
        $this->addSql('ALTER TABLE recipe ADD CONSTRAINT FK_DA88B13789A882D3 FOREIGN KEY (recipe_type_id) REFERENCES recipe_type (id)');
        $this->addSql('ALTER TABLE recipes_ingredients ADD CONSTRAINT FK_761206B059D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id)');
        $this->addSql('ALTER TABLE recipes_ingredients ADD CONSTRAINT FK_761206B0933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ingredient DROP FOREIGN KEY FK_6BAF78707E8B4AFC');
        $this->addSql('ALTER TABLE recipe DROP FOREIGN KEY FK_DA88B13789A882D3');
        $this->addSql('ALTER TABLE recipes_ingredients DROP FOREIGN KEY FK_761206B0933FE08C');
        $this->addSql('ALTER TABLE quantity DROP FOREIGN KEY FK_9FF3163636F84596');
        $this->addSql('ALTER TABLE recipes_ingredients DROP FOREIGN KEY FK_761206B059D8A214');
        $this->addSql('DROP TABLE quantity');
        $this->addSql('DROP TABLE recipe_type');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('DROP TABLE quantity_type');
        $this->addSql('DROP TABLE recipe');
        $this->addSql('DROP TABLE recipes_ingredients');
    }
}
