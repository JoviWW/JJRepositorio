<?php
    include("../requires/conexao.php");
    $erros = Array();

    $login_pesquisa = $_GET['pesquisa'];
    $id_usuario_logado = $_SESSION['id_usuario'];
    $sql = "SELECT login FROM usuario WHERE codigo = '$id_usuario_logado'";
    $resultado = mysqli_query($connect,$sql);
    
    $tratativa = mysqli_fetch_assoc($resultado);
    $excecao = $tratativa['login'];

    $sql = "SELECT * FROM usuario WHERE login = '$login_pesquisa'";
    $resultado = mysqli_query($connect,$sql);

    if(mysqli_num_rows($resultado)>0):
        $row = mysqli_fetch_assoc($resultado);
        $login_pesquisa = $row['login'];
        $codigo_pesquisa = $row['codigo'];
        $servidor = $_SERVER['PHP_SELF'];
        echo "<div class='row container' style='margin-right: auto; margin-left: auto;'> 
            <form class='col s12' action='$servidor' method='POST'>
                
                <h4 align='center'> Editar usuário $login_pesquisa </h4>
                
                <div class= 'row'>
                    <div class='input-field inline col s6 offset-s3'>
                        <input style='width:65%' placeholder='Nome' name='nome' type='text'>
                    </div>
                </div>
                
                <div class='row'>
                    <div class='input-field inline col s6 offset-s3'>
                    <input  style='width:65%' placeholder='Senha' name='senha' type='password'>
                    </div>
                </div>
                <input name='id_usuario' style='display:none' value='$codigo_pesquisa'>
                <button style='color:white'type='submit' name='editar' class='col s4 offset-s4 btn waves-effect #f57f17 black darken-4'>
				Editar  </button>
            </form>";
    else:
         if($login_pesquisa == $excecao):
        echo "<div style='display:flex;justify-content:center'> <p style='color:red'> Você está procurando por si mesmo! </p> </div>";
        else:
            echo "<div style='display:flex;justify-content:center'> <p style='color:red'> Login digitado inválido! </p> </div>";
        
    endif;
    endif;

?>