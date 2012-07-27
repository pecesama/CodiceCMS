--

CREATE TABLE IF NOT EXISTS `comments` (
  `idComment` int(11) NOT NULL AUTO_INCREMENT,
  `idCommentParent` int(11) NOT NULL,
  `idUser` int(11), -- puede ser NULL
  `idStatus` int(11) NOT NULL,
  `idPost` int(11) NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `ip` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `url` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `author` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `type` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`idComment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


--
-- Estructura de tabla para la tabla `configurations`
--

CREATE TABLE IF NOT EXISTS `configurations` (
  `idConfiguration` int(11) NOT NULL AUTO_INCREMENT,
  `blogName` varchar(150) COLLATE utf8_bin NOT NULL,
  `description` varchar(255) COLLATE utf8_bin NOT NULL,
  `postsPerPage` int(11) NOT NULL DEFAULT '10',
  `postsPerPageAdmin` int(11) NOT NULL DEFAULT '10',
  `uploadFolder` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT 'uploads',
  `idUser` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`idConfiguration`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `configurations` (
`idConfiguration` ,
`blogName` ,
`description` ,
`postPerPage` ,
`postPerPageAdmin` ,
`uploadFolder` ,
`idUser` ,
`created` ,
`modified`
)
VALUES (
NULL , 'Codice CMS blog', 'Description of your blog', '10', '10', 'uploads', '1', '2012-07-25 00:00:00', '2012-07-25 00:00:00'
);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `idPost` int(11) NOT NULL AUTO_INCREMENT,
  `urlfriendly` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `idUser` int(11) NOT NULL,
  `idStatus` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`idPost`),
  FULLTEXT KEY `content` (`title`,`content`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

ALTER TABLE `posts` ADD `mainImage` VARCHAR( 255 ) NOT NULL AFTER `content` 

CREATE  TABLE `tags` (
  `idTag` INT NOT NULL AUTO_INCREMENT COMMENT 'identificador unico de la etiqueta' ,
  `tag` VARCHAR(255) NOT NULL COMMENT 'descripcion de la etiqueta' ,
  `urlfriendly` VARCHAR(255) NOT NULL COMMENT 'texto unico para busqueda de post por etiqueta' ,
  PRIMARY KEY (`idTag`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;

INSERT INTO `tags` (`idTag`, `tag`, `urlfriendly`) VALUES
(1, 'general', 'general'),
(7, 'humor', 'humor'),
(11, 'web 2.0', 'web-20'),
(8, 'wordpress', 'wordpress'),
(14, 'ensamblador', 'ensamblador'),
(12, 'firefox', 'firefox'),
(3, 'pascal', 'pascal'),
(5, 'algoritmos', 'algoritmos'),
(15, 'css', 'css'),
(19, 'seguridad', 'seguridad'),
(35, 'programacion', 'programacion'),
(37, 'TengoEstaDuda', 'tengoestaduda'),
(38, '"web', 'web'),
(39, '2.0"', '2-0'),
(40, ' css humor ', 'css-humor'),
(41, '2.0web', '2-0web'),
(42, 'Colima', 'Colima'),
(43, 'MÃ©xico', 'Mexico'),
(44, 'Offtopic', 'Offtopic'),
(45, 'FlavorPHP', 'FlavorPHP'),
(46, 'PHP', 'PHP'),
(47, 'Diagramas de Flujo', 'Diagramas-de-Flujo'),
(48, 'Flujogramas', 'Flujogramas'),
(49, 'FotografÃ­a', 'Fotografia'),
(50, 'jquery', 'jquery'),
(51, 'html', 'html'),
(52, ' ', '');

CREATE  TABLE `rel_tags` (
  `idTag` INT NOT NULL COMMENT 'Relacion de la etiqueta' ,
  `idPost` INT NOT NULL COMMENT 'Relacion del post\n' ,
  PRIMARY KEY (`idTag`, `idPost`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(100) COLLATE utf8_bin NOT NULL,
  `lastName` varchar(100) COLLATE utf8_bin NOT NULL,
  `user` varchar(100) COLLATE utf8_bin NOT NULL,
  `password` varchar(64) COLLATE utf8_bin NOT NULL,
  `email` varchar(150) COLLATE utf8_bin NOT NULL,
  `website` varchar(150) COLLATE utf8_bin NOT NULL,
  `about` text COLLATE utf8_bin NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`idUser`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idUser`, `firstName`, `lastName`, `user`, `password`, `email`, `website`, `about`, `created`, `modified`) VALUES
(1, 'Administrador', 'De Codice', 'admin', md5('admin'), 'contacto@codicecms.com', 'http://www.codicecms.com/', 'Administrador de Codice CMS.', NOW(), NOW());

