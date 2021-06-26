<?php
session_start();
require('../_app/Config.inc.php');

$id = $_GET['id'];



$ver = new Read();
$ver->ExeRead("prevenda", "WHERE id_venda= :p", "p={$id}");
$ver->getResult();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Adesão HGM Rastreadores</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
      <table class="table"> 
          <tr> 
              <td>  <img src="img/logo-protege.png" width="100" /></td>
              <td><p> Contrato Nº <?= $ver->getResult()[0]['codigo']; ?> </p>
             
              </td>
          </tr>
      </table>
      <!--<h5 class="page-header"> DADOS DO ASSOCIADO </h5>-->
      
      <table class="table"> 
          <thead> 
              <tr> 
                  <th>NOME </th>
                  <th>DATA NASCIMENTO </th>
              </tr>
          </thead>
      
                <tbody> 
              <tr> 
                  <td><?= $ver->getResult()[0]['cliente']; ?> </td>
                  <td><?= $ver->getResult()[0]['data_nasc']; ?> </td>
              </tr>
          </tbody>
      </table>
      
            <table class="table"> 
          <thead> 
              <tr> 
                  <th>CPF/CNPJ </th>
                  <th>RG / IE </th>
                  <th>E-MAIL </th>
                  <th>TELEFONE </th>
                  <th>CELULAR </th>
              </tr>
          </thead>
           <tbody> 
              <tr> 
                  <td><?= $ver->getResult()[0]['cpf']; ?> </td>
                  <td><?= $ver->getResult()[0]['rg']; ?> </td>
                  <td><?= $ver->getResult()[0]['email']; ?> </td>
                  <td><?= $ver->getResult()[0]['telres']; ?> </td>
                  <td><?= $ver->getResult()[0]['telcel']; ?> </td>
              </tr>
          </tbody>
          
            </table>
      
      <!--<h5 class="page-header">DADOS DE COBRANÇA </h5>-->
      
            <table class="table"> 
          <thead> 
              <tr> 
                  <th>ENDEREÇO </th>
                  <th>Nº </th>
                  <th>COMPLEMENTO </th>
              </tr>
          </thead>
                    <tbody> 
              <tr> 
                  <td><?= $ver->getResult()[0]['endereco']; ?> </td>
                  <td><?= $ver->getResult()[0]['numero']; ?> </td>
                  <td><?= $ver->getResult()[0]['complemento']; ?> </td>
              </tr>
          </tbody>

            </table>
      
                  <table class="table"> 
          <thead> 
              <tr> 
                  <th>BAIRRO </th>
                  <th>CEP </th>
                  <th>CIDADE </th>
                  <th>ESTADO </th>
              </tr>
          </thead>
          
          <tbody> 
              <tr> 
                  <td><?= $ver->getResult()[0]['bairro']; ?> </td>
                  <td><?= $ver->getResult()[0]['cep']; ?> </td>
                  <td><?= $ver->getResult()[0]['cidade']; ?> </td>
                  <td><?= $ver->getResult()[0]['uf']; ?> </td>
              </tr>
          </tbody>
                  </table>
      
      <!--<h5 class="page-header">DADOS DO VEICULO </h5>-->
      
                        <table class="table"> 
          <thead> 
              <tr> 
                  <th>MARCA </th>
                  <th>MODELO </th>
                  <th>ANO </th>
                  <th>COR </th>
                  <th>PLACA </th>
              </tr>
          </thead>
          
                    <tbody> 
              <tr> 
                  <td><?= $ver->getResult()[0]['marca']; ?> </td>
                  <td><?= $ver->getResult()[0]['modelo']; ?> </td>
                  <td><?= $ver->getResult()[0]['ano']; ?> </td>
                  <td><?= $ver->getResult()[0]['cor']; ?> </td>
                  <td><?= $ver->getResult()[0]['placa']; ?></td>
              </tr>
          </tbody>
                        </table>
      
                              <table class="table"> 
          <thead> 
              <tr> 
                  <th>CHASSI </th>
                  <th>RENAVAM </th>
                  <th>FIPE </th>
                  <th>VALOR </th>
                  
              </tr>
          </thead>
                    <tbody> 
              <tr> 
                  <td><?= $ver->getResult()[0]['chassi']; ?> </td>
                  <td><?= $ver->getResult()[0]['renavam']; ?> </td>
                  <td><?= $ver->getResult()[0]['fipe']; ?> </td>
                  <td><?= $ver->getResult()[0]['valor']; ?> </td>
                  
              </tr>
          </tbody>
                              </table>
      
      <!--<h5 class="page-header">ADESÃO </h5>-->
      
       <table class="table"> 
          <thead> 
              <tr> 
                  <th>ADESÃO</th>
                  <th>PGTO </th>
                  <th>PLANO </th>
                  <th>VENCIMENTO </th>
                  
              </tr>
          </thead>
          
                    <tbody> 
              <tr> 
                  <td><?= $ver->getResult()[0]['adesao']; ?> </td>
                  <td><?= $ver->getResult()[0]['pgto_adesao']; ?> </td>
                  <td><?= $ver->getResult()[0]['plano_desc']; ?> - Total R$ <?= $ver->getResult()[0]['plano']; ?> </td>
                  <td><?= $ver->getResult()[0]['vencimento']; ?> </td>
                 
              </tr>
          </tbody>
          
       </table>
      
            
       <table class="table"> 
          <thead> 
              <tr> 
                  <th>VENDEDOR</th>
                  <th>TELEFONES </th>
       
                  
              </tr>
          </thead>
          
                    <tbody> 
              <tr> 
                  <td> <?php
            $puxavend = $ver->getResult()[0]['vendedor'];

            $nomevend = new Read();
            $nomevend->ExeRead("usuario", "WHERE id_usuario= :p", "p={$puxavend}");
            $nomevend->getResult();

            echo $nomevend->getResult()[0]['nome'];
            ?> </td>
                  <td>Roubo e Furto 0800 701 07 07 / GUINCHO (11) 9 9534-7531 - WHATSAPP - Baixe o APP MOVIT  </td>
                 
              </tr>
          </tbody>
       </table>
      
             <table class="table"> 
          <thead> 
              <tr> 
                  <th> <?= $ver->getResult()[0]['cliente']; ?>
                      </br> </br> </br> </th>
                  <th>HGM PROTEÇÃO E RECUPERAÇÃO DE VEÍCULOS </BR>
        CNPJ 36.726.851/0001-63 
                  
                  </br> </br> </br> </th>
       
                  
              </tr>
          </thead>
          
<!--                              <tbody> 
              <tr> 
                  <td style="border-bottom: 2px solid #000;">  </br> </br>  </td>
                  <td  style="border-bottom: 2px solid #000;"> </br> </br>  </td>
                 
              </tr>
          </tbody>
          -->
             </table>
          
          
      
      
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
  </body>
</html>