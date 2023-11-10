create database ReporteIncidencias;
use ReporteIncidencias;

create table formulario(
    id int not null AUTO_INCREMENT,
    ubicacion varchar (100),
    modalidad varchar (200),
    cant_asaltantes int (11),
    cant_afectados int (11),
    ambulancia boolean,
    bomberos boolean,
    objetos_sustraidos varchar (250),
    info_adicional varchar (250),
    primary key (id)
);