create database baVigila_incidentes;
use baVigila_incidentes;

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