<?php ?>
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

<?php 
            if(isset($_GET['metodo'])):
                
                if($_GET['metodo'] == "carros"):
                    $metodo = "";
                endif;
                if($_GET['metodo'] == "caminhoes"):
                    $metodo = "2";
                endif;
                
            endif;

?>



<script type='text/javascript' src='js/jquery.js'></script>

<script src="js/jquery-1.2.6.js" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function() {


        $('select[@name=veiculo]').change(function() {
            $.post('marca.php',
                    {veiculo: $(this).val()},
            function(veiculo) {

                $('select[@name=marca1]').html(veiculo)

            }

            )


        })

        $('select[@name=marca1]').change(function() {
            $.post('modelo.php',
                    {marca: $(this).val()},
            function(modelo) {

                $('select[@name=modelo1]').html(modelo)

            }

            )


        })
        $('select[@name=modelo1]').change(function() {
            $.post('ano.php',
                    {ano: $(this).val()},
            function(ano) {

                $('select[@name=ano1]').html(ano)

            }

            )


        })
        $('select[@name=ano1]').change(function() {
            $.post('codigofipe.php',
                    {codigofipe: $(this).val()},
            function(codigofipe) {

                $('select[@name=fipe]').html(codigofipe)

            }

            )


        })

        $('select[@name=ano1]').change(function() {
            $.post('preco.php',
                    {preco: $(this).val()},
            function(preco) {

                $('select[@name=valor]').html(preco)

            }

            )


        })


        $('select[@name=ano1]').change(function() {
            $.post('combustivel.php',
                    {combustivel: $(this).val()},
            function(combustivel) {

                $('select[@name=combustivel]').html(combustivel)

            }

            )


        })





    })
    function MM_openBrWindow(theURL, winName, features) { //v2.0
        window.open(theURL, winName, features);
    }
</script> 


