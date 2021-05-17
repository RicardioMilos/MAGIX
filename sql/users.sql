CREATE TABLE `users` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `username` varchar(40) NOT NULL,
 `first_name` varchar(40) NOT NULL,
 `last_name` varchar(40) NOT NULL,
 `password` varchar(255) NOT NULL,
 `visibility` int(11) NOT NULL,
 PRIMARY KEY (`id`),
 UNIQUE KEY `uk_username` (`username`)
 ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8