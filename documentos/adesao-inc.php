<?php
require'../vendor/autoload.php';

$cliente = new \Source\Models\Read();
$cliente->ExeRead("app_clientes", "WHERE cliente_id = :a ",
        "a={$_GET["cliente"]}");
$cliente->getResult();

$nascimento = date("d/m/Y", strtotime($cliente->getResult()[0]["data_nascimento"]));

$endereco = new \Source\Models\Read();
$endereco->ExeRead("app_enderecos", "WHERE cliente_id = :a", 
        "a={$_GET["cliente"]}");
$endereco->getResult();

//var_dump($endereco , $cliente);

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Adesão </title>
 
        <script src="https://kit.fontawesome.com/7e04532e8d.js" crossorigin="anonymous"></script>
    </head>
    <body>
     
        <div style="float: left; width: 20%; border-bottom: 1px solid #CCC; box-sizing: border-box ; padding: 5px;"><img src="../arquivos/logo.png" width="110" /> </div>
        <div  style="text-align:left;float: left; width: 80%; border-bottom: 1px solid #CCC; box-sizing: border-box ; padding: 5px;">
            <h3>S3 Blindagem </h3>
<!--            <p>CNPJ </p>
             <p>contato@s3blindagem.com.br (11)95555-0056 </p>-->
        </div>
        
        <div style="clear:both; width:100%;"> </div>
        
