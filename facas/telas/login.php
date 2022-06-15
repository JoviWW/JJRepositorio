<?php 

    session_start();

    if(isset($_POST['logar'])):
        require("../requires/login.php");
    endif;

?>

<html>

    <head>
        <link rel="stylesheet" href="estilos/index.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta charset="utf-8">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    </head>
    

    <body>

        <header class="col s12 m6">
            <nav class="#343a40 black" role="navigation">
                <div class="nav-wrapper container">
                    <p style="width: 60%;font-size: 110%;" id="logo-container" href="index.php" class="brand-logo center">Sadrian - Casa de Lâminas</p>
                    <ul class='left'>
                        <li><a style='padding:0 5px' onclick='voltar()'> <i style='font-size:20px'class= 'material-icons'> keyboard_return </i> </a> </li>
                    </ul>
                </div>
            </nav>
        </header>

        <main>
        
            <div class="container mt-5">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-6">
                        <div style="text-align:center;font-size:30px;"> LOGIN </div><br>
                        <form action= "<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                            <div class="card px-5 py-5" id="form1">
                                <div class="form-data">
                                    <div class="forms-inputs mb-4"> <span>Login</span> <input name="login" autocomplete="off" type="text">
                                    </div>
                                    <div class="forms-inputs mb-4"> <span>Senha</span> <input name="senha"autocomplete="off" type="password">
                                    </div>
                                    <div class="mb-3"> <button name="logar" type="submit" class="btn btn-dark w-100">Login</button> </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </main>

    </body>
   

</html>

<script>

    document.getElementById("confirma").style.visibility = 'hidden'

    function voltar(){
        javascript:history.go(-1);
    }

</script>