CREATE TABLE `comments` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `postID` int(11) NOT NULL,
 `commentAuthor` varchar(40) NOT NULL,
 `commentText` varchar(20000) NOT NULL,
 PRIMARY KEY (`id`)
 ) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8