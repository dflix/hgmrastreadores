<div class=\"modal fade\" id=\"myModal{$value['codigo']}\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\">
									<div class=\"modal-dialog\" role=\"document\">
										<div class=\"modal-content\">
											<div class=\"modal-header\">
												<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
												<h4 class=\"modal-title text-center\" id=\"myModalLabel\">DADOS DO CLIENTE</h4>
											</div>
											<div class=\"modal-body\">

                                                                                            
                                                                                            
                                                                                            <?php 

  $puxa = $_GET['id'];
  
  $dados = new Read();
  $dados->ExeRead("prevenda","WHERE placa = :p","p={$puxa}");
  $dados->getResult();
  
  

?>

<section>
    <h1 class="destaque">DADOS DO CLIENTE</h1>
</section>

<label class="dez"> 
    <p class="background padding">Código </p>
    <p class="padding"> <?= $dados->getResult()[0]['codigo'];?>  </p>
</label>

<label class="vinte"> 
    <p class="background padding">Data de Adesão </p>
    <p class="padding"> <?= date("d/m/Y H:i:s" , strtotime($dados->getResult()[0]['data']));?>  </p>
</label>

<label class="quarenta"> 
    <p class="background padding"> Cliente </p>
    <p class="padding">  <?= $dados->getResult()[0]['cliente'];?> </p>

</label>
<label class="quinze"> 
    <p class="background padding"> CPF </p>
    <p class="padding">  <?= $dados->getResult()[0]['cpf'];?> </p>

</label>
<label class="quinze"> 
    <p class="background padding"> RG </p>
    <p class="padding">  <?= $dados->getResult()[0]['rg'];?> </p>

</label>



<label class="vinte"> 
    <p class="background padding"> MARCA </p>
    <p class="padding"> <?= $dados->getResult()[0]['marca'];?> </p>   
</label>
<label class="vinte"> 
    <p class="background padding"> MODELO </p>
    <p class="padding"> <?= $dados->getResult()[0]['modelo'];?> </p>   
</label>
<label class="vinte"> 
    <p class="background padding"> ANO </p>
    <p class="padding"> <?= $dados->getResult()[0]['ano'];?> </p>   
</label>
<label class="vinte"> 
    <p class="background padding"> COR </p>
    <p class="padding"> <?= $dados->getResult()[0]['cor'];?> </p>   
</label>
<label class="vinte"> 
    <p class="background padding"> PLACA </p>
    <p class="padding"> <?= $dados->getResult()[0]['placa'];?> </p>   
</label>

<label class="oitenta"> 
    <p class="background padding"> ENDEREÇO </p>
    <p class="padding"> <?= $dados->getResult()[0]['endereco'];?> </p>
</label>
<label class="vinte"> 
    <p class="background padding"> NUMERO </p>
    <p class="padding"> <?= $dados->getResult()[0]['numero'];?> </p>
</label>

<label class="cinquenta"> 
    <p class="background padding"> COMPLEMENTO </p>
    <p class="padding"> <?= $dados->getResult()[0]['complemento'];?> </p>
</label>
<label class="dez"> 
    <p class="background padding"> CEP </p>
    <p class="padding"> <?= $dados->getResult()[0]['cep'];?> </p>
</label>
<label class="quinze"> 
    <p class="background padding"> BAIRRO </p>
    <p class="padding"> <?= $dados->getResult()[0]['bairro'];?> </p>
</label>
<label class="quinze"> 
    <p class="background padding"> CIDADE </p>
    <p class="padding"> <?= $dados->getResult()[0]['cidade'];?> </p>
</label>
<label class="dez"> 
    <p class="background padding"> ESTADO </p>
    <p class="padding"> <?= $dados->getResult()[0]['uf'];?> </p>
</label>


<label class="cinquenta"> 
    <p class="background padding"> EMAIL </p>
    <p class="padding"> <?= $dados->getResult()[0]['email'];?> </p>
</label>
<label class="vinteecinco"> 
    <p class="background padding"> TELEFONE CELULAR </p>
    <p class="padding"> <?= $dados->getResult()[0]['telcel'];?> </p>
