<?php
session_start();

date_default_timezone_set('America/Sao_Paulo');

if(empty($_COOKIE['logprot_nome'])):
    echo "<meta http-equiv=\"refresh\" content=0;url=\"../index.php\">";
endif;

require('../_app/Config.inc.php');
if (isset($_GET['p'])):
    $p = $_GET['p'];
else:
    $p = 0;
endif;
?>
<html>
    <head>
        
          <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Escritório Virtual {SS}</title>

  <link href="estilo.css" rel="stylesheet">
  <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
<!--  <link href="css/tiny.css" rel="stylesheet">-->
  <link href="estilo.css" rel="stylesheet">
  <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script> 
  <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script> 
  <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
  <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
<script language="JavaScript" type="text/javascript" src="js/mascara-validacao.js" ></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="shortcut icon" href="../favicon.png" /> 
        


    </head>
    <body>

<div class="row">
        <section class="col-md-2">
            
                        <?php 
        include("./nivel{$_COOKIE['logprot_nivel']}.php");
            ?>

        
        </section>   

        <section class="col-md-10">
            
            <section class="page-header col-md-12"> 
                
        <?php 
        $avatar = new Read();
        $avatar->ExeRead("usuario", "WHERE id_usuario = :p", "p={$_COOKIE['logprot_id_usuario']}");
        $avatar->getResult();
        
        if (empty($avatar->getResult()[0]['avatar'])):
                        $avatar = "<span class=\"glyphicon glyphicon-user\" style=\"font-size:50px; color:#CCC;\"> </span>";
                        else:
                        $avatar = "<img src=\"uploads/{$avatar->getResult()[0]['avatar']}\" class=\"img-circle\" style=\"width: 100px;\"/> ";

                    endif;
        ?>
        
    
                <div style="text-align: center; margin: 0 auto; widht:150px;"> <?= $avatar ?></div>
                <div style="text-align: center; margin: 0 auto;"> <h3><B>HGM RASTREADORES</B></h3>  </div>
            <p style="text-align: center;">Olá <b><span  style="color: #900;"><?= $_COOKIE['logprot_nome']; ?></span> </b> você está logado como <b> (<?php
                    $puxanivel = $_COOKIE['logprot_id_usuario'];
                    if ($_COOKIE['logprot_nivel'] == "1"):
                        echo "<b> ADMINISTRADOR </b>";
                    endif;
                    if ($_COOKIE['logprot_nivel'] == "2"):
                        echo "<b> VENDEDOR </b>";
                    endif;
                    if ($_COOKIE['logprot_nivel'] == "3"):
                        echo "<b> INSTALADOR </b>";
                    endif;
                    if ($_COOKIE['logprot_nivel'] == "4"):
                        echo "<b> LIDER </b>";
                    endif;
                    if ($_COOKIE['logprot_nivel'] == "5"):
                        echo "<b> AFILIADO </b>";
                    endif;
                    if ($_COOKIE['logprot_nivel'] == "6"):
                        echo "<b> MASTER </b>";
                    endif;
                    ?>)</b> <a href="logout.php" class="btn btn-danger">sair</a></p>


        </section>
            
            
            

            <?php
            if (empty($p)):
                require('inc/home.php');
            else:

                require("inc/{$_GET['p']}.php");


            endif;
            ?>

        </section>
    </div>
</main>
<!--<div class="row">
    <div class="col-md-2"> </div>
<footer class="col-md-10"> 
    <div class="alert alert-warning" role="alert"> Na duvida ligue para { SS } Solução em Sistemas (11)95001-5805 whatsapp fale com o <b>Marcio Leite</b></div>
</footer>
</div>-->
  <script>
    $(document).ready(function() {
        $('#summernote').summernote();
        
    });
  </script>
  
  
  


