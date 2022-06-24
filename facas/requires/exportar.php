<?php
    header("Access-Control-Allow-Origin: *");

    include("conexao.php");// Permite caracteres latinos.
    $consulta = mysqli_query($connect,'SELECT * FROM operacao');		

    $StringJson = "["; 
    if ( mysqli_num_rows($consulta) > 0 ) {
        // Gera arquivo CSV
        $fp = fopen("../requires/relatorio-exportado.csv", "w"); // o "a" indica que o arquivo será sobrescrito sempre que esta função for executada.
        $escreve = fwrite($fp, "Codigo;Data Inicial;Data Final;Comprador;Valor Final;OBS;Faca;Usuario;Pagamento;Lance Inicial?");
        if ($StringJson != "[") {$StringJson .= ",";}
        //$escreve = fwrite($fp,"\n$resultadoDaConsulta[codigo]");
        //$StringJson .= '{"codigo":"' . $resultadoDaConsulta['codigo']  . '",';
        //$StringJson .= '{"data_inicioBaixa":"' . $resultadoDaConsulta['data_inicioBaixa']  . '"}';
        while ($registro = mysqli_fetch_assoc($consulta)) {
            print_r($registro,"\n");
            $escreve = fwrite($fp,"\n$registro[codigo];$registro[data_inicioBaixa];$registro[data_finalBaixa];$registro[comprador];$registro[valorFinal];$registro[observacao];$registro[codigoFaca];$registro[codigoUsuario];$registro[pagamento];$registro[planceinicial]");           
            if ($StringJson != "[") {$StringJson .= ",";}
            $StringJson .= '{"codigo":"' . $registro['codigo']  . '",';
            $StringJson .= '"data_inicioBaixa":"' . $registro['data_inicioBaixa']  . '",';
            $StringJson .= '"data_finalBaixa":"' . $registro['data_finalBaixa']  . '",';
            $StringJson .= '"comprador":"' . $registro['comprador']  . '",';
            $StringJson .= '"valorFinal":"' . $registro['valorFinal']  . '",';
            $StringJson .= '"observacao":"' . $registro['observacao']  . '",';
            $StringJson .= '"codigoFaca":"' . $registro['codigoFaca']  . '",';
            $StringJson .= '"codigoUsuario":"' . $registro['codigoUsuario']  . '",';
            $StringJson .= '"pagamento":"' . $registro['pagamento']  . '",';
            $StringJson .= '"planceinicial":"' . $registro['planceinicial']  . '"}';
            
        }
        echo $StringJson . "]";
        fclose($fp);
        include("../PHPExcel/Classes/PHPExcel/IOFactory.php");
        $objReader = PHPExcel_IOFactory::createReader('CSV');
        $objReader->setDelimiter(";"); // define que a separação dos dados é feita por ponto e vírgula
        $objReader->setInputEncoding('UTF-8'); // habilita os caracteres latinos.
        $objPHPExcel = $objReader->load('relatorio-exportado.csv'); //indica qual o arquivo CSV que será convertido
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('relatorio-exportado.xls'); // Resultado da conversão; um arquivo do EXCEL 
    }
    header("Location: ../requires/relatorio-exportado.xls");
?>