mysql> SHOW DATABASES;

mysql> USE CINEFA;

mysql> CREATE TABLE USERS
    -> (
    -> id_user int primary key not null auto_increment,
    -> pseudo varchar(50) not null,
    -> address varchar(50),
    -> email varchar(50),
    -> phone varchar(20),
    -> password varchar(50) not null
    -> );

mysql> SHOW COLUMNS FROM USERS;
+----------+-------------+------+-----+---------+----------------+
| Field    | Type        | Null | Key | Default | Extra          |
+----------+-------------+------+-----+---------+----------------+
| id_user  | int(11)     | NO   | PRI | NULL    | auto_increment |
| pseudo   | varchar(50) | NO   |     | NULL    |                |
| address  | varchar(50) | YES  |     | NULL    |                |
| email    | varchar(50) | YES  |     | NULL    |                |
| phone    | varchar(20) | YES  |     | NULL    |                |
| password | varchar(50) | NO   |     | NULL    |                |
+----------+-------------+------+-----+---------+----------------+

mysql> CREATE TABLE CATEGORIES
    -> (
    -> id_category int not null auto_increment,
    -> title varchar(50) not null,
    -> creation_date date,
    -> id_user int,
    -> primary key (id_category),
    -> foreign key (id_user) references USERS(id_user)
    -> );

mysql> SHOW COLUMNS FROM CATEGORIES;
+---------------+-------------+------+-----+---------+----------------+
| Field         | Type        | Null | Key | Default | Extra          |
+---------------+-------------+------+-----+---------+----------------+
| id_category   | int(11)     | NO   | PRI | NULL    | auto_increment |
| title         | varchar(50) | NO   |     | NULL    |                |
| creation_date | date        | YES  |     | NULL    |                |
| id_user       | int(11)     | YES  | MUL | NULL    |                |
+---------------+-------------+------+-----+---------+----------------+

mysql> CREATE TABLE CATEGORY_CONTENT
    -> (
    -> id_movie int not null,
    -> id_category int not null,
    -> PRIMARY KEY (id_movie, id_category),
    -> FOREIGN KEY (id_movie) references MOVIES(id_movie),
    -> FOREIGN KEY (id_category) references CATEGORIES(id_category)
    -> );

mysql> SHOW COLUMNS FROM CATEGORY_CONTENT;
+-------------+---------+------+-----+---------+-------+
| Field       | Type    | Null | Key | Default | Extra |
+-------------+---------+------+-----+---------+-------+
| id_movie    | int(11) | NO   | PRI | NULL    |       |
| id_category | int(11) | NO   | PRI | NULL    |       |
+-------------+---------+------+-----+---------+-------+

mysql> CREATE TABLE ACTORS
    -> (
    -> id_actor int not null auto_increment,
    -> name varchar(50) not null,
    -> gender varchar(50),
    -> date_of_birth date,
    -> PRIMARY KEY (id_actor)
    -> );

mysql> SHOW COLUMNS FROM ACTORS;
+---------------+-------------+------+-----+---------+----------------+
| Field         | Type        | Null | Key | Default | Extra          |
+---------------+-------------+------+-----+---------+----------------+
| id_actor      | int(11)     | NO   | PRI | NULL    | auto_increment |
| name          | varchar(50) | NO   |     | NULL    |                |
| gender        | varchar(50) | YES  |     | NULL    |                |
| date_of_birth | date        | YES  |     | NULL    |                |
+---------------+-------------+------+-----+---------+----------------+


mysql> CREATE TABLE DIRECTORS
    -> (
    -> id_director int not null auto_increment,
    -> name varchar(50) not null,
    -> gender varchar(50),
    -> date_of_birth date,
    -> PRIMARY KEY (id_director)
    -> );

mysql> SHOW COLUMNS FROM DIRECTORS;
+---------------+-------------+------+-----+---------+----------------+
| Field         | Type        | Null | Key | Default | Extra          |
+---------------+-------------+------+-----+---------+----------------+
| id_director   | int(11)     | NO   | PRI | NULL    | auto_increment |
| name          | varchar(50) | NO   |     | NULL    |                |
| gender        | varchar(50) | YES  |     | NULL    |                |
| date_of_birth | date        | YES  |     | NULL    |                |
+---------------+-------------+------+-----+---------+----------------+

mysql> CREATE TABLE MOVIES
    -> (
    -> id_movie int not null auto_increment,
    -> title varchar(50) not null,
    -> release_date date not null,
    -> id_director int not null,
    -> PRIMARY KEY (id_movie),
    -> FOREIGN KEY (id_director) REFERENCES DIRECTORS(id_director)
    -> );

mysql> SHOW COLUMNS FROM MOVIES;
+--------------+-------------+------+-----+---------+----------------+
| Field        | Type        | Null | Key | Default | Extra          |
+--------------+-------------+------+-----+---------+----------------+
| id_movie     | int(11)     | NO   | PRI | NULL    | auto_increment |
| title        | varchar(50) | NO   |     | NULL    |                |
| release_date | date        | NO   |     | NULL    |                |
| id_director  | int(11)     | NO   | MUL | NULL    |                |
+--------------+-------------+------+-----+---------+----------------+


