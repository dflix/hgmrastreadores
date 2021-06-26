<?php
session_start();

require('../_app/Config.inc.php');
?>
<!DOCTYPE html>

<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Admistrador do Site</title>
        <style> 
            <?php require('./css/estilos.css'); ?>;
        </style>
    </head>
    <body>

        <div class="form">
            <section class="topo">

                <header>  Area Administrativa </header>

                <article class="article"> 
                    <?php
                    //require('../_app/Models/Login.class.php');
ini_set( 'display_errors', true );error_reporting( E_ALL );

                    $login = new Login(3);

                    $dataLogin = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                    if (!empty($dataLogin['AdminLogin'])):

                        $login->ExeLogin($dataLogin);
                        if (!$login->getResult()):
                            WSErro($login->getError()[0], $login->getError()[1]);
                        else:
                            echo "<script>location.href='painel.php'</script>";
                       //header('Location: painel.php');
                           //var_dump($login);
                        endif;

                    endif;
                    ?>
                </article>

            </section>

            <div class="clear"> </div>    

            <form name="login" action="" method="post"  > 

                <label class="label"> 
                    <span>E-mail </span>
                    <hr>
                    <input type="email" name="user" />

                </label>
                <hr>
                <label  class="label"> 
                    <span>Senha </span>
                    <hr>
                    <input type="password" name="pass" />

                </label>
                <hr>
                <input type="submit" name="AdminLogin" value="logar" class="botao" />

            </form>
        </div>
    </body>
</html>
