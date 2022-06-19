<?php
    require("../requires/conexao.php");
    $codigo_faca = $_GET['codigo_faca'];
    $codigo_usuario = $_GET['codigo_usuario'];
    $quantidade_separar = $_GET['quantidade_separar'];
    $permitir_lanceinicial = $_GET['permitir_planceinicial'];
  
    if ($permitir_lanceinicial == 1){
       
        $lanceinicial = $_GET['resposta'];
        echo $lanceinicial;
        if ($lanceinicial == 'sim'){
            $resultado = mysqli_query($connect,"CALL ColocarEmLeilaoLI('$quantidade_separar','$codigo_faca','$codigo_usuario', '0')");

        } else {
            $resultado = mysqli_query($connect,"CALL ColocarEmLeilao('2','$codigo_faca','$codigo_usuario')");
        }
    }else{

        $resultado = mysqli_query($connect,"CALL ColocarEmLeilao('$quantidade_separar','$codigo_faca','$codigo_usuario')");
    }

    header("Location: ../telas/faca.php?faca=".$codigo_faca);

?>