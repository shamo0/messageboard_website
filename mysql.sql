CREATE DATABASE messageboard;

USE messageboard;

/*Table structure for table `users` */
DROP TABLE IF EXISTS users;
CREATE TABLE users (
  CREATE TABLE `members` (
  id int(4) NOT NULL auto_increment PRIMARY KEY,
  username varchar(65) NOT NULL default '',
  password varchar(65) NOT NULL default '',
  PRIMARY KEY (`id`)
  ) TYPE=MyISAM AUTO_INCREMENT=2 ;
)

/*Table structure for table `messages` */
DROP TABLE IF EXISTS messages;
CREATE Table messages(
  messageVal varchar(260);
  timestampVal varcahr(200);
  id int(4) NOT NULL FOREIGN KEY;
)

INSERT INTO users(username,password) VALUE ('admin','secret');
INSERT INTO users(username,password) VALUE ('geno','password123');
INSERT INTO users(username,password) VALUE ('ryan','secretword');
INSERT INTO users(username,password) VALUE ('user1','princess');

