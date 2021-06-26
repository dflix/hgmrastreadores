<?php
session_start();
require('../_app/Config.inc.php');

$id = $_GET['id'];



$ver = new Read();
$ver->ExeRead("prevendaacasp", "WHERE id_venda= :p", "p={$id}");
$ver->getResult();

$dataadesao = $ver->getResult()[0]['data'];
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>adesão Protege Facil</title>
        <style> 
              body{ font-family: Verdana, Tahoma, Arial; font-size: 0.9em; }
            .arruma{ color:#fff;}
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

        </header>
        <div class="clear"> </div>

    <main> 
        
        <h1 class="contratoh1"> LAUDO DE VISTORIA </h1>
        
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
        
        <div class="vinteecinco background"> Mes Associação</div>
        <div class="vinteecinco background"> Mes Rastreador</div>
        <div class="vinteecinco background"> Assistência 24hs</div>
        <div class="vinteecinco background"> Total</div>
        <div class="clear"> </div>
        <div class="vinteecinco"> <?= $ver->getResult()[0]['mesacasp']; ?></div>
        <div class="vinteecinco"> <?= $ver->getResult()[0]['mesrastreador']; ?></div>
        <div class="vinteecinco"> <?= $ver->getResult()[0]['assist']; ?></div>
        <div class="vinteecinco"> <?= $ver->getResult()[0]['mestotal']; ?></div>
        <div class="clear"> </div>
        
        <div class="vinteecinco background">Contrato </div>
        <div class="vinteecinco background">Adesão</div>
        <div class="vinteecinco background">Pagamento da Adesão</div>
        <div class="vinteecinco background">Data Adesão</div>
        <div class="clear"> </div>
        <div class="vinteecinco"> <?= $ver->getResult()[0]['contrato']; ?> </div>
        <div class="vinteecinco"> <?= $ver->getResult()[0]['adesao']; ?> </div>
        <div class="vinteecinco"> <?= $ver->getResult()[0]['pgto_adesao']; ?> </div>
        <div class="vinteecinco"> <?= date("d/m/Y", strtotime($dataadesao)); ?> </div>
        <div class="clear"> </div>

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

        <h1 class="contratoh1">DADOS DO VEÍCULO </h1>

        <div class="vinteecinco background">Marca Modelo </div>
        <div class="vinteecinco background">Ano de Fabricação </div>
        <div class="vinteecinco background">Cor </div>
        <div class="vinteecinco background">Valor Estimado </div>
        <div class="clear"> </div>
        <div class="vinteecinco"> <?= $ver->getResult()[0]['marca_modelo1']; ?> </div>
        <div class="vinteecinco"> <?= $ver->getResult()[0]['ano1']; ?> </div>
        <div class="vinteecinco"> <?= $ver->getResult()[0]['cor1']; ?> </div>
        <div class="vinteecinco"> <?= $ver->getResult()[0]['valor1']; ?> </div>
        <div class="clear"> </div>

        <div class="vinteecinco background">Chassi </div>
        <div class="vinteecinco background">Renavam </div>
        <div class="vinteecinco background">Placa </div>
        <div class="vinteecinco background">Rastreamento </div>
        <div class="clear"> </div>
        <div class="vinteecinco"> <?= $ver->getResult()[0]['chassi1']; ?> </div>
        <div class="vinteecinco"> <?= $ver->getResult()[0]['renavam1']; ?> </div>
        <div class="vinteecinco"> <?= $ver->getResult()[0]['placa1']; ?> </div>
        <div class="vinteecinco"> <?= $ver->getResult()[0]['empresart_1']; ?></div>
        <div class="clear"> </div>
        <h1 class="contratoh1">DADOS DO IMPLEMENTO CARRETA </h1>

        <div class="vinteecinco background">Marca Modelo </div>
        <div class="vinteecinco background">Ano de Fabricação </div>
        <div class="vinteecinco background">Cor </div>
        <div class="vinteecinco background">Valor Estimado </div>
        <div class="clear"> </div>
        <div class="vinteecinco">. <?= $ver->getResult()[0]['marca_modelo2']; ?> </div>
        <div class="vinteecinco">. <?= $ver->getResult()[0]['ano2']; ?> </div>
        <div class="vinteecinco">. <?= $ver->getResult()[0]['cor2']; ?> </div>
        <div class="vinteecinco">. <?php  $ver->getResult()[0]['valor2']; ?> </div>
        <div class="clear"> </div>

        <div class="vinteecinco background">Chassi </div>
        <div class="vinteecinco background">Renavam </div>
        <div class="vinteecinco background">Placa </div>
        <div class="vinteecinco background">. </div>
        <div class="clear"> </div>
        <div class="vinteecinco">. <?= $ver->getResult()[0]['chassi2']; ?> </div>
        <div class="vinteecinco">. <?= $ver->getResult()[0]['renavam2']; ?> </div>
        <div class="vinteecinco">. <?= $ver->getResult()[0]['placa2']; ?> </div>
        <div class="vinteecinco"> .</div>
        <div class="clear"> </div>
        

        <div class="cem"> 
            <h4>Decalque do Chassi</h4>
            <p class="branquinho">.</p>
        </div>
        
        <div class="cem branquinho"> . </div>
        <div class="cem branquinho"> . </div>
        <div class="cem branquinho"> . </div>
        <div class="cem branquinho"> . </div>
        <div class="cem branquinho"> . </div>
       


        <div class="assinatura"> </div>
        <div class="assinatura"> </div>
        <div class="clear"> </div>
        <div class="dadosassinatura"> <?= $ver->getResult()[0]['associado']; ?>
            </br><?= $ver->getResult()[0]['cpf']; ?>
        </div>
        <div class="dadosassinatura"> Associação dos Caminhoneiros do Est.São Paulo	</br>
        CNPJ 20.911.572/0001-30
        </div>
        <div class="clear"> </div>
        </br></br>
        
       
    </main>

    <footer> 

    </footer>

</body>
</html>
