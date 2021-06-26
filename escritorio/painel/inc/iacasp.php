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





<script type="text/javascript">
    $(document).ready(function() {

        $('select[@name=marca1]').change(function() {
            $.post('modelo2.php',
                    {marca: $(this).val()},
            function(modelo) {

                $('select[@name=modelo1]').html(modelo)

            }

            )


        })
        $('select[@name=modelo1]').change(function() {
            $.post('ano2.php',
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

                $('select[@name=fipe1]').html(codigofipe)

            }

            )


        })

        $('select[@name=ano1]').change(function() {
            $.post('preco.php',
                    {preco: $(this).val()},
            function(preco) {

                $('select[@name=valor1]').html(preco)

            }

            )


        })


        $('select[@name=ano]').change(function() {
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



<main class="content"> 
    <div class="page-header">
        <h3>INSERIR VENDA ASSOCIAÇÃO SÃO PAULO  </h3>
    </div>

    <div class="cem"> 
        <div class="col-md-3">
            <a href="index.php?p=iacasp&opcao=1" ><botton class="btn btn-primary"> Opção 1 (Caminhões Pesados FIPE) </botton></a>
        </div>

<!--        <div class="col-md-3">   
            <a href="index.php?p=iacasp&opcao=3"><botton class="btn btn-primary"> Opção 3 (Antigos sem FIPE)  </botton></a>
        </div>-->
    </div>

    <div class="clear"> </div>

    <?php
    $form = filter_input_array(INPUT_POST, FILTER_DEFAULT);


    if ($form && $form['assist24hs']):
        $marcat = explode("|", $form['marca1']);
        $marca = $marcat[0];

        $modelot = explode("|", $form['modelo1']);
        $modelo = $modelot[0];


//        $ano1 = explode("|", $form['ano1']);
//        $form['ano1'] = $ano1[1];

        $valor = $form['valor1'];

        $valor = str_replace("R$ ", "", $valor); // Primeiro tira os pontos
        $valor = str_replace(".", "", $valor); // Primeiro tira os pontos
        $valor = str_replace(",", "", $valor); // Depois tira a vírgula


        $total = number_format($valor / 100, 2, ".", "");


        $form['assist'] = $form['assist24hs'];

        unset($form['marca1']);
        unset($form['modelo1']);
        unset($form['assist24hs']);

        $marcamodelo = $marca . "/" . $modelo;

        unset($form['cadastrarvenda']);
        unset($form['empresart_2']);
        unset($form['alienado2']);
        unset($form['nf2']);
       
        
        $form['vendedor'] = $_COOKIE['logprot_id_usuario'];

        $cadastra = new Create();
        $cadastra->ExeCreate("prevendaacasp", $form);
        $cadastra->getResult();
        if ($cadastra->getResult()) {
            echo "<p class=\"alert alert-success\">cadastro realizado com sucesso</p>";
            echo "<meta http-equiv=\"refresh\" content=0;url=\"index.php?p=iacaspb&placa={$form['placa1']}\">";
        } else {
            echo "ERRO ao cadastrar";
        }
        
       
    endif;

   //var_dump($form);
    ?>


    <?php
    
    if(empty($_GET['opcao'])){
        echo "</br><span class=\"glyphicon glyphicon-hand-up col-md-12\">Selecione uma opção acima</span>";
    }else{
   if ($_GET['opcao'] == 1):

      include('oacasp.php');
     
    endif;
   if ($_GET['opcao'] == 2):
        include('oacasp2.php');

    endif;
    if ($_GET['opcao'] == 3):

             include('oacasp3.php');

    endif;
    }
    ?>

    <?php if ($form['calcular'] == "CALCULAR") { ?>
    
    
        <div class="col-md-12"> 
        
        <?php 
        if($_COOKIE['logprot_nivel'] == "2"){
            echo "<input type=\"hidden\" name=\"vendedor\" value=\"{$_COOKIE['logprot_id_usuario']}\" />";
            echo "<div class=\"page-header\">
        <h3> VENDEDOR {$_COOKIE['logprot_nome']}   </h3> 
    </div>";
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

        <form name="" action="" method="post"> 

            <div class="page-header">
                <h3> Dados da Adesão </h3>
            </div>

            <div class="form-group col-md-6"> 
                <p><b>Adesão</b> </p>
                <input type="text" class="form-control" name="adesao"  />
            </div>
            <div class="form-group col-md-6"> 
                <p>Forma Pagamento da adesão </p>
                <input type="text" class="form-control" name="pgto_adesao"  />
            </div>
            <div class="form-group col-md-3"> 
                <p>Assistencia 24hs </p>
                <input type="text" name="assist24hs" class="form-control" value="<?php echo $form['assistencia24hs']; ?>"  />
            </div>
            <div class="form-group col-md-3"> 
                <p>Mensalidade Rastreador </p>
                <input type="text" name="mesrastreador" class="form-control" value="<?php echo number_format($rt, 2, '.', ''); ?>"  />
            </div>
            <div class="form-group col-md-3"> 
                <p>Mensalidade Associacao </p>
                <input type="text" name="mesacasp" class="form-control" value="<?php echo number_format($mescasp, 2, '.', ''); ?>"  />
            </div>
            <div class="vinteecincoform-group col-md-3"> 
                <p>Mensalidade Total </p>
                <input type="text" name="mestotal" class="form-control" value="<?php echo number_format($soma, 2, '.', ''); ?>"  />
            </div>

            <div class="form-group col-md-12"> . </div>

            <div class="col-md-12">
                <h3 class="page-header">DADOS DO VEICULO </h3>
            </div>
            <div class="form-group col-md-3"> 
                <p>Marca / Modelo</p>
                <input type="text" name="marca_modelo1" class="form-control" value="<?php 
                
                $vermarca = explode("|", $form['marca1']);
                
                $vermodelo = explode("|", $form['modelo1']);
                
                echo $vermarca[0] . "/" . $vermodelo[3];
                
                ?>" />
            </div>

            <div class="form-group col-md-1"> 
                <p>Ano </p>
                <input type="text" name="ano1" class="form-control" value="<?php 
                $verano = explode("|", $form['ano1']);
                
                echo $verano[4];
                
                ?>" /> 

            </div>
            <div class="form-group col-md-2"> 
                <p>Fipe </p>
                <input type="text" name="fipe1" class="form-control" value="<?php echo $form['fipe']; ?>" /> 
            </div>

            <div class="form-group col-md-2"> 
                <p>Valor </p>
                <input type="text" name="valor1" class="form-control" value="<?= $total; ?>" />
            </div>
            <div class="form-group col-md-2"> 
                <p>Placa </p>
                <input type="text" name="placa1" class="form-control" value="<?php echo $form['placa']; ?>" />

            </div>

            <div class="form-group col-md-2"> 
                <p>Cor </p>
                <input type="text" class="form-control" name="cor1"  />
            </div>


            <div class="form-group col-md-3"> 
                <p>Renavam </p>
                <input type="text" name="renavam1" class="form-control" />
            </div>
            <div class="form-group col-md-3"> 
                <p>Chassi </p>
                <input type="text" name="chassi1" class="form-control" />
            </div>

            <div class="form-group col-md-2"> 
                <p>Empresa de Rastreamento </p>
                <input type="text" name="empresart_1" class="form-control"  />
            </div>

            <div class="form-group col-md-2"> 
                <p>Alienado Por </p>
                <input type="text" name="alienado1" class="form-control" />
            </div>
            <div class="form-group col-md-2"> 
                <p>Nota Fiscal </p>
                <input type="text" name="nf1" class="form-control" />
            </div>



            <div class="page-header col-md-12">
                <h3>DADOS DO IMPLEMENTO CARRETA </h3>
            </div>
            <div class="form-group col-md-3"> 
                <p>Marca / Modelo</p>
                <input type="text" name="marca_modelo2" class="form-control"  />
            </div>

            <div class="form-group col-md-2"> 
                <p>Ano </p>
                <input type="text" name="ano2" class="form-control"  /> 

            </div>
            <div class="form-group col-md-2"> 
                <p>Fipe </p>
                <input type="text" name="fipe2" class="form-control"  /> 
            </div>

            <div class="form-group col-md-2"> 
                <p>Valor </p>
                <input type="text" name="valor2" class="form-control" value="<?= $imple ?>"  />
            </div>
            <div class="form-group col-md-3"> 
                <p>Placa </p>
                <input type="text" name="placa2" class="form-control" />

            </div>

            <div class="form-group col-md-2"> 
                <p>Cor </p>
                <input type="text" class="form-control" name="cor2"  />
            </div>


            <div class="form-group col-md-3"> 
                <p>Renavam </p>
                <input type="text" name="renavam2" class="form-control" />
            </div>
            <div class="form-group col-md-3"> 
                <p>Chassi </p>
                <input type="text" name="chassi2" class="form-control" />
            </div>


            <div class="form-group col-md-2"> 
                <p>Alienado Por </p>
                <input type="text" name="alienado2" class="form-control" />
            </div>
            <div class="form-group col-md-2"> 
                <p>Nota Fiscal </p>
                <input type="text" name="nf2" class="form-control" />
            </div>




            <h3 class="page-header"> DADOS DO ASSOCIADO </h3>


            <div class="form-group col-md-8"> 
                <p>Associado </p>
                <input type="text" class="form-control" name="associado" />
            </div>
            <div class="form-group col-md-4"> 
                <p>Data Nascimento </p>
                <input type="text" class="form-control" name="data_nasc" />
            </div>
            <div class="form-group col-md-4"> 
                <p>Responsável </p>
                <input type="text" class="form-control" name="responsavel"   />
            </div>
            <div class="form-group col-md-4"> 
                <p>CPF / CNPJ </p>
                <input type="text" name="cpf" class="form-control"   />
            </div>
            <div class="form-group col-md-4"> 
                <p>RG </p>
                <input type="text" name="rg" class="form-control" />
            </div>

            <div class="page-header"> 
                <h3> DADOS DE COBRANÇA </h3>
            </div>

            <div class="form-group col-md-2"> 
                <p>CEP:</p>
                <input name="cep" type="text" class="form-control" id="cep" value=""  maxlength="9"
                       onblur="pesquisacep(this.value);" />
            </div>
            <div class="form-group col-md-8">
                <p>Endereço </p>
                <input name="logradouro" class="form-control" type="text" id="logradouro" />
            </div>
            <div class="form-group col-md-2"> 
                <p>Numero </p>
                <input name="numero" class="form-control" type="text" id="numero" />
            </div>
            <div class="form-group col-md-4"> 
                <p>Complemento </p>
                <input name="complemento" class="form-control" type="text" id="complemento" />
            </div>
            <div class="form-group col-md-2"> 
                <p>Bairro </p>
                <input name="bairro" class="form-control" type="text" id="bairro"  />
            </div>
            <div class="form-group col-md-2"> 
                <p>Cidade </p>
                <input name="localidade" class="form-control" type="text" id="localidade"  />
            </div>
            <div class="form-group col-md-2"> 
                <p>UF </p>
                <input name="uf" type="text" class="form-control" id="uf" />
            </div>
            <div class="form-group col-md-6"> 
                <p>Email </p>
                <input type="text" class="form-control" name="email" />
            </div>
            <div class="form-group col-md-3"> 
                <p>Telefone Residencial </p>
                <input type="text" name="telres" class="form-control" onKeyPress="MascaraTelefone(form.telres)" />
            </div>
            <div class="form-group col-md-3"> 
                <p>Telefone Celular </p>
                <input type="text" name="telcel" class="form-control" onKeyPress="MascaraTelefone(form.telcel)" />
            </div>

            <div class="clear"> </div>


            <div class="form-group col-md-12">
                <input type="submit" value="CADASTRAR" name="cadastrarvenda" class="btn btn-success" />
                <input type="hidden" name="data" value="<?= date("Y-m-d"); ?>" />
<!--                <input type="hidden" name="vendedor" value="<?= $_COOKIE['logprot_id_usuario']; ?>" />-->
                
            </div>
        </form>

    <?php } ?>

   
  


</main>