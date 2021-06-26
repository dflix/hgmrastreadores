<?php 
session_start();

//if(empty($_SESSION['nome'])):
//    
//  echo "<meta http-equiv=\"refresh\" content=0;url=\"../index.php\">" ;
//      
//endif;
require('../_app/Config.inc.php');
if(isset($_GET['p'])):
 $p = $_GET['p']; 
else:
    $p = 0;
endif;

?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>Financeiro Associação Protege</title>

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

        <header class="cabecalho"> 
            <div class="logo">
                <img src="img/logo-protege.png" />
            </div>
            <div class="sessao"> 
                <p> Ola <b><?php echo $_SESSION['nome']; ?></b>, você esta logado <a href="../logout.php"> <b>sair</b> </a> </p>
                </br>
            </div>
        </header>
        
        <nav class="menu"> 
        <?php 
        require('./menuresponsivo/menu-responsivo.php');
        ?>
        </nav>
        
    <main> 
        
        <?php 
        
        if(empty($p)):
            require('inc/home.php');
        else:
        
        
        if($p == "eprotege"):
            require('inc/eprotege.php');
        endif;
        if($p == "iprotege"):
            require('inc/iprotege.php');
        endif;
        if($p == "assistencia"):
            require('inc/assistencia.php');
        endif;
        if($p == "planos"):
            require('inc/planos.php');
        endif;
        if($p == "sqlatendimento"):
            require('inc/sqlatendimento.php');
        endif;
        
        if($p == "aprotege"):
            require('inc/aprotege.php');
        endif;
        if($p == "tprotege"):
            require('inc/tprotege.php');
        endif;
        if($p == "oacasp"):
            require('inc/oacasp.php');
        endif;
        if($p == "iacasp"):
            require('inc/iacasp.php');
        endif;
        if($p == "eacasp"):
            require('inc/eacasp.php');
        endif;
        if($p == "aacasp"):
            require('inc/aacasp.php');
        endif;
        if($p == "tacasp"):
            require('inc/tacasp.php');
        endif;
        if($p == "dados"):
            require('inc/dados.php');
        endif;
        if($p == "dadosacasp"):
            require('inc/dados-associacao.php');
        endif;
        if($p == "caixa"):
            require('inc/caixa.php');
        endif;
        if($p == "fluxocaixa"):
            require('inc/fluxocaixa.php');
        endif;
        if($p == "santander"):
            require('inc/santander.php');
        endif;
        if($p == "upload"):
            require('inc/upload-arquivo.php');
        endif;
        if($p == "uploadacasp"):
            require('inc/upload-arquivo-acasp.php');
        endif;
        if($p == "cobrancasprotege"):
            require('inc/boletosantander.php');
        endif;
        
        
        
        endif;
        ?>
    
    </main>
    
    <footer> 
       
    </footer>
        
    </body>
</html>
