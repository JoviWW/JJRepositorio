<?php 

    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $dbname = "leilaofaca";

    $connect= mysqli_connect($servidor,$usuario,$senha,$dbname);
    if(!$connect){
        die("Erro de conexão ao BD: ".mysqli_connect_error());
    }

?>