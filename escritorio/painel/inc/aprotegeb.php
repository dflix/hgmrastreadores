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




<main class="content"> 
    <div class="page-header">
    <h1>INSERIR VENDA PROTEGE </h1>
    </div>
    
    <?php
    
    $puxa = new Read();
    $puxa->ExeRead("prevenda", "WHERE placa = :p", "p={$_GET['placa']}");
    $puxa->getResult();
    
    $form = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if ($form && $form['button']):
        unset($form['button']);

        $cadastra = new Update();
        $cadastra->ExeUpdate("prevenda", $form, "WHERE placa = :p", "p={$_GET['placa']}");
        $cadastra->getResult();

        if ($cadastra->getResult()) {

            echo "<p class=\"cadastro\">cadastro realizado com sucesso</p>";
            echo "<meta http-equiv=\"refresh\" content=0;url=\"index.php?p=aprotegec&placa={$form['placa']}\">";
        } else {
            echo "Erro ao atualizar";
        }

    endif;

    //var_dump($cadastra, $form);
    ?>


    <form id="form1" name="form1" method="post" action="">




        <h3>SELECIONE O PLANO</h3>
        <div class="clear"> </div>
        
        
        
                                    <div class="thumbnail col-md-3">
                               <label> <input type="radio" name="tipo_plano" checked="" value="<?= $puxa->getResult()[0]['tipo_plano'] ?>" style="float:left; width:20px;"> <b> Plano </b> <?= $puxa->getResult()[0]['tipo_plano'] ?></label> </br></br>
                                <label><input type="radio" name="plano_desc" checked="" value="<?= $puxa->getResult()[0]['plano_desc'] ?>" style="float:left; width:20px;"> <b> Descrição </b> <?= $puxa->getResult()[0]['plano_desc'] ?> </label></br></br>
<label><input type="radio" name="id_plano" checked="" value="<?= $puxa->getResult()[0]['id_plano'] ?>"  style="float:left; width:20px;"> <b>ID </b> <?= $puxa->getResult()[0]['id_plano'] ?> </label></br></br>
                                    <label><input type="radio" checked="" name="plano" value="<?= $puxa->getResult()[0]['plano'] ?>" style="float:left; width:20px;"> <b> Valor R$</b> <?= $puxa->getResult()[0]['plano'] ?> </label></br></br>

      
                        
                    </label> </div>


        <?php
        $readplano = new Read();
        $readplano->ExeRead("planos", "ORDER BY id_plano ASC");
        $readplano->getResult();

        foreach ($readplano->getResult() as $plano) {

            echo"                       
                                
                            <div class=\"thumbnail col-md-3 \">
                               <label> <input type=\"radio\" name=\"tipo_plano\" value=\"{$plano['plano']}\" style=\"float:left; width:20px;\"> <b> Plano </b> {$plano['plano']}</label> </br></br>
                                <label><input type=\"radio\" name=\"plano_desc\" value=\"{$plano['descricao']}\" style=\"float:left; width:20px;\"> <b> Descrição </b> {$plano['descricao']} </label></br></br>
<label><input type=\"radio\" name=\"id_plano\" value=\"{$plano['id_plano']}\" id=\"plano_{$plano['id_plano']}\" style=\"float:left; width:20px;\"> <b>ID </b> {$plano['id_plano']} </label></br></br>
                                    <label><input type=\"radio\" name=\"plano\" value=\"{$plano['valor']}\" style=\"float:left; width:20px;\"> <b> Valor R$</b> {$plano['valor']} </label></br></br>

      
                        
                    </label> </div>";
        }
        ?>
        <div style="clear:both;"> </div>
        </br>
        <div class="page-header"> 
            <h3> DADOS DE ADESÃO </h3>
            
            </div>
        <div class="form-group col-md-3">
                <label>
                    Adesão</label>
                    <input type="text" class="form-control" name="adesao" id="adesao" placeholder="450.00" value="<?= $puxa->getResult()[0]['adesao'] ?>" />
                </div>
        
        <div class="form-group col-md-3">        
        <label>Forma de pagamento</label> 
                    <select class="form-control" name="formapgto_adesao"> 
                        <option value="<?= $puxa->getResult()[0]['formapgto_adesao'] ?>"> <?= $puxa->getResult()[0]['formapgto_adesao'] ?>  </option>
                        <option value="1"> DINHEIRO</option>
                        <option value="2"> CARTÃ MAQUINA</option>
                        <option value="3"> CARTÃ PAGSEGURO</option>
                        <option value="4"> BOLETO</option>
                        <option value="5"> CHEQUE</option>
                    </select>
                </div>
        
        <div class="form-group col-md-3"> 
                <label class="quarenta">Forma de pagamento</label> 
                    <input name="pgto_adesao" class="form-control" type="text" id="pgto_adesao" size="75" value="<?= $puxa->getResult()[0]['pgto_adesao'] ?>" />
                </div>

<div class="form-group col-md-3"> 
                <label>data vencimento</label>
                    <input name="vencimento" type="text" id="vencimento" class="form-control" placeholder="30" <?= $puxa->getResult()[0]['vencimento'] ?>  />
                </div>
                <div class="clear"> </div>
                </br></br>
                <label>

                    <input type="submit" name="button" id="button" value="SEGUIR"  class="btn btn-primary"  />
                    <input type="hidden" name="placa" value="<?= $_GET['placa']; ?>" />
                </label>

                <div class="clear"> </div>

                </br></br>
                </form>



                </main>
                <div class="clear"> </div>