<?php
require('../_app/Config.inc.php');

session_start();

if (empty($_SESSION)):
    header("location:index.php");
endif;
?>
<!DOCTYPE html>

<html lang="pt-br">
    <head>


        <meta charset="UTF-8">
        <title>Area Administrativa  </title>
        <style> 
<?php require('./css/painel.css'); ?>
        </style>

        <script type="text/javascript" src="tinymce/js/tinymce/tinymce.min.js" ></script>
        <script type="text/javascript" src="tinymce/js/jquery.js" ></script>
        <script>
            tinymce.init({
                selector: 'textarea',
                height: 300,
                menubar: false,
                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime media table contextmenu paste code'
                ],
                toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                content_css: [
                    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                    '//www.tinymce.com/css/codepen.min.css']
            });
        </script>

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






    <main class="main">


        <?php
        $p = $_GET["p"];

        if (empty($p)) {

            include('./inc/painel.php');
        } else {

            if (isset($p)) {

                include("./inc/$p.php");
            }
        }
        ?>
    </main>

    <footer class="rodape"> Rodape do Site</footer>
</body>

    <script src="jquery.js" ></script>
    <script src="maskMoney.js" ></script>

<!--<script src="<?= HOME ?>/_cdn/jquery.js"></script>
<script src="<?= HOME ?>/_cdn/jcycle.js"></script>
<script src="<?= HOME ?>/_cdn/jmask.js"></script>
<script src="<?= HOME ?>/_cdn/shadowbox/shadowbox.js"></script>
<script src="<?= HOME ?>/_cdn/_plugins.conf.js"></script>
<script src="<?= HOME ?>/_cdn/_scripts.conf.js"></script>
<script src="<?= HOME ?>/_cdn/combo.js"></script>-->
</html>
