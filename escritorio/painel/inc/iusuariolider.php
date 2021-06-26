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


<script language="JavaScript" type="text/javascript" src="js/mascara-validacao.js" ></script>
<main> 

    <h1 class="page-header">CADASTRO DE USUÁRIOS </h1>

    <?php
    $form = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if ($form && $form['cadastrausuario']):
        unset($form['cadastrausuario']);

        $form['salario'] = str_replace("R$ ", "", $form['salario']); // Primeiro tira os pontos
        $form['salario'] = str_replace(".", "", $form['salario']); // Primeiro tira os pontos
        $form['salario'] = str_replace(",", "", $form['salario']); // Depois tira a vírgula

        $form['vr'] = str_replace("R$ ", "", $form['vr']); // Primeiro tira os pontos
        $form['vr'] = str_replace(".", "", $form['vr']); // Primeiro tira os pontos
        $form['vr'] = str_replace(",", "", $form['vr']); // Depois tira a vírgula

        $form['vt'] = str_replace("R$ ", "", $form['vt']); // Primeiro tira os pontos
        $form['vt'] = str_replace(".", "", $form['vt']); // Primeiro tira os pontos
        $form['vt'] = str_replace(",", "", $form['vt']); // Depois tira a vírgula

        $form['outros_beneficios'] = str_replace("R$ ", "", $form['outros_beneficios']); // Primeiro tira os pontos
        $form['outros_beneficios'] = str_replace(".", "", $form['outros_beneficios']); // Primeiro tira os pontos
        $form['outros_beneficios'] = str_replace(",", "", $form['outros_beneficios']); // Depois tira a vírgula


        $cadastra = new Create();
        $cadastra->ExeCreate("usuario", $form);
        $cadastra->getResult();
        if ($cadastra->getResult()) {
            echo "<p class=\"cadastro\">cadastro realizado com sucesso</p>";
        } else {
            echo "ERRO ao cadastrar";
        }
    endif;

    var_dump($form);
    ?>


    <form id="form1" name="form1" method="post" action="" class="form">

        <div class="col-md-4"> 
            <p>Nome </p>
            <input type="text" name="nome" class="form-control" />
        </div>
        <div class="col-md-4"> 
            <p>E-mail </p>
            <input type="text" name="email" class="form-control" />
        </div>
        <div class="col-md-4"> 
            <p>Senha </p>
            <input type="text" name="senha" class="form-control" />
        </div>

        <div class="col-md-4"> 
            <p>CPF </p>
            <input type="text" name="cpf" class="form-control" />
        </div>
        <div class="col-md-4"> 
            <p>RG </p>
            <input type="text" name="rg" class="form-control" />
        </div>
        <div class="col-md-4"> 
            <p>Data Nascimeto </p>
            <input type="text" name="nascimento" class="form-control" />
        </div>

        <div class="col-md-1"> 
            <p>CEP </p>
            <input type="text" name="cep" class="form-control" />
        </div>
        <div class="col-md-9"> 
            <p>Endereço </p>
            <input type="text" name="cep" class="form-control" />
        </div>
        <div class="col-md-2"> 
            <p>Numero </p>
            <input type="text" name="cep" class="form-control" />
        </div>

        <div class="col-md-6"> 
            <p>Complemento </p>
            <input type="text" name="complemento" class="form-control" />
        </div>
        <div class="col-md-2"> 
            <p>Bairro </p>
            <input type="text" name="cep" class="form-control" />
        </div>
        <div class="col-md-2"> 
            <p>Cidade </p>
            <input type="text" name="cep" class="form-control" />
        </div>
        <div class="col-md-2"> 
            <p>Estado</p>
            <input type="text" name="cep" class="form-control" />
        </div>

        <div class="col-md-4"> 
            <p>E-mail alternativo </p>
            <input type="text" name="email_alternativo" class="form-control" />
        </div>
        <div class="col-md-4"> 
            <p>Telefone Residencial </p>
            <input type="text" name="tel_res" class="form-control" />
        </div>
        <div class="col-md-4"> 
            <p>Telefone Celular</p>
            <input type="text" name="tel_cel" class="form-control" />
        </div>

<!--        <div class="col-md-3"> 
            <p>Tipo Funcionário</p>
            <select name="tipo" class="form-control"> 
                <option value="1"> CLT(1)</option>
                <option value="2"> AUTÔNOMO(2)</option>

            </select>
        </div>
        <div class="col-md-3"> 
            <p>Salário </p>
            <input type="text" name="salario" class="form-control" />
        </div>
        <div class="col-md-2"> 
            <p>Vale Refeição</p>
            <input type="text" name="vr" class="form-control" />
        </div>
        <div class="col-md-2"> 
            <p>Vale Transporte</p>
            <input type="text" name="vt" class="form-control" />
        </div>
        <div class="col-md-2"> 
            <p>Outros beneficios</p>
            <input type="text" name="outros_beneficios" class="form-control" />
        </div>-->






<!--        <div class="col-md-12"> 
            <p> Nivel de acesso ao sistema</p>
            <select name="nivel" class="form-control">
                <option value="1"> Financeiro</option>
                <option value="2"> Vendedor</option>
                <option value="3"> Instalador</option>
                <option value="4"> Lider</option>
                <option value="5"> Lojista</option>
                <option value="6"> Administrador</option>

            </select>
        </div>-->

        </br></br></br>
        <div class="col-md-12">
            <input type="hidden" name="ramdom" value="<?php
    $rdm = date("hisYmdsiY");
    echo $rdm;
    ?>" />
            <input type="hidden" name="ativo" value="1" />
            <input type="hidden" name="nivel" value="5" />
            <input type="hidden" name="relacionado" value="<?= $_COOKIE['logprot_id_usuario'] ?>" />
            <input type="submit" value="CADASTRAR" name="cadastrausuario" class="btn btn-primary" />
        </div>
    </form>


</main>