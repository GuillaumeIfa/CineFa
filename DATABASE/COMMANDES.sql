USE cinefa;

DROP TABLE IF EXISTS USERS;
CREATE TABLE USERS
(
id_user int primary key not null auto_increment,
pseudo varchar(50) not null,
address varchar(50),
email varchar(50),
phone varchar(20),
password varchar(50) not null
);


DROP TABLE IF EXISTS CATEGORIES;
CREATE TABLE CATEGORIES
(
id_category int not null auto_increment,
title varchar(50) not null,
creation_date date,
id_user int,
primary key (id_category),
foreign key (id_user) references USERS(id_user)
);

DROP TABLE IF EXISTS DIRECTORS;
CREATE TABLE DIRECTORS
(
id_director int not null auto_increment,
name varchar(50) not null,
gender varchar(50),
date_of_birth date,
PRIMARY KEY (id_director)
);

DROP TABLE IF EXISTS MOVIES;
CREATE TABLE MOVIES
(
id_movie int not null auto_increment,
title varchar(50) not null,
release_date date not null,
id_director int not null,
PRIMARY KEY (id_movie),
FOREIGN KEY (id_director) REFERENCES DIRECTORS(id_director)
);


DROP TABLE IF EXISTS CATEGORY_CONTENT;
CREATE TABLE CATEGORY_CONTENT
(
id_movie int not null,
id_category int not null,
PRIMARY KEY (id_movie, id_category),
FOREIGN KEY (id_movie) references MOVIES(id_movie),
FOREIGN KEY (id_category) references CATEGORIES(id_category)
);

DROP TABLE IF EXISTS ACTORS;
CREATE TABLE ACTORS
(
id_actor int not null auto_increment,
name varchar(50) not null,
gender varchar(50),
date_of_birth date,
PRIMARY KEY (id_actor)
);

DROP TABLE IF EXISTS MOVIE_NOTES;
CREATE TABLE MOVIE_NOTES
(
id_movie int not null,
id_user int not null,
note int,
PRIMARY KEY (id_movie, id_user),
FOREIGN KEY (id_movie) REFERENCES MOVIES(id_movie),
FOREIGN KEY (id_user) REFERENCES USERS(id_user)
);

DROP TABLE IF EXISTS PLAYS_IN;
CREATE TABLE PLAYS_IN
(
id_movie int not null,
id_actor int not null,
PRIMARY KEY (id_movie, id_actor),
FOREIGN KEY (id_movie) REFERENCES MOVIES(id_movie),
FOREIGN KEY (id_actor) REFERENCES ACTORS(id_actor)
);

INSERT INTO DIRECTORS
(
name, gender, date_of_birth
)
VALUES
('john mctiernan', 'male', '1951-01-08'),
('james cameron', 'male', '1954-08-16'),
('paul verhoeven', 'male', '1938-07-18')
;

INSERT INTO MOVIES
(
title, release_date, id_director
)
VALUES
('predator', '1987-08-19', '1'),
('last action hero', '1993-08-11', '1'),
('terminator 2', '1991-10-16', '2'),
('aliens', '1986-10-08', '2'),
('total recall', '1990-10-17', '3')
;


INSERT INTO ACTORS
(
name, gender, date_of_birth
)
VALUES
('arnold schwarzenegger', 'male', '1947-06-30'),
('sigourney weaser', 'female', '1949-10-08'),
('edward furlong', 'male', '1977-08-02')
;

INSERT INTO PLAYS_IN
(
id_movie, id_actor
)
VALUES
('1', '1'),
('2', '1'),
('3', '1'),
('3', '3'),
('4', '2'),
('5', '1')
; 
