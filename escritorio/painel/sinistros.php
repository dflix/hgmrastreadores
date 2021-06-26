<?php
session_start();
require('../_app/Config.inc.php');

$id = $_GET['codigo'];



$ver = new Read();
$ver->ExeRead("prevenda", "WHERE codigo= :p", "p={$id}");
$ver->getResult();

$sinistro = new Read();
$sinistro->ExeRead("sinistros", "WHERE codigo= :p", "p={$id}");
$sinistro->getResult();
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>adesão HGM RASTREADORES</title>
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
                <img src="img/adesao.png" width="500" />
            </div>
              <div class="clear"> </div>
            <div class="sessao"> 
                <p> Contrato Nº <?= $ver->getResult()[0]['codigo']; ?>  </p>
                </br>
            </div>
        </header>

        <div class="clear"> </div>
    <main> 

        <h1 class="contratoh1">DADOS DO ASSOCIADO </h1>

        <div class="setenta background"><span class="branquinho"> . </span> CLIENTE</div>
        <div class="trinta background"><span class="branquinho"> . </span> DATA NASCIMENTO</div>
        <div class="clear"> </div>
        <div class="setenta"> <span class="branquinho"> . </span> <?= $ver->getResult()[0]['cliente']; ?></div>
        <div class="trinta">  <span class="branquinho"> . </span> <?= $ver->getResult()[0]['data_nasc']; ?></div>
        <div class="clear"> </div>

        <div class="trintaetres background"><span class="branquinho"> . </span> CPF / CNPJ </div>
        <div class="trintaetres background"><span class="branquinho"> . </span> RG / IE </div>
        <div class="trintaetres background"><span class="branquinho"> . </span> E-MAIL </div>
        <div class="clear"> </div>
        <div class="trintaetres"> <span class="branquinho"> . </span> <?= $ver->getResult()[0]['cpf']; ?> </div>
        <div class="trintaetres"> <span class="branquinho"> . </span> <?= $ver->getResult()[0]['rg']; ?> </div>
        <div class="trintaetres"> <span class="branquinho"> . </span> <?= $ver->getResult()[0]['email']; ?> </div>
        <div class="clear"> </div>

        <div class="cinquenta background"><span class="branquinho"> . </span> Telefone Residencial </div>
        <div class="cinquenta background"><span class="branquinho"> . </span> Telefone Celular </div>
        <div class="clear"> </div>
        <div class="cinquenta"> <span class="branquinho"> . </span> <?= $ver->getResult()[0]['telres']; ?> </div>
        <div class="cinquenta"> <span class="branquinho"> . </span> <?= $ver->getResult()[0]['telcel']; ?> </div>
        <div class="clear"> </div>

