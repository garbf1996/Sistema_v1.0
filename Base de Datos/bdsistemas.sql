-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-02-2022 a las 18:34:28
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdsistemas`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizar_precio_producto` (IN `n_cantidad` INT, IN `n_precio` DECIMAL(10,2), IN `codigo` INT)  BEGIN
DECLARE nuevo_existencia int;
DECLARE nuevo_total decimal(10,2);
DECLARE nuevo_precio decimal(10,2);

DECLARE cant_actual decimal(10,2);
DECLARE pre_actual decimal(10,2);

DECLARE actaul_existencia int;
DECLARE actual_precio decimal(10,2);

SELECT precio,existencia INTO actual_precio,actaul_existencia FROM producto WHERE codproducto = codigo;
SET  nuevo_existencia = actaul_existencia + n_cantidad;
SET nuevo_total = ( actaul_existencia * actual_precio ) +(n_cantidad * n_precio);
SET nuevo_precio = nuevo_total / nuevo_existencia;

UPDATE producto SET existencia = nuevo_existencia, precio = nuevo_precio WHERE codproducto = codigo;

SELECT nuevo_existencia,nuevo_precio;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_detalle_temp` (IN `codigo` INT, IN `cantidad` INT, IN `token_user` VARCHAR(50))  BEGIN
DECLARE precio_actual decimal(10,2);

SELECT precio INTO precio_actual FROM producto WHERE codproducto  = codigo ;

INSERT INTO detalle (token_user,codproducto,cantidad,precio_venta) VALUES(token_user,codigo,cantidad,precio_actual);

SELECT tmp.correlativo,tmp.codproducto,p.nombre,tmp.cantidad,tmp.precio_venta FROM detalle tmp
INNER JOIN producto p 
ON tmp.codproducto = p.codproducto
WHERE tmp.token_user = token_user;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `del_detalle_temp` (IN `id_detalle` INT, IN `token` VARCHAR(50))  BEGIN



DELETE FROM detalle WHERE correlativo = id_detalle;

SELECT tmp.correlativo,tmp.codproducto,p.nombre,tmp.cantidad,tmp.precio_venta FROM detalle tmp
INNER JOIN producto p 
ON tmp.codproducto = p.codproducto
WHERE tmp.token_user = token_user;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `procesar_venta` (IN `cod_usuario` INT, IN `cod_cliente` INT, IN `token` VARCHAR(50))  BEGIN
DECLARE factura INT;

DECLARE registros INT;


DECLARE total DECIMAL(10,2);
DECLARE nueva_existencia INT;
DECLARE existencia_actual INT;

DECLARE tmp_cod_producto INT;
DECLARE tmp_cant_producto INT;
DECLARE a INT;
SET a = 1;

CREATE TEMPORARY TABLE tbl_tmp_tokenuser(
    id BIGINT NOT NULL auto_increment primary key,
    cod_prod BIGINT,
    cant_prod int);
    
    SET registros = (SELECT COUNT(*) FROM detalle WHERE token_user= token);
    
    IF registros > 0 THEN
    INSERT INTO tbl_tmp_tokenuser(cod_prod,cant_prod) SELECT codproducto,cantidad  FROM detalle WHERE token_user = token;
    
    INSERT INTO factura(usuario,codcliente) VALUES(cod_usuario,cod_cliente);
    SET factura = LAST_INSERT_ID();
    
    INSERT INTO detallefactura(nofactura,codproducto,cantidad,precio_venta) SELECT (factura) as nofactura,codproducto,cantidad,precio_venta FROM detalle WHERE token_user = token;
    
    WHILE a <= registros DO
    
    SELECT cod_prod,cant_prod INTO tmp_cod_producto, tmp_cant_producto FROM tbl_tmp_tokenuser WHERE id = a;
     SELECT existencia INTO existencia_actual FROM producto WHERE codproducto = tmp_cod_producto;
     
      SET nueva_existencia = existencia_actual - tmp_cant_producto;
          UPDATE producto SET existencia = nueva_existencia WHERE codproducto = tmp_cod_producto;
          SET a = a +1;

    END WHILE;
        
    SET total = (SELECT  SUM(cantidad * precio_venta) FROM detalle WHERE token_user = token);
     UPDATE factura SET totalfactura = total WHERE nofactura =factura;
     
    DELETE FROM detalle WHERE token_user = token;
    TRUNCATE TABLE tbl_tmp_tokenuser;
    SELECT * FROM factura WHERE nofactura = factura;
    
    
    ELSE
    SELECT 0;
    END IF;
    

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `idcliente` int(11) NOT NULL COMMENT 'Llave primaria',
  `nombre` varchar(45) NOT NULL COMMENT 'Nombre de cliente',
  `apellido` varchar(45) NOT NULL COMMENT 'Apellido de cliente',
  `documentos` varchar(45) NOT NULL COMMENT 'Documentos de cliente',
  `correo` varchar(30) NOT NULL COMMENT 'Correo de cliente',
  `dirrecion` varchar(20) NOT NULL COMMENT 'Dirección de cliente',
  `ciudad` varchar(45) NOT NULL COMMENT 'Regio de cliente',
  `movil` varchar(13) NOT NULL COMMENT 'Contactos de cliente ',
  `estatus` varchar(45) NOT NULL DEFAULT '1' COMMENT 'Estatus de cliente sin esta activo o inactivo ',
  `idusuario` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`idcliente`, `nombre`, `apellido`, `documentos`, `correo`, `dirrecion`, `ciudad`, `movil`, `estatus`, `idusuario`) VALUES
(1, 'garber', 'batista', '0', 'garbfbatista@gmail.com', 'Calle maximos Gomez ', 'Santaigo', '8294512', '1', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `id` bigint(20) NOT NULL,
  `nit` varchar(12) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `ranzon_social` varchar(20) NOT NULL,
  `telefono` bigint(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `dirrecion` text NOT NULL,
  `iva` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`id`, `nit`, `nombre`, `ranzon_social`, `telefono`, `email`, `dirrecion`, `iva`) VALUES
(1, '100221022101', 'vaper', '', 8025544, 'vape@gmail.com', 'calle maximo gomez', '18.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle`
--

