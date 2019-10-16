CREATE TABLE users (
id BIGSERIAL NOT NULL PRIMARY KEY,
first_name VARCHAR(50) NOT NULL,
email VARCHAR(150) NOT NULL,
pass VARCHAR(50) NOT NULL );

INSERT INTO users (first_name, email, pass)
VALUES ('admin', 'admin@example.com', 'admin');
INSERT INTO users (first_name, email, pass)
VALUES ('guest', 'guest@example.com', 'guest');