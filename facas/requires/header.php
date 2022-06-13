<style>
    @media (max-width: 394px){
        #logo-container{
            font-size: 80% !important;
        }
    }
</style>

<header class="col s12 m6">
    <nav class="#343a40 black" role="navigation">
        <div class="nav-wrapper container"><a style="left: 50%;width: 50%;;font-size: 110%;" id="logo-container" href="index.php" class="brand-logo center">Sadrian - Casa de Lâminas</a>
            
        <?php
            if(isset($_SESSION['logado'])):
                if($_SESSION['logado']):
                    echo "<ul class='left'>
                            <li style='font-size:80%'> Olá $nome_usuario! </li>
                        </ul>";
                    if($admin == 1):
                        echo "<ul class='right'>
                            
                            <li><a style='padding:0 5px' href='cadastro-usuarios.php'> <i style='font-size:20px' class= 'material-icons'> person_add </i> </a> </li>
                            <li><a style='padding:0 5px' href='cadastro.php'> <i style='font-size:20px' class= 'material-icons'> add_circle </i> </a> </li>    
                            <li><a style='padding:0 5px' href='../requires/logout.php'> <i style='font-size:20px'class= 'material-icons'> exit_to_app </i> </a> </li>
                        </ul>";
                    else:
                        echo "
                        <ul class='right'>
                            <li><a style='padding:0 5px' href='../requires/logout.php'> <i style='font-size:20px'class= 'material-icons'> exit_to_app </i> </a> </li>
                        </ul>";
                    endif;
                else:
                    echo "
                        <ul class='right'>
                            <li><a style='padding:0 5px' href='login.php'> <i style='font-size:20px'class= 'material-icons'> keyboard_return </i> </a> </li>
                        </ul>";
                endif;
            else:
                echo "
                    <ul class='right'>
                        <li><a style='padding:0 5px' href='login.php'> <i style='font-size:20px'class= 'material-icons'> keyboard_return </i> </a> </li>
                    </ul>";
            endif;
        ?>
        </div>
    </nav>
</header>