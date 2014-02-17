DROP DATABASE IF EXISTS `alley`;
CREATE DATABASE `alley` DEFAULT CHARSET utf8;

use `alley`;

GRANT ALL
ON `alley`.*
TO `marik`@localhost IDENTIFIED BY 'marik107';

CREATE TABLE IF NOT EXISTS `images` (
   `id` INT(11) NOT NULL AUTO_INCREMENT,
   PRIMARY KEY (`id`)
);


CREATE TABLE IF NOT EXISTS `teachers` (
   `id`       INT          NOT NULL AUTO_INCREMENT,
   `name`     VARCHAR(120) NOT NULL,
   `photo_id` INT          DEFAULT NULL,
   `info`     TEXT,
   PRIMARY KEY (`id`),
   FOREIGN KEY (`photo_id`) REFERENCES `images` (`id`) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS `courses` (
   `id`          INT          NOT NULL AUTO_INCREMENT,
   `name`        VARCHAR(150) NOT NULL,
   `description` TEXT         NOT NULL,
   `teacher_id`  INT          NOT NULL,
   `photo_id`    INT          DEFAULT NULL,
   PRIMARY KEY (`id`),
   FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE,
   FOREIGN KEY (`photo_id`)   REFERENCES `images`   (`id`) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS `course_images` (
   `id`          INT NOT NULL AUTO_INCREMENT,
   `course_id`   INT NOT NULL,
   `photo_id`    INT NOT NULL,
   PRIMARY KEY (`id`),
   FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
   FOREIGN KEY (`photo_id`)  REFERENCES `images`  (`id`) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS `master_class` (
   `id`          INT          NOT NULL AUTO_INCREMENT,
   `name`        VARCHAR(150) NOT NULL,
   `description` TEXT         NOT NULL,
   `photo_id`    INT       DEFAULT NULL,
   `date_of`     TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   PRIMARY KEY (`id`),
   FOREIGN KEY (`photo_id`) REFERENCES `images` (`id`) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS `texts` (
   `id`         INT          NOT NULL AUTO_INCREMENT,
   `name`       VARCHAR(150) NOT NULL,
   `text_head`  TEXT         NOT NULL,
   `text_body`  TEXT         NOT NULL,
   `have_photo` INT          NOT NULL DEFAULT 0,
   PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `texts_images` (
   `id`       INT NOT NULL AUTO_INCREMENT,
   `text_id`  INT NOT NULL,
   `photo_id` INT DEFAULT NULL,
   PRIMARY KEY (`id`),
   FOREIGN KEY (`text_id`)  REFERENCES `texts`  (`id`),
   FOREIGN KEY (`photo_id`) REFERENCES `images` (`id`)  ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS `news` (
   `id`               INT          NOT NULL AUTO_INCREMENT,
   `text_head`        VARCHAR(150) NOT NULL,
   `text_body`        TEXT         NOT NULL,
   `publication_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   `photo_id`         INT       DEFAULT NULL,
   PRIMARY KEY (`id`),
   FOREIGN KEY (`photo_id`) REFERENCES `images` (`id`) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS `news_images` (
   `id`       INT NOT NULL AUTO_INCREMENT,
   `news_id`  INT NOT NULL,
   `photo_id` INT NOT NULL,
   PRIMARY KEY (`id`),
   FOREIGN KEY (`news_id`)  REFERENCES `news`   (`id`) ON DELETE CASCADE,
   FOREIGN KEY (`photo_id`) REFERENCES `images` (`id`) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS `admin` (
   `id`       INT         NOT NULL AUTO_INCREMENT,
   `login`    VARCHAR(50) NOT NULL,
   `pass_md5` VARCHAR(50) NOT NULL,
   PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `time` (
   `id`    INT      NOT NULL AUTO_INCREMENT,
   `start` DATETIME NOT NULL,
   `end`   DATETIME NOT NULL,
   PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `days_of_week` (
   `id`   INT         NOT NULL AUTO_INCREMENT,
   `name` VARCHAR(13) NOT NULL,
   PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `timetable` (
   `id`        INT NOT NULL AUTO_INCREMENT,
   `day_id`    INT NOT NULL,
   `time_id`   INT NOT NULL,
   `course_id` INT NOT NULL,
   PRIMARY KEY(id),
   FOREIGN KEY (`day_id`)    REFERENCES `days_of_week` (`id`) ON DELETE CASCADE,
   FOREIGN KEY (`time_id`)   REFERENCES `time` (`id`)         ON DELETE CASCADE,
   FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`)      ON DELETE CASCADE
);

DROP TRIGGER IF EXISTS `update_admin`;
DELIMITER //
CREATE TRIGGER `update_admin` BEFORE UPDATE ON `admin`
FOR EACH ROW BEGIN
   IF new.pass_md5 != old.pass_md5 THEN
      SET new.pass_md5 = MD5(new.pass_md5);
   END IF;
END//
DELIMITER ;

INSERT INTO `texts`(`name`, `text_head`, `text_body`, `have_photo`) VALUES
   ('Главная страница', 'Арт-студия Аллея приглашает всех к себе!', 'Aрт-студия "Аллея" приглашает детей помладше — в рамках занятий их познакомят с основами анимации и такими вещами, как живопись по стеклу, анимация при помощи кофе, песка или пластилина, а также научат создавать флипбуки и "живые картины". А для самых маленьких предусмотрен курс арт-терапии, где дети научатся осознавать и выражать свою уникальность, общаться со сверстниками и преодолевать страхи.', 1),
   ('Страница курсов', 'Выберите курс который подходит именно вам!', 'Aрт-студия "Аллея" приглашает детей помладше — в рамках занятий их познакомят с основами анимации и такими вещами, как живопись по стеклу, анимация при помощи кофе, песка или пластилина, а также научат создавать флипбуки и "живые картины". А для самых маленьких предусмотрен курс арт-терапии, где дети научатся осознавать и выражать свою уникальность, общаться со сверстниками и преодолевать страхи.', 1),
   ('Страница О нас 1', 'О нас 1', 'Aрт-студия "Аллея" приглашает детей помладше — в рамках занятий их познакомят с основами анимации и такими вещами, как живопись по стеклу, анимация при помощи кофе, песка или пластилина, а также научат создавать флипбуки и "живые картины". А для самых маленьких предусмотрен курс арт-терапии, где дети научатся осознавать и выражать свою уникальность, общаться со сверстниками и преодолевать страхи.', 1),
   ('Страница О нас 2', 'О нас 2', 'Aрт-студия "Аллея" приглашает детей помладше — в рамках занятий их познакомят с основами анимации и такими вещами, как живопись по стеклу, анимация при помощи кофе, песка или пластилина, а также научат создавать флипбуки и "живые картины". А для самых маленьких предусмотрен курс арт-терапии, где дети научатся осознавать и выражать свою уникальность, общаться со сверстниками и преодолевать страхи.', 0);

INSERT INTO `admin`(`login`, `pass_md5`) VALUES('admin', '21232f297a57a5a743894a0e4a801fc3');

INSERT INTO `days_of_week`(`name`) VALUES
   ('Понедельник'),
   ('Вторник'),
   ('Среда'),
   ('Четверг'),
   ('Пятница'),
   ('Суббота'),
   ('Воскресенье');

DELIMITER //

CREATE PROCEDURE `remove_old_master_classes`()
BEGIN
   DELETE FROM `master_class` WHERE `date_of` < NOW() - INTERVAL 2 HOUR;
   -- DELETE FROM `master_class` WHERE `date_of` < NOW();
END//

DELIMITER ;