# 👾 Login Seguro PHP - Arcade Edition

![PHP](https://img.shields.io/badge/PHP-8.0%2B-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MariaDB](https://img.shields.io/badge/MariaDB-10.6%2B-003545?style=for-the-badge&logo=mariadb&logoColor=white)
![Security](https://img.shields.io/badge/Security-PDO%20%2B%20CSRF-green?style=for-the-badge)
![Style](https://img.shields.io/badge/Style-Retro%20Pixel-ff00de?style=for-the-badge)

Un sistema de autenticación robusto desarrollado en **PHP nativo** y **MariaDB**. Este proyecto combina una interfaz estilo **Videojuego Retro/Cyberpunk** con estándares de seguridad modernos para proteger contra ataques comunes en aplicaciones web.

---

## 🛡️ Características de Seguridad Implementadas

Este proyecto cumple con 8 niveles de seguridad críticos:

1.  **Validación Frontend (JS):**
    * Control de longitud (8-15 caracteres).
    * **Whitelist Regex:** Solo permite letras, números y los caracteres seguros `@ # $ % * ! _ -`.
2.  **Protección de Cookies:**
    * Flags activadas: `HttpOnly` (anti-XSS), `Secure` (si hay SSL), `SameSite=Strict`.
    * Configuración forzada vía `ini_set` en tiempo de ejecución.
3.  **Token Anti-CSRF:**
    * Generación de token criptográfico único por sesión (`bin2hex`).
    * Validación oculta en cada envío de formulario POST.
4.  **Gestión de Sesiones:**
    * **Anti-Fixation:** Regeneración de ID de sesión (`session_regenerate_id`) cada 30 minutos.
    * **Timeout:** Cierre automático tras 2 horas de inactividad absoluta.
    * **Logout Seguro:** Destrucción explícita de la cookie en el navegador y del archivo en el servidor.
5.  **Base de Datos Segura:**
    * Uso de **PDO** (PHP Data Objects) con Sentencias Preparadas.
    * Defensa total contra **SQL Injection**.
    * Contraseñas almacenadas como **HASH** usando el algoritmo BCRYPT (`password_hash` y `password_verify`).
6.  **Protección contra Fuerza Bruta:**
    * Sistema de bloqueo temporal de cuentas.
    * Tras **5 intentos fallidos**, el usuario queda bloqueado por **15 minutos**.

---

## 🕹️ Instalación y Puesta en Marcha

### 1. Requisitos
* Servidor Web (XAMPP, WAMP, o similar).
* PHP 7.4 o superior.
* MariaDB / MySQL.

### 2. Base de Datos
Ejecuta el siguiente script SQL en **phpMyAdmin** para crear la estructura y el usuario de prueba:

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

-- Tabla de Intentos de Login
CREATE TABLE login_attempts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    attempts INT DEFAULT 0,
    last_attempt DATETIME,
    blocked_until DATETIME,
    UNIQUE KEY unique_user (username)
);

-- Usuario de prueba: ismael_usuario / Contraseña: Admin1234@
INSERT INTO usuario (nombre, apellidos, idusuario, password) VALUES 
('Ismael', 'Gonzalez', 'ismael_usuario', '$2y$10$R9h/cIPz0gi.URNNX3kh2OPST9/PgBkqquii.V3TtI93eYz.n.8EC');

## 💻 Tecnologías Utilizadas
Lenguaje: [Ej: Python, JavaScript, C++]

Librerías: [Ej: Pandas, NumPy, React]

Herramientas: [Ej: Visual Studio Code, Git]