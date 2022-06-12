<?php
    include("../requires/conexao.php");
    $erros = Array();

    $nome = $_GET['pesquisa'];
    $sql = "SELECT codigo,login,nome,senha FROM usuario WHERE nome LIKE '%$nome%'";
    $resultado = mysqli_query($connect,$sql);

    if(mysqli_num_rows($resultado) > 0):
        $dados_pesquisa = mysqli_fetch_assoc($resultado);

        $codigo_pesquisa = $dados_pesquisa['codigo'];
        $nome_pesquisa = $dados_pesquisa['nome'];
        $login_pesquisa = $dados_pesquisa['login'];
        $senha_pesquisa = $dados_pesquisa['senha'];

        echo "
        <div class='row container'> 
            <form class='col s12' action='/facas/telas/perfil.php' method='POST'>
				
				<h4 align='center'> Editar usuário $login_pesquisa </h4>
				
				<div class= 'row'>
					<div class='input-field inline col s6 offset-s3'>
						<input placeholder='Nome' name='nome' type='text' value='$nome_pesquisa'>
					</div>
				</div>
				
				<div class='row'>
					<div class='input-field inline col s6 offset-s3'>
					  <input placeholder='Senha' name='senha' type='password' value='$senha_pesquisa'>
					</div>
				</div>
                <input name='autoedit' style='display:none' value='false'>
                <input name='id_usuario' style='display:none' value='$codigo_pesquisa'>
				<button type='submit' name='editar' class='col s6 offset-s3 btn waves-effect #f57f17 black darken-4'>
				Editar  <i class='material-icons right'>send</i> </button>
			</form>
        </div>";
    else:
        echo "<script>alert('Erro em pesquisar dados');</script>";
    endif;

?>