<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201114103212 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `character` (id INT AUTO_INCREMENT NOT NULL, tv_show_id INT NOT NULL, name VARCHAR(255) NOT NULL, picture_filename VARCHAR(255) DEFAULT NULL, INDEX IDX_937AB0345E3A35BB (tv_show_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE character_person (character_id INT NOT NULL, person_id INT NOT NULL, INDEX IDX_979E12E51136BE75 (character_id), INDEX IDX_979E12E5217BBB47 (person_id), PRIMARY KEY(character_id, person_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE episode (id INT AUTO_INCREMENT NOT NULL, season_id INT NOT NULL, number INT NOT NULL, title VARCHAR(255) DEFAULT NULL, duration VARCHAR(255) DEFAULT NULL COMMENT \'(DC2Type:dateinterval)\', INDEX IDX_DDAA1CDA4EC001D1 (season_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE person (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, birth_date DATE DEFAULT NULL, gender VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE season (id INT AUTO_INCREMENT NOT NULL, tv_show_id INT NOT NULL, number INT NOT NULL, year INT NOT NULL, INDEX IDX_F0E45BA95E3A35BB (tv_show_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tv_show (id INT AUTO_INCREMENT NOT NULL, directed_by_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, synopsis LONGTEXT DEFAULT NULL, release_date DATE DEFAULT NULL, slug VARCHAR(255) DEFAULT NULL, rating DOUBLE PRECISION DEFAULT NULL, updated_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, INDEX IDX_F1399B9DC52E0AEA (directed_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tv_show_category (tv_show_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_82897B525E3A35BB (tv_show_id), INDEX IDX_82897B5212469DE2 (category_id), PRIMARY KEY(tv_show_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB0345E3A35BB FOREIGN KEY (tv_show_id) REFERENCES tv_show (id)');
        $this->addSql('ALTER TABLE character_person ADD CONSTRAINT FK_979E12E51136BE75 FOREIGN KEY (character_id) REFERENCES `character` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE character_person ADD CONSTRAINT FK_979E12E5217BBB47 FOREIGN KEY (person_id) REFERENCES person (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE episode ADD CONSTRAINT FK_DDAA1CDA4EC001D1 FOREIGN KEY (season_id) REFERENCES season (id)');
        $this->addSql('ALTER TABLE season ADD CONSTRAINT FK_F0E45BA95E3A35BB FOREIGN KEY (tv_show_id) REFERENCES tv_show (id)');
        $this->addSql('ALTER TABLE tv_show ADD CONSTRAINT FK_F1399B9DC52E0AEA FOREIGN KEY (directed_by_id) REFERENCES person (id)');
        $this->addSql('ALTER TABLE tv_show_category ADD CONSTRAINT FK_82897B525E3A35BB FOREIGN KEY (tv_show_id) REFERENCES tv_show (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tv_show_category ADD CONSTRAINT FK_82897B5212469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tv_show_category DROP FOREIGN KEY FK_82897B5212469DE2');
        $this->addSql('ALTER TABLE character_person DROP FOREIGN KEY FK_979E12E51136BE75');
        $this->addSql('ALTER TABLE character_person DROP FOREIGN KEY FK_979E12E5217BBB47');
        $this->addSql('ALTER TABLE tv_show DROP FOREIGN KEY FK_F1399B9DC52E0AEA');
        $this->addSql('ALTER TABLE episode DROP FOREIGN KEY FK_DDAA1CDA4EC001D1');
        $this->addSql('ALTER TABLE `character` DROP FOREIGN KEY FK_937AB0345E3A35BB');
        $this->addSql('ALTER TABLE season DROP FOREIGN KEY FK_F0E45BA95E3A35BB');
        $this->addSql('ALTER TABLE tv_show_category DROP FOREIGN KEY FK_82897B525E3A35BB');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE `character`');
        $this->addSql('DROP TABLE character_person');
        $this->addSql('DROP TABLE episode');
        $this->addSql('DROP TABLE person');
        $this->addSql('DROP TABLE season');
        $this->addSql('DROP TABLE tv_show');
        $this->addSql('DROP TABLE tv_show_category');
        $this->addSql('DROP TABLE user');
    }
}
