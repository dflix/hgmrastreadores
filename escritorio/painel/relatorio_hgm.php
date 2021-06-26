<?php 
require('./source/Config.inc.php');
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Relatorio HGM</title>
  </head>
  <body>
      <table class="table"> 
          <thead>
          <tr> 
          <th>Cliente </th>
          <th>Inicio </th>
          <th>Telefone </th>
          <th>Celular </th>
          <th>Veiculo </th>
          <th>Plano </th>
          <th>Valor </th>
          </tr>
          </thead>
          
          <tbody>
              <?php 
              $ler = new Read();
              $ler->ExeRead("prevenda", "ORDER BY id_venda ASC");
              $ler->getResult();
              foreach ($ler->getResult() as $value) {

              ?>
          <tr> 
          <td><?= $value["cliente"] ?> </td>
          <td><?= date("d/m/Y",strtotime($value["data"])) ?> </td>
          <td><?= $value["telres"] ?> </td>
          <td><?= $value["telcel"] ?> </td>
          <td><?= $value["modelo"] ?> Placa <?= $value["placa"] ?> </td>
          <td><?= $value["plano_desc"] ?> </td>
          <td>R$ <?= $value["plano"] ?> </td>
          </tr>
              <?php } ?>
          </tbody>
      </table>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
