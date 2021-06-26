<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require('../_app/Config.inc.php');

        $variavel = new Read();
        $variavel->ExeRead("prevendaacasp", "ORDER BY id_venda DESC" );
        $variavel->getResult();
        
        
        foreach ($variavel->getResult() as $value) {
            
            echo "placa {$value['placa1']}";
            echo "</br>";
            echo "cliente {$value['associado']}";
            echo "</br>";
            echo "Assistência {$value['assist']}";
            
            echo "<hr>";
            
            $total += $value['assist'];
    
}

echo "<h1> R$" . number_format($total, 2 , "," , ".") . "</h1>";

echo "</br>";

echo "Quantidade de clientes <b>{$variavel->getRowCount()}</b>";
       
        ?>
    </body>
</html>
