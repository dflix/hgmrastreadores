


<?php
session_start();

require '../vendor/autoload.php';


    $pedido = new \Source\Core\Pedidos();
    $pedido->pedido();
    
  var_dump($_SESSION);
    ?>
