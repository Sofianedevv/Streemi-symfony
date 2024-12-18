<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241218093441 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category_media (category_id INT NOT NULL, media_id INT NOT NULL, INDEX IDX_821FEE4512469DE2 (category_id), INDEX IDX_821FEE45EA9FDD75 (media_id), PRIMARY KEY(category_id, media_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE upload (id INT AUTO_INCREMENT NOT NULL, uploaded_by_id INT NOT NULL, uploaded_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', url VARCHAR(255) NOT NULL, INDEX IDX_17BDE61FA2B28FE8 (uploaded_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category_media ADD CONSTRAINT FK_821FEE4512469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_media ADD CONSTRAINT FK_821FEE45EA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE upload ADD CONSTRAINT FK_17BDE61FA2B28FE8 FOREIGN KEY (uploaded_by_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE media_category DROP FOREIGN KEY FK_92D377312469DE2');
        $this->addSql('ALTER TABLE media_category DROP FOREIGN KEY FK_92D3773EA9FDD75');
        $this->addSql('DROP TABLE media_category');
        $this->addSql('ALTER TABLE category CHANGE nom name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE episode CHANGE season_id season_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE language CHANGE nom name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE media ADD score DOUBLE PRECISION NOT NULL, ADD type VARCHAR(255) NOT NULL, CHANGE release_date release_date DATE NOT NULL');
        $this->addSql('ALTER TABLE playlist DROP FOREIGN KEY FK_D782112D61220EA6');
        $this->addSql('DROP INDEX IDX_D782112D61220EA6 ON playlist');
        $this->addSql('ALTER TABLE playlist CHANGE creator_id author_id INT NOT NULL');
        $this->addSql('ALTER TABLE playlist ADD CONSTRAINT FK_D782112DF675F31B FOREIGN KEY (author_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_D782112DF675F31B ON playlist (author_id)');
        $this->addSql('ALTER TABLE season DROP FOREIGN KEY FK_F0E45BA9D94388BD');
        $this->addSql('DROP INDEX IDX_F0E45BA9D94388BD ON season');
        $this->addSql('ALTER TABLE season CHANGE serie_id series_id INT NOT NULL');
        $this->addSql('ALTER TABLE season ADD CONSTRAINT FK_F0E45BA95278319C FOREIGN KEY (series_id) REFERENCES serie (id)');
        $this->addSql('CREATE INDEX IDX_F0E45BA95278319C ON season (series_id)');
        $this->addSql('ALTER TABLE user ADD roles JSON NOT NULL, ADD reset_token VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE media_category (media_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_92D377312469DE2 (category_id), INDEX IDX_92D3773EA9FDD75 (media_id), PRIMARY KEY(media_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE media_category ADD CONSTRAINT FK_92D377312469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE media_category ADD CONSTRAINT FK_92D3773EA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_media DROP FOREIGN KEY FK_821FEE4512469DE2');
        $this->addSql('ALTER TABLE category_media DROP FOREIGN KEY FK_821FEE45EA9FDD75');
        $this->addSql('ALTER TABLE upload DROP FOREIGN KEY FK_17BDE61FA2B28FE8');
        $this->addSql('DROP TABLE category_media');
        $this->addSql('DROP TABLE upload');
        $this->addSql('ALTER TABLE category CHANGE name nom VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE playlist DROP FOREIGN KEY FK_D782112DF675F31B');
        $this->addSql('DROP INDEX IDX_D782112DF675F31B ON playlist');
        $this->addSql('ALTER TABLE playlist CHANGE author_id creator_id INT NOT NULL');
        $this->addSql('ALTER TABLE playlist ADD CONSTRAINT FK_D782112D61220EA6 FOREIGN KEY (creator_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_D782112D61220EA6 ON playlist (creator_id)');
        $this->addSql('ALTER TABLE episode CHANGE season_id season_id INT NOT NULL');
        $this->addSql('ALTER TABLE season DROP FOREIGN KEY FK_F0E45BA95278319C');
        $this->addSql('DROP INDEX IDX_F0E45BA95278319C ON season');
        $this->addSql('ALTER TABLE season CHANGE series_id serie_id INT NOT NULL');
        $this->addSql('ALTER TABLE season ADD CONSTRAINT FK_F0E45BA9D94388BD FOREIGN KEY (serie_id) REFERENCES serie (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_F0E45BA9D94388BD ON season (serie_id)');
        $this->addSql('ALTER TABLE language CHANGE name nom VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE media DROP score, DROP type, CHANGE release_date release_date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE `user` DROP roles, DROP reset_token');
    }
}
