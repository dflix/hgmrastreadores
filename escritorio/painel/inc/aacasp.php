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


<!--
<script type='text/javascript' src='js/jquery.js'></script>

<script language="JavaScript" type="text/javascript" src="js/mascara-validacao.js" ></script>-->
<main class="content"> 

    <h3 class="page-header">EDITAR VENDA ASSOCIAÇÃO SÃO PAULO </h3>

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

        if ($cadastra->getResult()) {
            echo "<div class=\"alert alert-success\" role=\"alert\">atualização realizada com sucesso</div>";
            echo "<meta http-equiv=\"refresh\" content=0;url=\"index.php?p=eacasp\">";
            
        
        } else {
            echo "ERRO ao atualizar";
        }
    endif;

    $ver = new Read();
    $ver->ExeRead("prevendaacasp", "WHERE id_venda= :p", "p={$_GET['id']}");
    $ver->getResult();

    //var_dump($form);
    ?>


    <?php include('oacasp.php'); ?>

    <form name="inseriracasp" class="form" action="" method="post"> 
       <h3 class="page-header">Selecione Vendedor </h3>

        <div class="col-md-12"> 

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
        </div>

        <h3 class="page-header"> Dados da Adesão </h3>

        <div class="col-md-6"> 
            <p><b>Adesão</b> </p>
            <input type="text" name="adesao" class="form-control" value="<?= $ver->getResult()[0]['adesao'] ?>"  />
        </div>
        <div class="col-md-6">  
            <p>Forma Pagamento da adesão </p>
            <input type="text" name="pgto_adesao" class="form-control" value="<?= $ver->getResult()[0]['pgto_adesao'] ?>"  />
        </div>
        <div class="col-md-3">  
            <p>Assistencia 24hs </p>
            <input type="text" name="assist" class="form-control" value="<?= $ver->getResult()[0]['assist'] ?>"  />
        </div>

        <div class="col-md-3">  
            <p>Mensalidade Rastreador </p>
            <input type="text" name="mesrastreador" class="form-control" value="<?= $ver->getResult()[0]['mesrastreador'] ?>"  />
        </div>

        <div class="col-md-3">  
            <p>Mensalidade Associacao </p>
            <input type="text" name="mesacasp" class="form-control" value="<?= $ver->getResult()[0]['mesacasp']; ?>"  />
        </div>

        <div class="col-md-3">  
            <p>Mensalidade Total </p>
            <input type="text" name="mestotal" class="form-control" value="<?= $ver->getResult()[0]['mestotal']; ?>"  />
        </div>
        <div class="clear"> </div>

        <h3 class="page-header">DADOS DO ASSOCIADO </h3>

        <div class="col-md-9"> 
            <p>Associado </p>
            <input type="text" name="associado" class="form-control" value="<?= $ver->getResult()[0]['associado']; ?>" />
        </div>
        <div class="col-md-3">  
            <p>Data Nascimento </p>
            <input type="text" name="data_nasc" class="form-control" value="<?= $ver->getResult()[0]['data_nasc']; ?>" />
        </div>

        <div class="col-md-6">
            <p>Responsável </p>
            <input type="text" name="responsavel" class="form-control" value="<?= $ver->getResult()[0]['responsavel']; ?>"   />
        </div>

        <div class="col-md-3">
            <p>CPF / CNPJ </p>
            <input type="text" name="cpf" class="form-control"  value="<?= $ver->getResult()[0]['cpf']; ?>"  />
        </div>
        <div class="col-md-3">
            <p>RG </p>
            <input type="text" name="rg" class="form-control" value="<?= $ver->getResult()[0]['rg']; ?>" />
        </div>

        <div class="col-md-2">
            <p>CEP:</p>
            <input name="cep" type="text" id="cep" value="<?= $ver->getResult()[0]['cep']; ?>"  maxlength="9"
                   onblur="pesquisacep(this.value);" class="form-control" />
        </div>
        <div class="col-md-8">
            <p>Endereço </p>
            <input name="logradouro" class="form-control" type="text" id="logradouro" value="<?= $ver->getResult()[0]['logradouro']; ?>" />
        </div>
        <div class="col-md-2">
            <p>Numero </p>
            <input name="numero" class="form-control" type="text" id="numero" value="<?= $ver->getResult()[0]['numero']; ?>" />
        </div>


        <div class="col-md-6">
            <p>Complemento </p>
            <input name="complemento" class="form-control" type="text" id="complemento" value="<?= $ver->getResult()[0]['complemento']; ?>" />
        </div>
        <div class="col-md-2">
            <p>Bairro </p>
            <input name="bairro" class="form-control" type="text" id="bairro"value="<?= $ver->getResult()[0]['bairro']; ?>"  />
        </div>
        <div class="col-md-2"> 
            <p>Cidade </p>
            <input name="localidade" class="form-control" type="text" id="localidade" value="<?= $ver->getResult()[0]['localidade']; ?>"  />
        </div>
        <div class="col-md-2"> 
            <p>UF </p>
            <input name="uf" type="text" class="form-control" id="uf" value="<?= $ver->getResult()[0]['uf']; ?>" />
        </div>

        <div class="col-md-6"> 
            <p>Email </p>
            <input type="text" name="email" class="form-control" value="<?= $ver->getResult()[0]['email']; ?>" />
        </div>
        <<div class="col-md-3">
            <p>Telefone Residencial </p>
            <input type="text" name="telres" class="form-control" onKeyPress="MascaraTelefone(form.telres)" value="<?= $ver->getResult()[0]['telres']; ?>" />
        </div>
