<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241002133032 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories_media (categories_id INT NOT NULL, media_id INT NOT NULL, INDEX IDX_6E2FB441A21214B7 (categories_id), INDEX IDX_6E2FB441EA9FDD75 (media_id), PRIMARY KEY(categories_id, media_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comments (id INT AUTO_INCREMENT NOT NULL, owner_id INT DEFAULT NULL, media_id INT DEFAULT NULL, content LONGTEXT DEFAULT NULL, status LONGTEXT NOT NULL COMMENT \'(DC2Type:simple_array)\', INDEX IDX_5F9E962A7E3C61F9 (owner_id), INDEX IDX_5F9E962AEA9FDD75 (media_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE episodes (id INT AUTO_INCREMENT NOT NULL, season_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, duration TIME DEFAULT NULL, release_date DATE DEFAULT NULL, INDEX IDX_7DD55EDD4EC001D1 (season_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE languages (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE languages_media (languages_id INT NOT NULL, media_id INT NOT NULL, INDEX IDX_F41A271E5D237A9A (languages_id), INDEX IDX_F41A271EEA9FDD75 (media_id), PRIMARY KEY(languages_id, media_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media (id INT AUTO_INCREMENT NOT NULL, media_type LONGTEXT NOT NULL COMMENT \'(DC2Type:simple_array)\', title VARCHAR(255) NOT NULL, short_description LONGTEXT DEFAULT NULL, long_description LONGTEXT DEFAULT NULL, release_date DATE DEFAULT NULL, cover_image VARCHAR(255) NOT NULL, staff JSON DEFAULT NULL COMMENT \'(DC2Type:json)\', casting JSON DEFAULT NULL COMMENT \'(DC2Type:json)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE movie (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE playlist_media (id INT AUTO_INCREMENT NOT NULL, added_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE playlist_subscriptions (id INT AUTO_INCREMENT NOT NULL, owner_id INT NOT NULL, playlist_id INT NOT NULL, subscribed_at DATETIME DEFAULT NULL, INDEX IDX_12B0B1B47E3C61F9 (owner_id), INDEX IDX_12B0B1B46BBD148 (playlist_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE playlists (id INT AUTO_INCREMENT NOT NULL, owner_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_5E06116F7E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE seasons (id INT AUTO_INCREMENT NOT NULL, serie_id INT DEFAULT NULL, seasons_number INT DEFAULT NULL, INDEX IDX_B4F4301CD94388BD (serie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE serie (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subscription_history (id INT AUTO_INCREMENT NOT NULL, owner_id INT NOT NULL, subscription_id INT NOT NULL, start_date DATE DEFAULT NULL, end_date DATE DEFAULT NULL, INDEX IDX_54AF90D07E3C61F9 (owner_id), INDEX IDX_54AF90D09A1887DC (subscription_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subscriptions (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, price NUMERIC(10, 2) NOT NULL, duration_in_month INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, current_subscription_id INT DEFAULT NULL, username VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, accountstatus VARCHAR(255) NOT NULL, INDEX IDX_8D93D649DDE45DDE (current_subscription_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE watch_history (id INT AUTO_INCREMENT NOT NULL, owner_id INT DEFAULT NULL, media_id INT DEFAULT NULL, last_watched DATETIME DEFAULT NULL, number_of_views INT DEFAULT NULL, INDEX IDX_DE44EFD87E3C61F9 (owner_id), INDEX IDX_DE44EFD8EA9FDD75 (media_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categories_media ADD CONSTRAINT FK_6E2FB441A21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categories_media ADD CONSTRAINT FK_6E2FB441EA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A7E3C61F9 FOREIGN KEY (owner_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962AEA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id)');
        $this->addSql('ALTER TABLE episodes ADD CONSTRAINT FK_7DD55EDD4EC001D1 FOREIGN KEY (season_id) REFERENCES seasons (id)');
        $this->addSql('ALTER TABLE languages_media ADD CONSTRAINT FK_F41A271E5D237A9A FOREIGN KEY (languages_id) REFERENCES languages (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE languages_media ADD CONSTRAINT FK_F41A271EEA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE playlist_subscriptions ADD CONSTRAINT FK_12B0B1B47E3C61F9 FOREIGN KEY (owner_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE playlist_subscriptions ADD CONSTRAINT FK_12B0B1B46BBD148 FOREIGN KEY (playlist_id) REFERENCES playlists (id)');
        $this->addSql('ALTER TABLE playlists ADD CONSTRAINT FK_5E06116F7E3C61F9 FOREIGN KEY (owner_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE seasons ADD CONSTRAINT FK_B4F4301CD94388BD FOREIGN KEY (serie_id) REFERENCES serie (id)');
        $this->addSql('ALTER TABLE subscription_history ADD CONSTRAINT FK_54AF90D07E3C61F9 FOREIGN KEY (owner_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE subscription_history ADD CONSTRAINT FK_54AF90D09A1887DC FOREIGN KEY (subscription_id) REFERENCES subscriptions (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D649DDE45DDE FOREIGN KEY (current_subscription_id) REFERENCES subscriptions (id)');
        $this->addSql('ALTER TABLE watch_history ADD CONSTRAINT FK_DE44EFD87E3C61F9 FOREIGN KEY (owner_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE watch_history ADD CONSTRAINT FK_DE44EFD8EA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categories_media DROP FOREIGN KEY FK_6E2FB441A21214B7');
        $this->addSql('ALTER TABLE categories_media DROP FOREIGN KEY FK_6E2FB441EA9FDD75');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A7E3C61F9');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962AEA9FDD75');
        $this->addSql('ALTER TABLE episodes DROP FOREIGN KEY FK_7DD55EDD4EC001D1');
        $this->addSql('ALTER TABLE languages_media DROP FOREIGN KEY FK_F41A271E5D237A9A');
        $this->addSql('ALTER TABLE languages_media DROP FOREIGN KEY FK_F41A271EEA9FDD75');
        $this->addSql('ALTER TABLE playlist_subscriptions DROP FOREIGN KEY FK_12B0B1B47E3C61F9');
        $this->addSql('ALTER TABLE playlist_subscriptions DROP FOREIGN KEY FK_12B0B1B46BBD148');
        $this->addSql('ALTER TABLE playlists DROP FOREIGN KEY FK_5E06116F7E3C61F9');
        $this->addSql('ALTER TABLE seasons DROP FOREIGN KEY FK_B4F4301CD94388BD');
        $this->addSql('ALTER TABLE subscription_history DROP FOREIGN KEY FK_54AF90D07E3C61F9');
        $this->addSql('ALTER TABLE subscription_history DROP FOREIGN KEY FK_54AF90D09A1887DC');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649DDE45DDE');
        $this->addSql('ALTER TABLE watch_history DROP FOREIGN KEY FK_DE44EFD87E3C61F9');
        $this->addSql('ALTER TABLE watch_history DROP FOREIGN KEY FK_DE44EFD8EA9FDD75');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE categories_media');
        $this->addSql('DROP TABLE comments');
        $this->addSql('DROP TABLE episodes');
        $this->addSql('DROP TABLE languages');
        $this->addSql('DROP TABLE languages_media');
        $this->addSql('DROP TABLE media');
        $this->addSql('DROP TABLE movie');
        $this->addSql('DROP TABLE playlist_media');
        $this->addSql('DROP TABLE playlist_subscriptions');
        $this->addSql('DROP TABLE playlists');
        $this->addSql('DROP TABLE seasons');
        $this->addSql('DROP TABLE serie');
        $this->addSql('DROP TABLE subscription_history');
        $this->addSql('DROP TABLE subscriptions');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE watch_history');
    }
}
