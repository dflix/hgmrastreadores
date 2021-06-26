<!-- Transferencia de titularidade -->
<!-- Adicionando Javascript -->
    <script type="text/javascript" >
    
    function limpa_formulário_cep() {
            //Limpa valores do formulário de cep.
            document.getElementById('endereco').value=("");
            document.getElementById('bairro').value=("");
            document.getElementById('cidade').value=("");
            document.getElementById('uf').value=("");
           
    }

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('endereco').value=(conteudo.logradouro);
            document.getElementById('bairro').value=(conteudo.bairro);
            document.getElementById('cidade').value=(conteudo.localidade);
            document.getElementById('uf').value=(conteudo.uf);
            
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
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById('endereco').value="...";
                document.getElementById('bairro').value="...";
                document.getElementById('cidade').value="...";
                document.getElementById('uf').value="...";
               

                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = '//viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

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
    };

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


        $('select[@name=tipo]').change(function() {
            $.post('tipo_plano.php',
                    {tipo_plano: $(this).val()},
            function(tipo_plano) {

                $('select[@name=tipo_plano]').html(tipo_plano)

            }

            )


        })

        $('select[@name=tipo_plano]').change(function() {
            $.post('plano_desc.php',
                    {plano_desc: $(this).val()},
            function(plano_desc) {

                $('select[@name=plano_desc]').html(plano_desc)

            }

            )


        })

        $('select[@name=tipo_plano]').change(function() {
            $.post('plano.php',
                    {plano: $(this).val()},
            function(plano) {

                $('select[@name=plano]').html(plano)

            }

            )


        })

        
    })
    function MM_openBrWindow(theURL, winName, features) { //v2.0
        window.open(theURL, winName, features);
    }
</script> 




<script language="JavaScript" type="text/javascript" src="js/mascara-validacao.js" ></script>
<main class="content"> 

    <h1>TRANSFERÊNCIA DE TITULARIDADE PROTEGE </h1>

    <?php
    $form = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    
    if($form && $form['button']):
        unset($form['button']);
    
    $atualiza = new Update();
    $atualiza->ExeUpdate("prevenda", $form , "WHERE id_venda= :p", "p={$_GET['id']}");
    $atualiza->getResult();
    if($atualiza->getResult()):
        echo "<div class=\"alert alert-success\" role=\"alert\">Atualização realizada com sucesso</div>";
        echo "<meta http-equiv=\"refresh\" content=1;url=\"index.php?p=eprotege\">";
       
    else:
        echo "<div class=\"alert alert-danger\" role=\"alert\">ERRO ao atualizar</div>";
    endif;
    
//    $cadastra = new Create();
//    $cadastra->ExeCreate("prevenda", $form);
//    $cadastra->getResult();
//    if($cadastra->getResult()){
//        echo "<p class=\"cadastro\">cadastro realizado com sucesso</p>";
//       
//    }else{
//        echo "ERRO ao cadastrar";
//    }
    endif;

    //var_dump($form);
    
    $ver = new Read();
    $ver->ExeRead("prevenda", "WHERE id_venda= :p", "p={$_GET['id']}");
    $ver->getResult();
    $puxavendedor = $ver->getResult()[0]['vendedor'];
    $plano = $ver->getResult()[0]['plano'];
    ?>


    <form id="form1" name="form1" class="form" method="post" action="">

 
        <div class="col-md-12">
                <h3 class="page-header">Vendedor</h3>
           

                        <select name="vendedor" id="vendedor" class="form-control">
                            <?php 
                            $vervend = new Read();
                            $vervend->ExeRead("usuario", "WHERE id_usuario= :p", "p={$puxavendedor}");
                            $vervend->getResult();
                            
                            echo "<option value=\"{$vervend->getResult()[0]['id_usuario']}\">{$vervend->getResult()[0]['nome']}</option>";
                            ?>
                            <option value=""> Selecione o Vendedor</option>
                            <?php
                            $vend = new Read();
                            $vend->ExeRead("usuario", "WHERE nivel= :p ORDER BY nome ASC", "p=2");
                            $vend->getResult();

                            foreach ($vend->getResult() as $valor) {
                                echo "<option value=\"{$valor['id_usuario']}\">{$valor['nome']}</option>";
                            }
                            ?>



                        </select>
                    </div>
            
        <div class="col-md-12">
                            <h1 class="page-header">DADOS DO CLIENTE</h1>

        </div>

                 <div class="col-md-4"><p>CLIENTE :</p>
                    <input name="cliente" type="text" class="form-control" id="cliente" size="75" value="<?= $ver->getResult()[0]['cliente']; ?>" />
                    </div>
     <div class="col-md-4">
               <p>DATA NASCIMENTO</p>
               <input name="data_nasc" type="text" id="data_nasc" class="form-control" size="10" value="<?= $ver->getResult()[0]['data_nasc']; ?>" onKeyPress="MascaraData(form.data_nasc)" />
            </div>
        <div class="col-md-4"><p>CPF: </p>