CREATE TABLE `detalle` (
  `correlativo` int(11) NOT NULL COMMENT 'Lave primario',
  `token_user` varchar(50) CHARACTER SET latin1 NOT NULL COMMENT 'Lave secundario ',
  `codproducto` int(11) NOT NULL COMMENT 'Lave secundaria',
  `cantidad` int(11) NOT NULL COMMENT 'Cantidad de producto ',
  `precio_venta` decimal(10,2) NOT NULL COMMENT 'Precio de venta de producto'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallefactura`
--

CREATE TABLE `detallefactura` (
  `correlativo` bigint(11) NOT NULL,
  `nofactura` int(11) NOT NULL,
  `codproducto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_venta` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrada`
--

CREATE TABLE `entrada` (
  `correlativo` int(11) NOT NULL COMMENT 'Llave Primaria',
  `codproducto` int(11) NOT NULL COMMENT 'Llave secundaria ',
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'Fecha de entrada ',
  `precio` decimal(10,2) NOT NULL COMMENT 'Precio de compra de producto ',
  `existencia` int(11) NOT NULL COMMENT 'cuanto producto se compro ',
  `idusuario` int(11) NOT NULL DEFAULT 1 COMMENT 'Lave secundario '
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `nofactura` int(11) NOT NULL COMMENT 'Numero de factura ',
  `fecha` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'Fecha de venta ',
  `usuario` int(11) NOT NULL COMMENT 'Usuario que realizo la venta',
  `codcliente` int(11) NOT NULL COMMENT 'Al cliente que estamos vendiendo el producto   ',
  `totalfactura` decimal(10,2) NOT NULL COMMENT 'Sub total de comprar ',
  `estatus` int(11) NOT NULL DEFAULT 1 COMMENT 'Estatus sin esta nulo '
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `codproducto` int(11) NOT NULL COMMENT 'Llave primaria',
  `nombre` varchar(50) NOT NULL COMMENT 'Nombre de producto ',
  `modelos` varchar(30) NOT NULL COMMENT 'Modelo de producto ',
  `ser_no` varchar(50) NOT NULL COMMENT 'Sierra de producto ',
  `categoria` varchar(30) NOT NULL COMMENT 'Categoría de producto ',
  `proveedor` int(11) NOT NULL COMMENT 'Llave secundaria ',
  `precio` decimal(10,2) NOT NULL COMMENT 'Precio de compra ',
  `existencia` varchar(11) NOT NULL COMMENT 'Existencia de producto ',
  `foto` text NOT NULL COMMENT 'Imagen de producto',
  `date_add` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Fecha de compra ',
  `estatus` int(11) NOT NULL DEFAULT 1 COMMENT 'Estatus si esta activo o inactivo ',
  `idusuario` int(11) NOT NULL COMMENT 'Llave secundaria '
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Disparadores `producto`
--
DELIMITER $$
CREATE TRIGGER `entrada_A_I` AFTER INSERT ON `producto` FOR EACH ROW BEGIN
    INSERT INTO entrada(codproducto,precio,existencia,idusuario)
    VALUES(new.codproducto,new.precio,new.existencia,new.idusuario);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `idproveedor` int(11) NOT NULL COMMENT 'Llave primaria ',
  `proveedor` varchar(45) NOT NULL COMMENT 'Proveedor ',
  `sector_comercial` varchar(45) NOT NULL COMMENT 'Tipos de comerciales ',
  `documentos` varchar(45) DEFAULT NULL COMMENT 'Documentos de proveedor ',
  `correo` varchar(45) NOT NULL COMMENT 'Correo de proveedor ',
  `URL` varchar(45) NOT NULL COMMENT 'Sitio wed de proveedor ',
  `dirrecion` varchar(45) NOT NULL COMMENT 'Dirección de proveedor ',
  `ciudad` varchar(45) NOT NULL COMMENT 'provincia donde el proveedor esta ubicado ',
  `telefono` varchar(13) NOT NULL COMMENT 'Contactos de proveedor',
  `estatus` varchar(1) NOT NULL DEFAULT '1' COMMENT 'Si el proveedor esta activo o inactivo ',
  `fecha` datetime NOT NULL COMMENT 'Fecha de registro ',
  `idusuario` int(11) NOT NULL COMMENT 'Usuario que se encargo de registra el proveedor '
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idrol` int(11) NOT NULL COMMENT 'Llave primaria ',
  `rol` varchar(45) NOT NULL COMMENT 'Tipo de usuario, Administrador, Almacén y Vendedor '
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idrol`, `rol`) VALUES
(1, 'Administrador'),
(2, 'Auxiliar de ventas'),
(3, 'Almacenes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL COMMENT 'Llave primaria ',
  `nombre` varchar(45) DEFAULT NULL COMMENT 'Nombre de empleado ',
  `usuario` varchar(45) NOT NULL COMMENT 'Usuario de empleado',
  `clave` varchar(45) NOT NULL COMMENT 'Contraseña de usuario ',
  `correo` varchar(45) DEFAULT NULL COMMENT 'correo de empleado ',
  `estatus` varchar(1) NOT NULL DEFAULT '1' COMMENT 'Si el usuario esta activo o inactivo ',
  `idrol` int(11) NOT NULL COMMENT 'Tipos de usuario '
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nombre`, `usuario`, `clave`, `correo`, `estatus`, `idrol`) VALUES
(1, 'Garber', 'Bgarber', '123', 'gabfbatista@gmail.com', '1', 1),
(2, 'juan', 'Pjuan', '123', 'sz@gmail.com', '1', 2),
(3, 'gaber', 'garfb', '123', 'jh@gmail.com', '0', 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idcliente`),
  ADD KEY `idusuario_idx` (`idusuario`);

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle`
--
ALTER TABLE `detalle`
  ADD PRIMARY KEY (`correlativo`),
  ADD KEY `toke_user` (`token_user`),
  ADD KEY `codproducto` (`codproducto`);

--
-- Indices de la tabla `detallefactura`
--
ALTER TABLE `detallefactura`
  ADD PRIMARY KEY (`correlativo`),
  ADD KEY `nofactura` (`nofactura`),
  ADD KEY `codproducto` (`codproducto`);

--
-- Indices de la tabla `entrada`
--
ALTER TABLE `entrada`
  ADD PRIMARY KEY (`correlativo`),
  ADD KEY `codproducto` (`codproducto`),
  ADD KEY `id_usuario` (`idusuario`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`nofactura`),
  ADD KEY `usuario` (`usuario`),
  ADD KEY `codcliennte` (`codcliente`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`codproducto`),
  ADD KEY `proveedor` (`proveedor`),
  ADD KEY `id_usuario` (`idusuario`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`idproveedor`),
  ADD KEY `fk_proveedor_usuario1_idx` (`idusuario`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idrol`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD KEY `idrol_idx` (`idrol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idcliente` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave primaria', AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detalle`
--
ALTER TABLE `detalle`
  MODIFY `correlativo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Lave primario', AUTO_INCREMENT=441;

--
-- AUTO_INCREMENT de la tabla `detallefactura`
--
ALTER TABLE `detallefactura`
  MODIFY `correlativo` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT de la tabla `entrada`
--
ALTER TABLE `entrada`
  MODIFY `correlativo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave Primaria', AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `nofactura` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Numero de factura ', AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `codproducto` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave primaria', AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `idproveedor` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave primaria ', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idrol` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave primaria ', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave primaria ', AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `idusuario` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle`
--
ALTER TABLE `detalle`
  ADD CONSTRAINT `detalle_ibfk_1` FOREIGN KEY (`codproducto`) REFERENCES `producto` (`codproducto`);

--
-- Filtros para la tabla `detallefactura`
--
ALTER TABLE `detallefactura`
  ADD CONSTRAINT `detallefactura_ibfk_1` FOREIGN KEY (`codproducto`) REFERENCES `producto` (`codproducto`),
  ADD CONSTRAINT `detallefactura_ibfk_2` FOREIGN KEY (`nofactura`) REFERENCES `factura` (`nofactura`);

--
-- Filtros para la tabla `entrada`
--
ALTER TABLE `entrada`
  ADD CONSTRAINT `entrada_ibfk_1` FOREIGN KEY (`codproducto`) REFERENCES `producto` (`codproducto`);

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`idusuario`),
  ADD CONSTRAINT `factura_ibfk_2` FOREIGN KEY (`codcliente`) REFERENCES `cliente` (`idcliente`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`proveedor`) REFERENCES `proveedor` (`idproveedor`),
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD CONSTRAINT `fk_proveedor_usuario1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `idrol` FOREIGN KEY (`idrol`) REFERENCES `rol` (`idrol`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
