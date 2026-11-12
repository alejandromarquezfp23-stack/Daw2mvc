-- Volcado completo de daw2mvc: esquema y datos actuales.
-- Incluye todas las tablas y sus filas; al importarlo, reemplaza las tablas existentes.
-- Importar con: mysql -u root -p < sql/init.sql

CREATE DATABASE IF NOT EXISTS `daw2mvc` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `daw2mvc`;
SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `pedido_detalle_ingrediente`;
DROP TABLE IF EXISTS `pedido_detalle`;
DROP TABLE IF EXISTS `pedidos`;
DROP TABLE IF EXISTS `favoritos`;
DROP TABLE IF EXISTS `usuarios`;
DROP TABLE IF EXISTS `producto_ingrediente`;
DROP TABLE IF EXISTS `oferta_producto`;
DROP TABLE IF EXISTS `productos`;
DROP TABLE IF EXISTS `ofertas`;
DROP TABLE IF EXISTS `ingredientes`;
DROP TABLE IF EXISTS `categorias`;
DROP TABLE IF EXISTS `camisetas`;

CREATE TABLE `camisetas` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `talla` enum('XXL','XL','L','M','S') COLLATE utf8mb4_unicode_ci NOT NULL,
  `precio` decimal(8,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `camisetas` (`nombre`, `talla`, `precio`) VALUES
  ('Camiseta básica negra', 'M', 19.99),
  ('Camiseta técnica running', 'L', 29.50),
  ('Camiseta oversize', 'XL', 24.00);

CREATE TABLE `categorias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci,
  `activa` tinyint(1) NOT NULL DEFAULT '1',
  `imagenes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `categorias` (`id`, `nombre`, `descripcion`, `activa`, `imagenes`) VALUES
  ('1', 'Entrantes', 'Pequeños comienzos elaborados con producto fresco y de temporada.', '1', 'imagenes/categorias/entrantes.webp'),
  ('2', 'Platos principales', 'Platos principales de cocina mediterránea con ingredientes seleccionados.', '1', 'imagenes/categorias/platos-principales.webp'),
  ('3', 'Postres', 'Postres artesanales para terminar la experiencia.', '1', 'imagenes/categorias/postres.webp'),
  ('4', 'Bebidas', 'Bebidas refrescantes, cafés y una selección para acompañar la carta.', '1', 'imagenes/categorias/bebidas.webp'),
  ('6', 'Menús especiales', 'Menús completos pensados para disfrutar de una experiencia gastronómica.', '1', 'imagenes/categorias/menus-especiales.webp');

CREATE TABLE `ingredientes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imagen` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `precio_extra` decimal(10,2) NOT NULL DEFAULT '0.00',
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `ingredientes` (`id`, `nombre`, `imagen`, `precio_extra`, `activo`) VALUES
  ('3', 'Albahaca fresca', 'imagenes/ingredientes/albahaca-fresca.webp', '0.50', '1'),
  ('5', 'Parmesano', 'imagenes/ingredientes/parmesano.webp', '1.50', '1'),
  ('6', 'Rúcula', 'imagenes/ingredientes/rucula.webp', '0.50', '1'),
  ('8', 'Aguacate', 'imagenes/ingredientes/aguacate.webp', '1.50', '1'),
  ('9', 'Sésamo', 'imagenes/ingredientes/sesamo.webp', '0.50', '1'),
  ('10', 'Gambas', 'imagenes/ingredientes/gambas.webp', '3.50', '1'),
  ('11', 'Ajo', 'imagenes/ingredientes/ajo.webp', '0.00', '1'),
  ('12', 'Boletus', 'imagenes/ingredientes/boletus.webp', '2.50', '1'),
  ('13', 'Trufa', 'imagenes/ingredientes/trufa.webp', '4.00', '1'),
  ('15', 'Coliflor', 'imagenes/ingredientes/coliflor.webp', '0.00', '1'),
  ('29', 'Queso curado', 'imagenes/ingredientes/queso-curado.webp', '1.50', '1'),
  ('31', 'Chocolate negro', 'imagenes/ingredientes/chocolate-negro.webp', '1.50', '1'),
  ('34', 'Vainilla', 'imagenes/ingredientes/vainilla.webp', '0.50', '1'),
  ('36', 'Limón', 'imagenes/ingredientes/limon.webp', '0.50', '1'),
  ('39', 'Jamón ibérico', 'imagenes/ingredientes/jamon-iberico.webp', '3.00', '1'),
  ('41', 'Pimentón', 'imagenes/ingredientes/pimenton.webp', '0.00', '1'),
  ('43', 'Aceitunas', 'imagenes/ingredientes/aceitunas.webp', '0.50', '1'),
  ('44', 'Piparras', 'imagenes/ingredientes/piparras.webp', '0.50', '1'),
  ('45', 'Huevo', 'imagenes/ingredientes/huevo.webp', '0.50', '1'),
  ('46', 'Cebolla', 'imagenes/ingredientes/cebolla.webp', '0.50', '1'),
  ('47', 'Tomate cherry', 'imagenes/ingredientes/tomate-cherry.webp', '0.50', '1'),
  ('48', 'Pan brioche', 'imagenes/ingredientes/pan-brioche.webp', '0.50', '1'),
  ('49', 'Mejillones', 'imagenes/ingredientes/mejillones.webp', '2.00', '1'),
  ('50', 'Calamar', 'imagenes/ingredientes/calamar.webp', '2.50', '1'),
  ('51', 'Atún rojo', 'imagenes/ingredientes/atun-rojo.webp', '3.50', '1'),
  ('52', 'Burrata', 'imagenes/ingredientes/burrata.webp', '2.50', '1'),
  ('53', 'Café', 'imagenes/ingredientes/cafe.webp', '1.00', '1'),
  ('54', 'Helado', 'imagenes/ingredientes/helado.webp', '1.50', '1'),
  ('55', 'Hierbabuena', 'imagenes/ingredientes/hierbabuena.webp', '0.50', '1'),
  ('56', 'Leche', 'imagenes/ingredientes/leche.webp', '0.50', '1'),
  ('57', 'Mascarpone', 'imagenes/ingredientes/mascarpone.webp', '1.50', '1'),
  ('58', 'Pulpo', 'imagenes/ingredientes/pulpo.webp', '3.50', '1'),
  ('59', 'Quesos variados', 'imagenes/ingredientes/quesos-variados.webp', '2.00', '1'),
  ('60', 'Solomillo', 'imagenes/ingredientes/solomillo.webp', '3.50', '1'),
  ('61', 'Vieiras', 'imagenes/ingredientes/vieiras.webp', '3.50', '1');

CREATE TABLE `ofertas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci,
  `tipo` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Valores: descuento, 2x1, combo, codigo',
  `valor` decimal(10,2) DEFAULT NULL,
  `codigo` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_fin` datetime DEFAULT NULL,
  `activa` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo` (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `ofertas` (`id`, `nombre`, `descripcion`, `tipo`, `valor`, `codigo`, `fecha_inicio`, `fecha_fin`, `activa`) VALUES
  ('1', 'Bienvenida Appletito', 'Descuento de bienvenida para nuevos clientes.', 'descuento', '10.00', 'BIENVENIDA10', '2026-11-01 11:58:50', '2027-11-01 11:58:50', '1'),
  ('2', 'Noche para dos', 'Menú especial para compartir en pareja.', 'combo', '2.00', 'NOCHE2', '2026-11-01 11:58:50', '2027-11-01 11:58:50', '1'),
  ('3', 'Dulce final', 'Descuento en una selección de postres.', 'descuento', '15.00', 'DULCE15', '2026-11-01 11:58:50', '2027-11-01 11:58:50', '1');

CREATE TABLE `productos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `categoria_id` int NOT NULL,
  `nombre` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci,
  `precio` decimal(10,2) NOT NULL,
  `imagen` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `categoria_id` (`categoria_id`),
  CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `productos` (`id`, `categoria_id`, `nombre`, `descripcion`, `precio`, `imagen`, `activo`) VALUES
  ('1', '1', 'Burrata con tomate confitado', 'Burrata cremosa sobre tomate cherry confitado, albahaca fresca y aceite de oliva virgen extra.', '16.50', 'imagenes/productos/burrata-con-tomate-confitado.webp', '1'),
  ('2', '1', 'Carpaccio de solomillo', 'Láminas finas de solomillo con parmesano, rúcula, alcaparras y vinagreta cítrica.', '19.50', 'imagenes/productos/carpaccio-de-solomillo.webp', '1'),
  ('3', '1', 'Tartar de atún rojo', 'Atún rojo cortado a cuchillo con aguacate, sésamo tostado y aliño suave de soja.', '21.00', 'imagenes/productos/tartar-de-atun-rojo.webp', '1'),
  ('4', '1', 'Gambas al ajillo', 'Gambas salteadas con ajo, guindilla suave y aceite de oliva virgen extra.', '18.00', 'imagenes/productos/gambas-al-ajillo.webp', '1'),
  ('5', '1', 'Crema de boletus y trufa', 'Crema fina de setas con aceite de trufa y crujiente de pan artesanal.', '15.50', 'imagenes/productos/crema-de-boletus-y-trufa.webp', '1'),
  ('6', '1', 'Vieiras a la plancha', 'Vieiras doradas con crema ligera de coliflor y aceite de hierbas.', '22.00', 'imagenes/productos/vieiras-a-la-plancha.webp', '1'),
  ('7', '2', 'Solomillo de ternera premium', 'Solomillo a la parrilla con patatas confitadas, verduras baby y jugo de carne.', '38.50', 'imagenes/productos/solomillo-de-ternera.webp', '1'),
  ('8', '2', 'Entrecot madurado', 'Entrecot madurado a la parrilla con mantequilla de hierbas y patatas rústicas.', '36.00', 'imagenes/productos/entrecot-madurado.webp', '1'),
  ('9', '2', 'Lomo de bacalao confitado', 'Bacalao confitado a baja temperatura con pilpil suave y espárragos verdes.', '29.50', 'imagenes/productos/lomo-de-bacalao-confitado.webp', '1'),
  ('10', '2', 'Salmón a la brasa', 'Lomo de salmón a la brasa con verduras de temporada y salsa de cítricos.', '27.50', 'imagenes/productos/salmon-a-la-brasa.webp', '1'),
  ('11', '2', 'Risotto de trufa y parmesano', 'Arroz cremoso con parmesano curado, setas y un toque de trufa.', '28.00', 'imagenes/productos/risotto-de-trufa-y-parmesano.webp', '1'),
  ('12', '2', 'Tagliatelle con bogavante', 'Pasta fresca con bogavante, tomate cherry y emulsión ligera de marisco.', '34.50', 'imagenes/productos/tagliatelle-con-bogavante-rico.webp', '1'),
  ('13', '2', 'Paletilla de cordero', 'Cordero cocinado lentamente con parmentier de patata y reducción de romero.', '35.00', 'imagenes/productos/paletilla-de-cordero.webp', '1'),
  ('14', '2', 'Magret de pato con frutos rojos', 'Magret rosado con salsa de frutos rojos y milhojas de patata.', '31.50', 'imagenes/productos/magret-de-pato.webp', '1'),
  ('15', '2', 'Hamburguesa gourmet de vacuno', 'Vacuno premium, queso curado, cebolla caramelizada y pan brioche.', '24.00', 'imagenes/productos/hamburguesa-gourmet.webp', '1'),
  ('16', '2', 'Arroz meloso de marisco', 'Arroz meloso con gambas, mejillones, calamar y fumet casero.', '32.00', 'imagenes/productos/arroz-meloso-de-marisco.webp', '1'),
  ('17', '3', 'Coulant de chocolate', 'Bizcocho tibio de chocolate negro con corazón fundente y frutos rojos.', '12.50', 'imagenes/productos/coulant-de-chocolate.webp', '1'),
  ('18', '3', 'Tarta cremosa de queso', 'Tarta de queso horneada con base crujiente y coulis de frutos del bosque.', '11.50', 'imagenes/productos/tarta-de-queso.webp', '1'),
  ('19', '3', 'Tiramisú artesanal', 'Clásico tiramisú con café espresso, mascarpone y cacao.', '11.50', 'imagenes/productos/tiramisu-artesanal.webp', '1'),
  ('20', '3', 'Crème brûlée de vainilla', 'Crema de vainilla natural con una fina capa de azúcar caramelizado.', '11.00', 'imagenes/productos/creme-brulee.webp', '1'),
  ('21', '3', 'Tartaleta de frutos rojos', 'Masa sablé, crema suave y selección de frutos rojos frescos.', '11.00', 'imagenes/productos/tartaleta-de-frutos-rojos.webp', '1'),
  ('22', '3', 'Helado artesano de temporada', 'Tres bolas de helado artesano con sabores de temporada.', '10.50', 'imagenes/productos/helado-artesano.webp', '1'),
  ('23', '4', 'Agua mineral premium', 'Agua mineral natural servida fría.', '5.00', 'imagenes/productos/agua-mineral-premium.webp', '1'),
  ('24', '4', 'Limonada natural', 'Limonada recién preparada con limón natural y hierbabuena.', '6.50', 'imagenes/productos/limonada-natural.webp', '1'),
  ('25', '4', 'Zumo de naranja natural', 'Zumo exprimido al momento con naranjas frescas.', '6.50', 'imagenes/productos/zumo-de-naranja-natural.webp', '1'),
  ('26', '4', 'Café espresso', 'Café espresso de tueste seleccionado.', '4.00', 'imagenes/productos/cafe-espresso.webp', '1'),
  ('27', '4', 'Cappuccino', 'Espresso con leche emulsionada y una capa cremosa de espuma.', '5.50', 'imagenes/productos/cappuccino.webp', '1'),
  ('28', '4', 'Té verde aromático', 'Infusión de té verde con notas vegetales suaves.', '5.00', 'imagenes/productos/te-verde.webp', '1'),
  ('29', '4', 'Cóctel cítrico de la casa', 'Cóctel de autor con cítricos, hierbas frescas y hielo.', '12.00', 'imagenes/productos/coctel-citrico-de-la-casa.webp', '1'),
  ('30', '4', 'Mocktail frutos rojos', 'Bebida sin alcohol con frutos rojos, lima y soda.', '9.00', 'imagenes/productos/mocktail-frutos-rojos.webp', '1'),
  ('39', '6', 'Menú Degustación Esencia', 'Recorrido de cinco pases con productos de temporada y postre del chef.', '68.00', 'imagenes/productos/menu-degustacion-esencia.webp', '1'),
  ('40', '6', 'Menú Mediterráneo', 'Entrante, pescado del día, postre artesanal y bebida.', '49.00', 'imagenes/productos/menu-mediterraneo.webp', '1'),
  ('41', '6', 'Menú Tierra y Mar', 'Selección de carne y marisco con acompañamientos y postre.', '62.00', 'imagenes/productos/menu-tierra-y-mar.webp', '1'),
  ('42', '6', 'Menú Celebración', 'Experiencia para compartir con entrantes, plato principal y postre especial.', '75.00', 'imagenes/productos/menu-celebracion.webp', '1');

CREATE TABLE `oferta_producto` (
  `oferta_id` int NOT NULL,
  `producto_id` int NOT NULL,
  PRIMARY KEY (`oferta_id`,`producto_id`),
  KEY `producto_id` (`producto_id`),
  CONSTRAINT `oferta_producto_ibfk_1` FOREIGN KEY (`oferta_id`) REFERENCES `ofertas` (`id`),
  CONSTRAINT `oferta_producto_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `oferta_producto` (`oferta_id`, `producto_id`) VALUES
  ('1', '7'),
  ('1', '17'),
  ('3', '17'),
  ('1', '18'),
  ('3', '18'),
  ('3', '19'),
  ('2', '41'),
  ('2', '42');

CREATE TABLE `producto_ingrediente` (
  `producto_id` int NOT NULL,
  `ingrediente_id` int NOT NULL,
  `cantidad` decimal(10,2) NOT NULL DEFAULT '1.00',
  PRIMARY KEY (`producto_id`,`ingrediente_id`),
  KEY `ingrediente_id` (`ingrediente_id`),
  CONSTRAINT `producto_ingrediente_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`),
  CONSTRAINT `producto_ingrediente_ibfk_2` FOREIGN KEY (`ingrediente_id`) REFERENCES `ingredientes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `producto_ingrediente` (`producto_id`, `ingrediente_id`, `cantidad`) VALUES
  ('1', '3', '1.00'),
  ('1', '47', '1.00'),
  ('2', '5', '1.00'),
  ('2', '6', '1.00'),
  ('3', '8', '1.00'),
  ('3', '9', '1.00'),
  ('5', '13', '1.00'),
  ('6', '15', '1.00'),
  ('7', '10', '1.00'),
  ('7', '12', '1.00'),
  ('9', '36', '1.00'),
  ('15', '29', '1.00'),
  ('15', '45', '1.00'),
  ('15', '46', '1.00'),
  ('15', '48', '1.00'),
  ('16', '49', '1.00'),
  ('16', '50', '1.00'),
  ('22', '31', '1.00'),
  ('22', '34', '1.00');

CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direccion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `rol` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'usuario' COMMENT 'Valores: usuario, admin',
  `fecha_registro` datetime NOT NULL DEFAULT (now()),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `favoritos` (
  `usuario_id` int NOT NULL,
  `producto_id` int NOT NULL,
  PRIMARY KEY (`usuario_id`,`producto_id`),
  KEY `producto_id` (`producto_id`),
  CONSTRAINT `favoritos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  CONSTRAINT `favoritos_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Usuarios de prueba: la contraseña común es 1234.
INSERT INTO `usuarios` (`id`, `nombre`, `email`, `password`, `telefono`, `direccion`, `fecha_nacimiento`, `rol`, `fecha_registro`) VALUES
  ('1', 'Usuario Demo 01', 'demo01@example.com', '$2y$10$dXrgGsinhkMlOJxyktnhw.39/veSPhy0xwXs3mC5i3BZ8blhAhQLK', '600000001', 'Calle Demo 1', '1995-01-10', 'usuario', '2026-11-02 18:47:45'),
  ('2', 'Usuario Demo 02', 'demo02@example.com', '$2y$10$dXrgGsinhkMlOJxyktnhw.39/veSPhy0xwXs3mC5i3BZ8blhAhQLK', '600000002', 'Calle Demo 2', '1992-02-11', 'usuario', '2026-11-02 18:47:45'),
  ('3', 'Usuario Demo 03', 'demo03@example.com', '$2y$10$dXrgGsinhkMlOJxyktnhw.39/veSPhy0xwXs3mC5i3BZ8blhAhQLK', '600000003', 'Calle Demo 3', '1998-03-12', 'usuario', '2026-11-02 18:47:45'),
  ('4', 'Usuario Demo 04', 'demo04@example.com', '$2y$10$dXrgGsinhkMlOJxyktnhw.39/veSPhy0xwXs3mC5i3BZ8blhAhQLK', '600000004', 'Calle Demo 4', '1994-04-13', 'usuario', '2026-11-02 18:47:45'),
  ('5', 'Usuario Demo 05', 'demo05@example.com', '$2y$10$dXrgGsinhkMlOJxyktnhw.39/veSPhy0xwXs3mC5i3BZ8blhAhQLK', '600000005', 'Calle Demo 5', '1991-05-14', 'usuario', '2026-11-02 18:47:45'),
  ('6', 'Usuario Demo 06', 'demo06@example.com', '$2y$10$dXrgGsinhkMlOJxyktnhw.39/veSPhy0xwXs3mC5i3BZ8blhAhQLK', '600000006', 'Calle Demo 6', '1996-06-15', 'usuario', '2026-11-02 18:47:45'),
  ('7', 'Usuario Demo 07', 'demo07@example.com', '$2y$10$dXrgGsinhkMlOJxyktnhw.39/veSPhy0xwXs3mC5i3BZ8blhAhQLK', '600000007', 'Calle Demo 7', '1993-07-16', 'usuario', '2026-11-02 18:47:45'),
  ('8', 'Usuario Demo 08', 'demo08@example.com', '$2y$10$dXrgGsinhkMlOJxyktnhw.39/veSPhy0xwXs3mC5i3BZ8blhAhQLK', '600000008', 'Calle Demo 8', '1997-08-17', 'usuario', '2026-11-02 18:47:45'),
  ('9', 'Usuario Demo 09', 'demo09@example.com', '$2y$10$dXrgGsinhkMlOJxyktnhw.39/veSPhy0xwXs3mC5i3BZ8blhAhQLK', '600000009', 'Calle Demo 9', '1990-09-18', 'usuario', '2026-11-02 18:47:45'),
  ('10', 'Usuario Demo 10', 'demo10@example.com', '$2y$10$dXrgGsinhkMlOJxyktnhw.39/veSPhy0xwXs3mC5i3BZ8blhAhQLK', '600000010', 'Calle Demo 10', '1999-10-19', 'usuario', '2026-11-02 18:47:45');

CREATE TABLE `pedidos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario_id` int NOT NULL,
  `estado` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pendiente' COMMENT 'Valores: pendiente, confirmado, preparando, enviado, entregado, cancelado',
  `fecha_pedido` datetime NOT NULL DEFAULT (now()),
  `subtotal` decimal(10,2) NOT NULL,
  `descuento` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total` decimal(10,2) NOT NULL,
  `metodo_pago` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'simulado',
  `estado_pago` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pendiente' COMMENT 'Valores: pendiente, pagado, fallido',
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `pedidos` (`id`, `usuario_id`, `estado`, `fecha_pedido`, `subtotal`, `descuento`, `total`, `metodo_pago`, `estado_pago`) VALUES
  ('1', '1', 'entregado', '2026-11-01 18:47:45', '55.00', '0.00', '55.00', 'demo', 'pagado'),
  ('2', '2', 'entregado', '2026-10-31 18:47:45', '89.50', '0.00', '89.50', 'demo', 'pagado'),
  ('3', '3', 'entregado', '2026-10-30 18:47:45', '59.50', '0.00', '59.50', 'demo', 'pagado'),
  ('4', '4', 'entregado', '2026-10-29 18:47:45', '90.00', '0.00', '90.00', 'demo', 'pagado'),
  ('5', '5', 'entregado', '2026-10-28 18:47:45', '60.50', '0.00', '60.50', 'demo', 'pagado'),
  ('6', '6', 'entregado', '2026-10-27 18:47:45', '88.50', '0.00', '88.50', 'demo', 'pagado'),
  ('7', '7', 'entregado', '2026-10-26 18:47:45', '58.00', '0.00', '58.00', 'demo', 'pagado'),
  ('8', '8', 'entregado', '2026-10-25 18:47:45', '137.50', '0.00', '137.50', 'demo', 'pagado'),
  ('9', '9', 'entregado', '2026-10-24 18:47:45', '56.50', '0.00', '56.50', 'demo', 'pagado'),
  ('10', '10', 'entregado', '2026-10-23 18:47:45', '99.00', '0.00', '99.00', 'demo', 'pagado');

CREATE TABLE `pedido_detalle` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pedido_id` int NOT NULL,
  `producto_id` int DEFAULT NULL,
  `nombre_producto` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL,
  `cantidad` int NOT NULL,
  `subtotal` decimal(10,2) NOT NULL COMMENT 'CHECK cantidad > 0 y precio_unitario >= 0',
  PRIMARY KEY (`id`),
  KEY `pedido_id` (`pedido_id`),
  KEY `producto_id` (`producto_id`),
  CONSTRAINT `pedido_detalle_ibfk_1` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`),
  CONSTRAINT `pedido_detalle_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `pedido_detalle` (`id`, `pedido_id`, `producto_id`, `nombre_producto`, `precio_unitario`, `cantidad`, `subtotal`) VALUES
  ('1', '1', '7', 'Solomillo de ternera premium', '38.50', '1', '38.50'),
  ('2', '1', '1', 'Burrata con tomate confitado', '16.50', '1', '16.50'),
  ('3', '2', '7', 'Solomillo de ternera premium', '38.50', '2', '77.00'),
  ('4', '2', '17', 'Coulant de chocolate', '12.50', '1', '12.50'),
  ('5', '3', '7', 'Solomillo de ternera premium', '38.50', '1', '38.50'),
  ('6', '3', '3', 'Tartar de atún rojo', '21.00', '1', '21.00'),
  ('7', '4', '7', 'Solomillo de ternera premium', '38.50', '2', '77.00'),
  ('8', '4', '24', 'Limonada natural', '6.50', '2', '13.00'),
  ('9', '5', '7', 'Solomillo de ternera premium', '38.50', '1', '38.50'),
  ('10', '5', '6', 'Vieiras a la plancha', '22.00', '1', '22.00'),
  ('11', '6', '7', 'Solomillo de ternera premium', '38.50', '2', '77.00'),
  ('12', '6', '19', 'Tiramisú artesanal', '11.50', '1', '11.50'),
  ('13', '7', '7', 'Solomillo de ternera premium', '38.50', '1', '38.50'),
  ('14', '7', '2', 'Carpaccio de solomillo', '19.50', '1', '19.50'),
  ('15', '8', '7', 'Solomillo de ternera premium', '38.50', '3', '115.50'),
  ('16', '8', '6', 'Vieiras a la plancha', '22.00', '1', '22.00'),
  ('17', '9', '7', 'Solomillo de ternera premium', '38.50', '1', '38.50'),
  ('18', '9', '4', 'Gambas al ajillo', '18.00', '1', '18.00'),
  ('19', '10', '7', 'Solomillo de ternera premium', '38.50', '2', '77.00'),
  ('20', '10', '6', 'Vieiras a la plancha', '22.00', '1', '22.00');

CREATE TABLE `pedido_detalle_ingrediente` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pedido_detalle_id` int NOT NULL,
  `ingrediente_id` int DEFAULT NULL,
  `nombre_ingrediente` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `precio_extra` decimal(10,2) NOT NULL DEFAULT '0.00',
  `accion` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Valores: incluido, quitado, añadido',
  PRIMARY KEY (`id`),
  KEY `pedido_detalle_id` (`pedido_detalle_id`),
  KEY `ingrediente_id` (`ingrediente_id`),
  CONSTRAINT `pedido_detalle_ingrediente_ibfk_1` FOREIGN KEY (`pedido_detalle_id`) REFERENCES `pedido_detalle` (`id`),
  CONSTRAINT `pedido_detalle_ingrediente_ibfk_2` FOREIGN KEY (`ingrediente_id`) REFERENCES `ingredientes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS = 1;
