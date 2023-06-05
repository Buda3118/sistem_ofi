-- DROP DATABASE IF EXISTS almacen;
-- A. Crear BD
CREATE DATABASE almacen;
USE almacen;


-- B. Crear Tablas
-- 1) Tabla clasificaciones
CREATE TABLE clasificaciones
(
	idclasificacion 	INT 			AUTO_INCREMENT 		PRIMARY KEY,
	clasificacion 		VARCHAR(50) 	NOT NULL,
	fechaalta 			DATETIME 		NOT NULL 			DEFAULT NOW(),
	fechabaja 			DATETIME 		NULL,
	estado 				CHAR(1) 		NOT NULL			DEFAULT '1',

	CONSTRAINT uk_clasificacion_cla UNIQUE (clasificacion)
) ENGINE = INNODB;


-- 2) Tabla marcas
CREATE TABLE marcas
(
	idmarca 	INT 			AUTO_INCREMENT 		PRIMARY KEY,
	marca 		VARCHAR(50) 	NOT NULL,
	fechaalta 	DATETIME 		NOT NULL 			DEFAULT NOW(),
	fechabaja 	DATETIME 		NULL,
	estado 		CHAR(1) 		NOT NULL 			DEFAULT '1',
	
	CONSTRAINT uk_marca_mar UNIQUE (marca)
) ENGINE = INNODB;


-- 3) Tabla trabajadores
CREATE TABLE trabajadores
(
	idtrabajador    INT 			AUTO_INCREMENT 		PRIMARY KEY,
	apellidos		VARCHAR(30)		NOT NULL,
	nombres			VARCHAR(30)		NOT NULL,
	email			VARCHAR(100)	NOT NULL,
	claveacceso		VARCHAR(90)		NOT NULL,
	nivelacceso		CHAR(3)			NOT NULL 			DEFAULT 'AST', -- ADM = Administrador, SPV = Supervisor, AST = Asistente
	fechacreacion	DATETIME 		NOT NULL 			DEFAULT NOW(),
	fechabaja		DATETIME 		NULL,
	estado			CHAR(1) 		NOT NULL			DEFAULT '1',
	
	CONSTRAINT uk_email_tra UNIQUE (email)
) ENGINE = INNODB;


-- 4) Tabla productos
CREATE TABLE productos
(
	idproducto 			INT 			AUTO_INCREMENT 		PRIMARY KEY,
	idclasificacion 	INT 			NOT NULL,
	idmarca 			INT 			NOT NULL,
	descripcion			VARCHAR(100) 	NOT NULL,
	numeroserie 		VARCHAR(30) 	NULL,
	cantidad 			INT 			NOT NULL,
	fechaalta 			DATETIME 		NOT NULL 			DEFAULT NOW(),
	fechabaja 			DATETIME 		NULL,
	estado 				CHAR(1) 		NOT NULL 			DEFAULT '1',
	
	CONSTRAINT fk_idclasificacion_pro FOREIGN KEY (idclasificacion) REFERENCES clasificaciones (idclasificacion),
	CONSTRAINT fk_idmarca_pro FOREIGN KEY (idmarca) REFERENCES marcas (idmarca)
) ENGINE = INNODB;


-- 5) Tabla movimientos
CREATE TABLE movimientos
(
	idmovimiento	INT 		AUTO_INCREMENT 		PRIMARY KEY,
	idtrabajador	INT 		NOT NULL,
	idproducto		INT 		NOT NULL,
	tipo			CHAR(1)		NOT NULL 			DEFAULT 'E',
	descripcion		TEXT		NULL,
	cantidad		INT 		NOT NULL,
	fecha			DATETIME	NOT NULL 			DEFAULT CURRENT_TIMESTAMP,
	stockactual		INT 		NOT NULL,
	
	CONSTRAINT fk_idtrabajador_mov FOREIGN KEY (idtrabajador) REFERENCES trabajadores (idtrabajador),
	CONSTRAINT fk_idproducto_mov FOREIGN KEY (idproducto) REFERENCES productos (idproducto)
) ENGINE = INNODB;


-- C. Insertar Registros
INSERT INTO clasificaciones (clasificacion) VALUES
	("Memoria RAM"),
	("Fuente de poder"),
	("Mouse"),
	("Monitor");

INSERT INTO marcas (marca) VALUES
	('Samsung'),
	('HP'),
	('Micronics');

INSERT INTO trabajadores (nombres, apellidos, email, claveacceso, nivelacceso) VALUES
	('Saavedra', 'Jose', 'jose@gmail.com', 'CLAVE_AQUI', 'ADM'),
	('Arroyo', 'Andres', 'andres@gmail.com', 'CLAVE_AQUI', 'SPV'),
	('Flores', 'Liz', 'liz@gmail.com', 'CLAVE_AQUI', 'AST');

INSERT INTO productos (idclasificacion, idmarca, descripcion, numeroserie, cantidad) VALUES
	(1, 1, '16 Gb. DDR5 5000Mhz', 'AH-520', 8),
	(2, 2, '500 Watts real', '51-YJ', 15);

INSERT INTO movimientos (idtrabajador, idproducto, descripcion, cantidad, stockactual) VALUES
	(1, 2, 'Salida de 5 Fuentes de poder', 5, 10),
	(3, 1, 'Registro de 4 Memorias RAM', 4, 12);

-- CONTRASEÑA: 123
UPDATE trabajadores
	SET claveacceso = '$2y$10$byxrMNLN.wxSz1g8kmuT9uBuqvy2DbzUSc5ffqZXw4NpF6zm67jke';

SELECT * FROM clasificaciones;
SELECT * FROM marcas;
SELECT * FROM trabajadores;
SELECT * FROM productos;
SELECT * FROM movimientos;