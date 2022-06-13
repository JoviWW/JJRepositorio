<?php
    include("../requires/conexao.php");
    $erros = Array();

    $login_pesquisa = $_GET['pesquisa'];
    $id_usuario_logado = $_SESSION['id_usuario'];
    $sql = "SELECT login FROM usuario WHERE codigo = '$id_usuario_logado'";
    $resultado = mysqli_query($connect,$sql);
    
    $tratativa = mysqli_fetch_assoc($resultado);
    $excecao = $tratativa['login'];

    $sql = "SELECT * FROM usuario WHERE login = '$login_pesquisa' AND login != '$excecao'";
    $resultado = mysqli_query($connect,$sql);

    if(mysqli_num_rows($resultado)>0):
        $row = mysqli_fetch_assoc($resultado);
        $login_pesquisa = $row['login'];
        $codigo_pesquisa = $row['codigo'];
        echo "<div class='row container'> 
            <form class='col s12' action='../telas/perfil.php' method='POST'>
                
                <h4 align='center'> Editar usuário $login_pesquisa </h4>
                
                <div class= 'row'>
                    <div class='input-field inline col s6 offset-s3'>
                        <input placeholder='Nome' name='nome' type='text'>
                    </div>
                </div>
                
                <div class='row'>
                    <div class='input-field inline col s6 offset-s3'>
                    <input placeholder='Senha' name='senha' type='password'>
                    </div>
                </div>
                <input name='id_usuario' style='display:none' value='$codigo_pesquisa'>
                <button type='submit' name='editar' class='col s6 offset-s3 btn waves-effect #f57f17 black darken-4'>
                Editar  <i class='material-icons right'>send</i> </button>
            </form>";
    else:
        echo "<div style='display:flex;justify-content:center'> <p style='color:red'> Você está procurando por si mesmo! </p> </div>";
    endif;

?>