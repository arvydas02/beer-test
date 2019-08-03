<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190803160306 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE geo_code (geo_code__id INT UNSIGNED AUTO_INCREMENT NOT NULL, brewery_id INT NOT NULL, latitude NUMERIC(12, 8) NOT NULL, longitude NUMERIC(12, 8) NOT NULL, accuracy VARCHAR(30) NOT NULL, INDEX brewery_idx (brewery_id), PRIMARY KEY(geo_code__id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE style (style_id INT UNSIGNED AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, name VARCHAR(255) NOT NULL, last_modified DATETIME NOT NULL, INDEX category_idx (category_id), PRIMARY KEY(style_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE brewery (brewery_id INT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, address1 VARCHAR(255) NOT NULL, address2 VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, PRIMARY KEY(brewery_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE beer (beer_id INT UNSIGNED AUTO_INCREMENT NOT NULL, brewery_id INT NOT NULL, name VARCHAR(255) NOT NULL, category_id INT NOT NULL, style_id INT NOT NULL, abv NUMERIC(12, 8) NOT NULL, ibu NUMERIC(12, 8) NOT NULL, srm NUMERIC(12, 8) NOT NULL, upc INT NOT NULL, filepath VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, add_user INT NOT NULL, last_modified DATETIME NOT NULL, INDEX brewery_idx (brewery_id), INDEX category_idx (category_id), INDEX style_idx (style_id), PRIMARY KEY(beer_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (category_id INT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, last_modified DATETIME NOT NULL, PRIMARY KEY(category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE geo_code');
        $this->addSql('DROP TABLE style');
        $this->addSql('DROP TABLE brewery');
        $this->addSql('DROP TABLE beer');
        $this->addSql('DROP TABLE category');
    }
}