<div class="col-md-3"> 
            <p>Telefone Celular </p>
            <input type="text" name="telcel" class="form-control"  onKeyPress="MascaraTelefone(form.telcel)" value="<?= $ver->getResult()[0]['telcel']; ?>" />
        </div>

        <div class="clear"> </div>
        <h3 class="page-header">DADOS DO VEICULO </h3>

       <div class="col-md-4"> 
            <p>Marca/Modelo </p>
            <input type="text" name="marca_modelo1" class="form-control" value="<?= $ver->getResult()[0]['marca_modelo1']; ?>" />
        </div>
       <div class="col-md-4">
            <p>Ano </p>
            <input type="text" name="ano1" class="form-control" value="<?= $ver->getResult()[0]['ano1']; ?>" />
        </div>
     <div class="col-md-4">
            <p>Cor </p>
            <input type="text" name="cor1" class="form-control" value="<?= $ver->getResult()[0]['cor1']; ?>" />
        </div>
 <div class="col-md-4">
            <p>Renavam </p>
            <input type="text" name="renavam1" class="form-control"  value="<?= $ver->getResult()[0]['renavam1']; ?>" />
        </div>
 <div class="col-md-4">
            <p>Chassi </p>
            <input type="text" name="chassi1" class="form-control" value="<?= $ver->getResult()[0]['chassi1']; ?>" />
        </div>
 <div class="col-md-4">
            <p>Placa </p>
            <input type="text" name="placa1" class="form-control" value="<?= $ver->getResult()[0]['placa1']; ?>" />
        </div>
        
 <div class="col-md-2">
            <p>Empresa de Rastreamento </p>
            <input type="text" name="empresart_1" class="form-control" value="<?= $ver->getResult()[0]['empresart_1']; ?>"  />
        </div>
 <div class="col-md-2">
            <p>Valor Estimado </p>
            <input type="text" name="valor1" class="form-control"  value="<?= $ver->getResult()[0]['valor1']; ?>" />
        </div>
 <div class="col-md-2">
            <p>FIPE </p>
            <input type="text" name="fipe1" class="form-control"  value="<?= $ver->getResult()[0]['fipe1']; ?>" />
        </div>
 <div class="col-md-2"> 
            <p>Alienado Por </p>
            <input type="text" name="alienado1" class="form-control" value="<?= $ver->getResult()[0]['alienado1']; ?>" />
        </div>
 <div class="col-md-4">
            <p>Nota Fiscal </p>
            <input type="text" name="nf1" class="form-control"  value="<?= $ver->getResult()[0]['nf1']; ?>" />
        </div>
        <div class="clear"> </div>
        <h3 class="page-header"> Dados do Implemento / Carreta </h3>
 <div class="col-md-4"> 
            <p>Marca/Modelo </p>
            <input type="text" name="marca_modelo2" class="form-control"  value="<?= $ver->getResult()[0]['marca_modelo2']; ?>" />
        </div>
 <div class="col-md-4">
            <p>Ano </p>
            <input type="text" name="ano2" class="form-control" value="<?= $ver->getResult()[0]['ano2']; ?>" />
        </div>
 <div class="col-md-4">
            <p>Cor </p>
            <input type="text" name="cor2" class="form-control" value="<?= $ver->getResult()[0]['cor2']; ?>" />
        </div>
 <div class="col-md-4">
            <p>Renavam </p>
            <input type="text" name="renavam2" class="form-control" value="<?= $ver->getResult()[0]['renavam2']; ?>" />
        </div>
 <div class="col-md-4">
            <p>Chassi </p>
            <input type="text" name="chassi2" class="form-control" value="<?= $ver->getResult()[0]['chassi2']; ?>" />
        </div>
 <div class="col-md-4">
            <p>Placa </p>
            <input type="text" name="placa2" class="form-control" value="<?= $ver->getResult()[0]['placa2']; ?>" />
        </div>
 <div class="col-md-2">
            <p>Empresa de Rastreamento </p>
            <input type="text" name="empresart_2" class="form-control"   />
        </div>
 <div class="col-md-2">
            <p>Valor Estimado </p>
            <input type="text" name="valor2" class="form-control" value="<?= $ver->getResult()[0]['valor2']; ?>"  />
        </div>
 <div class="col-md-2">
            <p>FIPE </p>
            <input type="text" name="fipe2" class="form-control" value="<?= $ver->getResult()[0]['fipe2']; ?>"  />
        </div>
 <div class="col-md-2">
            <p>Alienado Por </p>
            <input type="text" name="alienado2" class="form-control" value="<?= $ver->getResult()[0]['alienado2']; ?>"   />
        </div>
 <div class="col-md-4">
            <p>Nota Fiscal </p>
            <input type="text" name="nf2" class="form-control"  />
        </div>
        <h3 class="page-header">DADOS DO CONTRATO </h3>
 <div class="col-md-4">
            <p>Contrato </p>
            <input type="text" name="contrato" value="<?= $ver->getResult()[0]['contrato']; ?>" class="form-control" />
        </div>
 <div class="col-md-4">
            <p>Status do Pedido  </p>
            <select name="status" class="form-control"> 
               <option value="<?= $ver->getResult()[0]['status']; ?>"> <?= $ver->getResult()[0]['status']; ?>  </option>
                <option value="1"> Aguardando(1) </option>
                <option value="2"> Agendado(2) </option>
                <option value="3"> Instalado(3) </option>
                <option value="4"> Cancelado(4) </option>
            </select>

        </div>
        
        <div class="col-md-4"> 
            <p>Regulamento </p>
             
            <select name="regulamento" class="form-control"> 
                <option value="<?= $ver->getResult()[0]['regulamento']; ?>"> <?php 
                
                $vercontrato = new Read();
                $vercontrato->ExeRead("contrato", "WHERE id_contrato = :a", "a={$ver->getResult()[0]['regulamento']}");
                $vercontrato->getResult();
                
                echo $vercontrato->getResult()[0]['contrato'] ; ?> </option>
                <?php 
                $contrato = new Read();
                $contrato->ExeRead("contrato", "ORDER BY id_contrato DESC" );
                $contrato->getResult();
                
                foreach ($contrato->getResult() as $value) {
                    
              
                ?>
                <option value="<?= $value['id_contrato'] ?>"> <?= $value['contrato'] ?> </option>
                <?php } ?>
            </select>
        </div>

        <hr>
        <div class="col-md-12">
        
        
<!--        <input type="hidden" name="vendedor" value="<?= $ver->getResult()[0]['vendedor']; ?>" />-->
        <input type="submit" value="CADASTRAR" name="cadastravenda" class="btn btn-primary" />
        </div>
    </form>



</main>