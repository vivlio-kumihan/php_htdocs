create table members (
    id int not null auto_increment primary key,
    name varchar(255),
    email varchar(255) unique,
    password varchar(255),
    created datetime,
    modified datetime
);