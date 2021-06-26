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

<script language="JavaScript" type="text/javascript" src="js/mascara-validacao.js" ></script>
<main> 

    <h3>TRANSFERÊNCIA TITULARIDADE ASSOCIAÇÃO SÃO PAULO </h3>

    <?php


    
    $form = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    if ($form && $form['cadastravenda']):
        unset($form['cadastravenda']);
        unset($form['empresart_2']);
        unset($form['alienado2']);
        unset($form['nf2']);
    
    
    $cadastra = new Update();
    $cadastra->ExeUpdate("prevendaacasp", $form, "WHERE id_venda= :p", "p={$_GET['id']}");
    $cadastra->getResult();

    if($cadastra->getResult()){
        echo "<p class=\"cadastro\">cadastro atualizado com sucesso</p>";
        
        echo "<meta http-equiv=\"refresh\" content=1;url=\"index.php?p=eacasp\">";
       
    }else{
        echo "ERRO ao atualizar";
    }
   endif;
   
    $ver = new Read();
    $ver->ExeRead("prevendaacasp", "WHERE id_venda= :p", "p={$_GET['id']}");
    $ver->getResult();

    //var_dump($form);
    ?>


   

    <form name="inseriracasp" action="" method="post"> 
        <h3>Selecione Vendedor </h3>

        <label> 

            <select name="vendedor" class="form-control" >
                <option value="<?= $ver->getResult()[0]['vendedor']; ?>"> <?= $ver->getResult()[0]['vendedor']; ?></option>
                <?php
                
                
                
                $vend = new Read();
                $vend->ExeRead("usuario", "WHERE nivel= :p ORDER BY nome ASC", "p=2");
                $vend->getResult();

                foreach ($vend->getResult() as $puxa) {
                    echo "<option value=\"{$puxa['id_usuario']}\">{$puxa['nome']}</option>";
                }
                ?>



            </select>
        </label>

        <h3> Dados da Adesão (Transferência) </h3>
        <label class="cinquenta"> 
            <p><b>Taxa de Transferêcia</b> </p> 
            <input type="text" name="valor_transf" class="form-control" value="<?= $ver->getResult()[0]['valor_transf']; ?>"   />
        </label>
        <label class="cinquenta"> 
            <p>Forma Pagamento da transferência </p>
            <input type="text" name="pgto_transf" class="form-control" value="<?= $ver->getResult()[0]['pgto_transf']; ?>"   />
        </label>
        <label class="vinteecinco"> 
            <p>Assistencia 24hs </p>
            <input type="text" name="assist" class="form-control" value="<?= $ver->getResult()[0]['assist']; ?>" />
        </label>
        <label class="vinteecinco"> 
            <p>Mensalidade Rastreador </p>
            <input type="text" name="mesrastreador" class="form-control" value="<?php echo number_format($ver->getResult()[0]['mesrastreador'], 2, '.', ''); ?>"  />
        </label>
        <label class="vinteecinco"> 
            <p>Mensalidade Associacao </p>
            <input type="text" name="mesacasp" class="form-control" value="<?php echo number_format($ver->getResult()[0]['mesacasp'], 2, '.', ''); ?>"  />
        </label >
        <label class="vinteecinco"> 
            <p>Mensalidade Total </p>
            <input type="text" name="mestotal" class="form-control" value="<?php echo number_format($ver->getResult()[0]['mestotal'], 2, '.', ''); ?>"  />
        </label>
        <div class="clear"> </div>

        <h3>DADOS DO ASSOCIADO </h3>

        <label class="setenta"> 
            <p>Associado </p>
            <input type="text" name="associado" class="form-control" value="<?= $ver->getResult()[0]['associado']; ?>" />
        </label>
        <label class="trinta"> 
            <p>Data Nascimento </p>
            <input type="text" name="data_nasc" class="form-control" value="<?= $ver->getResult()[0]['data_nasc']; ?>" />
        </label>
                <label class="cinquenta"> 
            <p>Responsável </p>
            <input type="text" name="responsavel" class="form-control" value="<?= $ver->getResult()[0]['responsavel']; ?>"   />
        </label>
        <label class="vinteecinco"> 
            <p>CPF </p>
            <input type="text" name="cpf" onKeyPress="MascaraCPF(form.cpf)" class="form-control" value="<?= $ver->getResult()[0]['cpf']; ?>"  />
        </label>
        <label class="vinteecinco"> 
            <p>RG </p>
            <input type="text" name="rg" class="form-control" value="<?= $ver->getResult()[0]['rg']; ?>" />
        </label>

        <label class="vinte"> 
            <p>CEP:</p>
            <input name="cep" type="text" id="cep" class="form-control" value="<?= $ver->getResult()[0]['cep']; ?>"  maxlength="9"
                   onblur="pesquisacep(this.value);" />
        </label>
        <label class="setenta">
            <p>Endereço </p>
            <input name="logradouro" type="text" id="logradouro" class="form-control" value="<?= $ver->getResult()[0]['logradouro']; ?>" />
        </label>
        <label class="dez"> 
            <p>Numero </p>
            <input name="numero" type="text" id="numero" class="form-control" value="<?= $ver->getResult()[0]['numero']; ?>" />
        </label>
        <label class="cinquenta"> 
            <p>Complemento </p>
            <input name="complemento" type="text" class="form-control" id="complemento" value="<?= $ver->getResult()[0]['complemento']; ?>" />
        </label>
        <label class="vinte"> 
            <p>Bairro </p>
            <input name="bairro" type="text" class="form-control" id="bairro"value="<?= $ver->getResult()[0]['bairro']; ?>"  />
        </label>
        <label class="vinte"> 
            <p>Cidade </p>
            <input name="localidade" type="text" class="form-control" id="localidade" value="<?= $ver->getResult()[0]['localidade']; ?>"  />
        </label>
        <label class="dez"> 
            <p>UF </p>
            <input name="uf" type="text" class="form-control" id="uf" value="<?= $ver->getResult()[0]['uf']; ?>" />
        </label>
        <label class="cinquenta"> 
            <p>Email </p>
            <input type="text" name="email" class="form-control" value="<?= $ver->getResult()[0]['email']; ?>" />
        </label>
        <label class="vinteecinco"> 
            <p>Telefone Residencial </p>
            <input type="text" name="telres" class="form-control" onKeyPress="MascaraTelefone(form.telres)" value="<?= $ver->getResult()[0]['telres']; ?>" />
        </label>
        <label class="vinteecinco"> 
            <p>Telefone Celular </p>
            <input type="text" name="telcel" class="form-control" onKeyPress="MascaraTelefone(form.telcel)" value="<?= $ver->getResult()[0]['telcel']; ?>" />
        </label>

        <div class="clear"> </div>
        <h3>DADOS DO VEICULO CADASTRADO </h3>

        <label class="trintaetres"> 
            <p>Marca/Modelo </p>
            <input type="text" name="marca_modelo1" class="form-control" value="<?= $ver->getResult()[0]['marca_modelo1']; ?>" />
        </label>
        <label class="trintaetres"> 
            <p>Ano </p>
            <input type="text" name="ano1" class="form-control" value="<?= $ver->getResult()[0]['ano1']; ?>" />
        </label>
        <label class="trintaetres"> 
            <p>Cor </p>
            <input type="text" name="cor1" class="form-control" value="<?= $ver->getResult()[0]['cor1']; ?>" />
        </label>
        <label class="trintaetres"> 
            <p>Renavam </p>
            <input type="text" name="renavam1" class="form-control" value="<?= $ver->getResult()[0]['renavam1']; ?>" />
        </label>
        <label class="trintaetres"> 
            <p>Chassi </p>
            <input type="text" name="chassi1" class="form-control" value="<?= $ver->getResult()[0]['chassi1']; ?>" />
        </label>
        <label class="trintaetres"> 
            <p>Placa </p>
            <input type="text" name="placa1" class="form-control" value="<?= $ver->getResult()[0]['placa1']; ?>" />
        </label>
        <label class="vinteecinco"> 
            <p>Empresa de Rastreamento </p>
            <input type="text" name="empresart_1" class="form-control" value="<?= $ver->getResult()[0]['empresart_1']; ?>"  />
        </label>
        <label class="vinteecinco"> 
            <p>Valor Estimado </p>
            <input type="text" name="valor1" class="form-control"  value="<?= $ver->getResult()[0]['valor1']; ?>" />
        </label>
        <label class="vinteecinco"> 
            <p>Alienado Por </p>
            <input type="text" name="alienado1" class="form-control" value="<?= $ver->getResult()[0]['alienado1']; ?>" />
        </label>
        <label class="vinteecinco"> 
            <p>Nota Fiscal </p>
            <input type="text" name="nf1" class="form-control" value="<?= $ver->getResult()[0]['nf1']; ?>" />
        </label>
        <div class="clear"> </div>
        


        <h3>DADOS DO CONTRATO </h3>
        <label class="cinquenta">
            <p>Contrato </p>
            <input type="text" name="contrato" class="form-control" value="<?= $ver->getResult()[0]['contrato']; ?>" />
        </label>
        <label class="cinquenta">
            <p>Status do Pedido </p>
            <select name="status" class="form-control"> 
                <option value="1"> Aguardando </option>
                <option value="2"> Agendado </option>
                <option value="3"> Instalado </option>
                <option value="4"> Cancelado </option>
            </select>
            
        </label>

        <hr>
        <input type="hidden" name="data_transf" value="<?= date("Y/m/d"); ?>" />
        <input type="submit" value="CADASTRAR TRANSFERÊNCIA" name="cadastravenda" class="btn btn-primary" />

    </form>



</main>