CREATE SCHEMA IF NOT EXISTS leilaofaca DEFAULT CHARACTER SET utf8 ;
USE leilaofaca ;


CREATE TABLE IF NOT EXISTS usuario(
codigo INT PRIMARY KEY AUTO_INCREMENT NOT NULL ,
admin BOOLEAN NOT NULL DEFAULT FALSE ,
login VARCHAR( 55 ) NOT NULL ,
senha VARCHAR( 100 ) NOT NULL,
nome VARCHAR( 55 ) NOT NULL
);


CREATE TABLE IF NOT EXISTS faca(
codigo INT PRIMARY KEY AUTO_INCREMENT NOT NULL ,
estoquedisponivel INT( 7 ) NOT NULL ,
estoqueprocessamento INT( 7 ) DEFAULT '0',
lanceInicial FLOAT NOT NULL ,
nome TEXT NOT NULL ,
descricao TEXT,
img LONGTEXT,
fornecedor TEXT,
linkFotos TEXT,
permitir_planceinicial BOOLEAN NOT NULL,
tipofaca INT, 
custo INT
);

CREATE TABLE IF NOT EXISTS operacao(
codigo INT PRIMARY KEY AUTO_INCREMENT NOT NULL ,
data_inicioBaixa TIMESTAMP DEFAULT CURRENT_TIMESTAMP( ) ,
data_finalBaixa TIMESTAMP,
comprador varchar(65),
valorFinal FLOAT  ,
observacao TEXT,
codigoFaca INT NOT NULL,
codigoUsuario INT NOT NULL,
pagamento VARCHAR(55),
concluida BOOLEAN DEFAULT FALSE,
planceinicial BOOLEAN DEFAULT TRUE,
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

CREATE TABLE IF NOT EXISTS tipofaca(
   codigo INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nome VARCHAR(55));

CREATE TABLE IF NOT EXISTS `divulgacao` (
  `link` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `divulgacao` (`link`) VALUES
('https://api.whatsapp.com/send?l=pt&amp;phone=555596387410');
