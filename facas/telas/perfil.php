

<?php
    session_start();
    if($_SESSION['logado'] != true):
        header('Location: index.php');
    endif;

    $id_usuario = $_SESSION['id_usuario'];
    $nome_usuario = $_SESSION['nome'];
    $admin = $_SESSION['admin'];

    include_once '../requires/header.php';
?>

<?php

	if(isset($_POST['editar'])): //checando se o usuário clicou em Enviar
		require("../requires/editar.php");
	endif;
?>

<html>
    <head>

        <meta charset="utf-8">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    </head>
	
<?php
    include("../requires/conexao.php");
    $sql = "SELECT * FROM usuario WHERE codigo = '$id_usuario'";
    $resultado = mysqli_query($connect,$sql);
    $dados = mysqli_fetch_assoc($resultado);
?>

	<main style="height:500px">
		<div class="row container" style="border:solid 1px;width: 50%;margin-top:15px">
			<form class="col s12" action= "<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
				
				<h4 align="center"> Editar perfil </h4>
				
				<div class="row">
					<div class="input-field inline col s6 offset-s3">
						<input placeholder="Nome" name="nome" type="text" value="<?php echo $dados['nome'];?>">
					</div>
				</div>
				
				<div class="row">
					<div class="input-field inline col s6 offset-s3">
					  <input placeholder="Senha" name="senha" type="password" value="<?php echo $dados['senha'];?>">
					</div>
				</div>
				<input name='autoedit' style='display:none' value='true'>
                <input name='id_usuario' style='display:none' value='<?php echo $dados['codigo'];?>'>
				<button type="submit" name="editar" class="col s6 offset-s3 btn waves-effect #f57f17 black darken-4">
				Editar  <i class="material-icons right">send</i> </button>
			</form>
		</div>


        <?php
            if($admin == 1):
                $servidor = $_SERVER['PHP_SELF'];
                echo "
                <h5 align=center> Editar outros usuários </h5>
                <div id='divpesquisa' style='width: 35%;border-radius: 15px;' class='nav-wrapper container z-depth-1'>

                    <form action='$servidor' method='GET'>
                        <div class='input-field'>
                        <input style='font-size: 80%;padding: 12px 0px 10px 12% !important;border-radius: 15px;padding: 2px 0px 0px 12%' name='pesquisa' type='search' required>
                        <label style='left: 1%;padding: 7px 0px 10px 0%;' class='label-icon' for='search'><i class='material-icons'>search</i></label>
                        <i class='material-icons'>close</i>
                        </div>
                    </form>

                </div>";
            endif;
        ?>

        <?php
            if(isset($_GET['pesquisa'])): //checando se o usuário pesquisou
                require("../requires/pesquisa.php");
            endif;
        ?>
	</main>

</html>
	