<?php
    session_start();

    if(!isset($_SESSION['logado'])):
        header('Location: index.php');
    endif;

    $nome_usuario = $_SESSION['nome'];
    $admin = $_SESSION['admin'];

    if($admin == 0):
        header('Location: index.php');
    endif;
?>

<html>

    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <style>

        #box-img{
            box-shadow: 7px 7px 17px 0px rgb(240 240 240);
            height: 210px;
            width: 210px;
        }

        #infos-foto-ajuste{
                margin-left: 20px
            }

        #infos-foto{
            border-radius: 2%;
            height: 40%;
            width: 58%;
            margin-left: 20px;
        }

        @media only screen and (max-width:578px){

            #box-img{
                margin-bottom:10px;
            }

            #infos-foto{
                text-align:center;
                margin-left: 0px;
                
            }

            #infos-foto-ajuste{
                margin-left: 0px
            }

            #valores, #box-img, #infos-foto, #finalizar {
                float:none !important;
            }

            #valores, #finalizar {
                margin-left:30%;
            }

            #altura{
                height:100% !important
            }

        }
        

    </style>

    <body>

        <?php include("../requires/header.php")?>
        
        <main style="margin-top: 19px">

            <form name="formulario" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">

                <div class="row container">
                    <div id="altura" class="row" style="height: 125%;box-shadow: 0 2px 2px 0 rgb(0 0 0 / 14%), 0 3px 1px -2px rgb(0 0 0 / 12%), 0 1px 5px 0 rgb(0 0 0 / 20%);">
                        
                        <div class="col s12" style="margin-top: 25px;display: flex;flex-wrap: wrap;justify-content: center;">
                            <br>
                            <div id="box-img" class="left">
                                <img id="fotopreview" style="z-index:0;height:100%;width:100%" height="200px" width="200px" src="">
                                <label for="uploadfoto">
                                    <i style="z-index: 9999; margin: -75% 0 0 23%;;padding: 45px;" class= "material-icons"> collections </i>
                                </label>
                                <input id="uploadfoto" style="visibility:hidden" type="file" name="imagem">

                            </div>
                            <div id="infos-foto" class="right"> 
                                <div id="infos-foto-ajuste"class="right">
                                <input name="nome" style="font-size: 70%;box-shadow: 0 2px 2px 0 rgb(0 0 0 / 14%), 0 3px 1px -2px rgb(0 0 0 / 12%), 0 1px 5px 0 rgb(0 0 0 / 20%);padding-left: 5%;width: 70%;" placeholder="Nome da Faca">
                                <textarea name="descricao" style="border:none;box-shadow: 0 2px 2px 0 rgb(0 0 0 / 14%), 0 3px 1px -2px rgb(0 0 0 / 12%), 0 1px 5px 0 rgb(0 0 0 / 20%);resize: none; font-size:10px; padding-left: 1%; max-width: 98%; height: 120px; word-wrap: break-word; overflow-x:auto;">  AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
                                    
                                </textarea>
                                <input name="tipo" style="font-size: 70%;margin-top: 8px;box-shadow: 0 2px 2px 0 rgb(0 0 0 / 14%), 0 3px 1px -2px rgb(0 0 0 / 12%), 0 1px 5px 0 rgb(0 0 0 / 20%);padding: 1% 0% 1% 6%;;width: 92%;height: 12%;" placeholder="Categoria">
                                <input name="link" style="font-size: 70%;margin-top: 8px;box-shadow: 0 2px 2px 0 rgb(0 0 0 / 14%), 0 3px 1px -2px rgb(0 0 0 / 12%), 0 1px 5px 0 rgb(0 0 0 / 20%);padding: 1% 0% 1% 6%;;width: 92%;height: 12%;" placeholder="Link Google Fotos">
                                </div>
                            </div>
                        </div>
                        <div style="border-radius: 2%;height: 30%;margin-top:12px;" class="col s12">
                            <div id="valores" class="left" style="width: 40%">
                                <div style="border-radius: 10px;box-shadow: 2px 3px 3px 0px rgb(203 203 203); width: 100%;font-size: 17px;text-align: center;" > 
                                    <span style="font-size:75%"> Valores: </span><br>
                                    <input name="custo" style="font-size:62%;margin-top: 5px; box-shadow: 0 2px 2px 0 rgb(0 0 0 / 14%), 0 3px 1px -2px rgb(0 0 0 / 12%), 0 1px 5px 0 rgb(0 0 0 / 20%);padding-left: 5%;width: 72%;height: 30px;" placeholder="Custo">
                                    <input name="lance" style="font-size: 62%;margin-top: 5px; box-shadow: 0 2px 2px 0 rgb(0 0 0 / 14%), 0 3px 1px -2px rgb(0 0 0 / 12%), 0 1px 5px 0 rgb(0 0 0 / 20%);padding-left: 5%;width: 72%;height: 30px;"  placeholder="Lance inicial"><br>
                                    <input name="estoque" style="font-size: 62%;margin-top: 5px; box-shadow: 0 2px 2px 0 rgb(0 0 0 / 14%), 0 3px 1px -2px rgb(0 0 0 / 12%), 0 1px 5px 0 rgb(0 0 0 / 20%);padding-left: 5%;width: 72%;height: 30px;"  placeholder="Estoque"><br>
                                    
                                </div>
                                <div style="border-radius: 10px;margin-top:16px;box-shadow: 2px 3px 3px 0px rgb(203 203 203); width: 100%;font-size: 17px;text-align: center;">
                                    <span style="font-size:75%"> Pode ser ofertada sem lance inicial? </span> <br>
                                    <div>
                                        <input name="ofertaSemLance" type="radio" style="height:11px;position: relative;opacity: 1;pointer-events: all;" value="sim"> Sim 
                                        <input name="ofertaSemLance" type="radio" style="height:11px;position: relative;opacity: 1;pointer-events: all;"  value="nao"> Não
                                    </div>
                                    
                                </div>
                            </div>
                           
                            <br>
                            <br>
                            <div>
                                <button id="finalizar" name="cadastrar" style="margin: 2px 0 0 23%;background-color: grey;color:black; margin-top: 12px;" class="right btn white" type="submit"> Finalizar cadastro ➢ </button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
            <?php
            if(isset($_POST['cadastrar'])):
                require("../requires/cadastro_facas.php");
            endif;
            ?>
        </main>

    </body>

</html>

<script>
    var uploadfoto = document.getElementById('uploadfoto');
    var fotopreview = document.getElementById('fotopreview');

    uploadfoto.addEventListener('change', function(e) { //adiciona o evento "change" no input
        showThumbnail(this.files); //chama a função showThumbnail utilizando os arquivos carregados pelo input
    });

    function showThumbnail(files) { 
        if (files && files[0]) { // se existir algum arquivo
        var reader = new FileReader(); // adiciona a função de leitor à reader

        reader.onload = function (e) { // uma vez que o upload foi carregado
            fotopreview.src = e.target.result; // troca o src da foto preview para a url do arquiv
        }
        
        reader.readAsDataURL(files[0]); // lê o caminho do arquivo que foi carregado
        
        }
    }
</script>