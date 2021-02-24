CREATE DATABASE FMIN2;

CREATE TABLE TipoSolicitud (
    codigo int(3) AUTO_INCREMENT,
    nombre varchar(20),
    PRIMARY KEY (codigo)
);

CREATE TABLE cliente(
  codcliente int(8) AUTO_INCREMENT,
  nomcliente varchar(100),
  PRIMARY KEY (codcliente)
);

CREATE TABLE EstadoTrab (
   ConEstab int(3) AUTO_INCREMENT,
   nombre varchar(50),
   PRIMARY KEY (ConEstab)
);

CREATE TABLE GdespachoE (
  codDe int(8) AUTO_INCREMENT,
  codnumero int(10),
  fecha varchar(10),
  archivo varchar(100),
  PRIMARY KEY (codDe)
);

CREATE TABLE cargo (
    cod int(3) AUTO_INCREMENT,
    nombre varchar(10),
    PRIMARY KEY (cod)
);

CREATE TABLE trabajador(
  codtrab int(3) AUTO_INCREMENT,
  rutTrab varchar(10),
  nombre varchar(20),
  apellido varchar(20),
  contrasena varchar(10),
  ConEstab int(3),
  cod int(3),
  PRIMARY KEY(codtrab),
  FOREIGN KEY (ConEstab) REFERENCES EstadoTrab (ConEstab),
  FOREIGN KEY (cod) REFERENCES cargo (cod)
);

CREATE TABLE GdespachoC (
  codDc int(8) AUTO_INCREMENT,
  codnumero int(10),
  codcliente int(8),
  TipoSolicitud int(3),
  codS varchar(20),
  descripcion varchar(500),
  fecha varchar(10),
  encargado int(3),
  archivo varchar(100),
  PRIMARY KEY (codDc),
  FOREIGN KEY (codcliente) REFERENCES cliente (codcliente),
  FOREIGN KEY (TipoSolicitud) REFERENCES TipoSolicitud(codigo),
  FOREIGN KEY (encargado) REFERENCES trabajador(codtrab)
);

CREATE TABLE estado(
  codigo int(2) AUTO_INCREMENT,
  nombre varchar(20),
  PRIMARY KEY (codigo)
);


CREATE TABLE descripcionOT(
  codFolio int(8) AUTO_INCREMENT,
  Estado int(3),
  observacion text,
  ngC int(10),
  ngE int(10),
  PRIMARY KEY (codFolio),
  FOREIGN KEY (ngC) REFERENCES GdespachoC (codDc),
  FOREIGN KEY (ngE) REFERENCES GdespachoE (codDe),
  FOREIGN KEY (Estado) REFERENCES estado (codigo)
);

CREATE TABLE trabajadorOT(
   codigo int(8),
   codTrab int(3),
   horas integer,
   PRIMARY KEY (codigo, codTrab),
   FOREIGN KEY (codigo) REFERENCES descripcionOT (codFolio),
   FOREIGN KEY (codTrab) REFERENCES trabajador (codtrab)
);

INSERT INTO estadotrab (`nombre`) VALUES ('vinculado');
INSERT INTO estadotrab(`nombre`) VALUES ('desviculado');

INSERT INTO cargo (`nombre`) VALUES ('administrador');
INSERT INTO cargo (`nombre`) VALUES ('encargado');

INSERT INTO `trabajador`(rutTrab, nombre, apellido, contrasena, ConEstab, cod)
VALUES ('1-3','Nicolas','Varas','1234','1','1');

INSERT INTO `trabajador`(rutTrab, nombre, apellido, contrasena, ConEstab, cod)
VALUES ('1-44','Sebastian','Solis','1234','2','1');

