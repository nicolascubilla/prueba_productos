# 📦 API de Productos con PHP y PostgreSQL

Esta es una API RESTful sencilla desarrollada en PHP para administrar una tabla de productos, conectada a una base de datos PostgreSQL. 
También incluye una interfaz web para consultar, crear, editar y eliminar productos.

## 🚀 Requisitos

- PHP (recomendado: 8.x)
- PostgreSQL
- WAMP, XAMPP o similar
- Navegador web moderno

## 🛠 Estructura del proyecto

apiproductos/ ├── db.php # Conexión a la base de datos PostgreSQL ├── productos/ │
 ├── index.html # Vista principal con listado de productos │ ├── nuevoproducto.html # Formulario para crear un nuevo producto │ 
 ├── editar.html # Formulario para editar producto existente │ ├── consultar.html # Vista para consultar producto por ID │ 
 ├── create.php # Endpoint POST (crear producto) │ ├── read.php # Endpoint GET (listar productos) │ 
 ├── read_one.php # Endpoint GET (producto por ID) │ ├── update.php # Endpoint PUT (actualizar producto) │ 
 ├── delete.php # Endpoint DELETE (eliminar producto)
 
 
## Instalación y uso

### 1. Clonar el repositorio

```bash
git clone https://github.com/nicolascubilla/prueba_productos.git

Mover la carpeta al servidor local
Colocá la carpeta apiproductos/ dentro de:
C:/wamp/www/
O en el directorio correspondiente si usás XAMPP (htdocs/).
Crear la base de datos en PostgreSQL

CREATE DATABASE apiproductos;

CREATE TABLE productos (
  id SERIAL PRIMARY KEY,
  nombre TEXT NOT NULL,
  precio DECIMAL(10,2) NOT NULL,
  stock INTEGER NOT NULL
);

4. Configurar db.php
Modificá el archivo db.php con tus credenciales de conexión PostgreSQL:
<?php
$host = 'localhost';
$db   = 'apiproductos';
$user = 'tu_usuario';
$pass = 'tu_contraseña';
$port = '5432';

$dsn = "pgsql:host=$host;port=$port;dbname=$db;";
$pdo = new PDO($dsn, $user, $pass);
?>

5. Iniciar el servidor
Encendé WAMP y accedé desde el navegador a:
http://localhost/apiproductos/productos/index.html

 Endpoints disponibles
 Método | Ruta | Descripción
GET | /productos/read.php | Listar todos los productos
GET | /productos/read_one.php?id=1 | Obtener un producto por ID
POST | /productos/create.php | Crear un nuevo producto
PUT | /productos/update.php | Actualizar un producto existente
DELETE | /productos/delete.php | Eliminar un producto

 Estado del proyecto
✔ Listado, edición, creación, eliminación y consulta por ID implementados correctamente.
✔ Frontend simple con Bootstrap 5.
✔ Validaciones y manejo básico de errores.



