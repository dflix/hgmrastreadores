<?php
session_start();

require('_app/Config.inc.php');
?>
<!DOCTYPE html>

<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Escritório Virtual {SS}</title>
        <link rel="shortcut icon" href="../favicon.png" /> 
           
    
        <style> 
            
            
            html,
body {
  height: 100%;
}

body {
  display: -ms-flexbox;
  display: flex;
  -ms-flex-align: center;
  align-items: center;
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #f5f5f5;
}

.form-signin {
  width: 100%;
  max-width: 330px;
  padding: 15px;
  margin: auto;
}
.form-signin .checkbox {
  font-weight: 400;
}
.form-signin .form-control {
  position: relative;
  box-sizing: border-box;
  height: auto;
  padding: 10px;
  font-size: 16px;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}

            
        </style>
        
         <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<!--        <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">-->
<!--       <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">-->
    </head>
    
    
    
                        
    

    
   <body class="text-center">
       <form action="" method="post" class="form-signin">
           <div class="form-control" >
               <img style="widht:100px;"  src="img/logo-protege.png" />  
      <h3 class="page-header">Escritório Virtual</h3>
      <?php

                    $form = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                    
                  
                    if ($form && $form['SendLogin']):
                        $login = new Logar();
                    
                    endif;
                    
                  
                    ?>
                                      


           </div>
           <div class="form-control">
      <label class="sr-only">Seu E-mail</label>
      <input type="email" name="email"  class="form-control" placeholder="digite seu e-mail"  required autofocus>
           </div>
           <div class="form-control">
      <label  class="sr-only">Sua senha</label>
      <input type="password" name="senha"  placeholder="digite sua senha"  class="form-control" required>
           </div>
      <div class="form-control">
        <label>
            <a href="recuperarsenha.php">Esqueceu a senha</a>
        </label>
      </div>
           </br>
           <input class="btn btn-primary" style="width: 100%; " name="SendLogin" value="ENTRAR" type="submit" />
   
    </form>
  <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