<!--<script language="JavaScript" type="text/javascript" src="js/mascara-validacao.js" ></script>-->
<main class="content"> 


    <?php
    $form = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if ($form && $form['button']):
        unset($form['button']);

        $marca = explode("|", $form['marca1']);
        $form['marca'] = $marca[0];

        $modelo = explode("|", $form['modelo1']);
        $form['modelo'] = $modelo[3];

        $ano = explode("|", $form['ano1']);
        $form['ano'] = $ano[4];
        
        //var_dump($form);

        unset($form['marca1']);
        unset($form['modelo1']);
        unset($form['ano1']);
        
        
        $verifica = new Read();
        $verifica->ExeRead("prevenda", "WHERE placa = :p ", "p={$form['placa']}");
        $verifica->getResult();
        
        if($verifica->getResult()):
            echo "<div class=\"alert alert-danger\" role=\"alert\">Ja existe a placa {$form['placa']} cadastrada no sistema</div>";
            else:

        $cadastra = new Create();
        $cadastra->ExeCreate("prevenda", $form);
        $cadastra->getResult();
        if ($cadastra->getResult()) {
            echo "<div class=\"alert alert-success\" role=\"alert\">cadastro realizado com sucesso</div>";
            echo "<meta http-equiv=\"refresh\" content=2;url=\"index.php?p=iprotegec&placa={$form['placa']}\">";
        } else {
            echo "<div class=\"alert alert-danger\" role=\"alert\">ERRO ao cadastrar</div>";
        }
        endif;
    endif;

 //var_dump($form);
    ?>
    
        <form id="form" name="form" method="post" action="">

    

    
    <div class="col-md-12"> 
        
        <h3 class="bg bg-info padding">Selecione o vendedor  </h3>
        
        <?php 
        if($_COOKIE['logprot_nivel'] == "2" || $_COOKIE['logprot_nivel'] == "5"){
            echo "<input type=\"hidden\" name=\"vendedor\" value=\"{$_COOKIE['logprot_id_usuario']}\" />";
            echo "<div class=\"page-header\">
        <h3> VENDEDOR {$_COOKIE['logprot_nome']}   </h3> 
    </div>";
        ?>
        <?php 
        if($_COOKIE['logprot_nivel'] == "5"):
           
          echo "<input type=\"hidden\" name=\"afiliado\" value=\"{$_COOKIE['logprot_id_usuario']}\" />";  
            
            else:
        
        ?>
        <h3>Selecione o Afiliado </h3>
        <select name="afiliado" class="form-control">
            <option>Selecione Afiliado </option>
            <?php 
            $aff = new Read();
            $aff->ExeRead("usuario", "WHERE relacionado = :r", "r={$_COOKIE['logprot_id_usuario']}");
            $aff->getResult();
            foreach ($aff->getResult() as $value) {

            ?>
            <option value="<?= $value['id_usuario'] ?>"> <?= $value['nome'] ?> </option>
            
            <?php } ?>
        </select>
        
        <?php endif; ?>
        
        <hr>
        
        <?php
        }else{
            ?>
        
        <select name="vendedor" class="form-control">
            <option >Selecione o Vendedor </option>
            <?php 
            $selectvend = new Read();
            $selectvend->ExeRead("usuario", "WHERE nivel= :p ORDER BY id_usuario ASC", "p=2");
            $selectvend->getResult();
            foreach ($selectvend->getResult() as $value) {
                
                echo "<option value=\"{$value['id_usuario']}\"> {$value['nome']} </option>";
                
            }
            ?>
        </select>
        <?php } ?>
    </div>
            
            
            
        <div>
            <h3> DADOS DO VEÍCULO </h3>
            <a href="index.php?p=iprotege&metodo=manual" class="btn btn-info">ALTERAR  MÉTODO</a>
        </div>

          <div class="form-group col-md-2">
            <label >VEICULO: </label>
            <select name="veiculo" class="form-control"> 
                <option> Selecione o veiculo</option>
                <option value="motos"> Motos</option>
                <option value="carros"> Carros</option>
                <option value="caminhoes"> Caminhão</option>

            </select>
        </div>
            
            <?php 
            if($_GET['metodo'] == "manual"){
            ?>
            
                    <div class="form-group col-md-2">
            <label >MARCA: </label>

            <input type="text" name="marca1" class="form-control" /> 
        </div>

        <div class="form-group col-md-2">
            <label>MODELO </label>
            <input type="text" id="modelo1" name="modelo1" class="form-control" /> 
            </label>
        </div>

        <div class="form-group col-md-2">
            <label>ANO:</label>
            <input type="text" name="ano1"  id="ano1" class="form-control" /> 

        </div>

        <div class="form-group col-md-2">
            <label>
                CODIGO FIPE:</label>
            <input type="text"  name="fipe" id="fipe" class="form-control" /> 
        </div>

        <div class="form-group col-md-2">
            <label>
                VALOR:</label>
            <input type="text"  name="valor" id="valor" class="form-control" /> 

        </div>
            
            
            <?php }else{ ?>

        <div class="form-group col-md-2">
            <label >MARCA: </label>

            <select name="marca1" class="form-control"> </select>
        </div>

        <div class="form-group col-md-2">
            <label>MODELO </label>
            <select name="modelo1" id="modelo1" class="form-control"> </select>
            </label>
        </div>

        <div class="form-group col-md-2">
            <label>ANO:</label>
            <select name="ano1"  id="ano1" class="form-control"  > </select>

        </div>

        <div class="form-group col-md-2">
            <label>
                CODIGO FIPE:</label>
            <select  name="fipe" id="fipe" class="form-control" > </select>

        </div>

        <div class="form-group col-md-2">
            <label>
                VALOR:</label>
            <select  name="valor" id="valor" class="form-control"> </select>

        </div>

            <?php } ?>

        <div class="form-group col-md-3">
            <label>
                CHASSI:</label>
                <input type="text" name="chassi" id="chassi" class="form-control" />
            
        </div>

        <div class="form-group col-md-3">
            <label>
                RENAVAM:</label>
                <input type="text" name="renavam" id="renavam" class="form-control" />
            
        </div>

        <div class="form-group col-md-3">
            <label>COR:</label>
            
            <input type="text" name="cor" id="cor" class="form-control" />
        </div>
        
        <div class="form-group col-md-3">

            <label>PLACA</label>
            <input type="text" name="placa" id="placa" class="form-control" />
        </label>
        </div>

    <div class="page-header col-md-12">
        <h3> DADOS DO CLIENTE </h3> 
    </div>



           


        <div class="form-group col-md-8">

            <label >
                CLIENTE 
            </label>
            <input name="cliente" type="text" class="form-control" id="cliente"  />
        </div>

        <div class="form-group col-md-4">

            <label >DATA NASCIMENTO</label>
            <input name="data_nasc" type="text" id="data_nasc" class="form-control" size="10" onKeyPress="MascaraData(form.data_nasc)" />

        </div>

        <div class="form-group col-md-3">
            <label>
                CPF / CNPJ: 
            </label>
            <input type="text" name="cpf" id="cpf" class="form-control"  />
        </div>

        <div class="form-group col-md-3">

            <label>RG</label>
            <input type="text" name="rg" id="rg" class="form-control" />

        </div>

        <div class="form-group col-md-3">
            <label>
                TEL: Residencial </label>
            <input name="telres" type="text" id="telres" class="form-control" onKeyPress="MascaraTelefone(form.telres)" size="12" />

        </div>

        <div class="form-group col-md-3">
            <label>
                TEL: Celular
            </label>
            <input name="telcel" type="text" id="telcel" class="form-control" onKeyPress="MascaraTelefone(form.telcel)" size="12" />

        </div>


        <div class="form-group col-md-12">
            <label >EMAIL:</label>
            <input name="email" type="text" id="email" class="form-control" size="75" />
        </div>

        <div class="page-header">
            <h4 > DADOS DE COBRANÇA </h4> 
        </div>

        <div class="form-group col-md-2">
            <label class="vinte">
                CEP 
            </label>
            <input name="cep" type="text" id="cep" value="" class="form-control"  maxlength="9"
                   onblur="pesquisacep(this.value);" />
        </div>

        <div class="form-group col-md-8">
            <label>
                END.RES: </label>
            <input name="endereco" type="text" id="endereco" class="form-control" />
        </div>
        <div class="form-group col-md-2">
            <label>Numeroº</label>
            <input name="numero" type="text" id="numero" class="form-control"  />

        </div>

        <div class="form-group col-md-5">
            <label> 
                COMPLEMENTO:
            </label>
            <input name="complemento" type="text" id="complemento" class="form-control" />
        </div>

        <div class="form-group col-md-3">
            <label> BAIRRO : </label>
            <input name="bairro" type="text" id="bairro"  class="form-control" />
        </div>

        <div class="form-group col-md-3">
            <label>CIDADE: </label>        

            <input name="cidade" type="text" id="cidade" class="form-control"  />
        </div>  

        <div class="form-group col-md-1">
            <label>UF:</label>
            <input name="uf" type="text" id="uf" class="form-control" />
        </div>


       
        
<div class="form-group col-md-12">
        <label>
            <input type="hidden" name="ip" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>" />

            <input type="hidden" name="status" value="1" />
<!--            <input type="hidden" name="relacionado" value="<?= $_COOKIE['logprot_relacionado'] ?>" />-->
            <input type="hidden" name="data" value="<?php echo date("Y-m-d H:i:s"); ?>" />
            <input type="submit" name="button" id="button" value="SEGUIR" class="btn btn-primary"  />
<!--            <input type="hidden" name="vendedor" id="vendedor" value="<?php //echo $_SESSION['id_usuario']; ?>" />-->
<!--            <botoon type="submit" name="button" id="button" class="btn btn-primary"> SEGUIR </botoon>-->
        </label>
</div>
        
    </form>



</main>
<div class="clear"> </div>