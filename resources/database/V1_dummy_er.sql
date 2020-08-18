DROP DATABASE IF EXISTS eventos;

CREATE DATABASE IF NOT EXISTS eventos
    CHARACTER SET utf8
    COLLATE utf8_general_ci;

USE eventos;




DROP TABLE IF EXISTS media;

CREATE TABLE IF NOT EXISTS media(
    id          INT(11)      NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name        VARCHAR(255) NOT NULL,
    description TEXT
);





DROP TABLE IF EXISTS countries;

CREATE TABLE IF NOT EXISTS countries(
    id       INT(11)      NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name     VARCHAR(255) NOT NULL,
    language CHAR(2)      NOT NULL
);

INSERT INTO countries (name,language) VALUES ('Guatemala','es');
INSERT INTO countries (name,language) VALUES ('El Salvador','es');
INSERT INTO countries (name,language) VALUES ('Honduras','es');
INSERT INTO countries (name,language) VALUES ('Nicaragua','es');
INSERT INTO countries (name,language) VALUES ('Costa Rica','es');
INSERT INTO countries (name,language) VALUES ('Panamá','es');
INSERT INTO countries (name,language) VALUES ('República Dominicana','es');
INSERT INTO countries (name,language) VALUES ('Trinidad y Tobago','en');
INSERT INTO countries (name,language) VALUES ('Jamaica','en');
INSERT INTO countries (name,language) VALUES ('Bahamas','en');
INSERT INTO countries (name,language) VALUES ('Barbados','en');
INSERT INTO countries (name,language) VALUES ('Aruba','en');
INSERT INTO countries (name,language) VALUES ('Curacao','en');
INSERT INTO countries (name,language) VALUES ('Belice','en');





DROP TABLE IF EXISTS roles;

CREATE TABLE IF NOT EXISTS roles(
    id   INT(11)      NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL
);

INSERT INTO roles (name) VALUES('Administrator');
INSERT INTO roles (name) VALUES('Suscriptor');





DROP TABLE IF EXISTS franchises;

CREATE TABLE IF NOT EXISTS franchises(
    id      INT(11)      NOT NULL PRIMARY KEY AUTO_INCREMENT,
    es_name VARCHAR(255) NOT NULL,
    en_name VARCHAR(255) NOT NULL
);

INSERT INTO franchises (es_name,en_name) VALUES ('Cardiología','Cardiology');
INSERT INTO franchises (es_name,en_name) VALUES ('Pediatría','Pediatrics');





DROP TABLE IF EXISTS users;

CREATE TABLE IF NOT EXISTS users(
    id             INT(11)      NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name           VARCHAR(255) NOT NULL,
    email          VARCHAR(255) NOT NULL,
    franchise_id   INT(11),
    role_id        INT(11)      NOT NULL,
    pass           CHAR(32)     NOT NULL,
    activation_key CHAR(32),
    status         TINYINT(1)   NOT NULL,
    image_id       INT(11),
    country_id     INT(11)      NOT NULL,
    date           DATETIME     DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY(franchise_id)
        REFERENCES franchises(id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT,
    FOREIGN KEY(role_id)
        REFERENCES roles(id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT,
    FOREIGN KEY(image_id)
        REFERENCES media(id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT,
    FOREIGN KEY(country_id)
        REFERENCES countries(id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
);




DROP TABLE IF EXISTS events;

CREATE TABLE IF NOT EXISTS events(
    id           INT(11)      NOT NULL PRIMARY KEY AUTO_INCREMENT,
    title        VARCHAR(255) NOT NULL,
    description  TEXT         NOT NULL,
    franchise_id INT(11)      NOT NULL,
    image_id     INT(11)      NOT NULL,
    event_date   DATETIME     NOT NULL,
    video_id     INT(11),
    survey_url   VARCHAR(255) NOT NULL,
    language     CHAR(2)      NOT NULL,#un select con 2 options, es para Español y en para Ingles
    date         DATETIME     DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY(franchise_id)
        REFERENCES franchises(id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT,
    FOREIGN KEY(image_id)
        REFERENCES media(id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT,
    FOREIGN KEY(video_id)
        REFERENCES media(id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
);





DROP TABLE IF EXISTS speakers;

CREATE TABLE IF NOT EXISTS speakers(
    id           INT(11)      NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name         VARCHAR(255) NOT NULL,
    es_specialty VARCHAR(255) NOT NULL,
    en_specialty VARCHAR(255) NOT NULL,
    image_id     INT(11)      NOT NULL,
    FOREIGN KEY(image_id)
        REFERENCES media(id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
);





DROP TABLE IF EXISTS user_events;

CREATE TABLE IF NOT EXISTS user_events(
    user_id  INT(11) NOT NULL,
    event_id INT(11) NOT NULL,
    FOREIGN KEY(user_id)
        REFERENCES users(id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT,
    FOREIGN KEY(event_id)
        REFERENCES events(id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
);





DROP TABLE IF EXISTS user_diplomas;

CREATE TABLE IF NOT EXISTS user_diplomas(
    user_id  INT(11) NOT NULL,
    media_id INT(11) NOT NULL,
    FOREIGN KEY(user_id)
        REFERENCES users(id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT,
    FOREIGN KEY(media_id)
        REFERENCES media(id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
);





DROP TABLE IF EXISTS event_speakers;

CREATE TABLE IF NOT EXISTS event_speakers(
    event_id   INT(11) NOT NULL,
    speaker_id INT(11) NOT NULL,
    profile_id TINYINT(1) NOT NULL,#un select con dos options, 1 para Expositor y 2 para Moderador
    FOREIGN KEY(event_id)
        REFERENCES events(id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT,
    FOREIGN KEY(speaker_id)
        REFERENCES speakers(id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
);





DROP TABLE IF EXISTS event_media;

CREATE TABLE IF NOT EXISTS event_media(
    event_id INT(11) NOT NULL,
    media_id INT(11) NOT NULL,
    FOREIGN KEY(event_id)
        REFERENCES events(id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT,
    FOREIGN KEY(media_id)
        REFERENCES media(id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
);





DROP TABLE IF EXISTS event_stands;

CREATE TABLE IF NOT EXISTS event_stands(
    id       INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    event_id INT(11) NOT NULL,
    image_id INT(11) NOT NULL,
    FOREIGN KEY(event_id)
        REFERENCES events(id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT,
    FOREIGN KEY(image_id)
        REFERENCES media(id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
);





DROP TABLE IF EXISTS stands_media;

CREATE TABLE IF NOT EXISTS stands_media(
    stand_id INT(11) NOT NULL,
    media_id INT(11) NOT NULL,
    FOREIGN KEY(stand_id)
        REFERENCES event_stands(id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT,
    FOREIGN KEY(media_id)
        REFERENCES media(id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
);




DROP TABLE IF EXISTS event_interaction_links;

CREATE TABLE IF NOT EXISTS event_interaction_links(
    event_id INT(11) NOT NULL,
    link     VARCHAR(255) NOT NULL,
    FOREIGN KEY(event_id)
        REFERENCES events(id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
);