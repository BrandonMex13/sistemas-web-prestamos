# sistemas-web-prestamos
Un pequeño proyecto sin relevancia sobre un breve sistema de prestamos


Recursos necesarios

Crear un base de datos MySql
Nombre de la base de datos: bdprestamos

Crear la siguiente estructuras de tablas:

CREATE DATABASE `bdprestamos`;

USE `bdprestamos`;

/*Table structure for table `ctl_clientes` */

DROP TABLE IF EXISTS `ctl_clientes`;

CREATE TABLE `ctl_clientes` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `primer_nombre` varchar(50) NOT NULL,
  `segundo_nombre` varchar(50) DEFAULT NULL,
  `apellido_paterno` varchar(50) NOT NULL,
  `apellido_materno` varchar(50) NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT 1,
  KEY `id_cliente` (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

/*Data for the table `ctl_clientes` */

insert  into `ctl_clientes`(`id_cliente`,`primer_nombre`,`segundo_nombre`,`apellido_paterno`,`apellido_materno`,`estatus`) values (5,'Jhon',NULL,'Doe','',1),(6,'Jenny',NULL,'Alarcon','Rivera',1),(7,'Juan','Carlos','Perez','',1),(8,'Administrador',NULL,'','',1),(9,'Usuario',NULL,'','',1);

/*Table structure for table `ctl_montos` */

DROP TABLE IF EXISTS `ctl_montos`;

CREATE TABLE `ctl_montos` (
  `id_monto` int(11) NOT NULL AUTO_INCREMENT,
  `monto` int(11) NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT 1,
  KEY `id_monto` (`id_monto`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

/*Data for the table `ctl_montos` */

insert  into `ctl_montos`(`id_monto`,`monto`,`estatus`) values (1,100,1),(2,200,1),(3,300,1),(4,400,1),(5,500,1),(6,600,1),(7,700,1),(8,800,1),(9,900,1),(10,1000,1);

/*Table structure for table `ctl_plazos` */

DROP TABLE IF EXISTS `ctl_plazos`;

CREATE TABLE `ctl_plazos` (
  `id_plazos` int(11) NOT NULL AUTO_INCREMENT,
  `plazos` int(11) NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT 1,
  KEY `id_plazos` (`id_plazos`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

/*Data for the table `ctl_plazos` */

insert  into `ctl_plazos`(`id_plazos`,`plazos`,`estatus`) values (1,1,1),(2,2,1),(3,3,1),(4,4,1),(5,5,1),(6,6,1),(7,7,1),(8,8,1),(9,9,1),(10,10,1);

/*Table structure for table `registro_prestamos` */

DROP TABLE IF EXISTS `registro_prestamos`;

CREATE TABLE `registro_prestamos` (
  `id_prestamo` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) DEFAULT NULL,
  `id_monto` int(11) DEFAULT NULL,
  `id_plazos` int(11) DEFAULT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT 1,
  `fecha_registro` datetime NOT NULL DEFAULT current_timestamp(),
  KEY `id_prestamo` (`id_prestamo`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;
