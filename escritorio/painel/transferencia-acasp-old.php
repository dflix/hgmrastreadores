<?php
session_start();
require('../_app/Config.inc.php');

$id = $_GET['id'];



$ver = new Read();
$ver->ExeRead("prevendaacasp", "WHERE id_venda= :p", "p={$id}");
$ver->getResult();
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>Transferencia Associação</title>
        <style>
             body{ font-family: Verdana, Tahoma, Arial; font-size: 0.9em; }
<?php

require('./estilo.css');
?>
        </style> 



    </head>
    <body>

        <header class="cabecalho"> 
            <div class="logoadesao">
                <img src="img/topo-pedido.jpg" width="500" />
            </div>
            <div class="clear"> </div>
            <div class="sessao"> 
                <p> Contrato Nº <?= $ver->getResult()[0]['contrato']; ?>  </p>
                </br>
            </div>
        </header>


    <main> 

        <h1 class="contratoh1">DADOS DO ASSOCIADO </h1>

        <div class="setenta background"> CLIENTE</div>
        <div class="trinta background"> DATA NASCIMENTO</div>
        <div class="clear"> </div>
        <div class="setenta"> <?= $ver->getResult()[0]['associado']; ?></div>
        <div class="trinta"> <?= $ver->getResult()[0]['data_nasc']; ?></div>
        <div class="clear"> </div>

        <div class="trintaetres background"> CPF / CNPJ </div>
        <div class="trintaetres background"> RG / IE </div>
        <div class="trintaetres background"> e-MAIL </div>
        <div class="clear"> </div>
        <div class="trintaetres"> <?= $ver->getResult()[0]['cpf']; ?> </div>
        <div class="trintaetres"> <?= $ver->getResult()[0]['rg']; ?> </div>
        <div class="trintaetres"> <?= $ver->getResult()[0]['email']; ?> </div>
        <div class="clear"> </div>

        <div class="cinquenta background"> Telefone Residencial </div>
        <div class="cinquenta background"> Telefone Celular </div>
        <div class="clear"> </div>
        <div class="cinquenta"> <?= $ver->getResult()[0]['telres']; ?> </div>
        <div class="cinquenta"> <?= $ver->getResult()[0]['telcel']; ?> </div>
        <div class="clear"> </div>

        <h1 class="contratoh1">DADOS DE COBRANÇA </h1>

        <div class="setenta background"> Endereço Cobrança </div>
        <div class="dez background"> Número </div>
        <div class="vinte background"> Complemento </div>
        <div class="clear"> </div>
        <div class="setenta"> <?= $ver->getResult()[0]['logradouro']; ?> </div>
        <div class="dez"> <?= $ver->getResult()[0]['numero']; ?> </div>
        <div class="vinte"> <?= $ver->getResult()[0]['complemento']; ?> </div>
        <div class="clear"> </div>

        <div class="vinteecinco background">Bairro </div>
        <div class="vinteecinco background">CEP </div>
        <div class="vinteecinco background">Cidade </div>
        <div class="vinteecinco background">Estado </div>
        <div class="clear"> </div>
        <div class="vinteecinco"> <?= $ver->getResult()[0]['bairro']; ?> </div>
        <div class="vinteecinco"> <?= $ver->getResult()[0]['cep']; ?> </div>
        <div class="vinteecinco"> <?= $ver->getResult()[0]['localidade']; ?> </div>
        <div class="vinteecinco"> <?= $ver->getResult()[0]['uf']; ?> </div>
        <div class="clear"> </div>

        <h1 class="contratoh1">DADOS DO VEÍCULO ATUAL </h1>

        <div class="vinteecinco background">Marca </div>
        <div class="vinteecinco background">Modelo </div>
        <div class="vinteecinco background">Ano </div>
        <div class="vinteecinco background">Cor </div>
        <div class="clear"> </div>
        <div class="vinteecinco"> <?= $ver->getResult()[0]['marca_modelo1']; ?> </div>
        <div class="vinteecinco"> . </div>
        <div class="vinteecinco"> <?= $ver->getResult()[0]['ano1']; ?> </div>
        <div class="vinteecinco"> <?= $ver->getResult()[0]['cor1']; ?> </div>
        <div class="clear"> </div>

        <div class="vinteecinco background">Chassi </div>
        <div class="vinteecinco background">Renavam </div>
        <div class="vinteecinco background">Placa </div>
        <div class="vinteecinco background">Valor </div>
        <div class="clear"> </div>
        <div class="vinteecinco"> <?= $ver->getResult()[0]['chassi1']; ?> </div>
        <div class="vinteecinco"> <?= $ver->getResult()[0]['renavam1']; ?> </div>
        <div class="vinteecinco"> <?= $ver->getResult()[0]['placa1']; ?> </div>
        <div class="vinteecinco"> <?= $ver->getResult()[0]['valor1']; ?></div>
        <div class="clear"> </div>
        
        
        <?php 
        if(empty($_GET['veiculo'])){

            ?>
        
        <h1 class="contratoh1">DADOS DO VEÍCULO ANTIGO </h1>

        <div class="vinteecinco background">Marca </div>
        <div class="vinteecinco background">Modelo </div>
        <div class="vinteecinco background">Ano </div>
        <div class="vinteecinco background">Cor </div>
        <div class="clear"> </div>
        <div class="vinteecinco"> <?= $ver->getResult()[0]['marca_modelo_t']; ?> </div>
        <div class="vinteecinco"> .</div>
        <div class="vinteecinco"> <?= $ver->getResult()[0]['ano_t']; ?> </div>
        <div class="vinteecinco"> <?= $ver->getResult()[0]['cor_t']; ?> </div>
        <div class="clear"> </div>

        <div class="vinteecinco background">Chassi </div>
        <div class="vinteecinco background">Renavam </div>
        <div class="vinteecinco background">Placa </div>
        <div class="vinteecinco background">Valor </div>
        <div class="clear"> </div>
        <div class="vinteecinco"> <?= $ver->getResult()[0]['chassi_t']; ?> </div>
        <div class="vinteecinco"> <?= $ver->getResult()[0]['renavam_t']; ?> </div>
        <div class="vinteecinco"> <?= $ver->getResult()[0]['placa_t']; ?> </div>
        <div class="vinteecinco"> <?= $ver->getResult()[0]['valor_t']; ?></div>
        <div class="clear"> </div>
        
        <?php  } ?>
        
        <h1 class="contratoh1">TRANSFERÊNCIA </h1>
        
        <div class="cinquenta background"> Valor taxa transferência </div>
        <div class="cinquenta background"> Forma pagamento transferência </div>
        <div class="clear"> </div>
        <div class="cinquenta"> <?php 
        if(empty($ver->getResult()[0]['valor_transf'])):
            
            echo "0.00";
            else:
                echo $ver->getResult()[0]['valor_transf'];
            
        endif;
         ?> </div>
        <div class="cinquenta"> <?php 
        if(empty($ver->getResult()[0]['pgto_transf'])):
            echo "transferência gratuita";
            else:
                echo $ver->getResult()[0]['pgto_transf'];
            
        endif;
        $ver->getResult()[0]['pgto_transf']; ?> </div>
        <div class="clear"> </div>
        
        <div class="setenta background"> Mensalidade Associação </div>
        <div class="trinta background"> </div>
        <div class="clear"> </div>
        <div class="setenta">R$ <?= $ver->getResult()[0]['mestotal']; ?> </div>
        <div class="trinta"> . </div>
        <div class="clear"> </div>

        
         <div class="setenta background"> Vendedor  </div>
        <div class="trinta background"> Telefones </div>
        <div class="clear"> </div>
        <div class="setenta"> <?php $puxavend = $ver->getResult()[0]['vendedor']; 
        
        $nomevend = new Read();
$nomevend->ExeRead("usuario", "WHERE id_usuario= :p", "p={$puxavend}");
$nomevend->getResult();

echo $nomevend->getResult()[0]['nome']; 
        ?> </div>
        <div class="trinta"> (11)2649-7349 / 2649-7348 </div>
        <div class="clear"> </div>
        <div class="clear"> </div>
        
        <div class="assinatura"> </div>
        <div class="assinatura"> </div>
        <div class="clear"> </div>
        <div class="dadosassinatura"> <?= $ver->getResult()[0]['associado']; ?> </div>
        <div class="dadosassinatura"> ASSOCIAÇÃO SÃO PAULO DE CAMINHONEIROS </div>
        <div class="clear"> </div>
        </br></br>
        
        São Paulo, 
        <?PHP echo date("d/m/Y");?>
        
        
        


    </main>

    <footer> 

    </footer>

</body>
</html>
