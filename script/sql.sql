CREATE DATABASE `p5phpblog` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */

create table comment_status
(
    label varchar(50) not null
        primary key
);

create table user_status
(
    label varchar(50) not null
        primary key
);

create table user
(
    pseudo         varchar(50)  not null,
    email          varchar(100) not null,
    password       varchar(100) not null,
    fk_user_status varchar(50)  not null,
    firstname      varchar(50)  not null,
    lastname       varchar(50)  null,
    constraint email
        unique (email),
    constraint user_ibfk_1
        foreign key (fk_user_status) references user_status (label)
);

create table post
(
    id             int auto_increment
        primary key,
    fk_user_pseudo varchar(50)  not null,
    title          varchar(200) not null,
    head           varchar(400) not null,
    content        text         not null,
    createdAt      datetime     not null,
    updatedAt      datetime     null,
    constraint post_ibfk_2
        foreign key (fk_user_pseudo) references user (pseudo)
);

create table comment
(
    id                int auto_increment
        primary key,
    fk_post_id        int         not null,
    fk_user_pseudo    varchar(50) not null,
    fk_comment_status varchar(50) not null,
    content           text        not null,
    createdAt         datetime    not null,
    constraint comment_ibfk_1
        foreign key (fk_post_id) references post (id)
            on update cascade on delete cascade,
    constraint comment_ibfk_2
        foreign key (fk_user_pseudo) references user (pseudo),
    constraint comment_ibfk_3
        foreign key (fk_comment_status) references comment_status (label)
);

create index fk_comment_status
    on comment (fk_comment_status);

create index fk_user_name
    on comment (fk_user_pseudo);

create index fk_user_name
    on post (fk_user_pseudo);

create index fk_user_status
    on user (fk_user_status);

create index pseudo
    on user (pseudo);

