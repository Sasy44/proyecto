CREATE DATABASE todo_list;

Use todo_list;

CREATE TABLE `tareas` (
	`id` INT(10) NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(100) NOT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`description` TEXT NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`due_date` DATE NOT NULL,
	`completed` TINYINT(1) NULL DEFAULT '0',
	`category_id` INT(10) NULL DEFAULT NULL,
	PRIMARY KEY (`id`) USING BTREE,
	INDEX `category_id` (`category_id`) USING BTREE,
	CONSTRAINT `tareas_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categorias` (`id`) ON UPDATE NO ACTION ON DELETE SET NULL
)
COLLATE='utf8mb4_0900_ai_ci'
ENGINE=InnoDB
AUTO_INCREMENT=23
;


CREATE TABLE `categorias` (
	`id` INT(10) NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_0900_ai_ci',
	PRIMARY KEY (`id`) USING BTREE
)
COLLATE='utf8mb4_0900_ai_ci'
ENGINE=InnoDB
;
