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
            <div class="clear"> </div>
        </header>


    <main> 
        
        <h1 class="contratoh1"> TERMO DE ADESÃO </h1>
        
                 <div class="setenta background"> Vendedor  </div>
        <div class="trinta background"> Telefones </div>
        <div class="clear"> </div>
        <div class="setenta"> <?php $puxavend = $ver->getResult()[0]['vendedor']; 
        
        $nomevend = new Read();
$nomevend->ExeRead("usuario", "WHERE id_usuario= :p", "p={$puxavend}");
$nomevend->getResult();

echo $nomevend->getResult()[0]['nome']; 
        ?> </div>
        <div class="trinta"> (11)2649-7349 / 2649-7348  </div>
        
        <div class="clear"> </div>
        
        <div class="vinteecinco background"> Mes Associação</div>
        <div class="vinteecinco background"> Mes Rastreador</div>
        <div class="vinteecinco background"> Assistência 24hs</div>
        <div class="vinteecinco background"> Total</div>
        <div class="clear"> </div>
        <div class="vinteecinco"><span class="arruma"> . </span> <?= $ver->getResult()[0]['mesacasp']; ?></div>
        <div class="vinteecinco"><span class="arruma"> . </span> <?= $ver->getResult()[0]['mesrastreador']; ?></div>
        <div class="vinteecinco"><span class="arruma"> . </span> <?= $ver->getResult()[0]['assist']; ?></div>
        <div class="vinteecinco"><span class="arruma"> . </span> <?= $ver->getResult()[0]['mestotal']; ?></div>
        <div class="clear"> </div>
        
        <div class="vinteecinco background">Contrato </div>
        <div class="vinteecinco background">Adesão</div>
        <div class="cinquenta background">Data da Adesão</div>
      
        <div class="clear"> </div>
        <div class="vinteecinco"><span class="arruma"> . </span> <?= $ver->getResult()[0]['contrato']; ?> </div>
        <div class="vinteecinco"><span class="arruma"> . </span> <?= $ver->getResult()[0]['adesao']; ?> </div>
        <div class="cinquenta"><span class="arruma"> . </span> <?= date("d/m/Y" , strtotime($ver->getResult()[0]['data'])); ?> </div>
       
        <div class="clear"> </div>

        <h1 class="contratoh1">DADOS DO ASSOCIADO </h1>

        <div class="setenta background"> CLIENTE</div>
        <div class="trinta background"> DATA NASCIMENTO</div>
        <div class="clear"> </div>
        <div class="setenta"><span class="arruma"> . </span> <?= $ver->getResult()[0]['associado']; ?></div>
        <div class="trinta"><span class="arruma"> . </span> <?= $ver->getResult()[0]['data_nasc']; ?></div>
        <div class="clear"> </div>

        <div class="trintaetres background"> CPF / CNPJ </div>
        <div class="trintaetres background"> RG / IE </div>
        <div class="trintaetres background"> e-MAIL </div>
        <div class="clear"> </div>
        <div class="trintaetres"><span class="arruma"> . </span> <?= $ver->getResult()[0]['cpf']; ?> </div>
        <div class="trintaetres"><span class="arruma"> . </span> <?= $ver->getResult()[0]['rg']; ?> </div>
        <div class="trintaetres"><span class="arruma"> . </span> <?= $ver->getResult()[0]['email']; ?> </div>
        <div class="clear"> </div>

        <div class="cinquenta background"> Telefone Residencial </div>
        <div class="cinquenta background"> Telefone Celular </div>
        <div class="clear"> </div>
        <div class="cinquenta"><span class="arruma"> . </span> <?= $ver->getResult()[0]['telres']; ?> </div>
        <div class="cinquenta"><span class="arruma"> . </span> <?= $ver->getResult()[0]['telcel']; ?> </div>
        <div class="clear"> </div>

        <h1 class="contratoh1">ENDEREÇO DE COBRANÇA </h1>

        <div class="setenta background"> Endereço Cobrança </div>
        <div class="dez background"> Número </div>
        <div class="vinte background"> Complemento </div>
        <div class="clear"> </div>
        <div class="setenta"><span class="arruma"> . </span> <?= $ver->getResult()[0]['logradouro']; ?> </div>
        <div class="dez"><span class="arruma"> . </span> <?= $ver->getResult()[0]['numero']; ?> </div>
        <div class="vinte"><span class="arruma"> . </span> <?= $ver->getResult()[0]['complemento']; ?> </div>
        <div class="clear"><span class="arruma"> . </span> </div>

        <div class="vinteecinco background">Bairro </div>
        <div class="vinteecinco background">CEP </div>
        <div class="vinteecinco background">Cidade </div>
        <div class="vinteecinco background">Estado </div>
        <div class="clear"> </div>
        <div class="vinteecinco"><span class="arruma"> . </span> <?= $ver->getResult()[0]['bairro']; ?> </div>
        <div class="vinteecinco"><span class="arruma"> . </span> <?= $ver->getResult()[0]['cep']; ?> </div>
        <div class="vinteecinco"><span class="arruma"> . </span> <?= $ver->getResult()[0]['localidade']; ?> </div>
        <div class="vinteecinco"><span class="arruma"> . </span> <?= $ver->getResult()[0]['uf']; ?> </div>
        <div class="clear"> </div>

        <h1 class="contratoh1">INFORMAÇÕES DO VEÍCULO </h1>

        <div class="vinteecinco background">Marca Modelo </div>
        <div class="vinteecinco background">Ano de Fabricação </div>
        <div class="vinteecinco background">Cor </div>
        <div class="vinteecinco background">Valor Estimado </div>
        <div class="clear"> </div>
        <div class="vinteecinco"><span class="arruma"> . </span> <?= $ver->getResult()[0]['marca_modelo1']; ?> </div>
        <div class="vinteecinco"><span class="arruma"> . </span> <?= $ver->getResult()[0]['ano1']; ?> </div>
        <div class="vinteecinco"><span class="arruma"> . </span> <?= $ver->getResult()[0]['cor1']; ?> </div>
        <div class="vinteecinco"><span class="arruma"> . </span> <?= $ver->getResult()[0]['valor1']; ?> </div>
        <div class="clear"> </div>

        <div class="quinze background">Fipe </div>
        <div class="vinte background">Chassi </div>
        <div class="vinte background">Renavam </div>
        <div class="dez background">Placa </div>
        <div class="quinze background">Rastreamento </div>
        <div class="vinte background">Alienado </div>
        <div class="clear"> </div>
        <div class="quinze"><span class="arruma"> . </span> <?= $ver->getResult()[0]['fipe1']; ?> </div>
        <div class="vinte"><span class="arruma"> . </span> <?= $ver->getResult()[0]['chassi1']; ?> </div>
        <div class="vinte"><span class="arruma"> . </span> <?= $ver->getResult()[0]['renavam1']; ?> </div>
        <div class="dez"><span class="arruma"> . </span> <?= $ver->getResult()[0]['placa1']; ?> </div>
        <div class="quinze"><span class="arruma"> . </span> <?= $ver->getResult()[0]['empresart_1']; ?></div>
        <div class="vinte"><span class="arruma"> . </span> <?= $ver->getResult()[0]['alienado1']; ?></div>
        <div class="clear"> </div>
        <h1 class="contratoh1">INFORMAÇOES DO IMPLEMENTO CARRETA </h1>


     
        <div class="vinteecinco background">Marca Modelo </div>
        <div class="vinteecinco background">Ano de Fabricação </div>
        <div class="vinteecinco background">Cor </div>
        <div class="vinteecinco background">Valor Estimado </div>
        <div class="clear"> </div>
        <div class="vinteecinco"><span class="arruma"> . </span> <?= $ver->getResult()[0]['marca_modelo2']; ?> </div>
        <div class="vinteecinco"><span class="arruma"> . </span> <?= $ver->getResult()[0]['ano2']; ?> </div>
        <div class="vinteecinco"><span class="arruma"> . </span> <?= $ver->getResult()[0]['cor2']; ?> </div>
        <div class="vinteecinco"><span class="arruma"> . </span> <?php $ver->getResult()[0]['valor2']; ?> </div>
       
        <div class="clear"> </div>

        
        <div class="vinteecinco background">Chassi </div>
        <div class="vinteecinco background">Renavam </div>
        <div class="vinteecinco background">Placa </div>
        <div class="vinteecinco background">Alienado por </div>
        <div class="clear"> </div>
        <div class="vinteecinco"><span class="arruma"> . </span> <?= $ver->getResult()[0]['chassi2']; ?> </div>
        <div class="vinteecinco"><span class="arruma"> . </span> <?= $ver->getResult()[0]['renavam2']; ?> </div>
        <div class="vinteecinco"><span class="arruma"> . </span> <?= $ver->getResult()[0]['placa2']; ?> </div>
        <div class="vinteecinco"> <span class="arruma"> . </span><?= $ver->getResult()[0]['alienado2']; ?></div>
        <div class="vinteecinco"> <span class="arruma"> . </span></div>
        <div class="clear"> </div>
        
        
         <div class="cem"> 
            <h4>Vigência Contratual</h4>
            <p>O presente passa a vigorar, apartir da vistoria e instalação do localizador ou rastreador via satélite.</p>
        </div>
        
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
        <div class="dadosassinatura"> ASSOCIAÇÃO SÃO PAULO	</br>
        CNPJ 20.911.572/0001-30
        </div>
        <div class="clear"> </div>
        </br></br></br></br></br></br>
      
        
        <div class="cem"> 
            <h2> TERMO DE ADESÃO</h2>
        E Desta Associação
