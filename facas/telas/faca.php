<?php
    require("../requires/conexao.php");
    
    session_start();

    if(!isset($_SESSION['logado'])):
        header('Location: index.php');
    endif;

    $nome_usuario = $_SESSION['nome'];
    $admin = $_SESSION['admin'];

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
        header('Location: home.php');
    }

?>

<html>

    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script id="_carbonads_projs" type="text/javascript" src="https://srv.carbonads.net/ads/CKYIK27J.json?segment=placement:materializecss&amp;callback=_carbonads_go"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <style>
        @media only screen and (min-width: 600px) {
            #form1 {
                margin-left: 23% !important;
            }
            

        }
    </style>

    </head>

    <body>

        <div id="transp" style="opacity : 0.5;position: fixed;z-index:9998;height:100%;width:100%;background-color: rgb(0, 0, 0);"> </div>

        <?php include("../requires/header.php")?>
        
        <main style="margin-top: 40px">

            <!-- POPUP -->

            
            <div id="popup1" style="margin-top: -60px;left:2%;position: fixed;z-index:9999;height:400px;width:95%;background-color: rgb(255, 255, 255);">
                <button style="cursor:pointer;border:none;margin: 4%;color: black;padding-top: 0;" onclick="fechar1()"class="right btn-tiny white"> <i class= "material-icons" > close </i> </button>
                <div>
                    <form id="form1" style="margin-left: 10%;margin-right: 10%;width:80%;display: flex;max-width: 409px;flex-direction: row;justify-content: center;height: 100%">
                        <div id="content" style="margin-top: 20px;width:100%; max-width:400px;text-align:center">

                            <div style=" border:solid;border-width: 1px;height: 120px;width: 100px;" class="left"> <img style="width: 100%;height: 100%;" src='<?php echo $dados_faca['img'];?>'> </div>
        
                            <div style="padding-left: 35%; padding-top: 5%;">
                                <span style="font-size: 90%">Em estoque: <?php echo $dados_faca['estoquedisponivel'];?></span><br>
                                <input style="height: 7%;font-size: 10px;width: 57%;text-align: center;" placeholder="Quantidade para leiloar"><br>
                                <?php
                                    if($dados_faca['permitir_planceinicial'] == 1){
                                        $lanceInicial = $dados_faca['lanceInicial'];
                                        echo "<span style='font-size: 80%'>Ofertar sem lance inicial: R$$lanceInicial</span><br>
                                        <input onclick='changeDescSim()' style='height:11px;position: relative;opacity: 1;pointer-events: all;'type='radio' name='resposta' value='sim'> Sim 
                                        <input onclick='changeDescNao()' style='height:11px;position: relative;opacity: 1;pointer-events: all;'type='radio' name='resposta' value='nao'> Não";
                                    }
                                ?>
                                
                            </div>
                            <br>
                            <div>
                                <textarea id="desc" style="resize: none;font-size:10px; max-width: 400px;height: 40%; word-wrap: break-word; overflow-x:auto;"> <?php echo $dados_faca['descricao'] ?> </textarea><br>
                                <div style="padding-top: 10px">
                                    <button onclick="copiarDesc()" type="submit" class="right btn" style="border-radius: 5%;color: white;background-color:black"> Confirmar </button>    
                                </div>
                                
                            </div>
        
                        </div>
                    </form> 
                </div>   
            </div>

            <!-- POPUP 2 -->

            <div id="popup2" style="margin-top: -60px;left:2%;position: fixed;z-index:9999;height:400px;width:95%;background-color: rgb(255, 255, 255);">
                <button style="cursor:pointer;border:none;margin: 20px;color: black;padding-top: 0;" onclick="fechar2()"class="right btn-tiny white"> <i class= "material-icons" > close </i> </button>
                <div id="content" style="margin-top: 20px;">
                    <div style="font-size: 105%;margin-left:10%" class="center"> Facas em leilão </div>

                    <div style="width: 100%;max-height: 65%;overflow-x:hidden"> 

                        <div style="width:100%">
                            <div style="border:solid;border-width:1px;width:80%;margin-left:10%;height: 25%;"> 
                                <div class="left"style="border:solid;border-width:1px;height: 60px;width: 60px;margin: 1.7% 2% 0% 2%;"> <img style="width: 100%;height: 100%;" src='<?php echo $dados_faca['img'];?>'> </div>
                                <form>
                                    <div>
                                        <p style="font-size: 80%;margin: 5px 0px 0px 17%;"> Processamento #01 </p>
                                        <input style="font-size: 50%;width: 13%;height: 25%; margin: 5px" placeholder="Nome do comprador">
                                        <input style="font-size: 50%;width: 13%;height: 25%; margin: 5px" placeholder="Valor da venda">
                                        <input style="font-size: 50%;width: 13%;height: 25%; margin: 5px" placeholder="Obs (opcional)">
                                        <ul style="margin: 0% 5% 0px 0px;" class="right">
                                            <li> <button value="confirma" type="submit" style="cursor: pointer;border:none;background-color:white"> <i class= "tiny material-icons"> check </i> </button> </li>
                                            <li> <button value="cancela" type="submit" style="cursor: pointer;border:none;background-color:white"> <i class= "tiny material-icons"> close </i> </button> </li>
                                        </ul>
                                    </div>
                                </form>
                            </div>
                        </div>
    
                        <div style="width:100%">
                            <div style="border:solid;border-width:1px;width:80%;margin-left:10%;height: 25%;"> 
                                <div class="left"style="border:solid;border-width:1px;height: 60px;width: 60px;margin: 1.7% 2% 0% 2%;"> <img style="width: 100%;height: 100%;" src='<?php echo $dados_faca['img'];?>'> </div>
                                <form>
                                    <div>
                                        <p style="font-size: 80%;margin: 5px 0px 0px 17%;"> Processamento #01 </p>
                                        <input style="font-size: 50%;width: 13%;height: 25%; margin: 5px" placeholder="Nome do comprador">
                                        <input style="font-size: 50%;width: 13%;height: 25%; margin: 5px" placeholder="Valor da venda">
                                        <input style="font-size: 50%;width: 13%;height: 25%; margin: 5px" placeholder="Obs (opcional)">
                                        <ul style="margin: 0% 5% 0px 0px;" class="right">
                                            <li> <button value="confirma" type="submit" style="cursor: pointer;border:none;background-color:white"> <i class= "tiny material-icons"> check </i> </button> </li>
                                            <li> <button value="cancela" type="submit" style="cursor: pointer;border:none;background-color:white"> <i class= "tiny material-icons"> close </i> </button> </li>
                                        </ul>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div style="width:100%">
                            <div style="border:solid;border-width:1px;width:80%;margin-left:10%;height: 25%;"> 
                                <div class="left"style="border:solid;border-width:1px;height: 60px;width: 60px;margin: 1.7% 2% 0% 2%;"> <img style="width: 100%;height: 100%;" src='<?php echo $dados_faca['img'];?>'> </div>
                                <form>
                                    <div>
                                        <p style="font-size: 80%;margin: 5px 0px 0px 17%;"> Processamento #01 </p>
                                        <input style="font-size: 50%;width: 13%;height: 25%; margin: 5px" placeholder="Nome do comprador">
                                        <input style="font-size: 50%;width: 13%;height: 25%; margin: 5px" placeholder="Valor da venda">
                                        <input style="font-size: 50%;width: 13%;height: 25%; margin: 5px" placeholder="Obs (opcional)">
                                        <ul style="margin: 0% 5% 0px 0px;" class="right">
                                            <li> <button value="confirma" type="submit" style="cursor: pointer;border:none;background-color:white"> <i class= "tiny material-icons"> check </i> </button> </li>
                                            <li> <button value="cancela" type="submit" style="cursor: pointer;border:none;background-color:white"> <i class= "tiny material-icons"> close </i> </button> </li>
                                        </ul>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div style="width:100%">
                            <div style="border:solid;border-width:1px;width:80%;margin-left:10%;height: 25%;"> 
                                <div class="left"style="border:solid;border-width:1px;height: 60px;width: 60px;margin: 1.7% 2% 0% 2%;"> <img style="width: 100%;height: 100%;" src='<?php echo $dados_faca['img'];?>'> </div>
                                <form>
                                    <div>
                                        <p style="font-size: 80%;margin: 5px 0px 0px 17%;"> Processamento #01 </p>
                                        <input style="font-size: 50%;width: 13%;height: 25%; margin: 5px" placeholder="Nome do comprador">
                                        <input style="font-size: 50%;width: 13%;height: 25%; margin: 5px" placeholder="Valor da venda">
                                        <input style="font-size: 50%;width: 13%;height: 25%; margin: 5px" placeholder="Obs (opcional)">
                                        <ul style="margin: 0% 5% 0px 0px;" class="right">
                                            <li> <button value="confirma" type="submit" style="cursor: pointer;border:none;background-color:white"> <i class= "tiny material-icons"> check </i> </button> </li>
                                            <li> <button value="cancela" type="submit" style="cursor: pointer;border:none;background-color:white"> <i class= "tiny material-icons"> close </i> </button> </li>
                                        </ul>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                    

                </div>
                
            </div>

            <!-- FIM DO POPUP -->

            <div class="row container">
                <div class="row">
                    
                    <div class="col s12" style="display: flex;flex-direction: row;flex-wrap: nowrap;justify-content: center;">
                        <br>
                        <div style="box-shadow: 7px 7px 17px 0px rgb(240 240 240);height: 210px; width: 210px;" class="left"> <img style="width: 100%;height: 100%;" src="<?php echo $dados_faca['img']?>">  </div>
                        <div style="margin-top: -2%;border-radius: 2%;height: 220px; width: 58%;" class="right"> 
                            <h5 style="font:revert;font-size:120%;padding-left: 6%;"> <?php echo $dados_faca['nome'];?> </h5>
                            <p style="font-size:10px;margin-left: 6%;padding-left: 1%; max-width: 98%; height: 58%; word-wrap: break-word; overflow-x:auto;">
                                <?php 
                                    $desc = str_replace("\r\n","<br>",$dados_faca['descricao']);
                                    echo $desc;
                                ?>
                            </p>
                            <h6 style="font:revert;font-size:110%;padding-left: 6%;"> Lance inicial: R$<?php echo $dados_faca['lanceInicial'];?> </h6>
                        </div>
                    </div>
                    <div style="border-radius: 2%;height: 100px;margin-top:12px;" class="col s12">
                        <div style="width: 40%;font-size: 17px;text-align: center;" class="left"> 
                            <?php 
                            if($admin == 1):
                                echo "<form>
                                    <span style='font-size:70%;padding-right: 6px ;'>Em estoque: {15}</span><br>
                                    <input style='text-align:center;font-size: 14px; height:20px;width: 30%;' placeholder='valor'>
                                    <button class='btn-floating btn-small grey'  type='submit'> <i style='font-size: 15px' class= 'small material-icons'> add </i> </button>
                                    </form>";
                            endif;
                            ?>
                            <button onclick="popup2()" class="btn white" style="color:black;margin-top: 12px;"> Dar baixa </button>
                        </div>
                        
                        <br>
                        <br>
                        <div class="right"> 
                            <div onclick="popup1()" style="background-color: grey;color:black;" class="btn white">
                                Separar estoque ➢
                            </div>
                            <div style="margin-top:15px">

                            <a style="font-size:70%;color:black" class="btn white" href="https://drive.google.com/drive/u/0/folders/1lbcULPLUn4VzGfdR6ArtvmkbD2PT_xmX"> Link Google Fotos </a>

                            </div>
                        </div>
                        
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