<?php 
session_start();
?><!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<link rel="icon" type="favicon.png" />
		<link rel="stylesheet" type="text/css" href="estilo.css">
		
		<!--jQuery-->
                <script src="../js/jquery-1.2.6.js" type="text/javascript"></script>
		<!--Script-->
                <!-- <script src="script_marca.js"  type="text/javascript"></script> --->
                
                
             <script type="text/javascript">
$(document).ready(function() {
						   
	$('select[@name=marca]').change(function(){	
	  	$.post('modelo.php',
		{marca:$(this).val()},
			function(modelo){
			
				$('select[@name=modelo]').html(modelo)
			
			}		
		
		)
			
			
	})
	$('select[@name=modelo]').change(function(){	
	  	$.post('ano.php',
		{ano:$(this).val()},
			function(ano){
			
				$('select[@name=ano]').html(ano)
			
			}		
		
		)
			
			
	})
	$('select[@name=ano]').change(function(){	
	  	$.post('codigofipe.php',
		{codigofipe:$(this).val()},
			function(codigofipe){
			
				$('select[@name=codigofipe]').html(codigofipe)
			
			}		
		
		)
			
			
	})
        
        	$('select[@name=ano]').change(function(){	
	  	$.post('preco.php',
		{preco:$(this).val()},
			function(preco){
			
				$('select[@name=preco]').html(preco)
			
			}		
		
		)
			
			
	})
        
        
        	$('select[@name=ano]').change(function(){	
	  	$.post('combustivel.php',
		{combustivel:$(this).val()},
			function(combustivel){
			
				$('select[@name=combustivel]').html(combustivel)
			
			}		
		
		)
			
			
	})

						   

	  
	
})
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
</script>              
               
		
		
	</head>
	<body onload="carregarItens()" >
		<section>
			<h1>TABELA FIPE</h1>
			<!--Área que mostrará carregando-->
			<h2></h2>
                        
                        <p> Marca </p>
                        
			<!--Tabela-->
                        <?php 

//string json contendo os dados de um funcionário


 
$json_file = file_get_contents("http://fipeapi.appspot.com/api/1/carros/marcas.json");   
$json_str = json_decode($json_file, true);
$itens = $json_str;

echo "<select name=\"marca\" id=\"marca\"> <option> SELECIONE A MARCA</option>";



foreach ( $itens as $e ) 
    { 
    
    echo "<option value=\"{$e['id']}\">{$e['name']} </option>";

    
    
    } 
    
    echo "</select>";
?> 
                        
                        
 <HR>

 
  <p> Modelo </p>
 
      <select name="modelo" id="modelo"></select>
 
 

 <p> Ano </p>
 
      <select name="ano" id="ano"></select>
                        <HR>
		</section>
 <p> codigo fipe </p>
 
      <select name="codigofipe" id="codigofipe"></select>
                        <HR>
 <p> Preço do Veículo </p>
 
      <select name="preco" id="preco"></select>
                        <HR>
 <p> Combustível </p>
 
      <select name="combustivel" id="combustivel"></select>
                        <HR>
		</section>
	</body>
</html>