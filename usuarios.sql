-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-01-2026 a las 15:24:48
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
  `imagen` varchar(255) DEFAULT NULL,
  `genero` varchar(50) DEFAULT NULL,
  `metascore` int(11) DEFAULT NULL,
  `resena` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `videojuegos`
--

INSERT INTO `videojuegos` (`id`, `titulo`, `imagen`, `genero`, `metascore`, `resena`) VALUES
(1, 'The Legend of Zelda: Ocarina of Time', 'https://upload.wikimedia.org/wikipedia/en/5/57/The_Legend_of_Zelda_Ocarina_of_Time.jpg', 'Aventura', 99, 'La obra maestra de N64 que definió el 3D.'),
(2, 'SoulCalibur', 'https://steamcdn-a.akamaihd.net/steam/apps/544750/library_600x900_2x.jpg', 'Lucha', 98, 'El pináculo de la lucha en 3D con armas.'),
(3, 'Grand Theft Auto IV', 'https://upload.wikimedia.org/wikipedia/en/b/b7/Grand_Theft_Auto_IV_cover.jpg', 'Mundo Abierto', 98, 'La historia de Niko Bellic definió una generación.'),
(4, 'Super Mario Galaxy', 'https://upload.wikimedia.org/wikipedia/en/7/76/SuperMarioGalaxy.jpg', 'Plataformas', 97, 'Mario desafiando la gravedad en el espacio.'),
(6, 'Red Dead Redemption 2', 'https://upload.wikimedia.org/wikipedia/en/4/44/Red_Dead_Redemption_II.jpg', 'Mundo Abierto', 97, 'Detalle obsesivo en el salvaje oeste.'),
(7, 'Breath of the Wild', 'https://upload.wikimedia.org/wikipedia/en/c/c6/The_Legend_of_Zelda_Breath_of_the_Wild.jpg', 'Aventura', 97, 'Libertad absoluta en un Hyrule post-apocalíptico.'),
(8, 'Tony Hawk\'s Pro Skater 2', 'https://steamcdn-a.akamaihd.net/steam/apps/1245620/library_600x900_2x.jpg', 'Deportes', 98, 'Jugabilidad perfecta y banda sonora legendaria.'),
(9, 'BioShock', 'https://upload.wikimedia.org/wikipedia/en/6/6d/BioShock_cover.jpg', 'Shooter', 96, 'Rapture es una distopía submarina inolvidable.'),
(10, 'Half-Life 2', 'https://upload.wikimedia.org/wikipedia/en/2/25/Half-Life_2_cover.jpg', 'Shooter', 96, 'Físicas y narrativa integradas magistralmente.'),
(11, 'Elden Ring', 'https://upload.wikimedia.org/wikipedia/en/b/b9/Elden_Ring_Box_art.jpg', 'Action RPG', 96, 'El mundo abierto de FromSoftware es implacable.'),
(12, 'The Last of Us', 'https://upload.wikimedia.org/wikipedia/en/4/46/Video_Game_Cover_-_The_Last_of_Us.jpg', 'Narrativo', 95, 'Un viaje emocional devastador sobre la paternidad.'),
(13, 'Portal 2', 'https://upload.wikimedia.org/wikipedia/en/f/f9/Portal2cover.jpg', 'Puzzle', 95, 'Humor brillante y mecánicas de portales perfectas.'),
(14, 'Metal Gear Solid 2', 'https://m.media-amazon.com/images/I/81w6A3j+arL._AC_UF1000,1000_QL80_.jpg', 'Sigilo', 96, 'Kojima rompiendo la cuarta pared con Raiden.'),
(15, 'Resident Evil 4', 'https://steamcdn-a.akamaihd.net/steam/apps/2050650/library_600x900_2x.jpg', 'Survival Horror', 96, 'Reinventó la cámara al hombro y la acción.'),
(16, 'Skyrim', 'https://upload.wikimedia.org/wikipedia/en/1/15/The_Elder_Scrolls_V_Skyrim_cover.png', 'RPG', 94, 'Exploración nórdica infinita y dragones.'),
(17, 'God of War', 'https://upload.wikimedia.org/wikipedia/en/a/a7/God_of_War_4_cover.jpg', 'Acción', 94, 'El regreso maduro de Kratos con Atreus.'),
(19, 'The Witcher 3', 'https://upload.wikimedia.org/wikipedia/en/0/0c/Witcher_3_cover_art.jpg', 'RPG', 92, 'Geralt de Rivia en su mejor y más vasta aventura.'),
(20, 'Hades', 'https://upload.wikimedia.org/wikipedia/en/c/cc/Hades_cover_art.jpg', 'Roguelike', 93, 'Morir nunca fue tan divertido y narrativo.'),
(21, 'Persona 5 Royal', 'https://steamcdn-a.akamaihd.net/steam/apps/1687950/library_600x900_2x.jpg', 'JRPG', 95, 'Estilo visual único y profundidad social.'),
(22, 'Mass Effect 2', 'https://steamcdn-a.akamaihd.net/steam/apps/24980/library_600x900_2x.jpg', 'RPG', 96, 'La misión suicida definitiva en el espacio.'),
(23, 'Batman: Arkham City', 'https://upload.wikimedia.org/wikipedia/en/0/00/Batman_Arkham_City_Game_Cover.jpg', 'Acción', 96, 'Ser el Caballero Oscuro nunca se sintió tan real.'),
(25, 'Bloodborne', 'https://upload.wikimedia.org/wikipedia/en/6/68/Bloodborne_Cover_Wallpaper.jpg', 'Action RPG', 92, 'Terror cósmico victoriano y combate visceral.'),
(26, 'Undertale', 'https://steamcdn-a.akamaihd.net/steam/apps/391540/library_600x900_2x.jpg', 'RPG', 92, 'El RPG donde no tienes que matar a nadie.'),
(27, 'Hollow Knight', 'https://upload.wikimedia.org/wikipedia/en/0/04/Hollow_Knight_first_cover_art.webp', 'Metroidvania', 90, 'Un mundo de insectos melancólico y desafiante.'),
(28, 'Celeste', 'https://steamcdn-a.akamaihd.net/steam/apps/504230/library_600x900_2x.jpg', 'Plataformas', 91, 'Superar la ansiedad escalando una montaña.'),
(29, 'Disco Elysium', 'https://steamcdn-a.akamaihd.net/steam/apps/632470/library_600x900_2x.jpg', 'RPG', 97, 'Un detective amnésico en un RPG político y filosófico.'),
(30, 'Baldur\'s Gate 3', 'https://upload.wikimedia.org/wikipedia/en/1/12/Baldur%27s_Gate_3_cover_art.jpg', 'RPG', 96, 'Libertad total basada en Dungeons & Dragons.'),
(31, 'Final Fantasy VII', 'https://upload.wikimedia.org/wikipedia/en/c/c2/Final_Fantasy_VII_Box_Art.jpg', 'JRPG', 92, 'La historia de Cloud y Sephiroth cambió el género.'),
(32, 'Chrono Trigger', 'https://upload.wikimedia.org/wikipedia/en/a/a7/Chrono_Trigger.jpg', 'JRPG', 92, 'Viajes en el tiempo en el RPG perfecto de SNES.'),
(35, 'Street Fighter II', 'https://upload.wikimedia.org/wikipedia/en/1/1d/SF2_JPN_flyer.jpg', 'Lucha', 93, 'El padre de los juegos de lucha competitivos.'),
(38, 'Doom (1993)', 'https://upload.wikimedia.org/wikipedia/en/5/57/Doom_cover_art.jpg', 'Shooter', 88, 'Acción frenética matando demonios en Marte.'),
(39, 'Quake', 'https://steamcdn-a.akamaihd.net/steam/apps/2310/library_600x900_2x.jpg', 'Shooter', 94, 'El primer FPS totalmente en 3D real.'),
(40, 'Diablo II', 'https://upload.wikimedia.org/wikipedia/en/d/d5/Diablo_II_Coverart.png', 'Action RPG', 88, 'El rey del loot y el click frenético.'),
(42, 'Counter-Strike', 'https://steamcdn-a.akamaihd.net/steam/apps/730/library_600x900_2x.jpg', 'Shooter', 88, 'El shooter táctico competitivo por excelencia.'),
(44, 'Dota 2', 'https://steamcdn-a.akamaihd.net/steam/apps/570/library_600x900_2x.jpg', 'MOBA', 90, 'Profundidad estratégica infinita de Valve.'),
(45, 'Overwatch', 'https://upload.wikimedia.org/wikipedia/en/5/51/Overwatch_cover_art.jpg', 'Shooter', 91, 'Héroes carismáticos y trabajo en equipo.'),
(47, 'Among Us', 'https://upload.wikimedia.org/wikipedia/en/9/9a/Among_Us_cover_art.jpg', 'Social', 85, 'Traición y deducción en el espacio.'),
(48, 'Stardew Valley', 'https://steamcdn-a.akamaihd.net/steam/apps/413150/library_600x900_2x.jpg', 'Simulación', 89, 'La vida de granja relajante perfecta.'),
(49, 'Animal Crossing: New Horizons', 'https://upload.wikimedia.org/wikipedia/en/1/1f/Animal_Crossing_New_Horizons.jpg', 'Simulación', 90, 'Tu propia isla paradisíaca llena de amigos animales.'),
(50, 'Cuphead', 'https://steamcdn-a.akamaihd.net/steam/apps/268910/library_600x900_2x.jpg', 'Plataformas', 88, 'Animación estilo años 30 y dificultad brutal.'),
(51, 'Inazuma Eleven: Heroes\' Victory Road', 'https://i.3djuegos.com/juegos/13559/inazuma_eleven_ares/fotos/ficha/inazuma_eleven_ares-5978454.jpg', 'RPG, Deportes', 85, 'Videojuego de rol deportivo desarrollado y publicado por Level-5.'),
(52, 'The Binding of Isaac', 'https://store-images.s-microsoft.com/image/apps.72.14180640033505902.f3980150-855f-4339-9d70-5a300ea9f004.3214c5d3-ee9d-46a4-9294-5e724cfa1929', 'Roguelike', 88, 'Shooter de rol y acción generado aleatoriamente con fuertes elementos de roguelike.');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
