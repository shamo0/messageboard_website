DROP DATABASE IF EXISTS messageboard;
CREATE DATABASE messageboard;

USE messageboard;

/*Table structure for table `users` */
DROP TABLE IF EXISTS messages;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
  id int(4) NOT NULL auto_increment PRIMARY KEY,
  username varchar(65) NOT NULL default '',
  names varchar(65) NOT NULL default '',
  roles int NOT NULL,
  passwd varchar(65) NOT NULL default ''
  );


/*Table structure for table `messages` */

CREATE Table messages(
  messageId int PRIMARY KEY NOT NULL auto_increment,
  messageVal varchar(260),
  timestampVal varchar(200),
  id int(4) NOT NULL,
  FOREIGN KEY (id) REFERENCES users(id) 
);

INSERT INTO users(id,username,names,roles,passwd) VALUE (1,'admin','admin',1,'secret');
INSERT INTO users(id,username,names,roles,passwd) VALUE (2,'geno','geno',0,'password123');
INSERT INTO users(id,username,names,roles,passwd) VALUE (3,'ryan','ryan',0,'secretword');
INSERT INTO users(id,username,names,roles,passwd) VALUE (4,'user1','John',0,'princess');

INSERT INTO messages(messageVal,timestampVal,id) VALUE ("test message",'March 10, 2001, 5:16 pm',3);
INSERT INTO messages(messageVal,timestampVal,id) VALUE ("new test message",'March 10, 2001, 5:20 pm',2);
