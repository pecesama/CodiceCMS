
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
-- Table structure for table `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `id_file` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `hotlink` int(1) NOT NULL,
  `last_access` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `count` int(11) NOT NULL DEFAULT '0',
  `stats` int(1) NOT NULL,
  `url` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id_file`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id_file`, `name`, `created`, `hotlink`, `last_access`, `count`, `stats`, `url`, `password`, `type`) VALUES
(3, 'Visita_al_restaurant.png', '2009-05-21 19:30:08', 1, '0000-00-00 00:00:00', 0, 0, '964090f6cb2d620d6a458945d063f607', '', 'image/png');

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

CREATE TABLE IF NOT EXISTS `links` (
  `name` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `type` varchar(15) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'external',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=63 ;

--
-- Dumping data for table `links`
--

INSERT INTO `links` (`name`, `link`, `type`, `created`, `modified`, `ID`) VALUES
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

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `tag` varchar(255) NOT NULL,
  `urlfriendly` varchar(255) NOT NULL,
  PRIMARY KEY (`tag_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=53 ;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`tag_id`, `tag`, `urlfriendly`) VALUES
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

-- --------------------------------------------------------

--
-- Table structure for table `tags_rel`
--

CREATE TABLE IF NOT EXISTS `tags_rel` (
  `tag_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tags_rel`

-- --------------------------------------------------------

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
