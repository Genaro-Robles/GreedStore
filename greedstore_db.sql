-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: greedstore_db
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorias` (
  `idcategoria` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_categoria` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `foto_categoria` char(50) CHARACTER SET utf8mb4 NOT NULL,
  `descripcion_categoria` varchar(200) CHARACTER SET utf8mb4 NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idcategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'Procesadores','28928476_39009092.png','Marca/Socket/Frecuencia Normal/Frecuencia Turbo/Nucleos/TDP',1),(2,'Tarjetas Graficas','86019649_57345608.jpg','Marca/Memoria/Tipo memoria/Ancho de banda/Consumo/CUDA',1),(3,'Disco Duro','33754926_96140699.jpeg','Marca/Lectura/Escritura /Almacenamiento/Dimensiones',1),(4,'Fuente de Poder','68658778_85964438.jpg','Marca/Modelo/Potencia/Salidas/Certificado/Modular',1),(5,'Memoria Ram','35922423_61916614.webp','Modelo/Capacidad/Frecuencia/Memoria/Voltaje/Leds',1),(6,'Placa Base','63434291_81156764.webp','Marca/Modelo/Socket/Chipset/Ranuras de memoria/Memoria Maxima/Tipo',0);
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `productos` (
  `idproducto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(300) NOT NULL,
  `categoria` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `foto_producto` varchar(250) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idproducto`),
  KEY `categoria` (`categoria`),
  CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`categoria`) REFERENCES `categorias` (`idcategoria`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES (1,'Palit GeForce RTX 3090 GamingPro OC 24GB GDDR6X','Palit /24 GB/GDDR6X/936 GHz/350 W/Si',2,50,'24091533_40916517.webp',8250.20,1),(2,'AMD Ryzen 7 5700X 3.4GHz Box','Ryzen/AM4/3.4 GHz/4.6 GHz/8/65W',1,84,'93644864_29623154.webp',1266.74,1);
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rol` char(30) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'usuario'),(2,'vendedor'),(3,'administrador');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_apellido` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `pass` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `celular` char(9) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(250) COLLATE utf8_spanish_ci DEFAULT NULL,
  `perfil` mediumblob DEFAULT NULL,
  `edad` tinyint(2) NOT NULL,
  `dni` varchar(9) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_rol` int(11) NOT NULL DEFAULT 1,
  `token` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `autentificado` tinyint(1) DEFAULT 0,
  `metodo` char(20) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'normal',
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `correo` (`correo`),
  KEY `id_rol` (`id_rol`),
  KEY `id_rol_2` (`id_rol`),
  CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Nelson BR','nelsonbr862@gmail.com','','',NULL,'https://lh3.googleusercontent.com/a-/AOh14GjcI6iI6Py_yMQ7FvPOWWDAwA8rYV2TmrGQ0l_l=s96-c',0,NULL,2,NULL,0,'google',1,'2022-05-06 04:13:45'),(2,'Ronaldo BR','nelsonbr160602@gmail.com','','',NULL,'https://lh3.googleusercontent.com/a/AATXAJwezt08mbf6rwkr3ecDXOsENRrjvaC9lXCmcQ44=s96-c',0,NULL,1,NULL,0,'google',1,'2022-05-06 04:14:03'),(3,'Nelson','correo@correo.com','$2y$10$7ydPZXdsslITCKRqGX6QOeSY7B.cxQk0amB4xgVvFr8TyIEPkFN1y','972150041',NULL,NULL,19,NULL,1,NULL,0,'normal',1,'2022-05-06 04:54:24');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-05-23 23:10:38
