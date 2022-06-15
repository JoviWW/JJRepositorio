

<?php
    session_start();

    if(!isset($_SESSION['logado'])):
        header('Location: index.php');
    endif;

    $nome_usuario = $_SESSION['nome'];
    $admin = $_SESSION['admin'];

    if($admin == 0):
        header('Location: index.php');
    endif;

    include_once '../requires/header.php';
?>

<?php

	if(isset($_POST['cadastrar'])): //checando se o usuário clicou em Enviar
		require("../requires/cadastro_usuarios.php");
	endif;
?>

<html>
    <head>

        <meta charset="utf-8">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    </head>
	
	<main style="margin-top: 100px">
		<div class="row container">
			<form class="col s12" action= "<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
				
				<h4 align="center"> Cadastro de Usuário </h4>
				
				<div class="row">
					<div class="input-field inline col s6 offset-s3">
						<input placeholder="Nome" name="nome" type="text">
					</div>
				</div>
				
				
				<div class="row">
					<div class="input-field inline col s6 offset-s3">
						<input placeholder="Login" name="login" type="text">
					</div>
				</div>
				
				<div class="row">
					<div class="input-field inline col s6 offset-s3">
					  <input placeholder="Senha" name="senha" type="password">
					</div>
				</div>

                <div class="row" style="display: flex;flex-wrap: wrap;flex-direction: column;align-content: center;">
					<div class="input-field inline col s6" style="text-align: center;">
						<span> Usuário administrador? </span><br>
                        <input name="admin" type="radio" style="height:11px;position: relative;opacity: 1;pointer-events: all;" value="sim"> Sim 
                        <input name="admin" type="radio" style="height:11px;position: relative;opacity: 1;pointer-events: all;"  value="nao"> Não
					</div>
				</div>
				
				<button type="submit" name="cadastrar" class="col s6 offset-s3 btn waves-effect #f57f17 black darken-4">
				Cadastrar  <i class="material-icons right">send</i> </button>
			</form>
		</div>
	</main>

</html>
	