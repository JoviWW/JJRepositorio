DELIMITER $
CREATE PROCEDURE `ColocarEmLeilaoLI`(IN `quantidade` INT, IN `incodigofaca` INT, IN `incodigousuario` INT, IN `inplanceinicial` tinyint)
BEGIN
DECLARE contador INT DEFAULT 0;
loop_t: LOOP
    SET contador = contador + 1;
	INSERT INTO operacao(codigofaca,codigousuario,planceinicial) VALUES (incodigofaca,incodigousuario,inplanceinicial);
	UPDATE faca SET estoquedisponivel = estoquedisponivel-1 where codigo = incodigofaca;
	UPDATE faca SET estoqueprocessamento = estoqueprocessamento+1 where codigo = incodigofaca;
    IF contador >= quantidade THEN
        LEAVE loop_t;
    END IF;
END LOOP loop_t;
END $
DELIMITER ;

DELIMITER $
CREATE PROCEDURE `ColocarEmLeilao`(IN `quantidade` INT, IN `incodigofaca` INT, IN `incodigousuario` INT)
BEGIN
DECLARE contador INT DEFAULT 0;
loop_t: LOOP
    SET contador = contador + 1;
	INSERT INTO operacao(codigofaca,codigousuario) VALUES (incodigofaca,incodigousuario);
	UPDATE faca SET estoquedisponivel = estoquedisponivel-1 where codigo = incodigofaca;
	UPDATE faca SET estoqueprocessamento = estoqueprocessamento+1 where codigo = incodigofaca;
    IF contador >= quantidade THEN
        LEAVE loop_t;
    END IF;
END LOOP loop_t;
END $
DELIMITER ;


DELIMITER $
CREATE PROCEDURE `ConfirmarCompra`(IN `codigoBaixa` INT, IN `incomprador` VARCHAR(55), IN `invalorfinal` FLOAT, IN `inobservacao` TEXT, IN inmetodopag VARCHAR(55))
BEGIN
UPDATE operacao SET data_finalBaixa = CURRENT_TIMESTAMP(), comprador = incomprador, valorfinal = invalorfinal, observacao = inobservacao, pagamento = inmetodopag concluida = 1 WHERE codigo = codigoBaixa;
UPDATE faca f inner join operacao o on(o.codigoFaca = f.codigo) SET estoqueprocessamento = estoqueprocessamento-1 WHERE o.codigo = codigoBaixa;
END $
DELIMITER ;


DELIMITER $
CREATE PROCEDURE `getEstoqueEmProcessamentoUsuario`(IN `incodigofaca` INT, IN `inusuario` INT)
BEGIN
Select count(*) as "EstoqueProcessamento" from operacao where concluida = 0 and codigofaca = incodigofaca and codigousuario = inusuario;
END $
DELIMITER ;

DELIMITER $
CREATE PROCEDURE `getFacasEmProcessamentoUsuario`(IN `incodigofaca` INT, IN `inusuario` INT)
BEGIN
Select * from operacao where concluida = 0 and codigofaca = incodigofaca and codigousuario = inusuario;
END $
DELIMITER ;

DELIMITER $
CREATE PROCEDURE `cancelarBaixa`(IN `incodigoperacao` INT, IN `incodigofaca` INT  )
BEGIN
DELETE FROM operacao where codigo = incodigoperacao;
UPDATE faca SET estoquedisponivel = estoquedisponivel+1 where codigo = incodigofaca;
UPDATE faca SET estoqueprocessamento = estoqueprocessamento-1 where codigo = incodigofaca;
END $
DELIMITER ;