<input type="text" class="form-control" name="cpf" id="cpf" value="<?= $ver->getResult()[0]['cpf']; ?>" onKeyPress="MascaraCPF(form.cpf)" />

                </div>

         
               <div class="col-md-4"><P>RG</P>
                   <input type="text" class="form-control" name="rg" value="<?= $ver->getResult()[0]['rg']; ?>" id="rg" />
            </div>
            <div class="col-md-4"><p>TEL: Residencial.</p>
              <input name="telres" type="text" id="telres" class="form-control" value="<?= $ver->getResult()[0]['telres']; ?>" onKeyPress="MascaraTelefone(form.telres)" size="12" />  
            </div>
        
        <div class="col-md-4"><p>TEL: Celular</p>
            <input name="telcel" type="text" id="telcel" class="form-control" value="<?= $ver->getResult()[0]['telcel']; ?>" onKeyPress="MascaraTelefone(form.telcel)" size="12" />
            </div>
  
                <div class="page-header">
                    <h3>DADOS DE COBRANÇA</h3></div>
            </div>
<!--            <tr> 
                <div><?php //include ("inc/cep.php");?> </td>
            </div>-->
           <div class="col-md-2">
                <p>CEP</p>
           <input name="cep" type="text" class="form-control" id="cep" value="<?= $ver->getResult()[0]['cep']; ?>"  maxlength="9"
               onblur="pesquisacep(this.value);" />
           </div>
          

                <div class="col-md-9"  ><p>END.RES:</p>

                <input name="endereco" class="form-control" value="<?= $ver->getResult()[0]['endereco']; ?>" type="text" id="endereco" />
            </div>
            
 
                <div class="col-md-1"  ><P>Numero
                        º</P>
                    <input name="numero" type="text" class="form-control" id="numero" value="<?= $ver->getResult()[0]['numero']; ?>"  />
            </div>

                <div class="col-md-3"  >
                    <p>COMPLEMENTO:</p>
                    <input name="complemento" class="form-control" type="text" id="complemento" value="<?= $ver->getResult()[0]['complemento']; ?>" />
              
            </div>

                  <div class="col-md-3"  ><p>BAIRRO :</p>
                <input name="bairro" class="form-control" type="text" id="bairro" value="<?= $ver->getResult()[0]['bairro']; ?>"  />
            </div>

                <div class="col-md-3"  ><p>CIDADE:</p>
               <input name="cidade" class="form-control" type="text" id="cidade" value="<?= $ver->getResult()[0]['cidade']; ?>"  />     
            </div>
           
                <div class="col-md-3"  ><p>UF:</p>
                    <input name="uf" class="form-control" type="text" id="uf" value="<?= $ver->getResult()[0]['uf']; ?>" />
            </div>

                <div class="col-md-12" ><p>EMAIL:</p>
                    <input name="email" type="text" class="form-control" id="email" value="<?= $ver->getResult()[0]['email']; ?>" size="75" />
            </div>
            
                <div class="page-header"  ><h2>DADOS DO VEÍCULO</h2>
            </div>

                <div class="col-md-3"  ><p>MARCA: 
                    </p>
                    <input type="text" class="form-control" name="marca" id="marca" value="<?= $ver->getResult()[0]['marca']; ?>" />
                         </div>

                <div class="col-md-3"  ><p>MODELO </p>
                    <input type="text" class="form-control" name="modelo" id="modelo" value="<?= $ver->getResult()[0]['modelo']; ?>" />
            </div>
            
                <div class="col-md-3"  ><p>ANO:</p>
                 <input name="ano" type="text" class="form-control" id="ano" size="5" value="<?= $ver->getResult()[0]['ano']; ?>" />  
            </div>

                <div class="col-md-3"  ><p>COR:</p>
                    <input type="text" class="form-control" name="cor" id="cor" value="<?= $ver->getResult()[0]['cor']; ?>" />
            </div>

                <div class="col-md-4" ><p>CHASSI:</p>
                    <input type="text" class="form-control" name="chassi" id="chassi" value="<?= $ver->getResult()[0]['chassi']; ?>" />
            </div>
            

                <div class="col-md-4"  ><p>RENAVAM:</p>
                    <input type="text" class="form-control" name="renavam" id="renavam" value="<?= $ver->getResult()[0]['renavam']; ?>" />
            </div>

                <div class="col-md-4"  ><p>PLACA</p>
                    <input type="text" class="form-control" name="placa" id="placa" value="<?= $ver->getResult()[0]['placa']; ?>" />
            </div>

            <!--  Aqui é os dados abiaxo do transferencia-->

