<main> 

    <h3> Calcular Associação </h3>
    <?php 
   //require('../../_app/Config.inc.php');
    $form = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    
    //var_dump($form);
    ?>
    
    <script type='text/javascript' src='js/jquery.js'></script>

 <script src="js/jquery-1.2.6.js" type="text/javascript"></script>

             <script type="text/javascript">
$(document).ready(function() {
						   
	$('select[@name=marca1]').change(function(){	
	  	$.post('modelo.php',
		{marca:$(this).val()},
			function(modelo){
			
				$('select[@name=modelo1]').html(modelo)
			
			}		
		
		)
			
			
	})
	$('select[@name=modelo1]').change(function(){	
	  	$.post('ano.php',
		{ano:$(this).val()},
			function(ano){
			
				$('select[@name=ano1]').html(ano)
			
			}		
		
		)
			
			
	})
	$('select[@name=ano1]').change(function(){	
	  	$.post('codigofipe.php',
		{codigofipe:$(this).val()},
			function(codigofipe){
			
				$('select[@name=fipe1]').html(codigofipe)
			
			}		
		
		)
			
			
	})
        
        	$('select[@name=ano1]').change(function(){	
	  	$.post('preco.php',
		{preco:$(this).val()},
			function(preco){
			
				$('select[@name=valor1]').html(preco)
			
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



    
    <form name="orcamento" action="" method="post" enctype="multipart/form-data" > 
        
      
          <label class="vinte"> 
            <p>Marca </p>
             <?php 

//string json contendo os dados de um funcionário


 
$json_file = file_get_contents("http://fipeapi.appspot.com/api/1/carros/marcas.json");   
$json_str = json_decode($json_file, true);
$itens = $json_str;



echo "<select name=\"marca1\" id=\"marca1\"> ";




$d = "|";

foreach ( $itens as $e ) 
    { 
    
    echo "<option value=\"{$e['name']}{$d}{$e['id']}\">{$e['name']} </option>";

   
    
    } 
    
    echo "</select>";
    
    
?> 
        </label>
        <label class="vinte"> 
            <p>Modelo </p>
            <select name="modelo1"> </select>
            
        </label>
        <label class="vinte"> 
            <p>Ano </p>
            <select name="ano1"> </select>
            
        </label>
        <label class="vinte"> 
            <p>Fipe </p>
             <select name="fipe1"> </select>
        </label>
        <label class="vinte"> 
            <p>Valor </p>
            <select name="valor1"> </select>
        </label>
        
        
        
<!--        <label class="cinquenta">
            <p> Valor do Veículo </p>
            
    <?php //        $valor = "R$ 86.588,50";
//
//$valor = str_replace("R$ " , "" , $valor ); // Primeiro tira os pontos
//$valor = str_replace("." , "" , $valor ); // Primeiro tira os pontos
//$valor = str_replace("," , "" , $valor); // Depois tira a vírgula
//
//echo $valor; echo "</br>";
//
// $total = number_format($valor / 100, 2 , ",", ".");
// 
// echo $total;

?>
            
        <input name="valor" type="text" id="valor"  style="width:250px; padding:10px;" />
        exemplo R$120.000,00 digitar 120000.00
        </label>-->
       
        
        <label class="cinquenta"> 
            <p> Assistência 24HS</p>
            <select name="assistencia24hs" id="assistencia24hs" style="width: 250px; padding:10px;">
        <option value="0.00">Selecione a opção</option>
        <option value="10.00">Sim R$10,00</option>
        <option value="20.00">Sim R$20,00</option>
        <option value="24.90">Sim R$24,90 Utilitário Passeio</option>
        <option value="34.90">Sim R$34,90 Utilitário Carga</option>
        <option value="49.00">Sim R$49,00 Caminhão Pesado</option>
        <option value="65.00">Sim R$65,00 Caminhão Pesado</option>
        <option value="0.00">Não R$0,00</option>
      </select>
        </label>
        </br>
        
        <div class="clear"> </div>
        


        
        <label class="cem">
            <p> Valor do Caminhão </p>
            <?php 
            
            $valor = $form['valor1'];
            
            $valor = str_replace("R$ ", "", $valor); // Primeiro tira os pontos
            $valor = str_replace(".", "", $valor); // Primeiro tira os pontos
            $valor = str_replace(",", "", $valor); // Depois tira a vírgula

            echo $valor;
            echo "</br>";

            $total = number_format($valor / 100, 2, ",", ".");

 echo $total;
            
            ?>
            
        </label>
        
        <label class="cem">
        Quantidade de rastreadores >> 
        <?php 
        if($valor > 9999999){
            $qtd = 2 ;
        }else{
            $qtd = 1 ;
        }
        
        echo $qtd;
        
        ?>
        </label>
        
        <label class="cem"> 
        <?php 
        $rastreador = 65.00;
        
        ?>
            Valor Protege R$ <?php 
            $protege = $rastreador * $qtd;
            echo $rt = number_format($protege, 2, ".", ",")  ?>
        </label>
        
        <label class="cem"> 
            <p> Mes Associacao</p>
            
            <?php 
            $calculaacasp = $valor / 100 * 0.3 ;
            $mescasp = number_format($calculaacasp / 100 , 2 , "." , ".");
            echo "R$ " .  $mescasp;
            ?>
        
        </label>
        
        <label class="cem"> 
            <p> Assistência 24 horas </p>
            <?php 
            $assist = $form['assistencia24hs'];
            echo $assist;
            ?>
        </label>
        
        <label class="cem"> 
        Mensalidade Total
        
        <?php 
        $soma = $rt + $mescasp + $assist;
        
        echo "Soma R$" . $soma;
        ?>
        </label>

        
        <input type="submit" name="sendassist" value="CALCULAR" style="width: 200px; padding: 10px; border-radius:10px; background: #ec971f; color: #fff;" />
        </label>
        </br>
    
    
    </form>

    

    
    
   
      
</main>
