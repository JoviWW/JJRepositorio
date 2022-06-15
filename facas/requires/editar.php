<?php

    include("../requires/conexao.php");
    
    $id_usuario_editar = $_POST['id_usuario'];
    $resultados = Array();

    if(isset($_POST['nome'])):
        if($_POST['nome'] != ""):
            $nome =  $_POST['nome'];
            $sql = "UPDATE usuario SET nome = '$nome' WHERE codigo = $id_usuario_editar";
            $resultado = mysqli_query($connect,$sql);
            $resultados[] = "Nome alterado com sucesso!";
        endif;
    endif;

    if(isset($_POST['senha'])):
        if($_POST['senha'] != ""):
            $senha = md5($_POST['senha']);
            $sql = "UPDATE usuario SET senha = '$senha' WHERE codigo = $id_usuario_editar";
            $resultado = mysqli_query($connect,$sql);
            $resultados[] = "Senha alterada com sucesso!";
        endif;
    endif;

    if (count($resultados) == 2):
        echo "<script>alert('Nome e Senha alterados com sucesso!');</script>";
    elseif(count($resultados) == 1):
        $print = $resultados[0];
        echo "<script>alert('$print');</script>";
    else: 
        echo "<script>alert('Nenhuma alteração feita');</script>";
    endif;

?>