<?php
    require('conexao.php');
    if(isset($_GET['adicionarestoque'])):
        $codigo_faca = $_GET['codigo_faca'];
        $estoque_atual = $_GET['estoque_atual'];
        $add_estoque = $_GET['add_estoque'];
        $novo_estoque = $estoque_atual + $add_estoque;
        $sql = " UPDATE faca SET estoquedisponivel = '$novo_estoque' WHERE codigo = '$codigo_faca'";
        $resultado = mysqli_query($connect,$sql);
        if($resultado):
            echo "<script>alert('Estoque processado com sucesso!')</script>";
            header('Location: ../telas/faca?faca='.$codigo_faca);
        else:
            echo mysqli_error($connect);
        endif;
    endif;

?>