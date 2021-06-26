<?php
require('../_app/Config.inc.php');
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>


<?php
$exibe = new Read();
$exibe->ExeRead("baixacaixa", "ORDER BY id");
 $exibe->getResult();

foreach ($exibe->getResult() as $value) {
    
    $novovalor = number_format($value['valor']/100, 2, ",", ".");
    
    echo "Cliente= " . $value['nome'];
    echo "</br>";
    echo "Valor= " . $novovalor;
    echo "<hr>";
    
    
}
?>

    </body>
</html>
