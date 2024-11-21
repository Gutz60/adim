drop database if exists test;
CREATE DATABASE test;
USE test;

CREATE TABLE `test`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT  COMMENT '',
  `nome` VARCHAR(45) NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '');

CREATE TABLE `test`.`tags` (
  `id` INT NOT NULL AUTO_INCREMENT  COMMENT '',
  `nome` VARCHAR(45) NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '');

CREATE TABLE `test`.`user_tag` (
  `id` INT NOT NULL AUTO_INCREMENT  COMMENT '',
  `user_id` INT NOT NULL COMMENT '',
  `tag_id` INT NOT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '');

-- REFERENCIANDO DAS FOREIN KEY
ALTER TABLE `test`.`user_tag` 
ADD INDEX `fk_tag_idx` (`tag_id` ASC)  COMMENT '',
ADD INDEX `fk_user_idx` (`user_id` ASC)  COMMENT '';
ALTER TABLE `test`.`user_tag` 
ADD CONSTRAINT `fk_tag`
  FOREIGN KEY (`tag_id`)
  REFERENCES `test`.`tags` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_user`
  FOREIGN KEY (`user_id`)
  REFERENCES `test`.`users` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;


-- populando users
INSERT INTO users VALUES (1,'Joao');
INSERT INTO users VALUES (2,'Pedro');
INSERT INTO users VALUES (3,'Maria');
INSERT INTO users VALUES (4,'Ana');
-- populando tags
INSERT INTO tags VALUES (1,'SP');
INSERT INTO tags VALUES (2,'MG');
INSERT INTO tags VALUES (3,'Basquete');
INSERT INTO tags VALUES (4,'Futebol');
-- populando user_tag
INSERT INTO user_tag(user_id,tag_id) VALUES (1,1); -- > Joao  | SP
INSERT INTO user_tag(user_id,tag_id) VALUES (2,1); -- > Pedro | SP
INSERT INTO user_tag(user_id,tag_id) VALUES (3,1); -- > Maria | SP
INSERT INTO user_tag(user_id,tag_id) VALUES (4,2); -- > Ana   | MG
INSERT INTO user_tag(user_id,tag_id) VALUES (1,3); -- > Joao  | Basquete
INSERT INTO user_tag(user_id,tag_id) VALUES (1,4); -- > Joao  | Futebol
INSERT INTO user_tag(user_id,tag_id) VALUES (2,1); -- > Pedro | Basquete
INSERT INTO user_tag(user_id,tag_id) VALUES (3,2); -- > Maria | Futebol
INSERT INTO user_tag(user_id,tag_id) VALUES (4,3); -- > Ana   | Basquete
INSERT INTO user_tag(user_id,tag_id) VALUES (4,4); -- > Ana   | Futebol