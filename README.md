Es un software básico para la clase de Ingeniería Web.

Está usando HTML, CSS, JavaScript y php.

Creacion de base de datos 
--------------------------
Crea una base de datos llamada sistema_ventas.
Crea la tabla  ventas

CREATE TABLE ventas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente VARCHAR(100),
    producto VARCHAR(100),
    cantidad INT,
    precio INT,
    total INT,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP
); 