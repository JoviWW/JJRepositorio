<?php
    include("../requires/conexao.php");
    if($_POST):
        echo "<pre>";
        print_r($_POST);
        echo "</pre>";
        $codigo_faca = $_POST['codigo_faca'];
        $codigo_usuario = $_POST['codigo_usuario'];
        $result = mysqli_query($connect,"CALL getFacasEmProcessamentoUsuario('$codigo_faca','$codigo_usuario')");
        print_r($result);
        while ($row = mysqli_fetch_assoc($result)):
            $codigo = $row['codigo'];
            if(isset($_POST["baixa".$codigo])):
                $baixa = $_POST["baixa".$codigo];
                if($baixa == 'confirma'):
                    if(isset($_POST["comprador".$codigo]) and isset($_POST["valor_venda".$codigo])):
                        $baixa = $_POST["baixa".$codigo];
                        $codigo_processamento = $_POST["codigo".$codigo];
                        $comprador_processamento = $_POST["comprador".$codigo];
                        $valor_venda = $_POST["valor_venda".$codigo];
                        if (isset($_POST["obs".$codigo])):
                            $obs = $_POST["obs".$codigo];
                        else:
                            $obs = "";
                        endif;
                        $resultado = mysqli_query($connect,"CALL ConfirmarCompra('$codigo_processamento','$comprador_processamento','$valor_venda','$obs')");
                    endif;
                elseif($baixa == 'cancela'):
                    $codigo_processamento = $_POST["codigo".$codigo];
                    $resultado = mysqli_query($connect,"CALL cancelarBaixa('$codigo_processamento','$codigo_faca')");
                    echo mysqli_error($connect);
                    print_r($resultado);
                endif;
            endif;
            
        endwhile;
    else:
        echo "Sem info";
    endif;
?>