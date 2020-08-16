DROP DATABASE IF EXISTS eventos;

CREATE DATABASE IF NOT EXISTS eventos
    CHARACTER SET utf8
    COLLATE utf8_general_ci;

USE eventos;




DROP TABLE IF EXISTS media;

CREATE TABLE IF NOT EXISTS media(
    id   INT(11)      NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL
);





DROP TABLE IF EXISTS roles;

CREATE TABLE IF NOT EXISTS roles(
    id   INT(11)      NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL
);

INSERT INTO roles (name) VALUES('Administrator');
INSERT INTO roles (name) VALUES('Suscriptor');





DROP TABLE IF EXISTS franchises;

CREATE TABLE IF NOT EXISTS franchises(
    id   INT(11)      NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL
);

INSERT INTO franchises (name) VALUES ('Cardiología');
INSERT INTO franchises (name) VALUES ('Pediatría');





DROP TABLE IF EXISTS users;

CREATE TABLE IF NOT EXISTS users(
    id             INT(11)      NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name           VARCHAR(255) NOT NULL,
    email          VARCHAR(255) NOT NULL,
    franchise_id   INT(11),
    role_id        INT(11)      NOT NULL,
    pass           CHAR(32)     NOT NULL,
    activation_key CHAR(32),
    status         INT(11)      NOT NULL,
    image_id       INT(11),
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
        ON DELETE RESTRICT
);




DROP TABLE IF EXISTS events;

CREATE TABLE IF NOT EXISTS events(
    id           INT(11)      NOT NULL PRIMARY KEY AUTO_INCREMENT,
    title        VARCHAR(255) NOT NULL,
    description  TEXT,
    franchise_id INT(11)      NOT NULL,
    image_id     INT(11)      NOT NULL,
    event_date   DATETIME     NOT NULL,
    video_id     INT(11)      NOT NULL,
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
    id       INT(11)      NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name     VARCHAR(255) NOT NULL,
    image_id INT(11)      NOT NULL,
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
        REFERENCES stands(id)
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