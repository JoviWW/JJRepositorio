<?php
    require("../requires/conexao.php");
    
    session_start();

    if(isset($_SESSION['logado'])):
        if($_SESSION['logado']):
            $nome_usuario = $_SESSION['nome'];
            $admin = $_SESSION['admin'];
        endif;
    endif;

    if(!empty($_GET['faca'])){
        $codigo_faca = $_GET['faca'];
        $sql = "SELECT * FROM faca WHERE codigo = '$codigo_faca'";
        $resultado = mysqli_query($connect,$sql);
        if($resultado){
            $dados_faca = mysqli_fetch_assoc($resultado);
        }
        else{
            mysqli_error($connect);
        }
    }
    else{
        header('Location: index.php');
    }

?>

<html>

    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script id="_carbonads_projs" type="text/javascript" src="https://srv.carbonads.net/ads/CKYIK27J.json?segment=placement:materializecss&amp;callback=_carbonads_go"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    </head>

    <body>

        <div id="transp" style="opacity : 0.5;position: fixed;z-index:9998;height:100%;width:100%;background-color: rgb(0, 0, 0);"> </div>

        <?php include("../requires/header.php")?>
        
        <main style="margin-top: 40px">

            <!-- POPUP -->
            <?php
            $img = $dados_faca['img'];
            $nome_faca = $dados_faca['nome'];
            $lanceInicial_faca = $dados_faca['lanceInicial'];
            $estoquedisponivel_faca = $dados_faca['estoquedisponivel'];
            $descricao_faca = $dados_faca['descricao'];
            $linkFotos_faca = $dados_faca['linkFotos'];
            $permitir_planceinicial_faca = $dados_faca['permitir_planceinicial'];
                if(isset($_SESSION['logado'])):
                    if($_SESSION['logado']):
                       echo "<div id='popup1' style='margin-top: -60px;left:2%;position: fixed;z-index:9999;height:400px;width:95%;background-color: rgb(255, 255, 255);'>
                       <button style='cursor:pointer;border:none;margin: 4px;color: black;padding-top: 0;' onclick='fechar1()'class='right btn-tiny white'> <i class= 'material-icons' > close </i> </button>
                       <div style='display:flex;justify-content:center'>
                           <form id='form1'style=';width:100%;display: flex;max-width: 409px;flex-direction: row;justify-content: center;height: 100%'>
                               <div id='content' style='margin-top: 20px;width:100%; max-width:400px;text-align:center'>
       
                                   <div style=' border:solid;border-width: 1px;height: 120px;width: 100px;' class='left'> <img style='width: 100%;height: 100%;' src='$img'> </div>
               
                                   <div style='padding-left: 35%; padding-top: 5%;'>
                                       <span style='font-size: 90%'>Em estoque: $estoquedisponivel_faca</span><br>
                                       <input style='height: 7%;font-size: 10px;width: 57%;text-align: center;' placeholder='Quantidade para leiloar'><br>
                                       ";
                                           if($permitir_planceinicial_faca == 1){
                                               echo "<span style='font-size: 80%'>Ofertar sem lance inicial: R$$lanceInicial_faca</span><br>
                                               <input onclick='changeDescSim()' style='height:11px;position: relative;opacity: 1;pointer-events: all;'type='radio' name='resposta' value='sim'> Sim 
                                               <input onclick='changeDescNao()' style='height:11px;position: relative;opacity: 1;pointer-events: all;'type='radio' name='resposta' value='nao'> Não";
                                           }
                                            endif;
                                       
                                    echo"   
                                   </div>
                                   <br>
                                   <div>
                                       <textarea id='desc' style='resize: none;font-size:10px; max-width: 400px;height: 190px; word-wrap: break-word; overflow-x:auto;'>";
                                           echo str_replace("            ","",$descricao_faca);
                                       echo "</textarea>
                                       <br>
                                       <div style='padding-top: 10px'>
                                           <button onclick='copiarDesc()' type='submit' class='right btn' style='border-radius: 5%;color: white;background-color:black'> Confirmar </button>    
                                       </div>
                                       
                                   </div>
               
                               </div>
                           </form> 
                       </div>   
                   </div>
       
                   <!-- POPUP 2 -->
       
                   <div id='popup2' style='margin-top: -60px;left:2%;position: fixed;z-index:9999;height:400px;width:95%;background-color: rgb(255, 255, 255);'>
                       <button style='cursor:pointer;border:none;margin: 20px;color: black;padding-top: 0;' onclick='fechar2()'class='right btn-tiny white'> <i class= 'material-icons' > close </i> </button>
                       <div id='content' style='margin-top: 20px;'>
                           <div style='font-size: 105%;margin-left:10%' class='center'> Facas em leilão </div>
       
                           <div style='width: 100%;max-height: 65%;overflow-x:hidden'> 
       
                               <div style='width:100%'>
                                   <div style='border:solid;border-width:1px;width:80%;margin-left:10%;height: 25%;'> 
                                       <div class='left'style='border:solid;border-width:1px;height: 60px;width: 60px;margin: 1.7% 2% 0% 2%;'> <img style='width: 100%;height: 100%;' src='$img'> </div>
                                       <form>
                                           <div>
                                               <p style='font-size: 80%;margin: 5px 0px 0px 17%;'> Processamento #01 </p>
                                               <input style='font-size: 50%;width: 13%;height: 25%; margin: 5px' placeholder='Nome do comprador'>
                                               <input style='font-size: 50%;width: 13%;height: 25%; margin: 5px' placeholder='Valor da venda'>
                                               <input style='font-size: 50%;width: 13%;height: 25%; margin: 5px' placeholder='Obs (opcional)'>
                                               <ul style='margin: 0% 5% 0px 0px;' class='right'>
                                                   <li> <button value='confirma' type='submit' style='cursor: pointer;border:none;background-color:white'> <i class= 'tiny material-icons'> check </i> </button> </li>
                                                   <li> <button value='cancela' type='submit' style='cursor: pointer;border:none;background-color:white'> <i class= 'tiny material-icons'> close </i> </button> </li>
                                               </ul>
                                           </div>
                                       </form>
                                   </div>
                               </div>
           
                               <div style='width:100%'>
                                   <div style='border:solid;border-width:1px;width:80%;margin-left:10%;height: 25%;'> 
                                       <div class='left'style='border:solid;border-width:1px;height: 60px;width: 60px;margin: 1.7% 2% 0% 2%;'> <img style='width: 100%;height: 100%;' src='$img'> </div>
                                       <form>
                                           <div>
                                               <p style='font-size: 80%;margin: 5px 0px 0px 17%;'> Processamento #01 </p>
                                               <input style='font-size: 50%;width: 13%;height: 25%; margin: 5px' placeholder='Nome do comprador'>
                                               <input style='font-size: 50%;width: 13%;height: 25%; margin: 5px' placeholder='Valor da venda'>
                                               <input style='font-size: 50%;width: 13%;height: 25%; margin: 5px' placeholder='Obs (opcional)'>
                                               <ul style='margin: 0% 5% 0px 0px;' class='right'>
                                                   <li> <button value='confirma' type='submit' style='cursor: pointer;border:none;background-color:white'> <i class= 'tiny material-icons'> check </i> </button> </li>
                                                   <li> <button value='cancela' type='submit' style='cursor: pointer;border:none;background-color:white'> <i class= 'tiny material-icons'> close </i> </button> </li>
                                               </ul>
                                           </div>
                                       </form>
                                   </div>
                               </div>
       
                               <div style='width:100%'>
                                   <div style='border:solid;border-width:1px;width:80%;margin-left:10%;height: 25%;'> 
                                       <div class='left'style='border:solid;border-width:1px;height: 60px;width: 60px;margin: 1.7% 2% 0% 2%;'> <img style='width: 100%;height: 100%;' src='$img'> </div>
                                       <form>
                                           <div>
                                               <p style='font-size: 80%;margin: 5px 0px 0px 17%;'> Processamento #01 </p>
                                               <input style='font-size: 50%;width: 13%;height: 25%; margin: 5px' placeholder='Nome do comprador'>
                                               <input style='font-size: 50%;width: 13%;height: 25%; margin: 5px' placeholder='Valor da venda'>
                                               <input style='font-size: 50%;width: 13%;height: 25%; margin: 5px' placeholder='Obs (opcional)'>
                                               <ul style='margin: 0% 5% 0px 0px;' class='right'>
                                                   <li> <button value='confirma' type='submit' style='cursor: pointer;border:none;background-color:white'> <i class= 'tiny material-icons'> check </i> </button> </li>
                                                   <li> <button value='cancela' type='submit' style='cursor: pointer;border:none;background-color:white'> <i class= 'tiny material-icons'> close </i> </button> </li>
                                               </ul>
                                           </div>
                                       </form>
                                   </div>
                               </div>
       
                               <div style='width:100%'>
                                   <div style='border:solid;border-width:1px;width:80%;margin-left:10%;height: 25%;'> 
                                       <div class='left'style='border:solid;border-width:1px;height: 60px;width: 60px;margin: 1.7% 2% 0% 2%;'> <img style='width: 100%;height: 100%;' src='$img'> </div>
                                       <form>
                                           <div>
                                               <p style='font-size: 80%;margin: 5px 0px 0px 17%;'> Processamento #01 </p>
                                               <input style='font-size: 50%;width: 13%;height: 25%; margin: 5px' placeholder='Nome do comprador'>
                                               <input style='font-size: 50%;width: 13%;height: 25%; margin: 5px' placeholder='Valor da venda'>
                                               <input style='font-size: 50%;width: 13%;height: 25%; margin: 5px' placeholder='Obs (opcional)'>
                                               <ul style='margin: 0% 5% 0px 0px;' class='right'>
                                                   <li> <button value='confirma' type='submit' style='cursor: pointer;border:none;background-color:white'> <i class= 'tiny material-icons'> check </i> </button> </li>
                                                   <li> <button value='cancela' type='submit' style='cursor: pointer;border:none;background-color:white'> <i class= 'tiny material-icons'> close </i> </button> </li>
                                               </ul>
                                           </div>
                                       </form>
                                   </div>
                               </div>
       
                           </div>
                           
       
                       </div>
                       
                   </div>";
                endif;
            ?>
            

            <!-- FIM DO POPUP -->

            <div class="row container">
                <div class="row">
                    
                    <div class="col s12" style="display: flex;flex-direction: row;flex-wrap: nowrap;justify-content: center;">
                        <br>
                        <div style="box-shadow: 7px 7px 17px 0px rgb(240 240 240);height: 210px; width: 210px;" class="left"> <img style="width: 100%;height: 100%;" src="<?php echo $img?>">  </div>
                        <div style="margin-top: -2%;border-radius: 2%;height: 220px; width: 58%;" class="right"> 
                            <h5 style="font:revert;font-size:120%;padding-left: 6%;"> <?php echo $nome_faca;?> </h5>
                            <p style="font-size:10px;margin-left: 6%;padding-left: 1%; max-width: 98%; height: 58%; word-wrap: break-word; overflow-x:auto;">
                                <?php
                                    if(isset($_SESSION['logado'])):
                                        if($_SESSION['logado']):
                                            
                                            $desc = str_replace("\r\n","<br>",$descricao_faca);
                                            echo $desc;
                                        else:
                                            $desc = str_replace("*Lance Inicial:R$$lanceInicial_faca*","",$descricao_faca);
                                            $desc = str_replace("\r\n","<br>",$desc);
                                            echo $desc;
                                        endif;
                                        
                                    else:
                                        $desc = str_replace("*Lance Inicial:R$$lanceInicial_faca*","",$descricao_faca);
                                        $desc = str_replace("\r\n","<br>",$desc);
                                        echo $desc;
                                    endif;
                                    
                                ?>
                            </p>
                            <?php
                            if(isset($_SESSION['logado'])):
                                if($_SESSION['logado']):
                                    echo "<h6 style='font:revert;font-size:110%;padding-left: 6%;'> Lance inicial: R$$lanceInicial_faca</h6>";
                                endif;
                            endif;
                            ?>
                        </div>
                    </div>
                    <?php 
                    if(isset($_SESSION['logado'])):
                        if($_SESSION['logado']):
                            echo "
                    <div style='border-radius: 2%;height: 100px;margin-top:12px;' class='col s12'>
                        <div style='width: 40%;font-size: 17px;text-align: center;' class='left'>";
                            
                            if($admin == 1):
                                echo "<form action='../requires/adicionar_estoque.php' method='GET'>
                                    <span style='font-size:70%;padding-right: 6px ;'>Em estoque: $estoquedisponivel_faca </span><br>
                                    <input style='text-align:center;font-size: 14px; height:20px;width: 30%;' name='add_estoque' placeholder='valor'>
                                    <input style='display:none' name='codigo_faca' value='$codigo_faca'>
                                    <input style='display:none' name='estoque_atual' value='$estoquedisponivel_faca'>
                                    <button class='btn-floating btn-small grey' type='submit' name='adicionarestoque'> <i style='font-size: 15px' class= 'small material-icons'> add </i> </button>
                                    </form>";
                            endif;
                            echo "<button onclick='popup2()' class='btn white' style='color:black;margin-top: 12px;'> Dar baixa </button>
                        </div>
                        
                        <br>
                        <br>
                        
                        <div class='right'> 
                            <div onclick='popup1()' style='background-color: grey;color:black;' class='btn white'>
                                Separar estoque ➢
                            </div>
                            <div style='margin-top:15px'>

                            <a style='font-size:70%;color:black' class='btn white' href='$linkFotos_faca'> Link Google Fotos </a>

                            </div>
                        </div>";
                        endif;
                    endif;
                        
                        ?>
                        
                    </div>
                </div>
            </div>

        </main>

    </body>

    <script>
        
        
        
        document.getElementById("transp").style.visibility = "hidden"
        document.getElementById("popup1").style.visibility = "hidden"
        document.getElementById("popup2").style.visibility = "hidden"

        /// Popup do leilão /// 
        function popup1(){
            document.getElementById("transp").style.visibility = "visible"
            document.getElementById("popup1").style.visibility = "visible"
        }

        function fechar1(){
            document.getElementById("transp").style.visibility = "hidden"
            document.getElementById("popup1").style.visibility = "hidden"
        }

        /// Popup de dar baixa /// 
        function popup2(){
            document.getElementById("transp").style.visibility = "visible"
            document.getElementById("popup2").style.visibility = "visible"
        }

        function fechar2(){
            document.getElementById("transp").style.visibility = "hidden"
            document.getElementById("popup2").style.visibility = "hidden"
        }

        function copiarDesc() {

            let desc = document.getElementById("desc")
            desc.select();
            desc.setSelectionRange(0, 99999);
            document.execCommand("copy");
            alert("Texto copiado.");

        }

        function chanceDescSim(){
            let desc = document.getElementById("desc")

        }
    </script>

</html>