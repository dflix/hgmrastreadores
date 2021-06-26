<?php
require('../_app/Config.inc.php');

session_start();
//var_dump($_SESSION);
?>
<!DOCTYPE html>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Area Administrativa  </title>
        <style> 
<?php require('./css/painel.css'); ?>
        </style>
        
<script  src="tinymce/js/tinymce/tinymce.min.js" />
                

    </head>
    <body>
        <header class="cabecadosite"> 
            <div class="logo"> 
                <img src="imagens/logo.png" />
            </div>
            <div class="user"> 
                <?php
                echo "Olá ";
                echo "<b>";
                print_r($_SESSION['userlogin']['user_name']) . print_r($_SESSION['userlogin']['user_lastname']);
                echo "</b>";
                echo " Você esta logado";
                ?>
            </div>


            <div class="clear"> </div>

            </header>  
        

        
        <nav class="nav"> 
                    <?php include('./menuresponsivo/menu-responsivo.php'); ?>
                </nav>
        
                <header class="cabecadosite"> 
            <div class="logo"> 
                <img src="imagens/logo.png" />
            </div>
            <div class="user"> 
                <?php
                echo "Olá ";
                echo "<b>";
                print_r($_SESSION['userlogin']['user_name']) . print_r($_SESSION['userlogin']['user_lastname']);
                echo "</b>";
                echo " Você esta logado";
                ?>
            </div>


            <div class="clear"> </div>

            </header>  
        

        
        <nav class="nav"> 
                    <?php include('./menuresponsivo/menu-responsivo.php'); ?>
                </nav>
        
        


    <main class="main">
                

                <?php
                $p = $_GET["p"];

                if (empty($p)) {

                    include('./inc/painel.php');
                } else {

                    if ($p == "painel") {

                        include('./inc/painel.php');
                    }
                    
                    if ($p == "config") {

                        include('./inc/config.php');
                    }
                    if ($p == "icateg") {

                        include('./inc/icateg.php');
                    }
                    if ($p == "ecateg") {

                        include('./inc/ecateg.php');
                    }
                    if ($p == "acateg") {

                        include('./inc/acateg.php');
                    }
                    if ($p == "ipost") {

                        include('./inc/ipost.php');
                    }
                    if ($p == "epost") {

                        include('./inc/epost.php');
                    }
                    if ($p == "orcamentos") {

                        include('./inc/orcamentos.php');
                    }
                    if ($p == "contatos") {

                        include('./inc/contatos.php');
                    }
                }
                ?>
    </main>

                <footer class="rodape"> Rodape do Site</footer>
                </body>
                </html>
