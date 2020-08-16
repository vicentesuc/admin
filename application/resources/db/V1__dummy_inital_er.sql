create table tbl_typology
(
    typology_id        bigint       not null primary key auto_increment,
    description        varchar(100) not null default '%',
    typology_parent_id bigint       not null default 0,
    value_1            varchar(50)  not null default '%'
);

create table tbl_document_account
(
    document_account_id bigint primary key not null auto_increment,
    date_created        datetime
);

create table tbl_document
(
    document_id  bigint   not null primary key auto_increment,
    src          text     not null default '/',
    date_created datetime not null default '1900-01-01 00:00:00',
    status       bigint   not null default 0 references tbl_typology (typology_id)
);

create table tbl_person
(
    person_id           bigint         not null primary key auto_increment,
    first_name          varchar(100)   not null default 'S/D',
    last_name           varchar(100)   not null default 'S/D',
    email               varchar(100)   not null default '@',
    status              varchar(100)   not null default 100 references tbl_typology (typology_id),
    is_speaker          enum ('Y','N') not null default 'N',
    is_assistant        enum ('Y','N') not null default 'N',
    date_created        datetime       not null default '1900-01-01 00:00:00',
    document_account_id bigint         not null default 0
);

create table tbl_user
(
    user_id      bigint   not null primary key auto_increment,
    password     text     not null default '%',
    person_id    bigint   not null default 0,
    status       bigint   not null default 0,
    date_created datetime not null default '1900-01-01 00:00:00',
    role         bigint   not null default 100 references tbl_typology (typology_id)
);


create table tbl_event
(
    event_id            bigint       not null primary key auto_increment,
    title               varchar(200) not null default 'S/D',
    description         text         not null default 'S/D',
    no_people           bigint       not null default 0,
    type                bigint       not null default 0 references tbl_typology (typology_id),
    category            bigint       not null default 0 references tbl_typology (typology_id),
    speaker             bigint       not null default 0 references tbl_person (person_id),
    location            text         not null default 'S/D',
    state               bigint       not null default 0,
    city                bigint       not null default 0,
    zone                bigint       not null default 0,
    date_created        datetime     not null default '1900-01-01 00:00:00',
    document_account_id bigint       not null default 0
);


insert into tbl_typology(typology_id, description, typology_parent_id, value_1)
values (144, 'Roles del sistema', 100, '');
insert into tbl_typology(typology_id, description, typology_parent_id, value_1)
values (145, 'Administrador', 144, '');

insert into tbl_typology(typology_id, description, typology_parent_id, value_1)
values (146, 'Estados del sistema', 100, '');
insert into tbl_typology(typology_id, description, typology_parent_id, value_1)
values (147, 'Activo', 146, '');
insert into tbl_typology(typology_id, description, typology_parent_id, value_1)
values (148, 'Inactivo', 146, '');
insert into tbl_typology(typology_id, description, typology_parent_id, value_1)
values (149, 'Suspendio', 146, '');
