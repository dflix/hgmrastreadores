<?php 
session_start();
require('../_app/Config.inc.php');

$id= $_GET['id'];

$ver = new Read();
$ver->ExeRead("prevendaacasp", "WHERE id_venda= :p", "p={$id}");
$ver->getResult();

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title> Contrato Associação</title>
                <style> 
<?php
require('./estilo.css');
?>
        </style>
    </head>
    <body>
        <div class="content">
                <header class="cabecalho"> 
            <div class="logoadesao">
                <img src="img/topo-pedido.jpg" style="width:500; margin: 0 auto;"  />
            </div>
                    <div class="clear"> </div>
            <div class="sessao"> 
                <p> Contrato Nº <?= $ver->getResult()[0]['contrato']; ?>  </p>
                </br>
            </div>
        </header>

        <?php 
        $termos = new Read();
        $termos->ExeRead("contrato", "WHERE id_contrato = :a", "a={$ver->getResult()[0]['regulamento']}");
        $termos->getResult();
        
        echo $termos->getResult()[0]['termos'];
        
        ?>
        
        
       
        </br>
        </br>
        
        </br>
        
        <div style="width: 45%; float: left;">
            <p style="border-bottom: 2px solid #000; width: 100%"></p>

<p><?= $ver->getResult()[0]['associado']; ?></p>
<p style="font-size:0.8em;"> CONTRATANTE (assinatura igual cheque/documento)</p>
<!--<p style="border-bottom: 2px solid #000; width: 100%"></p>
<p>Local e data </p>-->

</div>
        
        <div style="float: left; width: 5%;"> <p style="border-bottom: 2px solid #fff; width: 100%"></p> </div>
        <div style="float: left; width: 5%;"> <p style="border-bottom: 2px solid #fff; width: 100%"></p> </div>
        
     

        <div style="width: 45%; float: left;">
            <p style="border-bottom: 2px solid #000; width: 100%"></p>
<p>Associação São Paulo de Caminhoneiros </p>
<p><br />
</div>
        
           <div class="clear"> </div>
          
           </br></br></br>
        
   <div style="width: 45%; float: left;">     
  <p style="border-bottom: 2px solid #000; width: 100%"></p>
       Testemunhas: 1.
   </div>
           
        <div style="float: left; width: 5%;"> <p style="border-bottom: 2px solid #fff; width: 100%"></p> </div>
        <div style="float: left; width: 5%;"> <p style="border-bottom: 2px solid #fff; width: 100%"></p> </div>
           
        <div style="width: 45%; float: left;">
            <p style="border-bottom: 2px solid #000; width: 100%"></p>
  Testemunhas: 2. 
</div>
        </div>
    </div>
    </body>
</html>
