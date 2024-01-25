SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP DATABASE IF EXISTS `bookstore`;
CREATE DATABASE `bookstore` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `bookstore`;

DROP TABLE IF EXISTS `authors`;
CREATE TABLE `authors`
(
    `id`   int(11) unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(255)     NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

INSERT INTO `authors` (`id`, `name`)
VALUES (1, 'Jane Austen'),
       (2, 'George Orwell'),
       (3, 'Agatha Christie'),
       (4, 'J.K. Rowling'),
       (5, 'Ernest Hemingway'),
       (6, 'C.S. Lewis'),
       (7, 'J.R.R. Tolkien'),
       (8, 'Leo Tolstoy'),
       (9, 'Dan Brown'),
       (10, 'Hilary Mantel'),
       (11, 'Douglas Adams'),
       (12, 'Haruki Murakami'),
       (13, 'Gabriel García Márquez'),
       (14, ' Philip K. Dick'),
       (15, 'Ursula K. Le Guin')
ON DUPLICATE KEY UPDATE `id`   = VALUES(`id`),
                        `name` = VALUES(`name`);

DROP TABLE IF EXISTS `books`;
CREATE TABLE `books`
(
    `id`             int(11) unsigned NOT NULL AUTO_INCREMENT,
    `title`          varchar(255)     NOT NULL,
    `published_year` int(11)          DEFAULT NULL,
    `genre_id`       int(11) unsigned DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `genre_id` (`genre_id`),
    CONSTRAINT `books_ibfk_1` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`id`) ON DELETE SET NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

INSERT INTO `books` (`id`, `title`, `published_year`, `genre_id`)
VALUES (1, 'Pride and Prejudice', 1813, 1),
       (2, '1984', 1949, 2),
       (3, 'Murder on the Orient Express', 1934, 3),
       (4, 'Harry Potter and the Sorcerer\'s Stone', 1997, 6),
       (5, 'The Old Man and the Sea', 1952, 1),
       (14, 'The Lion, the Witch and the Wardrobe', 1950, 6),
       (16, 'The Da Vinci Code', 2003, 8),
       (17, 'Wolf Hall', 2009, 9),
       (18, 'The Hitchhiker\'s Guide to the Galaxy', 1979, 4),
       (19, 'Inferno', 2013, 8),
       (21, 'Sense and Sensibility', 1811, 1),
       (22, 'Surreal Dreams', 1979, 10),
       (23, 'Parallel Realms', 1972, 4)
ON DUPLICATE KEY UPDATE `id`             = VALUES(`id`),
                        `title`          = VALUES(`title`),
                        `published_year` = VALUES(`published_year`),
                        `genre_id`       = VALUES(`genre_id`);

DROP TABLE IF EXISTS `books_authors`;
CREATE TABLE `books_authors`
(
    `book_id`   int(11) unsigned DEFAULT NULL,
    `author_id` int(11) unsigned DEFAULT NULL,
    KEY `book_id` (`book_id`),
    KEY `author_id` (`author_id`),
    CONSTRAINT `books_authors_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
    CONSTRAINT `books_authors_ibfk_2` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`) ON DELETE CASCADE
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

INSERT INTO `books_authors` (`book_id`, `author_id`)
VALUES (1, 1),
       (2, 2),
       (3, 3),
       (16, 9),
       (17, 10),
       (19, 9),
       (21, 1),
       (18, 11),
       (18, 11),
       (5, 5),
       (4, 4),
       (14, 6),
       (22, 13),
       (22, 12),
       (23, 14),
       (23, 15)
ON DUPLICATE KEY UPDATE `book_id`   = VALUES(`book_id`),
                        `author_id` = VALUES(`author_id`);

DROP TABLE IF EXISTS `books_genres`;
CREATE TABLE `books_genres`
(
    `book_id`  int(11) unsigned DEFAULT NULL,
    `genre_id` int(11) unsigned DEFAULT NULL,
    KEY `book_id` (`book_id`),
    KEY `genre_id` (`genre_id`),
    CONSTRAINT `books_genres_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
    CONSTRAINT `books_genres_ibfk_3` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`id`) ON DELETE CASCADE
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

INSERT INTO `books_genres` (`book_id`, `genre_id`)
VALUES (1, 1),
       (2, 2),
       (3, 3),
       (16, 8),
       (17, 9),
       (14, 6),
       (14, 1),
       (22, 11),
       (23, 12),
       (23, 4),
       (23, 11)
ON DUPLICATE KEY UPDATE `book_id`  = VALUES(`book_id`),
                        `genre_id` = VALUES(`genre_id`);

DROP TABLE IF EXISTS `genres`;
CREATE TABLE `genres`
(
    `id`   int(11) unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(255)     NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

INSERT INTO `genres` (`id`, `name`)
VALUES (1, 'Fiction'),
       (2, 'Non-Fiction'),
       (3, 'Mystery'),
       (4, 'Science Fiction'),
       (5, 'Romance'),
       (6, 'Fantasy'),
       (7, 'Historical Fiction'),
       (8, 'Thriller'),
       (9, 'Biography'),
       (10, 'Magical Realism'),
       (11, 'Surreal Fiction'),
       (12, 'Alternate History')
ON DUPLICATE KEY UPDATE `id`   = VALUES(`id`),
                        `name` = VALUES(`name`);

-- 2024-01-25 21:29:15