<!--                <div class="page-header"  ><h3>DADOS DO NOVO VEÍCULO</h3>            </div>
           
                <div class="col-md-3"  ><p>MARCA: 
                    </p>
                <input type="text" class="form-control" name="marca" id="marca"  />
            </div>
                
               <div class="col-md-3"  ><p>MODELO </p>
                   <input type="text" name="modelo" class="form-control" id="modelo"  />
            </div>
   
               

                <div class="col-md-3"  ><p>ANO:</p>
                   <input name="ano" class="form-control" type="text" id="ano" size="5"  />

            </div>

                <div class="col-md-3"  ><p>COR:</p>
                    <input type="text" class="form-control" name="cor" id="cor"  />
            </div>

                
                <div class="col-md-4"><p>CHASSI:</p>
                    <input type="text" class="form-control" name="chassi" id="chassi"  />
            </div>

                
                <div class="col-md-4"  ><p>RENAVAM:</p>
                    <input type="text" class="form-control" name="renavam" id="renavam"  />
            </div>
           
                <div class="col-md-4"  ><p>PLACA</p>
                    <input type="text" class="form-control" name="placa" id="placa"  />
                    
            </div>-->
            
<!--             <div>
                <div  >ASISTÊNCIA 24 HORAS</td>
            </div>
           <div>
                <div  ><label>
                        <select name="assistencia" id="assistencia">
                            <option>SELECIONE A OPÇÃO</option>
                            <option value="0.00">Sem Assistencia R$0.00</option>
                            <option value="14.90"> Opção 1 R$14.90</option>
                            <option value="24.90">Opção 2 R$24.90</option>
                        </select>
                    </label></td>
            </div>-->
            
                <div class="page-header" ><h3>SELECIONE O PLANO</h3>
           

                    
                    
                    <?php 
                    $verplano = new Read;
                    $verplano->ExeRead("prevenda", "WHERE plano= :p", "p={$plano}");
                    $verplano->getResult();
                    
                                           echo" </br>                       
                                
                            <div class=\"col-md-2 thumbnail altura\">
                               <label> <input type=\"radio\" name=\"tipo_plano\" value=\"{$verplano->getResult()[0]['tipo_plano']}\" checked=\"\"  style=\"float:left; width:20px;\"> <b> Plano </b> {$verplano->getResult()[0]['tipo_plano']}</label> </br></br>
                                <label><input type=\"radio\" name=\"plano_desc\" value=\"{$verplano->getResult()[0]['plano_desc']}\" checked=\"\" style=\"float:left; width:20px;\"> <b> Descrição </b> {$verplano->getResult()[0]['plano_desc']} </label></br></br>
