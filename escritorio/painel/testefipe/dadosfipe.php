<?php 
session_start();
$_SESSION['codigofipe'] = $_POST['codigofipe']
?>

                        <?php 

//string json contendo os dados de um funcionário


 
$json_file = file_get_contents("http://fipeapi.appspot.com/api/1/carros/veiculo/{$_SESSION['marca']}/{$_SESSION['ano']}/{$_SESSION['codigofipe']}.json");   
$json_str = json_decode($json_file, true);
$itens = $json_str;

    
    echo "<option value=\"{$itens['fipe_codigo']}\">{$itens['fipe_codigo']} </option>";
    
    echo "";
 
?> 



