USE daw2mvc;

-- Las diez cuentas usan la contraseña de demostración Demo1234!.
START TRANSACTION;

INSERT IGNORE INTO usuarios
    (nombre, email, password, telefono, direccion, fecha_nacimiento, rol)
VALUES
    ('Usuario Demo 01', 'demo01@example.com', '$2y$10$yuBeSKodED2DcG48.QcYl.dJIXO2zzLU4UNolJ7bWGgBoqmo1D4ve', '600000001', 'Calle Demo 1', '1995-01-10', 'usuario'),
    ('Usuario Demo 02', 'demo02@example.com', '$2y$10$yuBeSKodED2DcG48.QcYl.dJIXO2zzLU4UNolJ7bWGgBoqmo1D4ve', '600000002', 'Calle Demo 2', '1992-02-11', 'usuario'),
    ('Usuario Demo 03', 'demo03@example.com', '$2y$10$yuBeSKodED2DcG48.QcYl.dJIXO2zzLU4UNolJ7bWGgBoqmo1D4ve', '600000003', 'Calle Demo 3', '1998-03-12', 'usuario'),
    ('Usuario Demo 04', 'demo04@example.com', '$2y$10$yuBeSKodED2DcG48.QcYl.dJIXO2zzLU4UNolJ7bWGgBoqmo1D4ve', '600000004', 'Calle Demo 4', '1994-04-13', 'usuario'),
    ('Usuario Demo 05', 'demo05@example.com', '$2y$10$yuBeSKodED2DcG48.QcYl.dJIXO2zzLU4UNolJ7bWGgBoqmo1D4ve', '600000005', 'Calle Demo 5', '1991-05-14', 'usuario'),
    ('Usuario Demo 06', 'demo06@example.com', '$2y$10$yuBeSKodED2DcG48.QcYl.dJIXO2zzLU4UNolJ7bWGgBoqmo1D4ve', '600000006', 'Calle Demo 6', '1996-06-15', 'usuario'),
    ('Usuario Demo 07', 'demo07@example.com', '$2y$10$yuBeSKodED2DcG48.QcYl.dJIXO2zzLU4UNolJ7bWGgBoqmo1D4ve', '600000007', 'Calle Demo 7', '1993-07-16', 'usuario'),
    ('Usuario Demo 08', 'demo08@example.com', '$2y$10$yuBeSKodED2DcG48.QcYl.dJIXO2zzLU4UNolJ7bWGgBoqmo1D4ve', '600000008', 'Calle Demo 8', '1997-08-17', 'usuario'),
    ('Usuario Demo 09', 'demo09@example.com', '$2y$10$yuBeSKodED2DcG48.QcYl.dJIXO2zzLU4UNolJ7bWGgBoqmo1D4ve', '600000009', 'Calle Demo 9', '1990-09-18', 'usuario'),
    ('Usuario Demo 10', 'demo10@example.com', '$2y$10$yuBeSKodED2DcG48.QcYl.dJIXO2zzLU4UNolJ7bWGgBoqmo1D4ve', '600000010', 'Calle Demo 10', '1999-10-19', 'usuario');

INSERT INTO pedidos
    (usuario_id, estado, fecha_pedido, subtotal, descuento, total, metodo_pago, estado_pago)
SELECT u.id, 'entregado', DATE_SUB(NOW(), INTERVAL demo.dias DAY), demo.total, 0.00, demo.total, 'demo', 'pagado'
FROM (
    SELECT 'demo01@example.com' AS email, 1 AS dias, 60.00 AS total
    UNION ALL SELECT 'demo02@example.com', 2, 84.50
    UNION ALL SELECT 'demo03@example.com', 3, 47.00
    UNION ALL SELECT 'demo04@example.com', 4, 61.00
    UNION ALL SELECT 'demo05@example.com', 5, 48.00
    UNION ALL SELECT 'demo06@example.com', 6, 59.50
    UNION ALL SELECT 'demo07@example.com', 7, 35.50
    UNION ALL SELECT 'demo08@example.com', 8, 90.50
    UNION ALL SELECT 'demo09@example.com', 9, 36.00
    UNION ALL SELECT 'demo10@example.com', 10, 71.00
) AS demo
INNER JOIN usuarios u ON u.email = demo.email
WHERE NOT EXISTS (
    SELECT 1 FROM pedidos pe WHERE pe.usuario_id = u.id AND pe.metodo_pago = 'demo'
);

INSERT INTO pedido_detalle
    (pedido_id, producto_id, nombre_producto, precio_unitario, cantidad, subtotal)
SELECT pe.id, item.producto_id, item.nombre_producto, item.precio, item.cantidad, item.precio * item.cantidad
FROM (
    SELECT 'demo01@example.com' AS email, 15 AS producto_id, 'Hamburguesa gourmet de vacuno' AS nombre_producto, 24.00 AS precio, 2 AS cantidad
    UNION ALL SELECT 'demo01@example.com', 32, 'Croquetas cremosas de jamón', 12.00, 1
    UNION ALL SELECT 'demo02@example.com', 15, 'Hamburguesa gourmet de vacuno', 24.00, 3
    UNION ALL SELECT 'demo02@example.com', 17, 'Coulant de chocolate', 12.50, 1
    UNION ALL SELECT 'demo03@example.com', 15, 'Hamburguesa gourmet de vacuno', 24.00, 1
    UNION ALL SELECT 'demo03@example.com', 31, 'Patatas bravas de la casa', 11.50, 2
    UNION ALL SELECT 'demo04@example.com', 15, 'Hamburguesa gourmet de vacuno', 24.00, 2
    UNION ALL SELECT 'demo04@example.com', 24, 'Limonada natural', 6.50, 2
    UNION ALL SELECT 'demo05@example.com', 15, 'Hamburguesa gourmet de vacuno', 24.00, 1
    UNION ALL SELECT 'demo05@example.com', 32, 'Croquetas cremosas de jamón', 12.00, 2
    UNION ALL SELECT 'demo06@example.com', 15, 'Hamburguesa gourmet de vacuno', 24.00, 2
    UNION ALL SELECT 'demo06@example.com', 19, 'Tiramisú artesanal', 11.50, 1
    UNION ALL SELECT 'demo07@example.com', 15, 'Hamburguesa gourmet de vacuno', 24.00, 1
    UNION ALL SELECT 'demo07@example.com', 31, 'Patatas bravas de la casa', 11.50, 1
    UNION ALL SELECT 'demo08@example.com', 15, 'Hamburguesa gourmet de vacuno', 24.00, 3
    UNION ALL SELECT 'demo08@example.com', 33, 'Pulpo a la gallega', 18.50, 1
    UNION ALL SELECT 'demo09@example.com', 15, 'Hamburguesa gourmet de vacuno', 24.00, 1
    UNION ALL SELECT 'demo09@example.com', 32, 'Croquetas cremosas de jamón', 12.00, 1
    UNION ALL SELECT 'demo10@example.com', 15, 'Hamburguesa gourmet de vacuno', 24.00, 2
    UNION ALL SELECT 'demo10@example.com', 31, 'Patatas bravas de la casa', 11.50, 2
) AS item
INNER JOIN usuarios u ON u.email = item.email
INNER JOIN pedidos pe ON pe.usuario_id = u.id AND pe.metodo_pago = 'demo'
INNER JOIN productos p ON p.id = item.producto_id
WHERE NOT EXISTS (
    SELECT 1
    FROM pedido_detalle pd
    WHERE pd.pedido_id = pe.id AND pd.producto_id = item.producto_id
);

COMMIT;