</label>
<label class="vinteecinco"> 
    <p class="background padding"> TELEFONE RESIDENCIAL </p>
    <p class="padding"> <?= $dados->getResult()[0]['telres'];?> </p>
</label>

<div class="clear"> </div>

<section>
    <h1 class="destaque">DADOS DE PAGAMENTO</h1>
    
    <?php 
    
  $dadospagto = new Read();
  $dadospagto->ExeRead("baixasantander","WHERE placa = :p","p={$dados->getResult()[0]['placa']}");
  $dadospagto->getResult();
  
  if(empty($dadospagto->getResult()[0]['placa'])):
      
      echo "Não consta pagamentos em nosso banco de dados";
      
      else:
  
  
  foreach ($dadospagto->getResult() as $value) {
      
      $data = date("d/m/Y" , strtotime($value['data']));
      $valor = number_format($value['valor']/100,2,",",".");
      
      echo "<label class=\"cinquenta\"> 
    <p class=\"background padding\"> CLIENTE </p>
    <p class=\"padding\"> {$value['nome']} </p>
</label>
<label class=\"vinteecinco\"> 
    <p class=\"background padding\"> DATA </p>
    <p class=\"padding\"> {$data} </p>
</label>
<label class=\"vinteecinco\"> 
    <p class=\"background padding\"> VALOR </p>
    <p class=\"padding\">R$ {$valor} </p>
</label>

<div class=\"clear background padding\"> </div>";
      
  }
  
  endif;
    
    ?>
</section>
<hr>
<section> 
    <h1 class="destaque"> HISTÓRICO DE ATENDIMENTO</h1>
    
    <?php 
    $exibeatendimento = new Read();
    $exibeatendimento->ExeRead("atendimentoprotege","WHERE cliente = :p","p={$puxa}");
    $exibeatendimento->getResult();
    
    foreach ($exibeatendimento->getResult() as $retorno) {
        
        $data = date("d/m/Y H:i:s" , strtotime($retorno['data']));
        
        echo "    <div class=\"vinteecinco\"> 
        <p class=\"background padding\"> DATA </p>
        <p class=\"padding\"> {$data} </p>
    </div>
    <div class=\"cinquenta\"> 
        <p class=\"background padding\"> HISTÓRICO </p>
        <p class=\"padding\"> {$retorno['historia']} </p>
    </div>
    
        <div class=\"vinteecinco\"> 
        <p class=\"background padding\"> ATENDENTE </p>
        <p class=\"padding\"> {$retorno['atendente']} </p>
    </div>
    
    <div class=\"clear\"> </div><hr>";
        
    
}
    ?>
    

    </br>
    
    <p> INSERIR HISTÓRICO DE ATENDIMENTO </p>
    
    <?php 
    $form = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    
    if($form && $form['cadastro']):
        unset($form['cadastro']);
    
    $cadastra = new Create();
    $cadastra->ExeCreate("atendimentoprotege", $form);
    $cadastra->getResult();
    if($cadastra->getResult()):
        echo "Atendimento cadastrado com sucesso operador <b> {$_COOKIE['logprot_nome']} </b>";
        
        else:
        echo "Erro ao cadastrar atendimento";
    endif;
    endif;
    
    //var_dump($form);
    ?>
    
    <form action="" method="post" enctype="multipart-form/data"> 
        
        <label>
            <p>HISTÓRICO </p>
            <textarea name="historia"> </textarea>
        </label>

        <label> 
            <input type="hidden" name="cliente" value="<?= $puxa;  ?>" />
            <input type="hidden" name="data" value="<?= date("Y-m-d H:i:s");  ?>" />
            <input type="hidden" name="atendente" value="<?= $_COOKIE['logprot_nome'];  ?>" />
            <input type="submit" name="cadastro" value="CADASTRAR" class="botao" />
        </label>
    </form>
</section>
                                                                                            
                                                                                            
                                                                                            
                                                                                            
                                                                                            

                                                                                                        
											</div>
		
										</div>
									</div>
								</div>
