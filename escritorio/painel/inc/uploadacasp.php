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





    <?php
    $captura = new Read();
    $captura->ExeRead("prevendaacasp", "WHERE id_venda = :p", "p={$_GET['id_venda']}");
    $captura->getResult();
    ?>

    <h1>DOCUMENTAÇÃO CÓDIGO <?= $captura->getResult()[0]['contrato']; ?> </h1>
    </BR>

    <label class="setenta"> 
        <p class="background"> Cliente </p>
        <p> <?= $captura->getResult()[0]['associado']; ?> </p>
    </label>
    <label class="quinze"> 
        <p class="background"> CPF </p>
        <p> <?= $captura->getResult()[0]['cpf']; ?> </p>
    </label>
    <label class="quinze"> 
        <p class="background"> RG </p>
        <p> <?= $captura->getResult()[0]['rg']; ?> </p>
    </label>
    <div class="clear"> </div>

    <label class="vinte"> 
        <p class="background"> MARCA </p>
        <p> <?= $captura->getResult()[0]['marca_modelo1']; ?> </p>
    </label>
    <label class="vinte"> 
        <p class="background"> MODELO </p>
        <p> <?= $captura->getResult()[0]['marca_modelo1']; ?> </p>
    </label>
    <label class="vinte"> 
        <p class="background"> PLACA </p>
        <p> <?= $captura->getResult()[0]['placa1']; ?> </p>
    </label>
    <label class="vinte"> 
        <p class="background"> COR </p>
        <p> <?= $captura->getResult()[0]['cor1']; ?> </p>
    </label>
    <label class="vinte"> 
        <p class="background"> ANO </p>
        <p> <?= $captura->getResult()[0]['ano1']; ?> </p>
    </label>
    <div class="clear">  </div>

    <label class="setenta"> 
        <p class="background"> PLANO </p>
        <p> Associado  </p>
    </label>
    <label class="trinta"> 
        <p class="background"> VALOR </p>
        <p>R$  <?= $captura->getResult()[0]['mesacasp']; ?> </p>
    </label>

    <div class="clear">  </div>

    <hr>

    <h1>UPLOADS DE DOCUMENTOS </h1>
    </BR>

    <?php
    $form = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    if ($form && $form['sendImage']):

        $upload = new UploadArquivo('../documentos/');
        $imagem = $_FILES['imagem'];
        //var_dump($imagem);

        $upload->Image($imagem);
        if (!$upload->getResult()):
            WSErro("Erro ao enviar imagem:<br><small> {$upload->getError()} </small>", WS_ERROR);
        else:
            WSErro("Arquivo enviado com sucesso:<br><smal> {$upload->getResult()}</smal>", WS_ACCEPT);
            //$ficheiro = $upload->getResult();

            $Dados = [
                "doc" => $upload->getResult(),
                "data" => date("Y-m-d"),
                "placa" => $captura->getResult()[0]['placa1'],
                "categoria" => $_POST['categoria'],
                "id_venda" => $_GET['id_venda'],
                "ref" => "associacao"
            ];

            print_r($Dados);

            $cadastra = new Create();
            $cadastra->exeCreate("documentos", $Dados);
            $cadastra->getResult();

            if ($cadastra->getResult()):
                echo "<p class=\"verde\">Upload realizado com sucesso</p>";
            endif;

        endif;

        echo "<hr>";



// var_dump($upload);



    endif;
    ?>

    <form name="fileForm" action="" class="form" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <input type="file" name="imagem" class="form-control"/>
        </div>
        
        <div class="form-group">
            <p>SELECIONE A CATEGORIA </p>
            <select class="form-control" name="categoria"> 
                <option value="documentos">documentos </option>
                <option value="contratos">contratos </option>
                <option value="vistorias">foto - vistoria </option>
                <option value="revistorias">foto revistoria </option>
                    
            </select>
            
        </div>

        <input type="submit" name="sendImage" value="enviar arquivo!" class="btn btn-primary"/>
        <input type="hidden" name="placa" value="<?= $captura->getResult()[0]['placa1']; ?>" />
        <input type="hidden" name="id_venda" value="<?= $captura->getResult()[0]['id_venda']; ?>" />
        <input type="hidden" name="ref" value="protege" />
    </form>

    <hr>

    <h2> Arquivos enviados </h2>
    
    
<!--    <section class="col-md-12"> 
        
        <div class="thumbnail col-md-3"> <span class="glyphicon glyphicon-folder-open" style="font-size:45px; color: blue;"><a href="index.php?p=upload&id_venda=<?= $_GET['placa'] ?>&categoria=documentos"> Documentos </a></span></div>
        <div class="thumbnail col-md-3"> <span class="glyphicon glyphicon-folder-open" style="font-size:45px; color: blue;"><a href="index.php?p=upload&placa=<?= $_GET['placa'] ?>&categoria=contratos"> Contratos </a></span></div>
        <div class="thumbnail col-md-3"> <span class="glyphicon glyphicon-folder-open" style="font-size:45px; color: blue;"><a href="index.php?p=upload&placa=<?= $_GET['placa'] ?>&categoria=vitorias"> Vistorias </a> </span></div>
        <div class="thumbnail col-md-3"> <span class="glyphicon glyphicon-folder-open" style="font-size:45px; color: blue;"><a href="index.php?p=upload&placa=<?= $_GET['placa'] ?>&categoria=revistorias"> Re Vistorias</span></div>
    
    </section>-->
    
    

<?php
if (empty($_GET['acao'])):

else:


    if ($_GET['acao'] == "del"):
        echo "<a href=\"index.php?p=upload&id_venda={$_GET['id_venda']}&acao=del&arquivo={$_GET['arquivo']}&die=yes\" class=\"vermelho\"> Confirmar exclusão </a>";
    endif;

    if ($_GET['acao'] == "del" && $_GET['die'] == "yes"):

        $deleta = new Delete();
        $deleta->ExeDelete("documentos", "WHERE doc = :p", "p={$_GET['arquivo']}");
        $deleta->getResult();

        if ($deleta->getResult()):

            unlink("../documentos/{$_GET['arquivo']}");

            echo "<span class=\"vermelho\"> Arquivo deletado com sucesso do servidor </span>";

        endif;

    else:

        echo "nada ";


    endif;

endif;
?>

    <?php
    $enviados = new Read();
    $enviados->ExeRead("documentos", "WHERE id_venda = :p AND ref = :r", "p={$_GET['id_venda']}&r={$_GET['ref']}");
    $enviados->getResult();

    if($enviados->getResult()):

    foreach ($enviados->getResult() as $value) {

        $trata = $value['doc'];

        $array = explode('.', $trata);

        ////print_r($array[1]);

        if ($array[1] == "pdf"):
            $img = "pdf.png";
        else:

            $img = $value['doc'];

        endif;

        echo "<div class=\"imgup\"> <img src=\"../documentos/{$img}\" width=\"100%\" style=\"float: left; margin-left:5px;\" />"
        . "  <div class=\"botimgupview \"> <a href=\"../documentos/{$value['doc']}\" target=\"_blank\" class=\"branquinho\"> Visualizar </a> </div>  "
        . "<div class=\"botimgupdel\"> <a href=\"index.php?p=upload&id_venda={$_GET['id_venda']}&acao=del&arquivo={$value['doc']}\" class=\"branquinho\"> Deletar </a> </div></div>";
    }
    
    else:
        
        echo "<div class=\"alert alert-danger\" role=\"alert\">Nenhum arquivo encontrado nessa categoria</div>";
    
    endif;
    ?>



    <div class="clear"> . </div>



</main>

