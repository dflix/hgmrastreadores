
<html>
    <head>
        <meta charset="UTF-8">
        <title>Recibo</title>
                <style> 

            body{ font-family: Verdana, Tahoma, Arial; font-size: 0.9em; }
            <?php
            require('./estilo.css');
            ?>
        </style> 

    </head>
    <body>
        <?php
        require('../_app/Config.inc.php');
        
        $puxa = $_GET["id"];

        $variavel12 = new Read();
        $variavel12->ExeRead("prevenda", "WHERE id_venda = :p ", "p={$puxa}");
        $variavel12->getResult();

?>
        <div class="row">
        <div class="cem" style="border: 1px solid #ccc;"> 
            <img src="img/logo.png" width="200" />
            </br> <b>HGM PROTEÇÂO E RECUPERAÇÂO DE VEÌCULOS</b> </br>
            <b> CNPJ:36.726.851/0001-63</b></br>
            <b>Av Gago Coutinho, 544 sobreloja 1 - Vila Aquilino - Santo André - 09070-000 SP </b>
        </div>
            

            
            <div class="cem"> 
                <p style="border-bottom: 1px solid #ccc; padding: 15px;"> Recebemos de : <?= $variavel12->getResult()[0]['cliente'] ?></p>
            </div>
            
                        <div class="cem"> 
                <p style="border-bottom: 1px solid #ccc; padding: 15px;"> Valor : <?= $variavel12->getResult()[0]['valor_recibo'] ?></p>
            </div>
            
            <div class="cem"> 
                <p style="border-bottom: 1px solid #ccc; padding: 15px;"> Referente : <?= $variavel12->getResult()[0]['descricao_recibo'] ?></p>
            </div>
            
            <div class="cem"> 
                <p style="border-bottom: 1px solid #ccc; padding: 15px;"> São Paulo : <?= date("d/m/Y" , strtotime($variavel12->getResult()[0]['data'])); ?></p>
            </div>
            <div class="cem"> 
                <p style="border-bottom: 1px solid #ccc; padding: 15px;"> Assinatura: </p>
            </div>
        
      
        </div>
        
    </br> </br>
        
    <div class="cem"> .. </div>
    <div class="clear"> </div>
        
    <div class="cem">..  </div>
    <div class="clear"> </div>
        
    <div class="cem"> .. </div>
    <div class="clear"> </div>
    
            <div class="row">
        <div class="cem" style="border: 1px solid #ccc;"> 
            <img src="img/logo.png" width="200" />
            </br> <b>HGM PROTEÇÂO E RECUPERAÇÂO DE VEÌCULOS</b> </br>
            <b> CNPJ:36.726.851/0001-63</b></br>
            <b>Av Gago Coutinho, 544 sobreloja 1 - Vila Aquilino - Santo André - 09070-000 SP </b>
        </div>
            

            
            <div class="cem"> 
                <p style="border-bottom: 1px solid #ccc; padding: 15px;"> Recebemos de : <?= $variavel12->getResult()[0]['cliente'] ?></p>
            </div>
            
                        <div class="cem"> 
                <p style="border-bottom: 1px solid #ccc; padding: 15px;"> Valor : <?= $variavel12->getResult()[0]['valor_recibo'] ?></p>
            </div>
            
            <div class="cem"> 
                <p style="border-bottom: 1px solid #ccc; padding: 15px;"> Referente : <?= $variavel12->getResult()[0]['descricao_recibo'] ?></p>
            </div>
            
            <div class="cem"> 
                <p style="border-bottom: 1px solid #ccc; padding: 15px;"> São Paulo : <?= date("d/m/Y" , strtotime($variavel12->getResult()[0]['data'])); ?></p>
            </div>
            <div class="cem"> 
                <p style="border-bottom: 1px solid #ccc; padding: 15px;"> Assinatura: </p>
            </div>
        
      
        </div>
        
        
       
    </body>
</html>
