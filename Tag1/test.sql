Drop Database if exists test;
Create Database test;
Use test;

create table users(
    id int primary key auto_increment,
    vorname varchar(255) not null,
    age int not null
);

insert into users (vorname, age) values
('Max', 20),
('Peter', 30),
('Hans', 40);