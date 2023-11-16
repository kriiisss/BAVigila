create database if0_35439042_BAvigila;
use if0_35439042_BAvigila;

create table hurto(
    id int not null AUTO_INCREMENT,
    ubicacion varchar (200),
    objetos_sustraidos varchar (250),
    cant_afectados int (11),
    cant_asaltantes int (11),
    ambulancia boolean, 
    info_adicional varchar (250),
    primary key (id)
);

create table robo(
    id int not null AUTO_INCREMENT,
    ubicacion varchar (200),
    objetos_sustraidos varchar (250),
    cant_afectados int (11),
    cant_asaltantes int (11),
    modalidad varchar (200),
    ambulancia boolean, 
    info_adicional varchar (250),
    primary key (id)
);

create table accidente(
    id int not null AUTO_INCREMENT,
    ubicacion varchar (200),
    modalidad varchar (200),
    cant_afectados int (11),
    ambulancia boolean, 
    info_adicional varchar (250),
    primary key (id)
);

create table violencia_de_genero(
    id int not null AUTO_INCREMENT,
    ubicacion varchar (200),
    modalidad varchar (200),
    cant_afectados int (11),
    ambulancia boolean, 
    policia boolean,
    info_adicional varchar (250),
    primary key (id)
);

create table acoso(
    id int not null AUTO_INCREMENT,
    ubicacion varchar (200),
    modalidad varchar (200),
    cant_afectados int (11),
    ambulancia boolean, 
    policia boolean,
    info_adicional varchar (250),
    primary key (id)
);

create table disturbio(
    id int not null AUTO_INCREMENT,
    ubicacion varchar (200),
    modalidad varchar (200),
    cant_afectados int (11),
    ambulancia boolean, 
    policia boolean,
    info_adicional varchar (250),
    primary key (id)
);

create table entradera(
    id int not null AUTO_INCREMENT,
    ubicacion varchar (200),
    cant_afectados int (11),
    ambulancia boolean, 
    policia boolean,
    info_adicional varchar (250),
    primary key (id)
);

create table venta_de_estupefacientes(
    id int not null AUTO_INCREMENT,
    modalidad varchar (200),
    info_adicional varchar (250),
    primary key (id)
);

create table emergencia(
    id int not null AUTO_INCREMENT,
    dni int (11),
    primary key (id)
);

create table usuarios(
    id int AUTO_INCREMENT PRIMARY KEY,
    nombre varchar(255) NOT NULL,
    email varchar(255) NOT NULL,
    password varchar(255) NOT NULL
);

CREATE TABLE tokens_recuperacion (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    token VARCHAR(255) NOT NULL,
    fecha_expiracion DATETIME NOT NULL
);

insert into usuarios (nombre, email, password) values ('Enzo', 'enzo.bartolettiet32@gmail.com', 'BAvigila');