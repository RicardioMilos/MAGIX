CREATE TABLE `posts` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `postAuthor` varchar(40) NOT NULL,
 `postTitle` varchar(100) NOT NULL,
 `postText` text NOT NULL,
 `postComments` varchar(20000) DEFAULT NULL,
 `postDate` datetime NOT NULL,
 `visibility` int(11) NOT NULL,
 PRIMARY KEY (`id`)
 ) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8