<style> 
.nav-side-menu {
  overflow: auto;
  font-family: verdana;
  font-size: 12px;
  font-weight: 250;
  background-color:#F0F0F0;
  position: fixed;
  top: 0px;
  width: 200px;
  height: 100%;
  color: #e1ffff;
}
.nav-side-menu .brand {
  background-color:#F0F0F0;
  line-height: 50px;
  display: block;
  text-align: center;
  font-size: 14px;
}
.nav-side-menu .toggle-btn {
  display: none; color:#F0F0F0;
}
.nav-side-menu ul,
.nav-side-menu li {
  list-style: none;
  padding: 0px;
  margin: 0px;
  line-height: 35px;
  cursor: pointer;
  /*    
    .collapsed{
       .arrow:before{
                 font-family: FontAwesome;
                 content: "\f053";
                 display: inline-block;
                 padding-left:10px;
                 padding-right: 10px;
                 vertical-align: middle;
                 float:right;
            }
     }
*/
}
.nav-side-menu ul :not(collapsed) .arrow:before,
.nav-side-menu li :not(collapsed) .arrow:before {
  font-family: FontAwesome;
  content: "\f078";
  display: inline-block;
  padding-left: 10px;
  padding-right: 10px;
  vertical-align: middle;
  float: right;
}
.nav-side-menu ul .active,
.nav-side-menu li .active {
  border-left: 3px solid #ccc;
  background-color: #4f5b69;
}
.nav-side-menu ul .sub-menu li.active,
.nav-side-menu li .sub-menu li.active {
  color: #ccc;
}
.nav-side-menu ul .sub-menu li.active a,
.nav-side-menu li .sub-menu li.active a {
  color: #ccc;
}
.nav-side-menu ul .sub-menu li,
.nav-side-menu li .sub-menu li {
  background-color: #181c20;
  border: none;
  line-height: 28px;
  border-bottom: 1px solid #23282e;
  margin-left: 0px;
}
.nav-side-menu ul .sub-menu li:hover,
.nav-side-menu li .sub-menu li:hover {
  background-color: #020203;
}
.nav-side-menu ul .sub-menu li:before,
.nav-side-menu li .sub-menu li:before {
  font-family: FontAwesome;
  content: "\f105";
  display: inline-block;
  padding-left: 10px;
  padding-right: 10px;
  vertical-align: middle;
}
.nav-side-menu li {
  padding-left: 0px;
  border-left: 3px solid #2e353d;
  border-bottom: 1px solid #23282e;
}
.nav-side-menu li a {
  text-decoration: none;
  color: #e1ffff;
}
.nav-side-menu li a i {
  padding-left: 10px;
  width: 20px;
  padding-right: 20px;
}
.nav-side-menu li:hover {
  border-left: 3px solid #ccc;
  background-color: #4f5b69;
  -webkit-transition: all 1s ease;
  -moz-transition: all 1s ease;
  -o-transition: all 1s ease;
  -ms-transition: all 1s ease;
  transition: all 1s ease;
}
@media (max-width: 767px) {
  .nav-side-menu {
    position: relative;
    width: 100%; height:auto;
    margin-bottom: 10px;
  }
  .nav-side-menu .toggle-btn {
    display: block;
    cursor: pointer;
    position: absolute;
    right: 10px;
    top: 10px;
    z-index: 10 !important;
    padding: 3px;
    background-color: #ffffff;
    color: #000;
    width: 40px;
    text-align: center;
  }
  .brand {
    text-align: left !important;
    font-size: 22px;
    padding-left: 20px;
    line-height: 50px !important;
  }
}
@media (min-width: 767px) {
  .nav-side-menu .menu-list .menu-content {
    display: block;
  }
}
body {
  margin: 0px;
  padding: 0px;
}

</style>

<script>
    $(document).ready(function() {
        $('#summernote').summernote();

    });
</script>

<!--<script type="text/javascript" src="js/jquery.js"></script>-->

<!--<script type="text/javascript" src="js/Chart.min.js"> </script>-->

        <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
        <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>

</body>
</html>
