drop PROCEDURE if EXISTS stockControlConsigna;
DELIMITER $$

CREATE PROCEDURE `stockControlConsigna` (IN `stockDejado` INT, IN `idArticulo` INT, IN `idTienda` INT)  BEGIN
    -- Declarar variables para almacenar los valores actuales y nuevos
    DECLARE stock_actual INT;
    DECLARE nuevo_stock INT;
    DECLARE id_nuevo INT;
    -- Obtener el stock actual del insumo con id = id
    SELECT cantidad_piezas INTO stock_actual FROM consigna WHERE cliente_id = idTienda AND id_articulo = idArticulo LIMIT 1;
    SELECT consigna_id INTO id_nuevo FROM consigna WHERE id_articulo = idArticulo AND cliente_id = idTienda LIMIT 1;

    -- Calcular el nuevo stock restando la cantidad especificada
    SET nuevo_stock = stock_actual + stockDejado;

    -- Actualizar el stock solo para el registro con id = id
    UPDATE consigna SET cantidad_piezas = nuevo_stock WHERE consigna_id = id_nuevo;
END$$

DELIMITER ;