INSERT INTO cliente (nomcliente) VALUES ('Cia Minera Centinela Oxido');
INSERT INTO cliente (nomcliente) VALUES ('Cia Minera Centinela Oxe');
INSERT INTO cliente (nomcliente) VALUES ('Cia Minera Centinela Sulfuro');
INSERT INTO cliente (nomcliente) VALUES ('Cia Minera Centinela Siam');
INSERT INTO cliente (nomcliente) VALUES ('Cia Minera Antucoya');
INSERT INTO cliente (nomcliente) VALUES ('Cia Minera Pelambre');
INSERT INTO cliente (nomcliente) VALUES ('Cia Minera Mantos Blancos');
INSERT INTO cliente (nomcliente) VALUES ('Cia Minera Mantos Verdes');
INSERT INTO cliente (nomcliente) VALUES ('Cia Minera Pta Pellets');
INSERT INTO cliente (nomcliente) VALUES ('Cia Minera del Pacifico CNN');
INSERT INTO cliente (nomcliente) VALUES ('Cia Minera del Pacifico Pta Pellets ');
INSERT INTO cliente (nomcliente) VALUES ('Cia Minera del Pacifico Colorado');
INSERT INTO cliente (nomcliente) VALUES ('Cia Minera del Pacifico Magnetita');
INSERT INTO cliente (nomcliente) VALUES ('Cia Minera del Pacifico Romeral');
INSERT INTO cliente (nomcliente) VALUES ('Abastecimientos Cap'); /*VERIFICAR*/
INSERT INTO cliente (nomcliente) VALUES ('Anglo American');
INSERT INTO cliente (nomcliente) VALUES ('LSST Aura Inc.');
INSERT INTO cliente (nomcliente) VALUES ('Cia Minera Meridian');
INSERT INTO cliente (nomcliente) VALUES ('Cia Minera Teck Carmen');
INSERT INTO cliente (nomcliente) VALUES ('Cia Minera Atacama Kozan');
INSERT INTO cliente (nomcliente) VALUES ('Cia Minera Caserones');
INSERT INTO cliente (nomcliente) VALUES ('Cia Minera Carola');
INSERT INTO cliente (nomcliente) VALUES ('Cia Minera Candelaria');
INSERT INTO cliente (nomcliente) VALUES ('Ariba Sourcing');
INSERT INTO cliente (nomcliente) VALUES ('HABITA');
INSERT INTO cliente (nomcliente) VALUES ('Cia Minera Lomas Bayas');
INSERT INTO cliente (nomcliente) VALUES ('Cia Minera Ojos del Salado');
INSERT INTO cliente (nomcliente) VALUES ('Cia Minera Guanaco');
INSERT INTO cliente (nomcliente) VALUES ('Cia Minera');
INSERT INTO cliente (nomcliente) VALUES ('FINNING');
INSERT INTO cliente (nomcliente) VALUES ('Parque Talinay Oriente S.A');
INSERT INTO cliente (nomcliente) VALUES ('SKF Chile');
INSERT INTO cliente (nomcliente) VALUES ('Belfi');
INSERT INTO cliente (nomcliente) VALUES ('Faremin');
INSERT INTO cliente (nomcliente) VALUES ('Santiago Metals');
INSERT INTO cliente (nomcliente) VALUES ('MISECOP');
INSERT INTO cliente (nomcliente) VALUES ('SERAMA');
INSERT INTO cliente (nomcliente) VALUES ('Mecmart LTDA.');
INSERT INTO cliente (nomcliente) VALUES ('Minera Florida');
INSERT INTO cliente (nomcliente) VALUES ('Fractal Ing.');
INSERT INTO cliente (nomcliente) VALUES ('Enrique Osses');
INSERT INTO cliente (nomcliente) VALUES ('Cia Minera Centinela Zaldivar');
INSERT INTO cliente (nomcliente) VALUES ('Yamana Gold');
INSERT INTO cliente (nomcliente) VALUES ('PROSEAL');
INSERT INTO cliente (nomcliente) VALUES ('Enel');
INSERT INTO cliente (nomcliente) VALUES ('Grupo Misecop SPA');
INSERT INTO cliente (nomcliente) VALUES ('FCAB');
INSERT INTO cliente (nomcliente) VALUES ('REMA TIP TOP');
INSERT INTO cliente (nomcliente) VALUES ('Demelec');
INSERT INTO cliente (nomcliente) VALUES ('Antofagasta Railway');


INSERT INTO tiposolicitud (nombre) VALUES ('Reparacion');
INSERT INTO tiposolicitud (nombre) VALUES ('Evaluacion');
INSERT INTO tiposolicitud (nombre) VALUES ('Fabricacion');
INSERT INTO tiposolicitud (nombre) VALUES ('Cotizacion');
INSERT INTO tiposolicitud (nombre) VALUES ('Suministro');
INSERT INTO tiposolicitud (nombre) VALUES ('Garantia');
INSERT INTO tiposolicitud (nombre) VALUES ('Armado');
INSERT INTO tiposolicitud (nombre) VALUES ('Mecanizado');
INSERT INTO tiposolicitud (nombre) VALUES ('Proceso');
INSERT INTO tiposolicitud (nombre) VALUES ('Aporte Mandante');
INSERT INTO tiposolicitud (nombre) VALUES ('Modificacion');
INSERT INTO tiposolicitud (nombre) VALUES ('Confeccion');

