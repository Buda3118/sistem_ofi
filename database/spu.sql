USE almacen;
-- PROCEDIMIENTOS ALMACENADOS
-- 1. LOGIN
DELIMITER $$
CREATE PROCEDURE spu_trabajadores_login(_email VARCHAR(100))
BEGIN
	SELECT idtrabajador, nombres, apellidos, email, claveacceso, nivelacceso
		FROM trabajadores
		WHERE email = _email AND estado = '1';
END $$


-- 2. CLASIFICACIONES
DELIMITER $$
CREATE PROCEDURE spu_clasificaciones_listar()
BEGIN
	SELECT idclasificacion, clasificacion
		FROM clasificaciones
		WHERE estado = '1'
		ORDER BY clasificacion;
END $$


-- 3. MARCAS
DELIMITER $$
CREATE PROCEDURE spu_marcas_listar()
BEGIN
	SELECT idmarca, marca
		FROM marcas
		WHERE estado = '1'
		ORDER BY marca;
END $$


-- 4. LISTAR/MOSTRAR PRODUCTOS EN LA TABLA
DELIMITER $$
CREATE PROCEDURE spu_productos_listar()
BEGIN
	SELECT
		PR.idproducto,
		CL.clasificacion,
		MR.marca,
		PR.descripcion,
		PR.numeroserie,
		PR.cantidad
	FROM productos PR
		INNER JOIN clasificaciones CL ON CL.idclasificacion = PR.idclasificacion
		INNER JOIN marcas MR ON MR.idmarca = PR.idmarca
		WHERE PR.estado = 1;
END $$


-- 5. REGISTRAR PRODUCTOS
DELIMITER $$
CREATE PROCEDURE spu_productos_registrar(
	IN _idclasificacion INT,
	IN _idmarca 		INT,
	IN _descripcion 	VARCHAR(100),
	IN _numeroserie 	VARCHAR(30),
	IN _cantidad 		INT
)
BEGIN
	IF _numeroserie = NULL THEN 
		SET _numeroserie = '';
	END IF;
    
	INSERT INTO productos (idclasificacion, idmarca, descripcion, numeroserie, cantidad)
		VALUES (_idclasificacion, _idmarca, _descripcion, _numeroserie, _cantidad);
END $$


-- 6. ELIMINAR PRODUCTOS
DELIMITER $$
CREATE PROCEDURE spu_productos_eliminar(IN _idproducto INT)
BEGIN
	UPDATE productos
		SET estado = '0'
		WHERE idproducto = _idproducto;
END $$


-- 7. OBTENER PRODUCTO PARA EDITARLO
DELIMITER $$
CREATE PROCEDURE spu_productos_obtener(IN _idproducto INT)
BEGIN
	SELECT idproducto, idclasificacion, idmarca, descripcion, numeroserie, cantidad
		FROM productos
		WHERE estado = '1' AND idproducto = _idproducto;
END $$


-- 8. ACTUALIZAR PRODUCTOS
DELIMITER $$
CREATE PROCEDURE spu_productos_actualizar(
	IN _idproducto			INT,
	IN _idclasificacion 	INT,
	IN _idmarca				INT,
	IN _descripcion			VARCHAR(100),
	IN _numeroserie			VARCHAR(30),
	IN _cantidad			INT
)
BEGIN
	UPDATE productos SET 
		idclasificacion = _idclasificacion,
		idmarca 		= _idmarca,
		descripcion 	= _descripcion,
		numeroserie 	= _numeroserie,
		cantidad 		= _cantidad
	WHERE idproducto 	= _idproducto;
END $$