mysql> CREATE TABLE MOVIE_NOTES
    -> (
    -> id_movie int not null,
    -> id_user int not null,
    -> note int,
    -> PRIMARY KEY (id_movie, id_user),
    -> FOREIGN KEY (id_movie) REFERENCES MOVIES(id_movie),
    -> FOREIGN KEY (id_user) REFERENCES USERS(id_user)
    -> );

mysql> SHOW COLUMNS FROM MOVIE_NOTES;
+----------+---------+------+-----+---------+-------+
| Field    | Type    | Null | Key | Default | Extra |
+----------+---------+------+-----+---------+-------+
| id_movie | int(11) | NO   | PRI | NULL    |       |
| id_user  | int(11) | NO   | PRI | NULL    |       |
| note     | int(11) | YES  |     | NULL    |       |
+----------+---------+------+-----+---------+-------+

mysql> CREATE TABLE PLAYS_IN
    -> (
    -> id_movie int not null,
    -> id_actor int not null,
    -> PRIMARY KEY (id_movie, id_actor),
    -> FOREIGN KEY (id_movie) REFERENCES MOVIES(id_movie),
    -> FOREIGN KEY (id_actor) REFERENCES ACTORS(id_actor)
    -> );

mysql> SHOW COLUMNS FROM PLAYS_IN;
+----------+---------+------+-----+---------+-------+
| Field    | Type    | Null | Key | Default | Extra |
+----------+---------+------+-----+---------+-------+
| id_movie | int(11) | NO   | PRI | NULL    |       |
| id_actor | int(11) | NO   | PRI | NULL    |       |
+----------+---------+------+-----+---------+-------+

 mysql> INSERT INTO MOVIES
    -> (
    -> title, release_date, id_director
    -> )
    -> VALUES
    -> ('predator', '1987-08-19', '1'),
    -> ('last action hero', '1993-08-11', '1'),
    -> ('terminator 2', '1991-10-16', '2'),
    -> ('aliens', '1986-10-08', '2'),
    -> ('total recall', '1990-10-17', '3')
    -> ;

mysql> SELECT * FROM MOVIES;
+----------+------------------+--------------+-------------+
| id_movie | title            | release_date | id_director |
+----------+------------------+--------------+-------------+
|        1 | predator         | 1987-08-19   |           1 |
|        2 | last action hero | 1993-08-11   |           1 |
|        3 | terminator 2     | 1991-10-16   |           2 |
|        4 | aliens           | 1986-10-08   |           2 |
|        5 | total recall     | 1990-10-17   |           3 |
+----------+------------------+--------------+-------------+

mysql> INSERT INTO DIRECTORS
    -> (
    -> name, gender, date_of_birth
    -> )
    -> VALUES
    -> ('john mctiernan', 'male', '1951-01-08'),
    -> ('james cameron', 'male', '1954-08-16'),
    -> ('paul verhoeven', 'male', '1938-07-18')
    -> ;

mysql> SELECT * FROM DIRECTORS;
+-------------+----------------+--------+---------------+
| id_director | name           | gender | date_of_birth |
+-------------+----------------+--------+---------------+
|           1 | john mctiernan | male   | 1951-01-08    |
|           2 | james cameron  | male   | 1954-08-16    |
|           3 | paul verhoeven | male   | 1938-07-18    |
+-------------+----------------+--------+---------------+

mysql> INSERT INTO ACTORS
    -> (
    -> name, gender, date_of_birth
    -> )
    -> VALUES
    -> ('arnold schwarzenegger', 'male', '1947-06-30'),
    -> ('sigourney weaser', 'female', '1949-10-08'),
    -> ('edward furlong', 'male', '1977-08-02')
    -> ;

mysql> SELECT * FROM ACTORS;
+----------+-----------------------+--------+---------------+
| id_actor | name                  | gender | date_of_birth |
+----------+-----------------------+--------+---------------+
|        1 | arnold schwarzenegger | male   | 1947-06-30    |
|        2 | sigourney weaser      | female | 1949-10-08    |
|        3 | edward furlong        | male   | 1977-08-02    |
+----------+-----------------------+--------+---------------+ 

mysql> INSERT INTO PLAYS_IN
    -> (
    -> id_movie, id_actor
    -> )
    -> VALUES
    -> ('1', '1'),
    -> ('2', '1'),
    -> ('3', '1'),
    -> ('3', '3'),
    -> ('4', '2'),
    -> ('5', '1')
    -> ; 

mysql> SELECT * FROM PLAYS_IN;
+----------+----------+
| id_movie | id_actor |
+----------+----------+
|        1 |        1 |
|        2 |        1 |
|        3 |        1 |
|        3 |        3 |
|        4 |        2 |
|        5 |        1 |
+----------+----------+ 

              