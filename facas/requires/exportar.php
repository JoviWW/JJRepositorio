<?php
    header("Access-Control-Allow-Origin: *");

    include("conexao.php");
        $connect->exec("set names utf8"); // Permite caracteres latinos.
        $consulta = $connect->mysqli_query('SELECT operacao FROM leilaofaca');				
        $consulta->execute(array());  
        $resultadoDaConsulta = $consulta->fetchAll();

        $StringJson = "["; 
        if ( count($resultadoDaConsulta) ) {
            // Gera arquivo CSV
            $fp = fopen("../requires/relatorio-exportado.csv", "a"); // o "a" indica que o arquivo será sobrescrito sempre que esta função for executada.
            $escreve = fwrite($fp, "Codigo;Data Inicial;Data Final;Comprador;Valor Final;OBS;Faca;Usuario;Pagamento;Concluido;Permitido Lance Inicial?");
            foreach($resultadoDaConsulta as $registro) {
                //;$registro[data_inicioBaixa];$registro[data_finalBaixa];$registro[comprador];$registro[valorFinal];$registro[observacao];$registro[codigoFaca];$registro[codigoUsuario];$registro[pagamento];$registro[planceinicial]
                $escreve = fwrite($fp,"\n$registro[codigo]");
                if ($StringJson != "[") {$StringJson .= ",";}
                $StringJson .= '{"codigo":"' . $registro['codigo']  . '",';
                
            }
            echo $StringJson . "]";
            fclose($fp);
            include("PHPExcel/Classes/PHPExcel/IOFactory.php");
            $objReader = PHPExcel_IOFactory::createReader('CSV');
            $objReader->setDelimiter(";"); // define que a separação dos dados é feita por ponto e vírgula
            $objReader->setInputEncoding('UTF-8'); // habilita os caracteres latinos.
            $objPHPExcel = $objReader->load('relatorio-exportado.csv'); //indica qual o arquivo CSV que será convertido
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('relatorio-exportado.xls'); // Resultado da conversão; um arquivo do EXCEL 
        }
    header("Location: relatorio-exportado.csv");
?>