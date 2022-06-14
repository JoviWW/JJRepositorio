<?php
include("../requires/conexao.php");
echo $resultado = mysqli_query($connect,"CALL ColocarEmLeilao(15,1,2,1)");
echo "teste";
?>