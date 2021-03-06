CREATE TABLE user (
  id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(50)
);

CREATE TABLE list (
  id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  description VARCHAR(300),
  userId INTEGER,
  FOREIGN KEY(userId) REFERENCES user(id)
);

CREATE TABLE movie (
  id INTEGER NOT NULL,
  title VARCHAR(100),
  overview VARCHAR(1000),
  listId INTEGER NOT NULL,
  releaseDate varchar(10),
  posterPath varchar(100),
  PRIMARY KEY(id, listId)
);