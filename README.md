# 👾 Videojuego DB MVC - Arcade Edition

![PHP](https://img.shields.io/badge/PHP-8.0%2B-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Arquitectura](https://img.shields.io/badge/Patrón-MVC-blue?style=for-the-badge)
![Base de Datos](https://img.shields.io/badge/MariaDB-10.6%2B-003545?style=for-the-badge&logo=mariadb&logoColor=white)
![Seguridad](https://img.shields.io/badge/Seguridad-PDO%20%2B%20CSRF-green?style=for-the-badge)
![Licencia](https://img.shields.io/badge/Licencia-MIT-orange?style=for-the-badge)

## 📋 Descripción del Proyecto

**Videojuego DB MVC** es una aplicación web robusta diseñada para la gestión integral (CRUD) de una biblioteca personal de videojuegos. Este proyecto representa una evolución técnica significativa desde un sistema procedimental básico hacia una **Arquitectura de Software Profesional basada en el patrón Modelo-Vista-Controlador (MVC)**.

El objetivo principal del proyecto es demostrar cómo combinar una interfaz de usuario inmersiva (estética Retro/Cyberpunk) con prácticas de desarrollo backend de alto nivel, priorizando la escalabilidad, la limpieza del código y, sobre todo, la seguridad informática.



[Image of MVC architecture diagram]


---

## ✨ Características Principales

### 🏗️ Arquitectura y Diseño
* **Patrón MVC Estricto:** Separación lógica entre la gestión de datos (Modelos), la interfaz de usuario (Vistas) y la lógica de negocio (Controladores).
* **Enrutamiento Centralizado:** Todas las peticiones son procesadas por un único punto de entrada (`index.php`), lo que facilita el manejo de errores y la seguridad.
* **Interfaz Retro-Gaming:** Diseño visual personalizado con CSS que emula terminales antiguos, scanlines y tipografías pixeladas.

### 🛡️ Módulo de Seguridad Avanzada
El sistema implementa 8 capas de seguridad para proteger la integridad de la aplicación:
1.  **Prevención de Inyección SQL:** Uso exclusivo de **PDO** con sentencias preparadas.
2.  **Protección XSS & CSRF:** Tokens criptográficos únicos por sesión (`bin2hex`) y saneamiento de salidas.
3.  **Seguridad de Contraseñas:** Hashing unidireccional utilizando el algoritmo **BCRYPT**.
4.  **Blindaje de Sesiones:** Cookies configuradas con flags `HttpOnly`, `Secure` y `SameSite=Strict`.
5.  **Anti-Fuerza Bruta:** Sistema inteligente que bloquea la cuenta tras 5 intentos fallidos durante 15 minutos.
6.  **Validación Dual:** Verificación de datos tanto en cliente (JavaScript) como en servidor (PHP).

### 🎮 Funcionalidades CRUD
* **Create:** Registro de nuevos títulos con metadatos (Género, Nota, Reseña).
* **Read:** Visualización tabular de la colección con indicadores visuales de puntuación.
* **Update:** Edición completa de registros existentes.
* **Delete:** Eliminación segura de registros con confirmación previa.

---

## 📂 Estructura del Directorio

El proyecto sigue una estructura de directorios estándar para aplicaciones MVC en PHP:

```text
/Videojuego-MVC
│
├── /config
│   └── db.php              # Singleton para conexión a Base de Datos (PDO)
│
├── /controllers
│   ├── AuthController.php  # Lógica de Login, Logout y Seguridad
│   └── GameController.php  # Lógica del CRUD de Videojuegos
│
├── /models
│   ├── Usuario.php         # Interacción con tabla de usuarios
│   └── Videojuego.php      # Interacción con tabla de videojuegos
│
├── /views
│   ├── /auth               # Plantillas de Autenticación (Login)
│   └── /game               # Plantillas del Panel de Control (CRUD)
│
├── index.php               # Router / Front Controller
└── validacion.js           # Validaciones Frontend
```

---

## ⚙️ Instrucciones de Instalación

Sigue estos pasos para desplegar el entorno de desarrollo en tu máquina local:

### 1. Requisitos Previos
* **Servidor Web:** Apache o Nginx (Recomendado: XAMPP, WAMP o Laragon).
* **PHP:** Versión 7.4 o superior (Compatible con PHP 8.x).
* **Base de Datos:** MySQL o MariaDB.

### 2. Configuración de la Base de Datos
Accede a tu gestor de base de datos (ej. phpMyAdmin) y ejecuta el siguiente script SQL para generar la estructura y el usuario administrador:

```sql
CREATE DATABASE IF NOT EXISTS usuarios;
USE usuarios;

-- Tabla de Usuarios
CREATE TABLE usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50),
    apellidos VARCHAR(50),
    idusuario VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
);

-- Tabla de Videojuegos
CREATE TABLE videojuegos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    genero VARCHAR(50),
    nota INT,
    resena TEXT
);

-- Tabla de Seguridad (Intentos de Login)
CREATE TABLE login_attempts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    attempts INT DEFAULT 0,
    last_attempt DATETIME,
    blocked_until DATETIME,
    UNIQUE KEY unique_user (username)
);

-- Usuario Administrador por defecto
-- Usuario: ismael_usuario
-- Contraseña: Agente@007
INSERT INTO usuario (nombre, apellidos, idusuario, password) VALUES 
('Ismael', 'Gonzalez', 'ismael_usuario', '$2y$10$R9h/cIPz0gi.URNNX3kh2OPST9/PgBkqquii.V3TtI93eYz.n.8EC');
```

### 3. Configuración del Proyecto
1. Clona o descarga este repositorio en la carpeta pública de tu servidor web (ej. `C:\xampp\htdocs\Videojuego-MVC`).
2. Abre el archivo `config/db.php` y verifica que las credenciales coincidan con tu entorno local:

```php
$host = 'localhost';
$db = 'usuarios';
$user = 'root'; // Tu usuario SQL
$pass = '';     // Tu contraseña SQL
```

---

## 🚀 Guía de Uso

1. **Acceso:** Abre tu navegador y dirígete a `http://localhost/Videojuego-MVC/`.
2. **Login:** Serás redirigido automáticamente al formulario de inicio de sesión.
   * **Usuario:** `ismael_usuario`
   * **Contraseña:** `Agente@007`
3. **Panel de Control:** Una vez autenticado, accederás a la **Biblioteca Gamer**.
   * Utiliza el botón **+ AÑADIR NUEVO JUEGO** para registrar entradas.
   * Utiliza los botones de **EDITAR** o **BORRAR** en la tabla para gestionar juegos existentes.
4. **Cierre de Sesión:** Pulsa en `[SALIR (LOGOUT)]` en la esquina superior derecha para destruir la sesión de forma segura.

---

## 📄 Licencia

Este proyecto se distribuye bajo la licencia **MIT**. Eres libre de usar, modificar y distribuir este software, siempre y cuando se incluya el aviso de copyright original.

---

## 📞 Contacto y Soporte

Si encuentras algún problema de seguridad o tienes dudas sobre la implementación:

* **Desarrollador:** Ismael Gonzalez Tempa
* **Reporte de Problemas:** Por favor, abre un "Issue" en el repositorio de GitHub.

---
*Developed with ❤️ and PHP*