<label><input type=\"radio\" name=\"id_plano\" value=\"{$verplano->getResult()[0]['id_plano']}\" id=\"plano_{$verplano->getResult()[0]['id_plano']}\" checked=\"\" style=\"float:left; width:20px;\"> <b>ID </b> {$verplano->getResult()[0]['id_plano']} </label></br></br>
                                    <label><input type=\"radio\" name=\"plano\" value=\"{$verplano->getResult()[0]['plano']}\" checked=\"\" style=\"float:left; width:20px;\"> <b> Valor R$</b> {$verplano->getResult()[0]['plano']} </label></br></br>

                    <p></p>
                        <hr>
                        
                    </label></div>";
                    ?>

                        <?php
                        $readplano = new Read();
                        $readplano->ExeRead("planos", "ORDER BY id_plano ASC");
                        $readplano->getResult();
 

                        foreach ($readplano->getResult() as $plano) {

                            echo"                       
                                
                            <div class=\"col-md-2 thumbnail altura\" >
                               <label> <input type=\"radio\" name=\"tipo_plano\" value=\"{$plano['plano']}\"  style=\"float:left; width:20px;\"> <b> Plano </b> {$plano['plano']}</label> </br></br>
                                <label><input type=\"radio\" name=\"plano_desc\" value=\"{$plano['descricao']}\" style=\"float:left; width:20px;\"> <b> Descrição </b> {$plano['descricao']} </label></br></br>
<label><input type=\"radio\" name=\"id_plano\" value=\"{$plano['id_plano']}\" id=\"plano_{$plano['id_plano']}\" style=\"float:left; width:20px;\"> <b>ID </b> {$plano['id_plano']} </label></br></br>
                                    <label><input type=\"radio\" name=\"plano\" value=\"{$plano['valor']}\" style=\"float:left; width:20px;\"> <b> Valor R$</b> {$plano['valor']} </label></br></br>

                    <p></p>
                        <hr>
                        
                    </label></div>";
                        }
                        ?>


                <div class="page-header" >
                    <h3> DADOS DA TRANSFERÊNCIA 
                    
                    </h3> 
                </div>

                <div class="col-md-2" >
                    <p>Taxa de Transferência</p>
                    <input type="text" class="form-control" name="taxa" id="taxa"  />
            </div>
            <div class="col-md-3" >
                <P>Forma de pagamento Taxa</P> 
                <input name="pagto_taxa" type="text" class="form-control" id="pagto_taxa" value="<?= $ver->getResult()[0]['pagto_taxa']; ?>" size="75" />
            </div>

                <div class="col-md-2" ><P>Contrato</P>
                <input name="codigo"  class="form-control" type="text" value="<?= $ver->getResult()[0]['codigo']; ?>" id="codigo" />
            </div>

            <div>
                <div class="col-md-3" ><p>Status</p>
            
           
                <select name="status" id="status" class="form-control">
                        <option value="<?= $status= $ver->getResult()[0]['status']; ?>"> <?php 
                        if($status == 1):
                            echo "Em analise";
                        endif;
                        if($status == 2):
                            echo "Agendado";
                        endif;
                        if($status == 3):
                            echo "Instalado";
                        endif;
                        if($status == 4):
                            echo "Cancelado";
                        endif;
                        
                        ?> </option>
                        <option value="#">Selecione Opção</option>
                        <option value="1">Em Análise</option>
                        <option value="2">Agendado</option>
                        <option value="3">Instalado</option>
                        <option value="4">Cancelado</option>
                    </select></td>
            </div>
            <div>
                <div class="col-md-2" ><p>data vencimento</p> 
                    <input name="vencimento" class="form-control" value="<?= $ver->getResult()[0]['vencimento']; ?>" type="text" id="vencimento" " />
            </div>

                <div class="col-md-12" >
                    </br> </br>
                        <input type="hidden" name="ip" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>" />
                        <input type="hidden" name="id_venda" value="<?= $ver->getResult()[0]['id_venda']; ?>" />
                        <input type="hidden" name="datatransf" value="<?= date("Y-m-d"); ?>" />
                        <input type="submit" name="button" id="button" value="CADASTRAR TRANSFERÊNCIA"  class="btn btn-primary"  />
                    </br> </br>
            </div>


    </form>



</main>