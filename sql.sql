--

CREATE TABLE IF NOT EXISTS `comments` (
  `suscribe` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `content` text,
  `IP` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `ID_post` int(10) unsigned NOT NULL,
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=49477 ;

--
-- Table structure for table `configurations`
--

CREATE TABLE IF NOT EXISTS `configurations` (
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `configurations`
--

INSERT INTO `configurations` (`name`, `value`, `id_user`, `id`) VALUES
('blog_name', 'Blog Name', 1, 1),
('blog_description', 'Blog description', 1, 2),
('blog_siteurl', 'http://localhost/codice', 1, 3),
('blog_current_theme', 'misalgoritmos', 1, 4),
('blog_posts_per_page', '3', 1, 5),
('posts_per_page', '15', 1, 6),
('blog_feedburner_rssLink', 'http://feeds2.feedburner.com/misalgoritmos', 1, 7),
('blog_upload_folder', 'uploads', 1, 8),
('cancelar', 'Cancel', 1, 9);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `urlfriendly` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text,
  `status` varchar(50) DEFAULT NULL,
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`),
  FULLTEXT KEY `title` (`title`,`content`,`urlfriendly`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=201 ;

CREATE  TABLE `codice`.`tags` (
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

CREATE  TABLE `codice`.`rel_tags` (
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
  `id_user` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `login` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(64) NOT NULL DEFAULT '',
  `email` varchar(100) DEFAULT NULL,
  `website` varchar(150) DEFAULT NULL,
  `about` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `name`, `login`, `password`, `email`, `website`, `about`, `created`, `modified`) VALUES
(1, 'Victor De la Rocha', 'admin', md5('admin'), 'contacto@mis-algoritmos.com', 'http://www.codice-cms.org/', 'Programador PHP.', NULL, NULL);

CREATE  TABLE `codice`.`status` (
  `idStatus` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(100) NOT NULL COMMENT 'Nombre del estatus que serían utilizados por (posts, comments)' ,
  PRIMARY KEY (`idStatus`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;

CREATE  TABLE `codice`.`files` (
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

CREATE  TABLE `codice`.`links` (
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

CREATE  TABLE `codice`.`plugins` (
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