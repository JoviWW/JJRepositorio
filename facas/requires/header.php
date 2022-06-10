<header class="col s12 m6">
    <nav class="#343a40 black" role="navigation">
        <div class="nav-wrapper container"><a style="left: 50%;width: 50%;;font-size: 110%;" id="logo-container" href="home.php" class="brand-logo center">Sadrian - Casa de Lâminas</a>
            <ul class="left">
                <li style="font-size:80%"> Olá <?php echo $nome_usuario; ?>! </li>
            </ul>
            <ul class="right">
                <?php
                    if($admin == 1):
                        echo "<li><a style='padding:0 5px' href='cadastro-usuarios.php'> <i style='font-size:20px' class= 'material-icons'> person_add </i> </a> </li>";
                        echo "<li><a style='padding:0 5px' href='cadastro.php'> <i style='font-size:20px' class= 'material-icons'> add_circle </i> </a> </li>";
                    endif;
                ?>
                
                <li><a style="padding:0 5px"href="../requires/logout.php"> <i style="font-size:20px"class= "material-icons"> exit_to_app </i> </a> </li>
            </ul>
        </div>
    </nav>
</header>