<!--        <h1 class="contratoh1">DADOS DE COBRANÇA </h1>

        <div class="setenta background"><span class="branquinho"> . </span> Endereço Cobrança </div>
        <div class="trinta background"> <span class="branquinho"> . </span>Número </div>

        <div class="clear"> </div>
        <div class="setenta"> <span class="branquinho"> . </span> <?= $ver->getResult()[0]['endereco']; ?> </div>
        <div class="dez"> <span class="branquinho"> . </span> <?= $ver->getResult()[0]['numero']; ?> </div>

        <div class="clear"> </div>

        <div class="cem background"><span class="branquinho"> . </span> Complemento </div>
        <div class="cem"> <span class="branquinho"> . </span> <?= $ver->getResult()[0]['complemento']; ?> </div>
         <div class="clear"> </div>
         
        <div class="vinteecinco background"><span class="branquinho"> . </span>Bairro </div>
        <div class="vinteecinco background"><span class="branquinho"> . </span>CEP </div>
        <div class="vinteecinco background"><span class="branquinho"> . </span>Cidade </div>
        <div class="vinteecinco background"><span class="branquinho"> . </span>Estado </div>
        <div class="clear"> </div>
        <div class="vinteecinco"> <span class="branquinho"> . </span> <?= $ver->getResult()[0]['bairro']; ?> </div>
        <div class="vinteecinco"> <span class="branquinho"> . </span> <?= $ver->getResult()[0]['cep']; ?> </div>
        <div class="vinteecinco"> <span class="branquinho"> . </span> <?= $ver->getResult()[0]['cidade']; ?> </div>
        <div class="vinteecinco"> <span class="branquinho"> . </span> <?= $ver->getResult()[0]['uf']; ?> </div>
        <div class="clear"> </div>-->

        <h1 class="contratoh1">DADOS DO VEÍCULO </h1>

        <div class="vinte background"><span class="branquinho"> . </span>Bloqueio </div>
        <div class="vinte background"><span class="branquinho"> . </span>Marca </div>
        <div class="vinte background"><span class="branquinho"> . </span>Modelo </div>
        <div class="vinte background"><span class="branquinho"> . </span>Ano </div>
        <div class="vinte background"><span class="branquinho"> . </span>Cor </div>
        <div class="clear"> </div>
        <div class="vinte"> <span class="branquinho"> . </span> <?php 
        if($ver->getResult()[0]['bloqueio'] == "0"):
            ECHO "NÃO";
            else:
            echo "SIM";
        endif;
        $ver->getResult()[0]['bloqueio']; ?> </div>
        <div class="vinte"> <span class="branquinho"> . </span> <?= $ver->getResult()[0]['marca']; ?> </div>
        <div class="vinte"> <span class="branquinho"> . </span> <?= $ver->getResult()[0]['modelo']; ?> </div>
        <div class="vinte"> <span class="branquinho"> . </span> <?= $ver->getResult()[0]['ano']; ?> </div>
        <div class="vinte"> <span class="branquinho"> . </span> <?= $ver->getResult()[0]['cor']; ?> </div>
        <div class="clear"> </div>

        <div class="vinte background"><span class="branquinho"> . </span>Chassi </div>
        <div class="vinte background"><span class="branquinho"> . </span>Renavam </div>
        <div class="vinte background"><span class="branquinho"> . </span>Placa </div>
        <div class="vinte background"><span class="branquinho"> . </span> Fipe </div>
        <div class="vinte background"><span class="branquinho"> . </span> Valor </div>
        <div class="clear"> </div>
        <div class="vinte"> <span class="branquinho"> . </span> <?= $ver->getResult()[0]['chassi']; ?> </div>
        <div class="vinte"> <span class="branquinho"> . </span> <?= $ver->getResult()[0]['renavam']; ?> </div>
        <div class="vinte"> <span class="branquinho"> . </span> <?= $ver->getResult()[0]['placa']; ?> </div>
        <div class="vinte">  <span class="branquinho"> . </span><?= $ver->getResult()[0]['fipe']; ?></div>
        <div class="vinte">  <span class="branquinho"> . </span><?= $ver->getResult()[0]['valor']; ?></div>
        <div class="clear"> </div>
        


        <h1 class="contratoh1">OCORRÊNCIA </h1>

        <div class="cem background"> <span class="branquinho"> . </span>Ocorrencia </div>
      
        <div class="clear"> </div>
        <div class="cem"> <span class="branquinho"> . </span> 
            <h4> Boletim de Ocorrência Nº  <?= $sinistro->getResult()[0]['bo']; ?> </h4>
        <?= $sinistro->getResult()[0]['ocorrencia']; ?> </div>
       
        <div class="clear"> </div>

        <h1 class="contratoh1">SERVIÇO </h1>

        <div class="cem background"> <span class="branquinho"> . </span>serviços Realizados</div>
      
        <div class="clear"> </div>
        <div class="cem"> <span class="branquinho"> . </span> 
            
        <?= $sinistro->getResult()[0]['servicos']; ?> </div>
       
        <div class="clear"> </div>

        <h1 class="contratoh1">Franquia </h1>

        <div class="cem background"> <span class="branquinho"> . </span>Franquia e pagamentos</div>
      
        <div class="clear"> </div>
        <div class="cem"> <span class="branquinho"> . </span> 
            
        <?= $sinistro->getResult()[0]['pagamento']; ?> </div>
       
        <div class="clear"> </div>

<!--        <div class="setenta background"> <span class="branquinho"> . </span> <span style="font-size:0.8em"><?= $ver->getResult()[0]['tipo_plano']; ?></span> </div>
        <div class="trinta background"> <span class="branquinho"> . </span>Vencimento </div>
        <div class="clear"> </div>
        <div class="setenta">  <span class="branquinho"> . </span><?= $ver->getResult()[0]['plano_desc']; ?> - Total R$ <?= $ver->getResult()[0]['plano']; ?> </div>
        <div class="trinta">  <span class="branquinho"> . </span><?= $ver->getResult()[0]['vencimento']; ?> </div>
        <div class="clear"> </div>-->


<!--        <div class="setenta background"> <span class="branquinho"> . </span> Vendedor  </div>
        <div class="trinta background"> <span class="branquinho"> . </span> Telefones </div>
        <div class="clear"> </div>
        <div class="setenta">  <span class="branquinho"> . </span> <?php
            $puxavend = $ver->getResult()[0]['vendedor'];

            $nomevend = new Read();
            $nomevend->ExeRead("usuario", "WHERE id_usuario= :p", "p={$puxavend}");
            $nomevend->getResult();

            echo $nomevend->getResult()[0]['nome'];
            ?> </div>
        <div class="trinta"> 0800 701 07 07 </div>-->
        <div class="clear"> </div>
        <div class="clear"> </div>

        <div class="assinatura"> </div>
        <div class="assinatura"> </div>
        <div class="clear"> </div>
        <div class="dadosassinatura"> <?= $ver->getResult()[0]['cliente']; ?> </div>
        <div class="dadosassinatura"> HGM PROTEÇÃO E RECUPERAÇÃO DE VEÍCULOS </BR>
        CNPJ 36.726.851/0001-63
        </div>
        <div class="clear"> </div>
        </br></br>

        São Paulo, 
<?PHP echo date("d/m/Y"); ?>



        <div class="cem" style="border: 1px solid #ccc;"> 
            <h2 style="text-align: center; font-size: 20px;"> ROUBO E FURTO</h2>
            <h3 style="text-align: center; font-size: 20px;"> 0800 - 717 0707</h3>
             <h2 style="text-align: center; font-size: 20px;"> GUINCHO </h2>
             <h3 style="text-align: center; font-size: 20px;">(11) 9 9534-7531 - WHATSAPP</h3>
             <p style="text-align: center; font-size: 14px;">Baixe o APP MOVIT  </p>
        </div>


    </main>

    <footer> 

    </footer>

</body>
</html>
