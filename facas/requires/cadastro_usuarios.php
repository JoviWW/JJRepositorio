<?php

    include("../requires/conexao.php");

    $erros = Array();

    $nome =  $_POST['nome'];
    $login = $_POST['login'];
    $senha = mysqli_escape_string($connect, md5($_POST['senha']));
    $admin = $_POST['admin'];
        
    if(empty($login) or empty($senha) or empty($nome) or empty($admin)):
        $erros[] = "<script>alert('Todos os campos são obrigatórios: $nome,$login,$senha,$admin');</script>";
    else:
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
            $senha = md5($senha);
            $sql = "INSERT INTO usuario (nome,login,senha,admin) VALUES ('$nome','$login','$senha','$admin')";
            $resultado = mysqli_query($connect,$sql);
            if ($resultado):
                echo "<script>alert('Cadastro realizado!');</script>";
                mysqli_close();
                header('Location: ../telas/index.php');
            else:
                echo "<script>alert('Erro em inserir dados');</script>";
            endif;
        endif;
    endif;

    if(!empty($erros)):
        foreach($erros as $erro):
            echo $nome;
            echo $login;
            echo $senha;
            echo $admin;
            echo $erro;
        endforeach;
    endif;

?>