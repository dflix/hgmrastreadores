
<!-- Adicionando Javascript -->
<script type="text/javascript" >

    function limpa_formulário_cep() {
        //Limpa valores do formulário de cep.
        document.getElementById('endereco').value = ("");
        document.getElementById('bairro').value = ("");
        document.getElementById('cidade').value = ("");
        document.getElementById('uf').value = ("");

    }

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('endereco').value = (conteudo.logradouro);
            document.getElementById('bairro').value = (conteudo.bairro);
            document.getElementById('cidade').value = (conteudo.localidade);
            document.getElementById('uf').value = (conteudo.uf);

        } //end if.
        else {
            //CEP não Encontrado.
            limpa_formulário_cep();
            alert("CEP não encontrado.");
        }
    }

    function pesquisacep(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if (validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById('endereco').value = "...";
                document.getElementById('bairro').value = "...";
                document.getElementById('cidade').value = "...";
                document.getElementById('uf').value = "...";


                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = '//viacep.com.br/ws/' + cep + '/json/?callback=meu_callback';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    }
    ;

</script>
<style type="text/javascript"> 

    var headertext = [];
    var headers = document.querySelectorAll("thead");
    var tablebody = document.querySelectorAll("tbody");

    for (var i = 0; i < headers.length; i++) {
        headertext[i]=[];
        for (var j = 0, headrow; headrow = headers[i].rows[0].cells[j]; j++) {
            var current = headrow;
            headertext[i].push(current.textContent);
        }
    } 

    for (var h = 0, tbody; tbody = tablebody[h]; h++) {
        for (var i = 0, row; row = tbody.rows[i]; i++) {
            for (var j = 0, col; col = row.cells[j]; j++) {
                col.setAttribute("data-th", headertext[h][j]);
            } 
        }
    }


</style>



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
			
				$('select[@name=fipe]').html(codigofipe)
			
			}		
		
		)
			
			
	})
        
        	$('select[@name=ano1]').change(function(){	
	  	$.post('preco.php',
		{preco:$(this).val()},
			function(preco){
			
				$('select[@name=valor]').html(preco)
			
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


<script language="JavaScript" type="text/javascript" src="js/mascara-validacao.js" ></script>
<main> 

    <h1>DADOS DO ASSOCIADO </h1>
    
    <img src="img/ivenda1.png" width="auto" />
    <?php
    
    $puxa = new Read();
    $puxa->ExeRead("prevenda", "WHERE placa = :p", "p={$_GET['placa']}");
    $puxa->getResult();
    
    
    $form = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if ($form && $form['button']):
//        $tmarca = explode("/", $form['marca1']);
//        $tmodelo = explode("/", $form['modelo1']);
//        $tano = explode("/", $form['ano1']);
//        
//        $form['marca'] = $tmarca[1];
//        $form['modelo'] = $tmodelo[1];
//        $form['ano'] = $tano[1];
//        unset($form['button']);
//        unset($form['marca1']);
//        unset($form['modelo1']);
//        unset($form['ano1']);
//
//    $cadastra = new Update();
//    $cadastra->ExeUpdate("prevenda", $form , "WHERE placa = :p", "p={$_GET['placa']}");
//    $cadastra->getResult();
//    
//    if($cadastra->getResult()){
//        
//            echo "<p class=\"cadastro\">cadastro realizado com sucesso</p>";
//            echo "<meta http-equiv=\"refresh\" content=0;url=\"index.php?p=aprotegeb&placa={$form['placa']}\">";
//        
//    }else{
//        echo "Erro ao atualizar";
//    }
    endif;

    var_dump($form);
    ?>



    <form id="form1" name="form1" method="post" action="">


        <label class="cem">
          
            <input type="hidden" name="vendedor" id="vendedor" value="<?php echo $_SESSION['id_usuario']; ?>" />
               

            </select>
        </label>
        <div class="clear"> </div>
        <h3>DADOS DO CLIENTE</h3>


        <label class="setentaecinco">
            <p>CLIENTE :</p>
            <input name="cliente" type="text" id="cliente" size="75" value="<?= $puxa->getResult()[0]['cliente'] ?>" />
        </label>
        <label class="vinteecinco"><p>DATA NASCIMENTO</p>
            <input name="data_nasc" type="text" id="data_nasc" size="10" onKeyPress="MascaraData(form.data_nasc)" value="<?= $puxa->getResult()[0]['data_nasc'] ?>" />
        </label>
        <label class="vinteecinco">
            <p>CPF / CNPJ: </p>
            <input type="text" name="cpf" id="cpf" value="<?= $puxa->getResult()[0]['cpf'] ?>"  />
        </label>
        <label class="vinteecinco"><P>RG</P>
            <input type="text" name="rg" id="rg" value="<?= $puxa->getResult()[0]['rg'] ?>" />
        </label>
        <label class="vinteecinco">
            <p>TEL: Residencial.</p>
            <input name="telres" type="text" id="telres" onKeyPress="MascaraTelefone(form.telres)" size="12"value="<?= $puxa->getResult()[0]['telres'] ?>" />
        </label>
        <label class="vinteecinco">
            <p>TEL: Celular</p>
            <input name="telcel" type="text" id="telcel" onKeyPress="MascaraTelefone(form.telcel)" size="12" value="<?= $puxa->getResult()[0]['telcel'] ?>" />
        </label>
        <div class="clear"> </div>
               
        <label class="cem"><p>EMAIL:</p>
            <input name="email" type="text" id="email" size="75" value="<?= $puxa->getResult()[0]['email'] ?>" />
        </label>
        
        <div class="clear"> </div>
        <h3>DADOS DE COBRANÇA</h3>

        <label class="vinte">
            <p>CEP </p>
            <input name="cep" type="text" id="cep" value="<?= $puxa->getResult()[0]['cep'] ?>"  maxlength="9"
                   onblur="pesquisacep(this.value);" /></label>

        <label class="setenta">
            <p>END.RES:</p>
            <input name="endereco" type="text" id="endereco" value="<?= $puxa->getResult()[0]['endereco'] ?>" />
        </label>

        <label class="dez"><P>Numeroº</P>
            <input name="numero" type="text" id="numero" value="<?= $puxa->getResult()[0]['numero'] ?>"  />
        </label>
        <div class="clear"> </div>
        <label class="vinteecinco"> 
            <p>COMPLEMENTO:</p>
            <input name="complemento" type="text" id="complemento" value="<?= $puxa->getResult()[0]['complemento'] ?>"/>
        </label>
        <label class="vinteecinco"><p>BAIRRO :</p>
            <input name="bairro" type="text" id="bairro" value="<?= $puxa->getResult()[0]['bairro'] ?>"  />
        </label>
        <label class="vinteecinco"><p>CIDADE:</p>
            <input name="cidade" type="text" id="cidade" value="<?= $puxa->getResult()[0]['cidade'] ?>"  />
        </label>
        <label class="vinteecinco"><p>UF:</p>
            <input name="uf" type="text" id="uf" value="<?= $puxa->getResult()[0]['uf'] ?>" />
        </label>

        <div class="clear"> </div>
        <h3>DADOS DO VEÍCULO</h3>
        <div class="clear"> </div>
        <label class="vinte"><p>MARCA: 
            </p>
                                    <?php 

//string json contendo os dados de um funcionário


 
$json_file = file_get_contents("http://fipeapi.appspot.com/api/1/carros/marcas.json");   
$json_str = json_decode($json_file, true);
$itens = $json_str;



echo "<select name=\"marca1\" id=\"marca1\"> <option value=\"{$puxa->getResult()[0]['marca']}\"> {$puxa->getResult()[0]['marca']}</option>";

$d = "/";

foreach ( $itens as $e ) 
    { 
    
    echo "<option value=\"{$e['id']}{$d}{$e['name']}\">{$e['name']} </option>";

   
    
    } 
    
    echo "</select>";
    
    
?> 
        </label>
        <label class="vinte"><p>MODELO </p>
            <select name="modelo1" id="modelo1">
                <option value="<?=  $puxa->getResult()[0]['modelo'] ?>"> <?=  $puxa->getResult()[0]['modelo'] ?></option>
            </select>
        </label>

        <label class="vinte"><p>ANO:</p>
            <select name="ano1"  id="ano1"  > 
            <option value="<?=  $puxa->getResult()[0]['ano'] ?>"> <?=  $puxa->getResult()[0]['ano'] ?></option>
            </select>
        </label>
        
                <label class="vinte">
            <p>CODIGO FIPE:</p>
            <select  name="fipe" id="fipe" >
            <option value="<?=  $puxa->getResult()[0]['fipe'] ?>"> <?=  $puxa->getResult()[0]['fipe'] ?></option>
            </select>
        </label>
        <label class="vinte">
            <p>VALOR:</p>
            <select  name="valor" id="valor" >
            <option value="<?=  $puxa->getResult()[0]['valor'] ?>"> <?=  $puxa->getResult()[0]['valor'] ?></option>
            </select>
        </label>

        <div class="clear"> </div>

        <label class="vinte"><p>CHASSI:</p>
            <input type="text" name="chassi" id="chassi" value="<?=  $puxa->getResult()[0]['chassi'] ?>" />
        </label>
        <label class="vinte">
            <p>RENAVAM:</p>
            <input type="text" name="renavam" id="renavam" value="<?=  $puxa->getResult()[0]['renavam'] ?>" />
        </label>
        
                
        
        <label class="vinte"><p>COR:</p>
            <input type="text" name="cor" id="cor" value="<?=  $puxa->getResult()[0]['cor'] ?>" /></label>

        <label class="vinte"><p>PLACA</p>
            <input type="text" name="placa" id="placa" value="<?=  $puxa->getResult()[0]['placa'] ?>" />
        </label>
        <div class="clear"> </div>
        </br>
       
               <label>
                            <input type="hidden" name="ip" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>" />

                            <input type="hidden" name="status" value="1" />
                            <input type="hidden" name="data" value="<?php echo date("Y-m-d H:i:s"); ?>" />
                            <input type="submit" name="button" id="button" value="SEGUIR" class="botao"  />
                        </label>
            
            <div class="clear"> </div>

</br></br>
                </form>



                </main>
<div class="clear"> </div>