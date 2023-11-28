-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-11-2023 a las 02:02:59
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `login`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacts`
--

CREATE TABLE `contacts` (
  `ID` int(11) NOT NULL,
  `NAMES` varchar(45) NOT NULL,
  `PROBLEM` varchar(45) NOT NULL,
  `COMENT` varchar(255) NOT NULL,
  `PHONE` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `contacts`
--

INSERT INTO `contacts` (`ID`, `NAMES`, `PROBLEM`, `COMENT`, `PHONE`) VALUES
(1, 'PROBLEM1', 'Problemas con registro.', 'COMENT1', '3000000000'),
(2, 'PROBLEM2', 'No puedo iniciar sesion de ninguna forma.', 'COMENT2', '3000000001'),
(3, 'PROBLEM3', 'Problemas con reconocimiento de contraseña.', 'COMENT3', '3000000002');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contraseñas_anteriores`
--

CREATE TABLE `contraseñas_anteriores` (
  `EMAIL` varchar(45) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `FECHA` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `contraseñas_anteriores`
--

INSERT INTO `contraseñas_anteriores` (`EMAIL`, `PASSWORD`, `FECHA`) VALUES
('rapidplase@gmail.com', '$2y$10$F1X8dw9bLdHmSGTyzNJ3IO4Tqy/C0gsFvEk6/x/ybd3Z0tI/pqbN2', '2023-11-14 03:59:06'),
('rapidplase@gmail.com', '$2y$10$H3KZv6Nl9xHffKu2UYJP6OjZPPkeVXsBm8aUaiQZaM1OJLEHGAdV2', '2023-11-14 04:02:26'),
('rapidplase@gmail.com', '$2y$10$pWoYAN8pM4dUhW/hMTRAL.hYedykty5VliBEv.4bvG53rJ3rRghFW', '2023-11-14 04:03:54'),
('rapidplase@gmail.com', '$2y$10$juC5GcWE6.ZHWA1GGPqxyOssNp5KoYz0aNfp3jHQ0C77vakb2xfjS', '2023-11-14 04:12:56'),
('rapidplase@gmail.com', '$2y$10$vGouygEYpxQ.a/yq578Di.iTR4riCI3Mlow3tjtqTkr/DInKIBZLm', '2023-11-14 05:55:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datas`
--

CREATE TABLE `datas` (
  `ID` int(11) NOT NULL,
  `NAMES` varchar(45) NOT NULL,
  `SURNAMES` varchar(45) NOT NULL,
  `EMAIL` varchar(45) NOT NULL,
  `PHONE` varchar(45) NOT NULL,
  `CITY` varchar(45) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `DATE` datetime NOT NULL,
  `CC` varchar(45) NOT NULL,
  `TYPE` varchar(45) NOT NULL,
  `TOKEN` varchar(255) DEFAULT NULL,
  `VERIFICADO` tinyint(1) DEFAULT 0,
  `INTENTOS` int(11) DEFAULT 0,
  `ULTIMO_INTENTO` timestamp NULL DEFAULT NULL,
  `RECUPERACION_TOKEN` varchar(255) DEFAULT NULL,
  `RECUPERACION_EXPIRACION` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `datas`
--

INSERT INTO `datas` (`ID`, `NAMES`, `SURNAMES`, `EMAIL`, `PHONE`, `CITY`, `PASSWORD`, `DATE`, `CC`, `TYPE`, `TOKEN`, `VERIFICADO`, `INTENTOS`, `ULTIMO_INTENTO`, `RECUPERACION_TOKEN`, `RECUPERACION_EXPIRACION`) VALUES
(1, 'Andres', 'Zapata', 'zandresestevan@gmail.com', '3207224647', 'Bogotá', '$2y$10$YETyGYSvxfEtj5/g.AvYcuDoCBr0b0EO2NhO/RnxkSmwrHqv8eOx.', '2023-11-01 00:00:00', '1000693763', 'Cliente', '2822570a7bf042265f3271d042ebd995', 1, 0, '2023-11-20 08:01:52', NULL, NULL),
(2, 'aosidj', 'asoidjaisod', 'aezapata57@ucatolica.edu.co', '129387213', 'Neiva', '$2y$10$8HE5Upib/x7JoH7gBPmFPu3Mp4f/cFB18diMS48GsjXeTwHChqFzG', '2023-11-01 00:00:00', '129837123', 'Cliente', '59217a0c9e8b34d43fa00fa42537bf70', 0, 1, '2023-11-11 01:37:56', NULL, NULL),
(3, 'oaisjd', 'oaisdj', 'rapidplase@gmail.com', '128937', 'Cartagena', '$2y$10$vGouygEYpxQ.a/yq578Di.iTR4riCI3Mlow3tjtqTkr/DInKIBZLm', '2023-11-02 00:00:00', '1092381', 'Cliente', '128dbb9a3ab6f2db0437dbc970f4ad81', 1, 0, '2023-11-12 07:15:51', '2f6ccb4e76c6fc38cf841b2ad7767d2a', '2023-11-15 00:56:03'),
(4, 'Daniel', 'Ordoñez', 'daordonez67@gmail.com', '12983689', 'Bogotá', '$2y$10$NixZbKPsZ.wSkfPlQOlkpOzCr9ent9mb3VbvGWrxa5ZomJ7xj1DIG', '2023-11-08 00:00:00', '198237981', 'Conductor', 'e7f1202c50fc00a2e4d39fce8ce87d21', 0, 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(5, 'Daniel', 'Ordoñez', 'daordonez67@ucatolica.edu.co', '1298371239', 'Ibagué', '$2y$10$Jh/RM1mP1jwrEGBrYdE03u8u9xIrr1eRNCR80aOy86/f/qNDg1f8u', '2023-11-15 00:00:00', '1298371', 'Conductor', '30397b05029f36a70e1345a73271c700', 1, 0, '2023-11-16 06:53:30', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `service`
--

CREATE TABLE `service` (
  `ID` int(11) NOT NULL,
  `ORIGEN` varchar(45) NOT NULL,
  `DESTINO` varchar(45) NOT NULL,
  `HORA` time NOT NULL,
  `FECHA` datetime NOT NULL,
  `TIPO` varchar(45) NOT NULL,
  `CANTIDAD` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `service`
--

INSERT INTO `service` (`ID`, `ORIGEN`, `DESTINO`, `HORA`, `FECHA`, `TIPO`, `CANTIDAD`) VALUES
(1, 'ORIGEN1', 'DESTINO1', '00:00:00', '2022-12-04 00:00:00', 'Grúa', '1'),
(2, 'ORIGEN2', 'DESTINO2', '00:00:00', '2022-12-04 00:00:00', 'Camión(carga delicada)', '2'),
(3, 'ORIGEN3', 'DESTINO3', '00:00:00', '2022-12-04 00:00:00', 'Camión(carga normal)', '3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zandresestevan@gmail.com`
--

CREATE TABLE `zandresestevan@gmail.com` (
  `ID` int(3) NOT NULL,
  `TIPO` varchar(20) NOT NULL,
  `ARTICULO` varchar(40) NOT NULL,
  `CANTIDAD` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `zandresestevan@gmail.com`
--

INSERT INTO `zandresestevan@gmail.com` (`ID`, `TIPO`, `ARTICULO`, `CANTIDAD`) VALUES
(1, 'Mobiliario', 'Silla', 1),
(3, 'Mobiliario', 'Silla', 1),
(4, 'Electrodomésticos', 'Lavadora', 1),
(6, 'Ropa y Articulos', 'Ropa', -3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `datas`
--
ALTER TABLE `datas`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `zandresestevan@gmail.com`
--
ALTER TABLE `zandresestevan@gmail.com`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `contacts`
--
ALTER TABLE `contacts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `datas`
--
ALTER TABLE `datas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `service`
--
ALTER TABLE `service`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `zandresestevan@gmail.com`
--
ALTER TABLE `zandresestevan@gmail.com`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
