<?php 

    include("../requires/conexao.php");

    $erros = Array();
            
    $login = $_POST['login'];
    $senha = mysqli_escape_string($connect, $_POST['senha']);

    if(empty($login) or empty($senha)):
        $erros[] = "<script>alert('O campo login/senha precisa ser preenchido');</script>";
    else:
        $sql = "SELECT login FROM usuario WHERE login = '$login'";
        $resultado = mysqli_query($connect, $sql);
        
        if(mysqli_num_rows($resultado) > 0):
            
            $senha = md5($senha);
            $sql = "SELECT * FROM usuario WHERE login = '$login' AND senha = '$senha'";
            $resultado = mysqli_query($connect,$sql);
            
            if (mysqli_num_rows($resultado) == 1):
                $dados = mysqli_fetch_assoc($resultado); //transformando o resultado sql em um array para $dados
                mysqli_close();
                $_SESSION['logado'] = true;
                $_SESSION['admin'] = $dados['admin'];
                $_SESSION['nome'] = $dados['nome'];
                $_SESSION['id_usuario'] = $dados['codigo'];
                header('Location: ../telas/index.php');
            else:
                $erros[] = "<script>alert('Usuário e senha não conferem');</script>";
            endif;
            
        else:
            $erros[] = "<script>alert('Usuário inexiste');</script>";
        endif;
    endif;

    if(!empty($erros)):
        foreach($erros as $erro):
            echo $erro;
        endforeach;
    endif;
?>