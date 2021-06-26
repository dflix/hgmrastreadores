<?php 
session_start();
require('../_app/Config.inc.php');

$id= $_GET['id'];

$ver = new Read();
$ver->ExeRead("prevenda", "WHERE id_venda= :p", "p={$id}");
$ver->getResult();

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title> Contrato Protege</title>
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
                <img src="img/contrato.png" style="width:500; margin: 0 auto;"  />
            </div>
                    <div class="clear"> </div>
            <div class="sessao"> 
                <p> Contrato Nº <?= $ver->getResult()[0]['codigo']; ?>  </p>
                </br>
            </div>
        </header>

        <?php 
        $termos = new Read();
        $termos->ExeRead("contrato", "WHERE id_contrato = :a", "a={$ver->getResult()[0]['contrato']}");
        $termos->getResult();
        
        echo $termos->getResult()[0]['termos'];
        
        ?>
        
        
       
        </br>
        </br>
        
        </br>
        
        <div style="width: 45%; float: left;">
            <p style="border-bottom: 2px solid #000; width: 100%"></p>

<p><?= $ver->getResult()[0]['cliente']; ?></p>
<p style="font-size:0.8em;"> CONTRATANTE (assinatura igual cheque/documento)</p>
<!--<p style="border-bottom: 2px solid #000; width: 100%"></p>
<p>Local e data </p>-->

</div>
        
        <div style="float: left; width: 5%;"> <p style="border-bottom: 2px solid #fff; width: 100%"></p> </div>
        <div style="float: left; width: 5%;"> <p style="border-bottom: 2px solid #fff; width: 100%"></p> </div>
        
     

        <div style="width: 45%; float: left;">
            <p style="border-bottom: 2px solid #000; width: 100%"></p>
<p> HGM PROTEÇÃO E RECUPERAÇÃO DE VEÍCULOS </BR>
        CNPJ 36.726.851/0001-63</p>
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