<!--        <div style="text-align:left;float: left; width: 100%; border-bottom: 1px solid #CCC; box-sizing: border-box ; padding: 5px;"> <h3> <i class="fas fa-asterisk"></i> TERMO DE ADESÃO </h3> </div>-->
        
        <div style="text-align:left;float: left; width: 80%; border-bottom: 1px solid #CCC; box-sizing: border-box ; padding: 5px;"> 
            <b> <i class="fas fa-user"></i> Nome </b>
            <p> <?= $cliente->getResult()[0]["nome"] ?> </p>
        </div>
        
        <div style="text-align:left;float: left; width: 20%; border-bottom: 1px solid #CCC; box-sizing: border-box ; padding: 5px;"> 
            <b> <i class="fas fa-id-card"></i> CPF / CNPJ </b>
            <p> <?= $cliente->getResult()[0]["cpf"] ?> <?= $cliente->getResult()[0]["cnpj"] ?> </p>
        </div>
        <div style="clear:both; width:100%;"> </div>
        
        <?php 
        $email = new Source\Models\Read();
        $email->ExeRead("app_contatos", "WHERE cliente_id = :a AND tipo = :b", 
                "a={$_GET["cliente"]}&b=email");
      
        
        foreach ( $email->getResult() as $emails) {

        ?>
        
        <div style="text-align:left;float: left; width: 25%; border-bottom: 1px solid #CCC; box-sizing: border-box ; padding: 5px;"> 
            <b> <i class="fas fa-at"></i> E-mail </b>
            <p><?= $emails["contato"] ?> </p>
            
        </div>
        
        <?php } ?>
        
        <?php 
        $telefone = new Source\Models\Read();
        $telefone->ExeRead("app_contatos", "WHERE cliente_id = :a AND tipo = :b", 
                "a={$_GET["cliente"]}&b=telefone");
      
        
        foreach ( $telefone->getResult() as $tel) {

        ?>
        
        <div style="text-align:left;float: left; width: 25%; border-bottom: 1px solid #CCC; box-sizing: border-box ; padding: 5px;"> 
            <b> <i class="fas fa-phone"></i> Telefones </b>
            <p><?= $tel["contato"] ?> </p>
            
        </div>
        
        <?php } ?>
      
        <div style="clear:both; width:100%;"> </div>
        
        <div style="text-align:left;float: left; width: 100%; border-bottom: 1px solid #CCC; box-sizing: border-box ; padding: 5px;"> 
            <h3> <i class="fas fa-car"></i> Veiculo </h3>
            <?php 
            $car = new Source\Models\Read();
            $car->ExeRead("app_veiculos", "WHERE cliente_id = :a AND pedido_id = :b", 
                    "a={$_GET["cliente"]}&b={$_GET["pedido"]}");
                    $car->getResult();
            ?>
        </div>
        <div style="text-align:left;float: left; width: 10%; border-bottom: 1px solid #CCC; box-sizing: border-box ; padding: 5px;"> 
            <b>Tipo </b>
            <p><?= $car->getResult()[0]['tipo'] ?></p>
        </div>
        <div style="text-align:left;float: left; width: 10%; border-bottom: 1px solid #CCC; box-sizing: border-box ; padding: 5px;"> 
            <b>Marca </b>
            <p><?= $car->getResult()[0]['marca'] ?></p>
        </div>
        <div style="text-align:left;float: left; width: 40%; border-bottom: 1px solid #CCC; box-sizing: border-box ; padding: 5px;"> 
            <b>Modelo </b>
            <p><?= $car->getResult()[0]['modelo'] ?></p>
        </div>
        <div style="text-align:left;float: left; width: 20%; border-bottom: 1px solid #CCC; box-sizing: border-box ; padding: 5px;"> 
            <b>Ano </b>
            <p><?= $car->getResult()[0]['ano'] ?></p>
        </div>
        <div style="text-align:left;float: left; width: 10%; border-bottom: 1px solid #CCC; box-sizing: border-box ; padding: 5px;"> 
            <b>Cor </b>
            <p><?= $car->getResult()[0]['cor'] ?></p>
        </div>
        <div style="text-align:left;float: left; width: 10%; border-bottom: 1px solid #CCC; box-sizing: border-box ; padding: 5px;"> 
            <b>Placa </b>
            <p><?= $car->getResult()[0]['placa'] ?></p>
        </div>
        
        <div style="clear:both; width:100%;"> </div>
        
                <div style="text-align:left;float: left; width: 100%; border-bottom: 1px solid #CCC; box-sizing: border-box ; padding: 5px;"> 
            <h3> <i class="fas fa-check"></i> Itens do Pedido </h3>
                    <div style="text-align:left;float: left; width: 10%; border-bottom: 1px solid #CCC; box-sizing: border-box ; padding: 5px;"> 
            <b> Qtd</b>
            
        </div>
        
        <div style="text-align:left;float: left; width: 70%; border-bottom: 1px solid #CCC; box-sizing: border-box ; padding: 5px;"> 
            <b> Descrição</b>
           
        </div>
        
        <div style="text-align:left;float: left; width: 20%; border-bottom: 1px solid #CCC; box-sizing: border-box ; padding: 5px;"> 
            <b> Valor Unit</b>
           
        </div>
            <?php 
            $item = new Source\Models\Read();
            $item->ExeRead("app_itens", "WHERE pedido_id = :b", 
                    "b={$_GET["pedido"]}");
                    $item->getResult();
                    
                    foreach ($item->getResult() as $itens) {

            ?>
        </div>
        
        <div style="text-align:left;float: left; width: 10%; border-bottom: 1px solid #CCC; box-sizing: border-box ; padding: 5px;"> 
            
            <p> <?= $itens["qtd"] ?> </p>
        </div>
        
        <div style="text-align:left;float: left; width: 70%; border-bottom: 1px solid #CCC; box-sizing: border-box ; padding: 5px;"> 
           
            <p> <?= $itens["descricao"] ?> </p>
        </div>
        
        <div style="text-align:left;float: left; width: 20%; border-bottom: 1px solid #CCC; box-sizing: border-box ; padding: 5px;"> 
           
            <p> <?= number_format($itens["valor_unit"] / 100, 2, ",", "."); ?> </p>
        </div>
        
                    <?php } ?>
        
         <div style="clear:both; width:100%;"> </div>
        
                <div style="text-align:left;float: left; width: 100%; border-bottom: 1px solid #CCC; box-sizing: border-box ; padding: 5px;"> 
                    <h3> <i class="fas fa-info-circle"></i> Detalhes </h3>
                    <?php 
                    $details = new Source\Models\Read();
                    $details->ExeRead("app_pedidos_detalhes", "WHERE pedido_id = :a", "a={$_GET["pedido"]}");
                   echo $details->getResult()[0]["detalhes"];
                    ?>
                </div>
         
            <div style="clear:both; width:100%;"> </div>
            
               <div style="text-align:left;float: left; width: 100%; border-bottom: 1px solid #CCC; box-sizing: border-box ; padding: 5px;"> 
                    <h3> <i class="fas fa-money-check-alt"></i> Recibo </h3>
                    <?php 
                   $recibo = new Source\Models\Read();
                   $recibo->ExeRead("app_recibo", "WHERE pedido_id = :a", "a={$_GET["pedido"]}");
                   $recibo->getResult();
                    ?>
                </div>
            
            <div style="text-align:left;float: left; width: 20%; border-bottom: 1px solid #CCC; box-sizing: border-box ; padding: 5px;"> 
                <b>Valor</b>
                <p><?= $recibo->getResult()[0]["valor"] ?> </p>
            </div>
            
            <div style="text-align:left;float: left; width: 40%; border-bottom: 1px solid #CCC; box-sizing: border-box ; padding: 5px;"> 
                <b>Descrição</b>
                <p><?= $recibo->getResult()[0]["descricao"] ?> </p>
            </div>
            
            <div style="text-align:left;float: left; width: 40%; border-bottom: 1px solid #CCC; box-sizing: border-box ; padding: 5px;"> 
                <b>Forma Pagamento</b>
                <p><?= $recibo->getResult()[0]["forma_pagamento"] ?> </p>
            </div>
            
            <div style="text-align:left;float: left; width: 100%; border-bottom: 1px solid #CCC; box-sizing: border-box ; padding: 5px;"> 
                <p> <?php 
            $local = new Source\Models\Read();
            $local->ExeRead("app_local_data", "WHERE pedido_id = :a", "a={$_GET["pedido"]}");
            echo $local->getResult()[0]["local"];
            ?></p>
            </div>
            
             <div style="clear:both; width:100%;"> </div>
             <div style="text-align:left;float: left; width: 10%; border-bottom: 1px solid #CCC; box-sizing: border-box ; padding: 5px;" style="border-bottom:solid 1px #fff"> </div>
             <div style="text-align:left;float: left; width: 30%; border-bottom: 1px solid #CCC; box-sizing: border-box ; padding: 5px;">
                 </br></br>
             <div style="text-align:left;float: left; width: 100%; border-bottom: 1px solid #CCC; box-sizing: border-box ; padding: 5px;"> </div>
             <div style="text-align:left;float: left; width: 100%; border-bottom: 1px solid #CCC; box-sizing: border-box ; padding: 5px;"> 
             <?= $cliente->getResult()[0]["nome"] ?></br>
             <?= $cliente->getResult()[0]["cpf"] ?> <?= $cliente->getResult()[0]["cnpj"] ?>
             </div>
             </div>
             
             
             <div style="text-align:left;float: left; width: 20%; border-bottom: 1px solid #CCC; box-sizing: border-box ; padding: 5px;" style="border-bottom:solid 1px #fff"> </div>
             <div style="text-align:left;float: left; width: 30%; border-bottom: 1px solid #CCC; box-sizing: border-box ; padding: 5px;"> 
                  </br></br>
             <div style="text-align:left;float: left; width: 100%; border-bottom: 1px solid #CCC; box-sizing: border-box ; padding: 5px;"> </div>
             <div style="text-align:left;float: left; width: 100%; border-bottom: 1px solid #CCC; box-sizing: border-box ; padding: 5px;"> 
             S3 Blindagem</br>
             CNPJ 04.410.560/0001-23
             </div>
             </div>

    </body>
</html>
