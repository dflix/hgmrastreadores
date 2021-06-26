<?php 
session_start();
$_SESSION['ano'] = $_POST['ano'];
?>

<option> SELECIONE ANO</option>


                        <?php 

//string json contendo os dados de um funcionário


 
$json_file = file_get_contents("http://fipeapi.appspot.com/api/1/carros/veiculo/{$_SESSION['marca']}/{$_POST['ano']}.json");   
$json_str = json_decode($json_file, true);
$itens = $json_str;


foreach ( $itens as $e ) 
   
    { 
    
    echo "<option value=\"{$e['key']}\">{$e['name']} </option>";

    
    
    } 
    
   
?> 



