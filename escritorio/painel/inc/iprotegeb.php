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


<!--
<script type='text/javascript' src='js/jquery.js'></script>


<script language="JavaScript" type="text/javascript" src="js/mascara-validacao.js" ></script>-->
<main class="content"> 
    
    <div class="page-header">
      <h3>DOCUMENTAÇÃO </h3>  
        
    </div>
    
<!--     <img src="img/ivenda2.png" width="auto" />-->

    <?php
    $captura = new Read();
    $captura->ExeRead("prevenda", "WHERE placa = :p", "p={$_GET['placa']}");
    $captura->getResult();
    ?>
    </BR>

    <label class="col-md-8"> 
        <p class="background"> Cliente </p>
        <p> <?= $captura->getResult()[0]['cliente']; ?> </p>
    </label>
    <label class="col-md-2"> 
        <p class="background"> CPF </p>
        <p> <?= $captura->getResult()[0]['cpf']; ?> </p>
    </label>
    <label class="col-md-2"> 
        <p class="background"> RG </p>
        <p> <?= $captura->getResult()[0]['rg']; ?> </p>
    </label>
   

    <label class="col-md-3"> 
        <p class="background"> MARCA </p>
        <p> <?= $captura->getResult()[0]['marca']; ?> </p>
    </label>
    <label class="col-md-2"> 
        <p class="background"> MODELO </p>
        <p> <?= $captura->getResult()[0]['modelo']; ?> </p>
    </label>
    <label class="col-md-2"> 
        <p class="background"> PLACA </p>
        <p> <?= $captura->getResult()[0]['placa']; ?> </p>
    </label>
    <label class="col-md-2"> 
        <p class="background"> COR </p>
        <p> <?= $captura->getResult()[0]['cor']; ?> </p>
    </label>
    <label class="col-md-2"> 
        <p class="background"> ANO </p>
        <p> <?= $captura->getResult()[0]['ano']; ?> </p>
    </label>
    <div class="clear">  </div>
    
    <label class="col-md-10"> 
        <p class="background"> PLANO </p>
        <p> <?= $captura->getResult()[0]['tipo_plano']; ?> >> <?= $captura->getResult()[0]['plano_desc']; ?> </p>
    </label>
    <label class="col-md-2"> 
        <p class="background"> VALOR </p>
        <p>R$  <?= $captura->getResult()[0]['plano']; ?> </p>
    </label>
    
   

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
            "placa" => $captura->getResult()[0]['placa'],
            "id_venda" => $captura->getResult()[0]['id_venda'],
            "ref" => "protege"
        ];
        
        print_r($Dados);
        
        $cadastra = new Create();
        $cadastra->exeCreate("documentos", $Dados);
        $cadastra->getResult();
        
        if($cadastra->getResult()):
            echo "<meta http-equiv=\"refresh\" content=0;url=\"index.php?p=iprotegeb&placa={$_GET['placa']}\">";
        endif;

    endif;

    echo "<hr>";



// var_dump($upload);



endif;
?>

    <form name="fileForm" action="" method="post" enctype="multipart/form-data">
        <label>
            <input type="file" name="imagem"/>
        </label>

        <input type="submit" name="sendImage" class="btn btn-primary" value="enviar arquivo!" class="botao"/>
        <input type="hidden" name="placa" value="<?= $captura->getResult()[0]['placa']; ?>" />
        <input type="hidden" name="id_venda" value="<?= $captura->getResult()[0]['id_venda']; ?>" />
        <input type="hidden" name="ref" value="protege" />
    </form>

    <hr>

    <h2> Arquivos enviados </h2>

<?php
$enviados = new Read();
$enviados->ExeRead("documentos", "WHERE placa = :p", "p={$_GET['placa']}");
$enviados->getResult();

foreach ($enviados->getResult() as $value) {

    echo "<a href=\"../documentos/{$value['doc']}\" target=\"blank\"> <img src=\"../documentos/{$value['doc']}\" width=\"200\" class=\"col-md-2 thumbnail\" /></a>";
}
?>
    <br>
    <div class="col-md-12"> <br> </div>
    <div class="row">  
    <button class="btn btn-primary"> <a href="index.php?p=eprotege" >FINALIZAR VENDA</a>  </button>
    </div>
    
    

</main>