<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<link rel="icon" type="favicon.png" />
		<link rel="stylesheet" type="text/css" href="estilo.css">
		
		<!--jQuery-->
		<script src="https://code.jquery.com/jquery-2.0.3.min.js" type="text/javascript"></script>
                <!-- script src="../js/jquery-1.2.6.js" type="text/javascript"> </script> -->
		<!--Script-->
                <script src="script_marca.js"  type="text/javascript"></script>
		
		
	</head>
	<body>
            
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
	  	$.post('tipo.php',
		{tipo:$(this).val()},
			function(tipo){
			
				$('select[@name=tipo]').html(tipo)
			
			}		
		
		)
			
			
	})
			$('select[@name=tipo]').change(function(){	
	  	$.post('outro.php',
		{outro:$(this).val()},
			function(outro){
			
				$('select[@name=outro]').html(outro)
			
			}		
		
		)
			
			
	})
						   

	  
	
})
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
</script>
		<section>
                    <label>
                        <p>MARCA </p>
                    <select name="marca">
                        <option value="fiat"> FIAT </option>
                        <option value="chevrolet"> chevrolet </option>
                        <option value="vw"> VW </option>
                        <option value="peugeot"> peugeot </option>
                    </select>
                    </label>
                    <label>
                        <p>Modelo </p>
                    <select name="modelo"> </select>
                    </label>
                    <label>
                        <p>Tipo </p>
                    <select name="tipo"> </select>
                    </label>
                    <label>
                        <p>Outro </p>
                    <select name="outro"> </select>
                    </label>
                    
                    
		</section>
	</body>
</html>