DROP DATABASE IF EXIST movies;

CREATE DATABASE IF NOT EXIS movies;

USE movies;


CREATE TABLE IF NOT EXIST movie(
	movie_id VARCHAR(9) PRIMARY KEY,
	title VARCHAR(100),
	release_year VARCHAR(4),
	rating DECIMAL(2,1),
	image VARCHAR(255)

);