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
            
            #divulgacao{
                max-width: 115px;
                width: 100%;
                margin-left: 910px;
                z-index: 9998;
                position: fixed;
                text-align: center;
            }
            
            .card-image{
                max-height: 70% !important; 
            }
            
            @media only screen and (max-width: 600px){
                #divulgacao{
                    width: 80px;
                    margin-left: 260px !important;
                    font-size: 10px !important;
                }

                img {
                    height: 50%;
                }

                #flutuante{
                    margin-left: 100px;
                }
                
                .lul {
                    height: 350px !important
                }
            }
            
            @media only screen and (min-width: 800px) {
                #flutuante{
                    margin-top: 20px;
                    margin-left: 200px !important;
                }
                .card-content {
                    padding: 5% 0px 0px 0px;
                }
            }

        </style>
    </head>

    <body>

        <?php include("../requires/header.php")?>
        
        <main style="margin-top: 100px;">

        <div id="transp" style="margin-top: -100px;opacity : 0.5;position: fixed;z-index:9999;height:100%;width:100%;background-color: rgb(0, 0, 0);"> </div>
        <?php 
            if(isset($_SESSION['logado'])):
                if($_SESSION['logado']):
                    if($admin == 1):
                            echo "<div id='popup2' style='margin-top: -60px;left:2%;position: fixed;z-index:9999;height:400px;width:95%;background-color: rgb(255, 255, 255);'>
                            <button style='cursor:pointer;border:none;margin: 20px;color: black;padding-top: 0;' onclick='fechar2()'class='right btn-tiny white'> <i class= 'material-icons' > close </i> </button>
                            <div id='content' style='margin-top: 20px;'>
                                <div style='font-size: 105%;margin-left:10%' class='center'> Facas em leilão </div>
            
                                <div style='width: 100%;max-height: 65%;overflow-x:hidden'>
                                <form action='../requires/darbaixa.php' method='POST'>";
                                require("../requires/conexao.php");
                                $result = mysqli_query($connect,'SELECT * FROM `operacao` WHERE concluida = 0');
                                if(mysqli_num_rows($result) > 0):
                                    $resultado  = mysqli_query($connect,"CALL getFacasEmProcessamentoUsuario('$codigo_faca','$codigo_usuario')");
                                    while ($row = mysqli_fetch_assoc($resultado)):
                                    $codigo = $row['codigo'];
                                    $data = $row['data_inicioBaixa'];
                                    echo "
                                        <div style='width:100%'>
                                            <div style='border:solid;border-width:1px;width:80%;margin-left:10%;height: 25%;'> 
                                                <div class='left'style='border:solid;border-width:1px;height: 60px;width: 60px;margin: 1.7% 2% 0% 2%;'> <img style='width: 100%;height: 100%;' src='$img'> </div>
                                                
                                                    <div>
                                                        <p style='font-size: 80%;margin: 5px 0px 0px 17%;'> Processamento #$codigo ($data) </p>
                                                        <input name='codigo_usuario' value='$codigo_usuario' style='display:none'>
                                                        <input name='codigo_faca' value='$codigo_faca' style='display:none'>
                                                        <input name='codigo$codigo' value='$codigo' style='display:none'>
                                                        <input name='comprador$codigo' style='font-size: 50%;width: 13%;height: 25%; margin: 5px' placeholder='Nome do comprador'>
                                                        <input name='valor_venda$codigo' style='font-size: 50%;width: 13%;height: 25%; margin: 5px' placeholder='Valor da venda'>
                                                        <input name='obs$codigo' style='font-size: 50%;width: 13%;height: 25%; margin: 5px' placeholder='Obs (opcional)'>
                                                        <ul style='margin: 0% 5% 0px 0px;' class='right'>
                                                            <li> <input style='position: relative;opacity: 1;pointer-events: all;' type='radio' name='baixa$codigo' value='confirma'>  <i class= 'tiny material-icons'> check </i> </li>
                                                            <li> <input style='position: relative;opacity: 1;pointer-events: all;' type='radio' name='baixa$codigo' value='cancela'>  <i class= 'tiny material-icons'> close </i> </li>
                                                        </ul>
                                                    </div>
                                                
                                            </div>
                                        </div> ";
                                    endwhile;
                                endif;
                                echo "
                                <div style='display:flex;justify-content:center;' > 
                                 <button type='submit' class='btn' style='border-radius: 5%;color: white;background-color:black'> Confirmar </button>
                                 </div>
                             </div>
                                 
                             </div>
                            
                            </form>
                         </div>";
                    endif;
                endif;
            endif;
        ?>
        <div name='conteudo'>
            <div id='divulgacao'>
                 Conheça nosso grupo de leilão!<br><a href="#">Clique aqui</a>
            </div>
        <?php

            if(isset($_SESSION['logado'])):
                if($_SESSION['logado']):
                    echo "<div id='flutuante'style='margin-top:-20px;margin-left: 40px;position: fixed;height: 70px;'>
                            <ul> <a class='btn-floating right waves-effect waves-light btn-small black' style='margin-right: 10%' href='perfil.php' ><i class='material-icons'>person</i></a></ul>";
                    if($admin == 1):
                        echo "
                        <br><ul><a onclick='processamentos()' class='btn-floating right waves-effect waves-light btn-small black' style='margin-right: 10%' ><i class='material-icons'>art_track</i></a></ul>
                        </div>";
                    endif;
                    echo "</div>";
                    
                endif;
            endif;


            ?>
            <div id='divpesquisa' style="width: 35%;border-radius: 15px;" class='nav-wrapper container z-depth-1'>

                <form action="<?php echo $_SERVER['PHP_SELF']?>" method='GET'>
					<div class='input-field'>
					  <input style="font-size: 80%;padding: 12px 0px 10px 25px !important;border-radius: 15px" name='pesquisa' type='search' required>
					  <label style="left: 1%;padding: 10px 0px 10px 0%;" class='label-icon' for='search'><i style='font-size: 20px'class='material-icons'>search</i></label>
					</div>
                </form>

            </div>
            <?php
                
                if(!$_GET):
                    include("../requires/facas_index.php");
                else:
                    include("../requires/pesquisa_home.php");
                endif;
            
            ?>
        </div>
        </div>
        </main>
        


    </body>

</html>

<script>
    document.getElementById("transp").style.visibility = "hidden"
    document.getElementById("popup2").style.visibility = "hidden"

    /// Popup de dar baixa /// 
    function processamentos(){
            document.getElementById("transp").style.visibility = "visible"
            document.getElementById("popup2").style.visibility = "visible"
        }

        function fechar2(){
            document.getElementById("transp").style.visibility = "hidden"
            document.getElementById("popup2").style.visibility = "hidden"
        }
</script>