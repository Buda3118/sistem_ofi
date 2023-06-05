USE almacen;

-- LLAMADAS
-- 1. LOGIN
CALL spu_trabajadores_login('andres@gmail.com');

-- 2. LISTAR CLASIFICACIONES
CALL spu_clasificaciones_listar();

-- 3. LISTAR MARCAS
CALL spu_marcas_listar();

-- 4. LISTAR PRODUCTOS
CALL spu_productos_listar();

-- 5. REGISTRAR PRODUCTOS
CALL spu_productos_registrar(2, 1, 'Memoria RAM HP DDR4', '', 12);

-- 6. ELIMINAR PRODUCTOS
-- CALL spu_productos_eliminar(2);

-- 7. OBTENER PRODUCTO PARA EDITARLO
CALL spu_productos_obtener(1);

-- 8. ACTUALIZAR PRODUCTOS
CALL spu_productos_actualizar(1, 1, 1, '16 Gb. DDR5 5000Mhz', 'AH-520', 5);