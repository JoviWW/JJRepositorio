<?php
    session_start();

    if(isset($_SESSION['logado'])):
        if($_SESSION['logado']):
            $nome_usuario = $_SESSION['nome'];
            $admin = $_SESSION['admin'];
        endif;
    endif;

    
?>

<html>
    <head>

        <meta charset="utf-8">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

        <style>
            
            .card-image{
                max-height: 70% !important; 
            }
            
            @media only screen and (max-width: 600px){
                img {
                    height: 50%;
                }
                
                .lul {
                    height: 350px !important
                }
            }
            
            @media only screen and (min-width: 800px) {
                #perfil {
                    margin-right: 18% !important;
                }
                .card-content {
                    padding: 5% 0px 0px 0px;
                }
            }

        </style>
    </head>

    <body>

        <?php include("../requires/header.php")?>
        
        <main style="margin-top: 40px;">

        <?php

            if(isset($_SESSION['logado'])):
                if($_SESSION['logado']):
                    echo "<div>
                            <a id='perfil' class='btn-floating right waves-effect waves-light btn-small black' style='margin-right: 10%' href='perfil.php' ><i class='material-icons'>person</i></a>
                        </div>";
                endif;
            endif;

            
        ?>

            <div id='divpesquisa' style="width: 35%;border-radius: 15px;" class='nav-wrapper container z-depth-1'>

                <form action='$servidor' method='GET'>
					<div class='input-field'>
					  <input style="font-size: 80%;padding: 12px 0px 10px 12% !important;border-radius: 15px;padding: 2px 0px 0px 12%" name='pesquisa' type='search' required>
					  <label style="left: 1%;padding: 7px 0px 10px 0%;" class='label-icon' for='search'><i class='material-icons'>search</i></label>
					  <i class='material-icons'>close</i>
					</div>
					<input name='cozinheiros' type='hidden' value='true'>
                </form>

            </div>

            <?php
                include("../requires/conexao.php");

                $sql = "SELECT * FROM faca ORDER BY estoquedisponivel DESC";
                $resultado = mysqli_query($connect,$sql);
                $facas = Array();
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
                    endif;
                    
                    
				endwhile;
            
            ?>

        </main>
        


    </body>

</html>