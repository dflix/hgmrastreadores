<?php
session_start();

if(empty($_SESSION['nome'])):
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
        
        
        
        
<!--        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>ADMINISTRATIVO ASSOCIAÇÃO PROTEGE</title>

         Bootstrap 
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="estilo.css" rel="stylesheet">

         HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries 
         WARNING: Respond.js doesn't work if you view the page via file:// 
        [if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    <body>
        
        <div class="marginmenutop"> . </div>

        <section class="page-header col-md-12"> 
                
        <?php 
        $avatar = new Read();
        $avatar->ExeRead("usuario", "WHERE id_usuario = :p", "p={$_SESSION['id_usuario']}");
        $avatar->getResult();
        
        if (empty($avatar->getResult()[0]['avatar'])):
                        $avatar = "<span class=\"glyphicon glyphicon-user\" style=\"font-size:50px; color:#CCC;\"> </span>";
                        else:
                        $avatar = "<img src=\"uploads/{$avatar->getResult()[0]['avatar']}\" class=\"img-circle\" style=\"width: 100px;\"/> ";

                    endif;
        ?>
        
    
            <div style="text-align: center; margin: 0 auto; widht:150px;"> <?= $avatar ?> </div>
            <div style="text-align: center; margin: 0 auto;"> <h3>ASSOCIAÇÃO SÃO PAULO / PROTEGE RASTREADORES</h3> </div>
            <p style="text-align: center;">Olá <b><span  style="color: #900;"><?= $_SESSION['nome']; ?></span> </b> você está logado como <b> (<?php
                    $puxanivel = $_SESSION['nivel'];
                    if ($_SESSION['nivel'] == "1"):
                        echo "<b> ADMINISTRADOR </b>";
                    endif;
                    if ($_SESSION['nivel'] == "2"):
                        echo "<b> VENDEDOR </b>";
                    endif;
                    ?>)</b> <a href="logout.php" class="btn btn-danger">sair</a></p>


        </section>




        <div class="col-md-12">

            <nav class="navbar navbar-inverse sidebar navbar-fixed-top" role="navigation">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-sidebar-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>      
                    </div>
                    <div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="index.php"><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-home"></span>HOME</a></li>
<?php if ($_SESSION['nome'] == "Mercia" || $_SESSION['nome'] == "master" || $_SESSION['nome'] == "Adilson Brito" || $_SESSION['nome'] == "Gabriel") { ?>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">FUNCIONÁRIOS <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-user"></span></a>
                                    <ul class="dropdown-menu forAnimate" role="menu">
                                        <li><a href="index.php?p=iusuario">Inserir</a></li>
                                        <li><a href="index.php?p=eusuario">Ver / Editar</a></li>

                                    </ul>
                                </li>


                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">FLUXO DE CAIXA <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-usd"></span></a>
                                    <ul class="dropdown-menu forAnimate" role="menu">
                                        <li><a href="index.php?p=categmov">Categorias</a></li>
                                        <li><a href="index.php?p=fluxocaixa">Fluxo de Caixa</a></li>

                                    </ul>
                                </li> 



                               
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">INDICAÇÕES <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-tags"></span></a>
                                    <ul class="dropdown-menu forAnimate" role="menu">
                                        <li><a href="index.php?p=indicacaoprotege">Indicações PROTEGE</a></li>
                                        <li><a href="index.php?p=indicacaoacasp">Indicações ASSOCIAÇÂO</a></li>            
                                         <li><a href="index.php?p=indicacaomoto&moto=yes">Indicações MOTO</a></li>            
                                    </ul>
                                </li>          
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">COMISSÕES <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-share"></span></a>
                                    <ul class="dropdown-menu forAnimate" role="menu">
                                        <li><a href="index.php?p=comissaoprotege">Comissões PROTEGE</a></li>
                                        <li><a href="index.php?p=comissaoacasp">Comissões ASSOCIAÇÂO</a></li>            
                                    </ul>
                                </li> 
                            <?php } ?>

<?php if ($_SESSION['nivel'] == "2") { ?>

                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">COMISSÕES <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-share"></span></a>
                                    <ul class="dropdown-menu forAnimate" role="menu">
                                        <li><a href="index.php?p=comissaoprotege">Comissões PROTEGE</a></li>
                                        <li><a href="index.php?p=comissaoacasp">Comissões ASSOCIAÇÂO</a></li>            
                                    </ul>
                                </li> 
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">INDICAÇÕES <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-tags"></span></a>
                                    <ul class="dropdown-menu forAnimate" role="menu">
                                        <li><a href="index.php?p=indicacaoprotege">Indicações PROTEGE</a></li>
                                        <li><a href="index.php?p=indicacaoacasp">Indicações ASSOCIAÇÂO</a></li>            
                                        <li><a href="index.php?p=indicacaomoto&moto=yes">Indicações MOTO</a></li>            
                                    </ul>
                                </li>  
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">PROTEGE <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-map-marker"></span></a>
                                    <ul class="dropdown-menu forAnimate" role="menu">
                                        <li><a href="index.php?p=iprotege&metodo=carros">Cadastrar Pedido</a></li>
                                        <li><a href="index.php?p=eprotege">Ver / Editar Pedido</a></li>            
                                    </ul>
                                </li>          
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">ASSOCIAÇÃO <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-screenshot"></span></a>
                                    <ul class="dropdown-menu forAnimate" role="menu">
                                        <li><a href="index.php?p=iacasp">Cadastrar Pedido</a></li>
                                        <li><a href="index.php?p=eacasp">Ver / Editar Pedido</a></li>

                                    </ul>
                                </li> 

                            <?php } ?>

<?php if ($_SESSION['nivel'] == "1") { ?>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">PROTEGE <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-map-marker"></span></a>
                                    <ul class="dropdown-menu forAnimate" role="menu">
                                        <li><a href="index.php?p=iprotege&metodo=carros">Cadastrar Pedido</a></li>
                                        <li><a href="index.php?p=eprotege">Ver / Editar Pedido</a></li>            
                                    </ul>
                                </li>          
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">ASSOCIAÇÃO <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-screenshot"></span></a>
                                    <ul class="dropdown-menu forAnimate" role="menu">
                                        <li><a href="index.php?p=iacasp">Cadastrar Pedido</a></li>
                                        <li><a href="index.php?p=eacasp">Ver / Editar Pedido</a></li>

                                    </ul>
                                </li>          
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">CRIAR PLANOS <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-star-empty"></span></a>
                                    <ul class="dropdown-menu forAnimate" role="menu">
                                        <li><a href="index.php?p=planos">Criar planos PROTEGE</a></li>
                                        <li><a href="index.php?p=assistencia">Criar planos ASSIST 24 HS</a></li>

                                    </ul>
                                </li>          
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">COBRANÇAS <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-check"></span></a>
                                    <ul class="dropdown-menu forAnimate" role="menu">
                                        <li><a href="index.php?p=santander">Baixa Santander (auto)</a></li>
                                        <li><a href="index.php?p=caixa">Baixa Caixa (auto)</a></li>
                                        <li><a href="index.php?p=santandermanual">Baixa Santander (manual)</a></li>
                                        <li><a href="index.php?p=caixamanual">Baixa Caixa (manual)</a></li>


                                    </ul>
                                </li>          
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">ATENDIMENTOS <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-phone-alt"></span></a>
                                    <ul class="dropdown-menu forAnimate" role="menu">
                                        <li><a href="index.php?p=segundavia">2º vias de boleto</a></li>
                                        <li><a href="index.php?p=manutencao">Manutenção</a></li>
                                        <li><a href="index.php?p=guincho">Guincho</a></li>
                                        <li><a href="index.php?p=sinistro">Sinistros (Roubo e Furto)</a></li>
                                        <li><a href="index.php?p=cancelamentos">Cancelamentos</a></li>
                                        <li><a href="index.php?p=geral">Geral</a></li>
                                        <li><a href="index.php?p=teste">Teste Mensal</a></li>


                                    </ul>
                                </li>          
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">ESTOQUE <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-dashboard"></span></a>
                                    <ul class="dropdown-menu forAnimate" role="menu">
                                        <li><a href="index.php?">Chips</a></li>
                                        <li><a href="index.php?">Equipamentos</a></li>

                                    </ul>
                                </li>          
<?php } ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>   

        <section class="col-md-12">

            <?php
            if (empty($p)):
                require('inc/home.php');
            else:


                if ($p == "eprotege"):
                    require('inc/eprotege.php');
                endif;
                if ($p == "iprotege"):
                    require('inc/iprotege.php');
                endif;
                if ($p == "iprotegeb"):
                    require('inc/iprotegeb.php');
                endif;
                if ($p == "iprotegec"):
                    require('inc/iprotegec.php');
                endif;
                if ($p == "assistencia"):
                    require('inc/assistencia.php');
                endif;
                if ($p == "planos"):
                    require('inc/planos.php');
                endif;
                if ($p == "sqlatendimento"):
                    require('inc/sqlatendimento.php');
                endif;

                if ($p == "aprotege"):
                    require('inc/aprotege.php');
                endif;
                if ($p == "tprotege"):
                    require('inc/tprotege.php');
                endif;
                if ($p == "ttprotege"):
                    require('inc/ttprotege.php');
                endif;
                if ($p == "oacasp"):
                    require('inc/oacasp.php');
                endif;
                if ($p == "iacasp"):
                    require('inc/iacasp.php');
                endif;
                if ($p == "iacaspb"):
                    require('inc/iacaspb.php');
                endif;
                if ($p == "iacaspc"):
                    require('inc/iacaspc.php');
                endif;
                if ($p == "bacasp"):
                    require('inc/bacasp.php');
                endif;
                if ($p == "bprotege"):
                    require('inc/bprotege.php');
                endif;
                if ($p == "eacasp"):
                    require('inc/eacasp.php');
                endif;
                if ($p == "aacasp"):
                    require('inc/aacasp.php');
                endif;
                if ($p == "tacasp"):
                    require('inc/tacasp.php');
                endif;
                if ($p == "ttacasp"):
                    require('inc/ttacasp.php');
                endif;
                if ($p == "dados"):
                    require('inc/dados.php');
                endif;
                if ($p == "dadosacasp"):
                    require('inc/dados-associacao.php');
                endif;
                if ($p == "caixa"):
                    require('inc/caixa.php');
                endif;
                if ($p == "caixamanual"):
                    require('inc/caixamanual.php');
                endif;
                if ($p == "fluxocaixa"):
                    require('inc/fluxocaixa.php');
                endif;
                if ($p == "santander"):
                    require('inc/santander.php');
                endif;
                if ($p == "santandermanual"):
                    require('inc/santandermanual.php');
                endif;
                if ($p == "upload"):
                    require('inc/upload-arquivo.php');
                endif;
                if ($p == "uploadacasp"):
                    require('inc/upload-arquivo-acasp2.php');
                endif;
                if ($p == "cobrancasprotege"):
                    require('inc/cobrancasprotege.php');
                endif;
                if ($p == "cobrancasacasp"):
                    require('inc/cobrancasacasp.php');
                endif;
                if ($p == "segundavia"):
                    require('inc/segundavia.php');
                endif;
                if ($p == "manutencao"):
                    require('inc/manutencao.php');
                endif;
                if ($p == "guincho"):
                    require('inc/guincho.php');
                endif;
                if ($p == "sinistro"):
                    require('inc/sinistro.php');
                endif;
                if ($p == "cancelamentos"):
                    require('inc/cancelamento.php');
                endif;
                if ($p == "geral"):
                    require('inc/geral.php');
                endif;
                if ($p == "indicacaoprotege"):
                    require('inc/indicacaoprotege.php');
                endif;
                if ($p == "indicacaoacasp"):
                    require('inc/indicacaoacasp.php');
                endif;
                if ($p == "categmov"):
                    require('inc/categmov.php');
                endif;
                if ($p == "eusuario"):
                    require('inc/eusuarios.php');
                endif;
                if ($p == "ausuarios"):
                    require('inc/ausuarios.php');
                endif;
                if ($p == "iusuario"):
                    require('inc/iusuarios.php');
                endif;
                if ($p == "ausuario"):
                    require('inc/ausuarios.php');
                endif;
                if ($p == "indicacaomoto"):
                    require('inc/indicacaomoto.php');
                endif;
                if ($p == "teste"):
                    require('inc/teste.php');
                endif;



            endif;
            ?>

        </section>
    </div>
</main>

<footer class="col-md-12"> 
    <div class="alert alert-warning" role="alert"> Na duvida ligue para { SS } Solução em Sistemas (11)95001-5805 whatsapp fale com o <b>Disbiriflix</b></div>
</footer>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="js/jquery-1.2.6.js"></script>
<script src="js/mascara-validacao.js"></script>

</body>
</html>
