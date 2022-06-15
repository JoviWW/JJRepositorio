<?php
    require("../requires/conexao.php");
    $codigo_faca = $_GET['codigo_faca'];
    $codigo_usuario = $_GET['codigo_usuario'];
    $quantidade_separar = $_GET['quantidade_separar'];
    $resultado = mysqli_query($connect,"CALL ColocarEmLeilao('$quantidade_separar','$codigo_faca','$codigo_usuario')");
    echo $resultado;
    header("Location: ../telas/faca.php?faca=".$codigo_faca);

?>