CREATE  TABLE `statuses` (
  `idStatus` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(100) NOT NULL COMMENT 'Nombre del estatus que serían utilizados por (posts, comments)' ,
  PRIMARY KEY (`idStatus`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;

CREATE  TABLE `files` (
  `idFile` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(150) NOT NULL COMMENT 'Nombre del archivo.\n' ,
  `downloadCounter` INT NULL COMMENT 'Contador de descargas.\n' ,
  `password` VARCHAR(32) NULL COMMENT 'clave secreta para permitir descarga de archivo encriptada en md5.\n' ,
  `mimeType` VARCHAR(100) NULL COMMENT 'Mime type del archivo, por ejemplo: image/png.\n' ,
  `created` DATETIME NULL COMMENT 'Fecha de creacion del registro' ,
  `modified` DATETIME NULL COMMENT 'Fecha de actualizacion del registro\n' ,
  PRIMARY KEY (`idFile`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;

CREATE  TABLE `links` (
  `idLink` INT NOT NULL AUTO_INCREMENT COMMENT 'Campo autonumerico identificador del registro\n' ,
  `name` VARCHAR(255) NULL COMMENT 'nombre del link\n' ,
  `link` VARCHAR(255) NULL COMMENT 'direccion url\n' ,
  `type` VARCHAR(15) NULL COMMENT 'external, internal, no follow, \n' ,
  `created` DATETIME NULL COMMENT 'Fecha de creacion del registro\n' ,
  `modified` DATETIME NULL COMMENT 'Fecha de actualizacion del registro' ,
  PRIMARY KEY (`idLink`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;

INSERT INTO `links` (`name`, `link`, `type`, `created`, `modified`, `idLink`) VALUES
('sabrosus', 'http://www.mis-algoritmos.com/sabrosus', 'external', NULL, NULL, 8),
('Pedro Santana', 'http://www.pecesama.net/', 'external', NULL, NULL, 10),
('Ruben Ploneda', 'http://rubenploneda.com/', 'external', NULL, NULL, 11),
('C', 'http://www.mis-algoritmos.com/ejemplos/indice-10.html', 'external', NULL, NULL, 16),
('Free Pascal', 'http://www.mis-algoritmos.com/ejemplos/indice-9.html', 'external', NULL, NULL, 17),
('Turbo C', 'http://www.mis-algoritmos.com/ejemplos/indice-2.html', 'external', NULL, NULL, 18),
('Turbo C', 'http://www.mis-algoritmos.com/ejemplos/indice-6.html', 'external', NULL, NULL, 19),
('Turbo Pascal', 'http://www.mis-algoritmos.com/ejemplos/indice-1.html', 'external', NULL, NULL, 20),
('Turbo Pascal', 'http://www.mis-algoritmos.com/ejemplos/indice-5.html', 'external', NULL, NULL, 21),
('Visual Basic', 'http://www.mis-algoritmos.com/ejemplos/indice-3.html', 'external', NULL, NULL, 22),
('Visual Basic Net', 'http://www.mis-algoritmos.com/ejemplos/indice-7.html', 'external', NULL, NULL, 23),
('BuayaCorp', 'http://www.buayacorp.com/', 'external', NULL, NULL, 25),
('Ejemplos en Javascript', 'http://javascript.mis-algoritmos.com', 'external', NULL, NULL, 29),
('Documentacion', 'http://www.mis-algoritmos.com/documentacion.html', 'external', NULL, NULL, 30),
('Diagramas de flujo', 'http://www.mis-algoritmos.com/ejemplos/diagramas-flujo.html', 'external', NULL, NULL, 31),
('Programador PHP', 'http://www.vbracco.com.ar', 'external', NULL, NULL, 35),
('Ejemplos en Ensamblador', 'http://www.mis-algoritmos.com/ejemplos/asm.html', 'external', NULL, NULL, 36),
('Expresiones Regulares', 'http://www.mis-algoritmos.com/ejemplos/regex.php', 'external', NULL, NULL, 40),
('raVen', 'http://www.raven.com.ar/', 'external', NULL, NULL, 41),
('El ticus', 'http://www.elticus.com', 'external', NULL, NULL, 42),
('Dentro de la Cabeza de GiBraiNe', 'http://gibraine.com/', 'external', NULL, NULL, 53),
('Colima', 'http://www.flickr.com/photos/victorrocha', 'external', NULL, NULL, 48),
('Librerias de C', 'http://docs.mis-algoritmos.com/c.librerias.html', 'external', NULL, NULL, 54),
('Librerias de Pascal', 'http://docs.mis-algoritmos.com/pascal.librerias.html', 'external', NULL, NULL, 55),
('pmsilva.com', 'http://pmsilva.com/', 'external', NULL, NULL, 57),
('Victor De la Rocha', 'http://victordelarocha.com', 'external', '2009-07-25 13:14:15', '2009-07-25 13:14:15', 62);

CREATE  TABLE `plugins` (
  `idPlugin` INT NOT NULL AUTO_INCREMENT ,
  `plugin` VARCHAR(255) NULL ,
  `description` TEXT NULL ,
  `url` VARCHAR(255) NULL COMMENT 'página web del plugin\n' ,
  `urlVersion` VARCHAR(255) NULL COMMENT 'url para consultar versión de plugin y verificar si es necesario actualizar\n' ,
  `urlDownload` VARCHAR(255) NULL COMMENT 'url para descargar version de plugin nueva (en caso de urlVersion ser mayor que fila version)' ,
  `active` INT NULL COMMENT '¿activado o desactivado?' ,
  `version` DOUBLE NULL COMMENT 'version del plugin\n' ,
  `created` DATETIME NULL COMMENT 'Fecha de creación del registro' ,
  `modified` DATETIME NULL COMMENT 'Fecha de actualizacion del registro\n' ,
  PRIMARY KEY (`idPlugin`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;



-- ------------
--
--
--
-- PARA HACER PRUEBAS
--
--
--
-- ------------

INSERT INTO `statuses` (`idStatus`, `name`) VALUES (1, 'Publish');
INSERT INTO `statuses` (`idStatus`, `name`) VALUES (2, 'Draft');
INSERT INTO `statuses` (`idStatus`, `name`) VALUES (3, 'Waiting');

INSERT INTO `posts` (`idPost`, `urlfriendly`, `title`, `content`, `idUser`, `idStatus`, `created`) VALUES (1, 'uno', 'uno', 'uno', 1, 1, '2011-12-29 14:13:29');
INSERT INTO `posts` (`idPost`, `urlfriendly`, `title`, `content`, `idUser`, `idStatus`, `created`) VALUES (2, 'dos', 'dos', 'dos', 1, 2, '2011-12-20 18:35:37');
INSERT INTO `posts` (`idPost`, `urlfriendly`, `title`, `content`, `idUser`, `idStatus`, `created`) VALUES (3, 'tres', 'tres', 'tres', 1, 3, '2011-12-10 9:58:12');

-- comentario de un admin, solo tiene el idUser.
INSERT INTO `codice`.`comments` (`idComment`, `idUser`, `idStatus`, `idPost`, `content`, `ip`, `email`, `type`, `created`) VALUES (5, 1, 1, 2, 'cinco', '192.168.1.2', '', 0, '2011-12-30 14:13:29');
-- comentarios de lectores del blog.
INSERT INTO `codice`.`comments` (`idComment`, `idCommentParent`, `idUser`, `idStatus`, `idPost`, `content`, `ip`, `email`, `type`, `created`) VALUES (1, 1, 1, 1, 1, 'uno', '192.168.1.2', 'autor1@gmail.com', 0, '2011-12-30 14:15:29');
INSERT INTO `codice`.`comments` (`idComment`, `idCommentParent`, `idUser`, `idStatus`, `idPost`, `content`, `ip`, `email`, `type`, `created`) VALUES (2, 2, null, 3, 1, 'respuesta a uno', '192.168.1.2', 'autor2@gmail.com', 0, '2011-12-30 14:16:29');
INSERT INTO `codice`.`comments` (`idComment`, `idCommentParent`, `idUser`, `idStatus`, `idPost`, `content`, `ip`, `email`, `type`, `created`) VALUES (3, 1, null, 1, 1, 'tres', '192.168.1.2', 'autor2@gmail.com', 0, '2011-12-30 14:18:29');
INSERT INTO `codice`.`comments` (`idComment`, `idCommentParent`, `idUser`, `idStatus`, `idPost`, `content`, `ip`, `email`, `type`, `created`) VALUES (4, 1, null, 1, 1, 'cuatro', '192.168.1.2', 'autor3@gmail.com', 0, '2011-12-30 14:25:29');

INSERT INTO `tags` (`idTag`, `tag`, `urlfriendly`) VALUES (2, 'El Dos', 'el-dos');
INSERT INTO `tags` (`idTag`, `tag`, `urlfriendly`) VALUES (4, 'Cuatro 4', 'cuatro');

INSERT INTO `rel_tags` (`idTag`, `idPost`) VALUES (1, 1);
INSERT INTO `rel_tags` (`idTag`, `idPost`) VALUES (2, 1);
INSERT INTO `rel_tags` (`idTag`, `idPost`) VALUES (3, 1);
INSERT INTO `rel_tags` (`idTag`, `idPost`) VALUES (2, 2);
INSERT INTO `rel_tags` (`idTag`, `idPost`) VALUES (4, 2);
