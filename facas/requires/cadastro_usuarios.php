<?php

    include("../requires/conexao.php");

    $erros = Array();
        
    if(!isset($_POST['login']) or !isset($_POST['senha']) or !isset($_POST['nome']) or !isset($_POST['admin'])):
        echo "<script>alert('Todos os campos são obrigatórios');</script>";
    else:

        $login = $_POST['login'];
        $senha = md5($_POST['senha']);
        $nome = $_POST['nome'];
        $admin = $_POST['admin'];

        $sql = "SELECT codigo FROM usuario WHERE login = '$login'";
        $resultado = mysqli_query($connect, $sql);

        if(mysqli_num_rows($resultado) == 1):
            $erros[] = "<script>alert('O login $login já está cadastrado');</script>";
        else:
            if($admin == 'sim'):
                $admin = 1;
            else:
                $admin = 0;
            endif;
            $sql = "INSERT INTO usuario (nome,login,senha,admin) VALUES ('$nome','$login','$senha','$admin')";
            $resultado = mysqli_query($connect,$sql);
            if ($resultado):
                echo "<script>alert('Cadastro realizado!');</script>";
                mysqli_close();
                header('Location: ../telas/index.php');
            endif;
        endif;
    endif;

?>