Através dos presente contrato de adesão,declaro minha vontade em aderir ao plano de beneficios
desta Associação conferindo proteção ao veículo acima descrito, de minha propriedade.
Estou ciente de ainda a proteção de veículos somente se inicia quando houver o pagamento dos 
valores acordados, bem como após a realização de vistoria prévia no veículo.
Declaro estar ciente que o não pagamento dos valores ajustados, neste contrato me excluirá
automaticamente da condição de associado desta associação, não me dando o direito de 
reclamar por qualquer via de direitos do associado, nem reembolso dos valores pagos até a
presente data.
Declaro ainda, sob a pena da lei, que o veículo sobre o qual recairá os beneficios deste contrato
se encontra regularmente legalizado junto ao DETRAN competente, não pesando sobre o mesmo
ônus de furto / roubo.
Declaro conhecer e estar de acordo com todas as clausulas do Regulamento do Associado desta
associação (cujo o exemplar foi entregue ao associado nesta data) me comprometendo a respeitar
e zelar pelo efetivo cumprimento de todas elas.									
Declaro ainda que todas as informações que constam neste documento são verídicas e de minha
inteira responsabilidade, passíveis de serem verificadas a qualquer momento, sob pena de sanções
legais cíveis e penais cabíveis, sem prejuizo da imediata exclusão do associado caso venham a ser
descobertas fraudes nas informações prestadas pelo mesmo.

        </div>
        
        <div class="clear"> </div>
        
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
