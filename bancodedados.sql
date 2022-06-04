DROP SCHEMA IF EXISTS leilaofaca2;
CREATE SCHEMA IF NOT EXISTS leilaofaca2 DEFAULT CHARACTER SET utf8 ;
USE leilaofaca2 ;
CREATE TABLE IF NOT EXISTS usuario(
codigo INT PRIMARY KEY AUTO_INCREMENT NOT NULL ,
admin BOOL NOT NULL DEFAULT FALSE ,
login VARCHAR( 55 ) NOT NULL ,
senha VARCHAR( 100 ) NOT NULL
);


CREATE TABLE IF NOT EXISTS faca(
codigo INT PRIMARY KEY AUTO_INCREMENT NOT NULL ,
estoquedisponivel INT( 7 ) NOT NULL ,
estoqueprocessamento INT( 7 ) DEFAULT '0',
lanceInicial FLOAT NOT NULL ,
nome TEXT NOT NULL ,
descricao TEXT,
img TEXT,
linkFotos TEXT
);

CREATE TABLE IF NOT EXISTS operacao(
codigo INT PRIMARY KEY AUTO_INCREMENT NOT NULL ,
data_inicioBaixa TIMESTAMP DEFAULT CURRENT_TIMESTAMP( ) ,
data_finalBaixa TIMESTAMP,
comprador varchar(65),
valorFinal FLOAT NOT NULL ,
codigoFaca INT NOT NULL,
codigoUsuario INT NOT NULL,
quantidade INT,
    CONSTRAINT fk_vendedor
    FOREIGN KEY (codigoUsuario)
    REFERENCES usuario(codigo)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_modelo
    FOREIGN KEY (codigoFaca)
    REFERENCES faca(codigo)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);
DELIMITER $$
CREATE PROCEDURE FinalizarBaixa(IN codigoBaixa int)
BEGIN
UPDATE operacao SET data_finalBaixa = CURRENT_TIMESTAMP() WHERE codigo = codigoBaixa;
END $$
DELIMITER ;