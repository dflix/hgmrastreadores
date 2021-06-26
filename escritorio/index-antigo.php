<?php
session_start();
require('./_app/Config.inc.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Área Administrativa PROTEGE</title>

        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="estilo.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>

        <div class="content">



            <div class="jumbotron">
                <form action="" method="post" enctype="multipart/form-data" name="login" class="formlogin">
                    <?php
                    $form = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                    if ($form && $form['SendLogin']):
                        $login = new Logar();
                    
                    endif;
                    ?>

                    <div class="form-group">


                       
                            <div class="imglogin">  <img src="img/logo-protege.png" class="imglogin" /></div>

                        
                        <div class="form-group">
                            <label> 
                                 Usuário </label>
                            <input type="text" name="email" class="form-control" placeholder="Entre com seu usuário">
                        </div>
                        
                        <div class="form-group">
                        <label> 
                             Senha 
                              </label>
                            <input type="password" class="form-control" name="senha" placeholder="Entre com sua senha">
                       
                        </br>  </br>
                        <button type="submit" value="LOGAR" name="SendLogin" class="btn btn-primary">LOGAR</button>
<!--                        <input type="submit" value="LOGAR" name="SendLogin" class="botao" />-->

                </form>
            </div>
        </div>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="js/jquery-1.2.6.js" type="text/javascript"></script>
    </body>
</html>
