CREATE DATABASE minicurso
  WITH OWNER ifsul
  ENCODING 'UTF8';

CREATE TABLE users (
  id SERIAL PRIMARY KEY,
  username VARCHAR(64) NOT NULL,
  password VARCHAR(255) NOT NULL
);

ALTER TABLE users ADD CONSTRAINT users_username_unique UNIQUE (username);
