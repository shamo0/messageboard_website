CREATE DATABASE messageboard;

USE messageboard;

/*Table structure for table `users` */
DROP TABLE IF EXISTS users;
CREATE TABLE users (
  username varchar[40] NOT NULL;
  name varchar[40] NOT NULL;
  password varchar[50] NOT NULL;
)


/*Table structure for table `messages` */
DROP TABLE IF EXISTS messages;
CREATE Table messages(
  message varchar[260];
  timestamp varcahr[200];
)
