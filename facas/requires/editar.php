<?php

    include("../requires/conexao.php");

    $erros = Array();

    $autoedit = $_POST['autoedit'];
    $id_usuario_editar = $_POST['id_usuario'];

    $nome =  $_POST['nome'];
    $senha = md5($_POST['senha']);

    $sql = "UPDATE usuario SET nome = '$nome', senha = '$senha' WHERE codigo = $id_usuario_editar";
    $resultado = mysqli_query($connect,$sql);

    if ($resultado):
        echo "<script>alert('Edições realizadas com sucesso!');</script>";
    else:
        echo "<script>alert('Erro em inserir dados');</script>";
    endif;

    if(!empty($erros)):
        foreach($erros as $erro):
            echo $erro;
        endforeach;
    endif;

?>