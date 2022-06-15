<?php
    include("../requires/conexao.php");
    $sql = "SELECT * FROM faca WHERE estoquedisponivel != 0 ORDER BY estoquedisponivel DESC";
    $resultado = mysqli_query($connect,$sql);
    while ($row = mysqli_fetch_assoc($resultado)):
        $codigo_faca_atual = $row['codigo'];
        $nome_faca_atual = $row['nome'];
        $img_faca_atual = $row['img'];
        $lanceInicial_faca_atual = $row['lanceInicial'];
        $permitir_planceinicial_faca_atual = $row['permitir_planceinicial'];
        if($permitir_planceinicial_faca_atual == 1):
            $permitir_planceinicial_faca_atual = 'SIM';
        else:
            $permitir_planceinicial_faca_atual = "NÃO";
        endif;

        if(isset($_SESSION['logado'])):
            if($_SESSION['logado']):
                echo "
                    <div class='row container'>
                        <div class='row'>
                            <div style='width: 50%;margin-left: 25%;' class='col s12 m7'>
                                <div style='height: 470px;' class='card medium lul'>
                                    <div class='card-image' style='max-height: 50%;'>
                                        <img style='max-height: 500px;'src='$img_faca_atual'>
                                    </div>
                                    <div style='text-align:center;padding: 5px 0px 0px 0px;' class='card-content'>
                                        <span style='font-size:110%;color:black;width: 100%;text-align:center;''>$nome_faca_atual</span>
                                        <p style='color:green'>R$$lanceInicial_faca_atual</p>
                                        <p style='font-size: 85%;'>Oferta sem lance inicial? $permitir_planceinicial_faca_atual </p>
                                    </div>
                                    <div class='card-action'>
                                        <a class='right' style='color:gray' href='faca.php?faca=$codigo_faca_atual'> Acesse ➤ </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    ";
            else:
                echo "
                    <div class='row container'>
                        <div class='row'>
                            <div style='width: 50%;margin-left: 25%;' class='col s12 m7'>
                                <div style='height: 470px;' class='card medium lul'>
                                    <div class='card-image' style='max-height: 50%;'>
                                        <img style='max-height: 50%;'src='$img_faca_atual'>
                                    </div>
                                    <div style='text-align:center;padding: 5% 0px 0px 0px;' class='card-content'>
                                        <span style='font-size:110%;color:black;width: 100%;text-align:center;''>$nome_faca_atual</span>
                                        
                                    </div>
                                    <div class='card-action'>
                                        <a class='right' style='color:gray' href='faca.php?faca=$codigo_faca_atual'> Acesse ➤ </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    ";
            endif;
        else:
            echo "
            <div class='row container'>
                <div class='row'>
                    <div style='width: 50%;margin-left: 25%;' class='col s12 m7'>
                        <div style='height: 470px;' class='card medium lul'>
                            <div class='card-image' style='max-height: 50%;'>
                                <img style='max-height: 50%;'src='$img_faca_atual'>
                            </div>
                            <div style='text-align:center;padding: 5% 0px 0px 0px;' class='card-content'>
                                <span style='font-size:110%;color:black;width: 100%;text-align:center;''>$nome_faca_atual</span>
                    
                            </div>
                            <div class='card-action'>
                                <a class='right' style='color:gray' href='faca.php?faca=$codigo_faca_atual'> Acesse ➤ </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            ";
        endif;
        
        
    endwhile;

?>