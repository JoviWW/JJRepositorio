

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
						<input placeholder="Nome" name="nome" type="text">
					</div>
				</div>
				
				<div class="row">
					<div class="input-field inline col s6 offset-s3">
					  <input placeholder="Senha" name="senha" type="password">
					</div>
				</div>
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

                <form action='$servidor' method='GET'>
                    <div style='display:flex;justify-content:center;'>
                        <input autocomplete='on' name='pesquisa' id='select' style='text-align:center' type='list' list='opcoes' placeholder='Selecione o usuário'>
                        <datalist id='opcoes'>";
                        $sql = "SELECT * FROM usuario where codigo != $id_usuario";
                        $resultado = mysqli_query($connect,$sql);
                        while ($row = mysqli_fetch_assoc($resultado)):

                            $nome_pesquisa = $row['nome'];
                            $codigo_pesquisa  = $row['codigo'];
                            $login_pesquisa = $row['login'];
            
                            echo "<option value='$login_pesquisa'>$nome_pesquisa</option>";
                        endwhile;
                    echo "</datalist>";
                    echo"
                    </div>
                </form>";
                    
                    if(isset($_POST['editar'])): //checando se o usuário clicou em editar
                        require("../requires/editar.php");
                    endif;
                    echo"
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
	