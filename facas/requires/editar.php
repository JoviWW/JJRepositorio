<?php

    include("../requires/conexao.php");
    
    $id_usuario_editar = $_POST['id_usuario'];
    $resultados = Array();

    if(isset($_POST['nome'])):
        $nome =  $_POST['nome'];
        $sql = "UPDATE usuario SET nome = '$nome' WHERE codigo = $id_usuario_editar";
        $resultado = mysqli_query($connect,$sql);
        $resultados[] = $resultado;
    endif;

    if(isset($_POST['senha'])):
        $senha = md5($_POST['senha']);
        $sql = "UPDATE usuario SET senha = '$senha' WHERE codigo = $id_usuario_editar";
        $resultado = mysqli_query($connect,$sql);
        $resultados[] = $resultado;
    endif;

    if ($resultados[0] && $resultados[1]):
        echo "<script>alert('Edições realizadas com sucesso!');</script>";
    endif;

?>