INSERT INTO estado (nombre) VALUES ('Pendiente');
INSERT INTO estado (nombre) VALUES ('En Ejecucion');
INSERT INTO estado (nombre) VALUES ('Terminada');
INSERT INTO estado (nombre) VALUES ('Cerrada');
INSERT INTO estado (nombre) VALUES ('Enviada');


CREATE VIEW descripcion  AS
SELECT d.codFolio, gc.codnumero, gc.codS, t.nombre, gc.descripcion, gc.fecha, c.nomcliente, tab.nombre as nomencargado, tab.apellido, est.nombre AS estado
FROM descripcionot AS d, gdespachoc AS gc, cliente AS c, tiposolicitud AS t , trabajador AS tab, estado AS est
WHERE d.ngC = gc.codDc and gc.codcliente = c.codcliente AND gc.TipoSolicitud = t.codigo AND gc.encargado = tAB.codtrab AND   d.Estado = est.codigo
ORDER BY D.codFolio DESC LIMIT 15;

CREATE VIEW descripcionTodo AS
SELECT d.codFolio, gc.codnumero, gc.codS, t.nombre, gc.descripcion, gc.fecha, c.nomcliente, tab.nombre as nomencargado, tab.apellido, est.nombre AS estado
FROM descripcionot AS d, gdespachoc AS gc, cliente AS c, tiposolicitud AS t , trabajador AS tab, estado AS est
WHERE d.ngC = gc.codDc and gc.codcliente = c.codcliente AND gc.TipoSolicitud = t.codigo AND gc.encargado = tAB.codtrab AND   d.Estado = est.codigo  ORDER BY D.codFolio;


DELIMITER $$
CREATE PROCEDURE busqueda(in folio int(8))
BEGIN
SELECT d.codFolio, gc.codnumero, gc.codS, t.nombre, gc.descripcion, gc.fecha, c.nomcliente, tab.nombre As nomencargado, tab.apellido, e.nombre as estado
FROM descripcionot AS d, gdespachoc AS gc, cliente AS c, tiposolicitud AS t, trabajador AS tab, estado as e
WHERE d.codFolio = folio AND d.ngC = gc.codDc and gc.codcliente = c.codcliente AND gc.TipoSolicitud = t.codigo AND gc.encargado = tab.codtrab and d.Estado = e.codigo
END$$
DELIMITER ;

DELIMITER $$
  CREATE PROCEDURE busquedas(in num int(8))
    BEGIN
      SELECT d.codFolio, gc.codnumero, gc.codS, t.nombre, gc.descripcion, gc.fecha, c.nomcliente, tab.nombre As nomencargado, tab.apellido
      FROM descripcionot AS d, gdespachoc AS gc, cliente AS c, tiposolicitud AS t, trabajador AS tab
      WHERE d.codFolio = num or gc.codnumero = num AND d.ngC = gc.codDc and gc.codcliente = c.codcliente AND gc.TipoSolicitud = t.codigo AND gc.encargado = tab.codtrab;
    END $$
  DELIMITER ;

  DELIMITER $$
  CREATE PROCEDURE descripcion(in num int(8))
    BEGIN
    SELECT d.codFolio, gc.codnumero, gc.codS, t.nombre, gc.descripcion, gc.fecha, c.nomcliente, tab.nombre As nomencargado, tab.apellido, g.codnumero as numsal, g.fecha as fesal, e.nombre as estado
    FROM descripcionot AS d, gdespachoc AS gc, cliente AS c, tiposolicitud AS t, trabajador AS tab, gdespachoe as g, Estado as e
    WHERE d.codFolio = 8 AND d.ngC = gc.codDc and gc.codcliente = c.codcliente AND gc.TipoSolicitud = t.codigo AND gc.encargado = tab.codtrab and ngE= g.codDe and d.Estado = e.codigo;
    END $$
  DELIMITER ;

  DELIMITER $$
  CREATE PROCEDURE busquedaGuia (in num int(8))
  BEGIN
  SELECT d.codFolio, gc.codnumero, gc.codS, t.nombre, gc.descripcion, gc.fecha, c.nomcliente, tab.nombre As nomencargado, tab.apellido, e.nombre
    FROM descripcionot AS d, gdespachoc AS gc, cliente AS c, tiposolicitud AS t, trabajador AS tab, estado as e
    WHERE gc.codnumero = 1253 AND d.ngC = gc.codDc and gc.codcliente = c.codcliente AND gc.TipoSolicitud = t.codigo and gc.encargado = tab.codtrab AND d.Estado = e.codigo;
  END $$
  DELIMITER;
