CREATE DATABASE messageboard;

USE messageboard;

/*Table structure for table `users` */
DROP TABLE IF EXISTS users;
CREATE TABLE users (
  id int(4) NOT NULL auto_increment PRIMARY KEY,
  username varchar(65) NOT NULL default '',
  password varchar(65) NOT NULL default '',
  )


/*Table structure for table `messages` */
DROP TABLE IF EXISTS messages;
CREATE Table messages(
  messageVal varchar(260),
  timestampVal varchar(200),
  id int(4) NOT NULL,
  FOREIGN KEY (id) REFERENCES users(id) 
)

INSERT INTO users(username,password) VALUE ('admin','secret');
INSERT INTO users(username,password) VALUE ('geno','password123');
INSERT INTO users(username,password) VALUE ('ryan','secretword');
INSERT INTO users(username,password) VALUE ('user1','princess');

A comma or a closing bracket was expected. (near "FOREIGN KEY" at position 103)
