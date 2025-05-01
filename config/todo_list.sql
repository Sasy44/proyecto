CREATE DATABASE todo_list;

USE todo_list;

CREATE TABLE `categorias` (
	`id` INT(10) NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_0900_ai_ci',
	PRIMARY KEY (`id`) USING BTREE
);

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
);

-- Insertar las dos categorías
INSERT INTO categorias (name) VALUES ('Trabajo'), ('Personal');

-- Insertar las dos tareas
INSERT INTO tareas (title, description, due_date, completed, category_id) 
VALUES 
    ('Terminar informe', 'Completar el informe mensual para la reunión', '2025-05-10', 0, 1),
    ('Comprar víveres', 'Ir al supermercado para la semana', '2025-05-03', 0, 2);