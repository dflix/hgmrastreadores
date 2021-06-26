<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="windows-1252">
        <title></title>
    </head>
    <body>
        <?php
        echo $data=  date("d/m/Y");
        
        echo "</br>";
        
        $portuga = implode("/", array_reverse(explode("/", $data)));
        
        echo $portuga;
        ?>
    </body>
</html>
