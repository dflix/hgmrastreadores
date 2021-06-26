<?php
session_start();

date_default_timezone_set('America/Sao_Paulo');

if(empty($_COOKIE['logprot_nome'])):
    echo "<meta http-equiv=\"refresh\" content=0;url=\"../index.php\">";
endif;

require('../_app/Config.inc.php');
if (isset($_GET['p'])):
    $p = $_GET['p'];
else:
    $p = 0;
endif;
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Relatorio HGM</title>
  </head>
  <body>
  <table class="table "> 
            <thead> 
                <tr> 
                    <th>ID </th>
                    <th>Nome </th>
                    <th>Veiculo </th>
                    <th>Placa </th>
                    <th>Plano </th>
                    <th>Vencimento </th>
                    <th>Telefones </th>
                </tr>
            </thead>
            
            <tbody> 
                
                <?php 
                $ler = new Read();
                $ler->ExeRead("prevenda" , "ORDER BY vencimento ASC");
                $i=0;
                foreach ( $ler->getResult() as $value) {
                    $i++;
                ?>
                <tr> 
                    <td><?= $i ?> </td>
                    <td><?= $value["cliente"] ?> </td>
                    <td><?= $value["modelo"] ?></td>
                    <td><?= $value["placa"] ?> </td>
                    <td><?= $value["plano"] ?> </td>
                    <td><?= $value["vencimento"] ?> </td>
                    <td><?= $value["telres"] ?> / <?= $value["telcel"] ?>   </td>
                </tr>
                
                <?php } ?>
                

                
            </tbody>
        </table>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>