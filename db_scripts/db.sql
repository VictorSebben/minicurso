-- postgres
CREATE DATABASE minicurso
  WITH OWNER ifsul
  ENCODING 'UTF8';

-- mariadb / mysql
CREATE DATABASE minicurso CHARACTER SET 'utf8';
GRANT ALL ON minicurso.* TO 'ifsul';

-- Geral
CREATE TABLE users (
  id SERIAL PRIMARY KEY,
  username VARCHAR(64) NOT NULL,
  password VARCHAR(255) NOT NULL
);

ALTER TABLE users ADD CONSTRAINT users_username_unique UNIQUE (username);

CREATE TABLE tweets (
  id SERIAL PRIMARY KEY,
  text VARCHAR (140) NOT NULL,
  user_id INTEGER NOT NULL,
  public INTEGER NOT NULL DEFAULT 0
);
