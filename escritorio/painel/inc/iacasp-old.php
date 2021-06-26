<!-- Adicionando Javascript -->
<script type="text/javascript" >

    function limpa_formulário_cep() {
        //Limpa valores do formulário de cep.
        document.getElementById('logradouro').value = ("");
        document.getElementById('bairro').value = ("");
        document.getElementById('localidade').value = ("");
        document.getElementById('uf').value = ("");

    }

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('logradouro').value = (conteudo.logradouro);
            document.getElementById('bairro').value = (conteudo.bairro);
            document.getElementById('localidade').value = (conteudo.localidade);
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
                document.getElementById('logradouro').value = "...";
                document.getElementById('bairro').value = "...";
                document.getElementById('localidade').value = "...";
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
	  	$.post('modelo2.php',
		{marca:$(this).val()},
			function(modelo){
			
				$('select[@name=modelo1]').html(modelo)
			
			}		
		
		)
			
			
	})
	$('select[@name=modelo1]').change(function(){	
	  	$.post('ano2.php',
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


<script language="JavaScript" type="text/javascript" src="js/mascara-validacao.js" ></script>
<main> 

    <h3>INSERIR VENDA ASSOCIAÇÃO SÃO PAULO </h3>

    <?php
    $form = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    if ($form && $form['cadastravenda']):
        unset($form['cadastravenda']);
        unset($form['empresart_2']);
        unset($form['alienado2']);
        unset($form['nf2']);
    
    $cadastra = new Create();
    $cadastra->ExeCreate("prevendaacasp", $form);
    $cadastra->getResult();
    if($cadastra->getResult()){
        echo "<p class=\"cadastro\">cadastro realizado com sucesso</p>";
         echo "<meta http-equiv=\"refresh\" content=0;url=\"index.php?p=iacaspb&placa={$form['placa1']}\">";
       
    }else{
        echo "ERRO ao cadastrar";
    }
   endif;

    var_dump($form);
    ?>


    <?php include('oacasp.php'); ?>

    <form name="inseriracasp" action="" method="post"> 
       


                <input type="hidden" name="vendedor" value="<?= $_SESSION['id_usuario'] ?>"/>
                
     
        <h3> Dados da Adesão </h3>
        <label class="cinquenta"> 
            <p><b>Adesão</b> </p>
            <input type="text" name="adesao"  />
        </label>
        <label class="cinquenta"> 
            <p>Forma Pagamento da adesão </p>
            <input type="text" name="pgto_adesao"  />
        </label>
        <label class="vinteecinco"> 
            <p>Assistencia 24hs </p>
            <input type="text" name="assist" value="<?php echo $assist; ?>"  />
        </label>
        <label class="vinteecinco"> 
            <p>Mensalidade Rastreador </p>
            <input type="text" name="mesrastreador" value="<?php echo number_format($rastreador, 2, '.', ''); ?>"  />
        </label>
        <label class="vinteecinco"> 
            <p>Mensalidade Associacao </p>
            <input type="text" name="mesacasp" value="<?php echo number_format($mesacasp, 2, '.', ''); ?>"  />
        </label >
        <label class="vinteecinco"> 
            <p>Mensalidade Total </p>
            <input type="text" name="mestotal" value="<?php echo number_format($total, 2, '.', ''); ?>"  />
        </label>
        <div class="clear"> </div>

        <h3>DADOS DO ASSOCIADO </h3>

        <label class="setenta"> 
            <p>Associado </p>
            <input type="text" name="associado" />
        </label>
        <label class="trinta"> 
            <p>Data Nascimento </p>
            <input type="text" name="data_nasc" />
        </label>
                <label class="cinquenta"> 
            <p>Responsável </p>
            <input type="text" name="responsavel"   />
        </label>
        <label class="vinteecinco"> 
            <p>CPF / CNPJ </p>
            <input type="text" name="cpf"   />
        </label>
        <label class="vinteecinco"> 
            <p>RG </p>
            <input type="text" name="rg" />
        </label>

        <label class="vinte"> 
            <p>CEP:</p>
            <input name="cep" type="text" id="cep" value=""  maxlength="9"
                   onblur="pesquisacep(this.value);" />
        </label>
        <label class="setenta">
            <p>Endereço </p>
            <input name="logradouro" type="text" id="logradouro" />
        </label>
        <label class="dez"> 
            <p>Numero </p>
            <input name="numero" type="text" id="numero" />
        </label>
        <label class="cinquenta"> 
            <p>Complemento </p>
            <input name="complemento" type="text" id="complemento" />
        </label>
        <label class="vinte"> 
            <p>Bairro </p>
            <input name="bairro" type="text" id="bairro"  />
        </label>
        <label class="vinte"> 
            <p>Cidade </p>
            <input name="localidade" type="text" id="localidade"  />
        </label>
        <label class="dez"> 
            <p>UF </p>
            <input name="uf" type="text" id="uf" />
        </label>
        <label class="cinquenta"> 
            <p>Email </p>
            <input type="text" name="email" />
        </label>
        <label class="vinteecinco"> 
            <p>Telefone Residencial </p>
            <input type="text" name="telres" onKeyPress="MascaraTelefone(form.telres)" />
        </label>
        <label class="vinteecinco"> 
            <p>Telefone Celular </p>
            <input type="text" name="telcel" onKeyPress="MascaraTelefone(form.telcel)" />
        </label>

        <div class="clear"> </div>
        <h3>DADOS DO VEICULO </h3>

        <label class="vinte"> 
            <p>Marca </p>
             <?php 

//string json contendo os dados de um funcionário


 
$json_file = file_get_contents("http://fipeapi.appspot.com/api/1/caminhoes/marcas.json");   
$json_str = json_decode($json_file, true);
$itens = $json_str;



echo "<select name=\"marca1\" id=\"marca1\"> ";




$d = "/";

foreach ( $itens as $e ) 
    { 
    
    echo "<option value=\"{$e['id']}{$d}{$e['name']}\">{$e['name']} </option>";

   
    
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
            <input type="text" name="modelo1" />
        </label>
<!--        <label class="trintaetres"> 
            <p>Ano </p>
            <input type="text" name="ano1" />
        </label>
        <label class="trintaetres"> 
            <p>Cor </p>
            <input type="text" name="cor1" />
        </label>-->
        <label class="trintaetres"> 
            <p>Renavam </p>
            <input type="text" name="renavam1" />
        </label>
        <label class="trintaetres"> 
            <p>Chassi </p>
            <input type="text" name="chassi1" />
        </label>
        <label class="trintaetres"> 
            <p>Placa </p>
            <input type="text" name="placa1" />
        </label>
        <label class="vinteecinco"> 
            <p>Empresa de Rastreamento </p>
            <input type="text" name="empresart_1"  />
        </label>
        <label class="vinteecinco"> 
            <p>Valor Estimado </p>
             <select name="valor1"> </select>
            
        </label>
        <label class="vinteecinco"> 
            <p>Alienado Por </p>
            <input type="text" name="alienado1" />
        </label>
        <label class="vinteecinco"> 
            <p>Nota Fiscal </p>
            <input type="text" name="nf1" />
        </label>
        <div class="clear"> </div>
        <h3> Dados do Implemento / Carreta </h3>
        <label class="trintaetres"> 
            <p>Marca/Modelo </p>
            <input type="text" name="marca_modelo2" />
        </label>
        <label class="trintaetres"> 
            <p>Ano </p>
            <input type="text" name="ano2" />
        </label>
        <label class="trintaetres"> 
            <p>Cor </p>
            <input type="text" name="cor2" />
        </label>
        <label class="trintaetres"> 
            <p>Renavam </p>
            <input type="text" name="renavam2" />
        </label>
        <label class="trintaetres"> 
            <p>Chassi </p>
            <input type="text" name="chassi2" />
        </label>
        <label class="trintaetres"> 
            <p>Placa </p>
            <input type="text" name="placa2" />
        </label>
        <label class="vinteecinco"> 
            <p>Empresa de Rastreamento </p>
            <input type="text" name="empresart_2"  />
        </label>
        <label class="vinteecinco"> 
            <p>Valor Estimado </p>
            <input type="text" name="valor2"  />
        </label>
        <label class="vinteecinco"> 
            <p>Alienado Por </p>
            <input type="text" name="alienado2" />
        </label>
        <label class="vinteecinco"> 
            <p>Nota Fiscal </p>
            <input type="text" name="nf2" />
        </label>
        <hr>
        <input type="hidden" name="data" value="<?= date("Y-m-d"); ?>" />
        <input type="submit" value="CADASTRAR" name="cadastravenda" style="width: 200px; padding: 10px; border-radius:10px; background: #ec971f; color: #fff;" />

    </form>



</main>