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
   `id`    INT          NOT NULL AUTO_INCREMENT,
   `name`  VARCHAR(150) NOT NULL,
   `info`  TEXT,
   PRIMARY KEY(`id`)
);

CREATE TABLE IF NOT EXISTS `courses` (
   `id`          INT          NOT NULL AUTO_INCREMENT,
   `name`        VARCHAR(150) NOT NULL,
   `description` TEXT         NOT NULL,
   `teacher_id`  INT          NOT NULL,
   `photo_id`    INT          NOT NULL,
   PRIMARY KEY(`id`),
   FOREIGN KEY (`photo_id`)   REFERENCES `images` (`id`)   ON DELETE CASCADE,
   FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS `master_class` (
   `id`          INT          NOT NULL AUTO_INCREMENT,
   `name`        VARCHAR(150) NOT NULL,
   `description` TEXT         NOT NULL,
   `photo_id`    INT          NOT NULL,
   `date_of`     TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   PRIMARY KEY(`id`),
   FOREIGN KEY (`photo_id`)   REFERENCES `images` (`id`) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS `texts` (
   `id`        INT          NOT NULL AUTO_INCREMENT,
   `name`      VARCHAR(150) NOT NULL,
   `text_head` TEXT         NOT NULL,
   `text_body` TEXT         NOT NULL,
   PRIMARY KEY(`id`)
);

CREATE TABLE IF NOT EXISTS `news` (
   `id`               INT          NOT NULL AUTO_INCREMENT,
   `text_head`        VARCHAR(150) NOT NULL,
   `text_body`        TEXT         NOT NULL,
   `publication_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   PRIMARY KEY(`id`)
);

INSERT INTO `texts`(`name`, `text_head`, `text_body`) VALUES
   ('Главная страница', 'Арт-студия Аллея приглашает всех к себе!', 'Aрт-студия "Аллея" приглашает детей помладше — в рамках занятий их познакомят с основами анимации и такими вещами, как живопись по стеклу, анимация при помощи кофе, песка или пластилина, а также научат создавать флипбуки и "живые картины". А для самых маленьких предусмотрен курс арт-терапии, где дети научатся осознавать и выражать свою уникальность, общаться со сверстниками и преодолевать страхи.'),
   ('Страница регистрации', 'УПС', 'Для участия в конкурсе сфотографируйте свои работы либо сделайте скан-копии рисунков. Заполните поля регистрационной формы. Не забудьте указать телефон родителей или учителя, чтобы организаторы конкурса могли связаться с вашими представителями. Получите собственный аккаунт. Это ваша страничка в конкурсе, где вы можете выложить фотографии своих работ. Не стоит ждать, что жюри примет решение на следующий день. Жюри будет работать до 18 апреля 2014 года. До этого срока под фотографией своей работой вы увидите принята она к следующему этапу конкурса или отклонена. Официально результаты будут объявлены 24 мая 2014 года.');

DELIMITER $$

CREATE PROCEDURE `remove_old_master_classes`()
BEGIN
   DELETE FROM `master_class` WHERE `date_of` < NOW() - INTERVAL 1 DAY;
   -- DELETE FROM `master_class` WHERE `date_of` < NOW();
END$$

DELIMITER ;