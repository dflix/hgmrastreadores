<?php 

//string json contendo os dados de um funcionário


 
$json_file = file_get_contents("http://fipeapi.appspot.com/api/1/carros/marcas.json");   
$json_str = json_decode($json_file, true);
$itens = $json_str;

foreach ( $itens as $e ) 
    { 
    echo $e['name']."<br>"; 
    echo $e['id']."<br>"; 
    echo "<hr>";
    
    
    } 
?> 

