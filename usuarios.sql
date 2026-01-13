-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-01-2026 a las 20:41:46
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `usuarios`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `attempts` int(11) DEFAULT 0,
  `last_attempt` datetime DEFAULT NULL,
  `blocked_until` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellidos` varchar(50) DEFAULT NULL,
  `idusuario` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `apellidos`, `idusuario`, `password`) VALUES
(3, 'Ismael', 'Gonzalez Tempa', 'ismael_usuario', '$2y$10$/5ioH9tZqks93v4BzBZS0eyKPl7y//u87Ad3jonIFBqETHNq9C0fq'),
(4, 'Pepe', 'Escobar Ruiz', 'pepe_usuario', '$2y$10$B3qlEnVhsfh7yswMjo5JcOrBgXLwpZAPFX5u6J9wQx0XzrZODU4ha');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `videojuegos`
--

CREATE TABLE `videojuegos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `genero` varchar(50) DEFAULT NULL,
  `nota` int(11) DEFAULT NULL,
  `resena` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `videojuegos`
--

INSERT INTO `videojuegos` (`id`, `titulo`, `genero`, `nota`, `resena`) VALUES
(2, 'Super Mario Bros', 'Plataformas', 10, 'El clásico que definió el género de plataformas.'),
(3, 'The Legend of Zelda', 'Aventura', 10, 'Una aventura épica en Hyrule.'),
(4, 'Metroid', 'Metroidvania', 9, 'Atmósfera increíble y exploración profunda.'),
(5, 'Street Fighter II', 'Lucha', 9, 'El rey de los juegos de lucha competitivos.'),
(6, 'Sonic the Hedgehog', 'Plataformas', 8, 'Velocidad pura y diseño de niveles icónico.'),
(7, 'Final Fantasy VII', 'RPG', 10, 'Una historia inolvidable y personajes legendarios.'),
(8, 'Castlevania: SOTN', 'Metroidvania', 10, 'La perfección del género y una banda sonora magistral.'),
(9, 'Doom', 'Shooter', 9, 'El padre de los shooters modernos en primera persona.'),
(10, 'Pac-Man', 'Arcade', 10, 'Un icono de la cultura pop y vicio infinito.'),
(11, 'Tetris', 'Puzzle', 10, 'El juego de puzzle perfecto y más adictivo de la historia.'),
(12, 'Metal Gear Solid', 'Sigilo', 10, 'Innovacion cinematografica y narrativa tactica de espionaje.'),
(13, 'Resident Evil 2', 'Survival Horror', 9, 'Terror atmosferico y gestion de recursos en Raccoon City.'),
(14, 'Halo: Combat Evolved', 'Shooter', 9, 'Revoluciono los FPS en consolas con su IA y vehiculos.'),
(15, 'Grand Theft Auto V', 'Mundo Abierto', 10, 'Un mundo vivo inmenso con tres protagonistas entrelazados.'),
(16, 'The Last of Us', 'Narrativo', 10, 'Una obra maestra emocional sobre la supervivencia humana.'),
(17, 'Elden Ring', 'Action RPG', 10, 'Libertad total en un mundo de fantasia oscura y desafiante.'),
(18, 'Pokemon Rojo/Azul', 'RPG', 9, 'El inicio del fenomeno global de coleccionismo de monstruos.'),
(19, 'God of War (2018)', 'Accion', 10, 'Reinvencion magistral de Kratos con una narrativa padre-hijo.'),
(20, 'Minecraft', 'Sandbox', 10, 'Creatividad infinita y supervivencia en un mundo de bloques.'),
(21, 'The Witcher 3', 'RPG', 10, 'Narrativa adulta y misiones secundarias con impacto real.'),
(22, 'Half-Life 2', 'Shooter', 10, 'Fisicas revolucionarias y una narrativa integrada sin fisuras.'),
(23, 'Dark Souls', 'Action RPG', 10, 'Diseño de niveles magistral y dificultad que recompensa la paciencia.'),
(24, 'Silent Hill 2', 'Survival Horror', 10, 'Una exploracion psicologica profunda del trauma y la culpa.'),
(25, 'Shadow of the Colossus', 'Aventura', 9, 'Enfrentamientos epicos contra gigantes en un mundo melancolico.'),
(26, 'Chrono Trigger', 'RPG', 10, 'Viajes en el tiempo y multiples finales en un juego perfecto.'),
(27, 'BioShock', 'Shooter', 10, 'Una distopia submarina con una narrativa filosofica impactante.'),
(28, 'Portal 2', 'Puzzle', 10, 'Humor brillante y mecanicas de portales que desafian la logica.'),
(29, 'Skyrim', 'Mundo Abierto', 9, 'Libertad casi infinita en un mundo de fantasia nordica.'),
(30, 'Red Dead Redemption 2', 'Mundo Abierto', 10, 'Un simulador de vaqueros con un nivel de detalle obsesivo.'),
(31, 'Crash Bandicoot', 'Plataformas', 8, 'El salto de Sony a las plataformas 3D con personalidad vibrante.');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_user` (`username`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idusuario` (`idusuario`);

--
-- Indices de la tabla `videojuegos`
--
ALTER TABLE `videojuegos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `videojuegos`
--
ALTER TABLE `videojuegos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
