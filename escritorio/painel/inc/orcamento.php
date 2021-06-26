<?php 
 ?>
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
    
if(isset($form['cadastra'])):
        
    
    
    $marca = explode("|", $form['marca1']);
    $modelo = explode("|" , $form['modelo1']);
    $ano = explode("|" , $form['ano1']);

    $Dados = [
        "nome" => $form['nome'],
        "whatsapp" => $form['whatsapp'],
        "veiculo" => $form['veiculo'],
        "marca" => $marca[0],
        "modelo" => $modelo[3],
        "ano" => $ano[4],
        "fipe" => $form['fipe'],
        "valor" => $form['valor'],
        "vendedor" => $_COOKIE['logprot_id_usuario'],
        "data" => $form['data']
    ];
    
    $cad = new Create();
    $cad->ExeCreate("propostacarwhats", $Dados);
    $cad->getResult();
    
    if($cad->getResult()):
        echo "<div class='clear'> </div><div class='alert alert-success'> Orçamento cadastrado com sucesso </div>";
        else:
        echo "<div class='alert alert-danger'> ERRO ao cadastrar orçamento </div>";
    endif;
    
    endif;

//var_dump($Dados);

    
    ?>
    
        <form id="form" name="form" method="post" action="">

    

    
   

        <div class="page-header">
            <h3> ORÇAMENTO </h3> 

        </div>
           <div class="form-group col-md-6">
             <label >NOME: </label> 
             <input type="text" class="form-control" name="nome" />
           </div>
           <div class="form-group col-md-6">
             <label >whatsapp: </label> 
             <input type="text" class="form-control" name="whatsapp" value="5511" />
           </div>
            

          <div class="form-group col-md-2">
            <label >VEICULO: </label>
            <select name="veiculo" class="form-control"> 
                <option> Selecione o veiculo</option>
                <option value="motos"> Moto</option>
                <option value="carros"> Carros</option>
<!--                <option value="caminhoes"> Caminhão</option>-->

            </select>
        </div>

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
            <select  name="valor" id="valor" class="form-control" > </select>

        </div>


       
       
        
<div class="form-group col-md-12">
        <label>
            <input type="hidden" name="ip" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>" />
            

            <input type="hidden" name="status" value="1" />
            <input type="hidden" name="cadastra" value="cadastra" />
            
            <input type="hidden" name="data" value="<?php echo date("Y-m-d H:i:s"); ?>" />
            <input type="submit"  id="button" value="ORÇAMENTO" class="btn btn-primary"  />
           <input type="hidden" name="vendedor" id="vendedor" value="<?php echo $_SESSION['id_usuario']; ?>" />
<!--            <botoon type="submit" name="button" id="button" class="btn btn-primary"> SEGUIR </botoon>-->
        </label>
</div>
        
    </form>
    
    
    <?php 
    
    if(isset($form['marca1'])):
        
   
    
    ?>
    
   <div class="col-md-12"> 
       
       <div class="row">
       <div class="col-md-1">
       <p><b>Veiculo</b>: <?= $form['veiculo'] ?> </p>
       </div>
       <div class="col-md-2">    
       <p><b>Marca</b>: <?php $marca = $form['marca1'];
       $newmarca = explode("|", $marca);
       echo $newmarca['0'];
       ?> </p>
       </div>
       <div class="col-md-2">    
       <p><b>Modelo</b>: <?php $modelo = $form['modelo1'];
       $newmodelo = explode("|", $modelo);
       echo $newmodelo['3'];
       ?> </p>
       </div>
           <div class="col-md-2">
       <p><b>Ano</b>: <?php $ano = $form['ano1'];
       $newano = explode("|", $ano);
       echo $newano['4'];
       ?> </p>
           </div>
           <div class="col-md-2">
       <p><b>Valor</b>: <?= $valor = $form['valor'];
       
       ?> </p>
       <div class="col-md-1"> 
           <p><b>FIPE </b><?= $_POST['fipe']?> </p>
       </div>
           </div>
       </div>
      <?php 
       function soNumero($str) {
    return preg_replace("/[^0-9]/", "", $str);
}

   $filtrovalor = soNumero($form['valor']);
       ?> 
       
       
       
       
       <?php 
       if($form['veiculo'] == "carros"):

       ?>
           
       
       <?php 
       //menor que R$40.000,00
       if( $filtrovalor < 3999999) :
       ?>
       
       <div class="col-md-3"> 
           <div class="page-header"> Monitoramento </div>
           <ul> 
               <li> Localização via internet ou APP</li>
               <li> Central de monitoramento 24hs</li>
               <li> Anti furto virtual</li>
           </ul>
           <div class="alert alert-info" role="alert">R$299,00 (Adesão) </br> em até 3 vezes no cartão</div>
           <div class="alert alert-success" role="alert">R$65,00 (boleto mensal) Passeio</div>
           <div class="alert alert-success" role="alert">R$65,00 (boleto mensal) SUV / Utilitário</div>
       </div>
       
       <div class="col-md-3"> 
           <div class="page-header"> Monitoramento + Roubo </div>
           <ul> 
               <li> Localização via internet ou APP</li>
               <li> Central de monitoramento 24hs</li>
               <li> Anti furto virtual</li>
               <li> Indenização 100% FIPE (roubo)</li>
           </ul>
           <div class="alert alert-info" role="alert">R$299,00 (Adesão) </br> em até 3 vezes no cartão</div>
           <div class="alert alert-success" role="alert">R$94,96 (boleto mensal) Passeio</div>
           <div class="alert alert-success" role="alert">R$105,19 (boleto mensal) SUV / Utilitário</div>
       </div>
       
       <div class="col-md-3"> 
           <div class="page-header"> Monitoramento +  Roubo + Assist 24 hs </div>
           <ul> 
               <li> Localização via internet ou APP</li>
               <li> Central de monitoramento 24hs</li>
               <li> Anti furto virtual</li>
               <li> Indenização 100% FIPE (roubo)</li>
               <li> Assistência 24hs guincho </li>
           </ul>
<!--           <div class="alert alert-info" role="alert">R$299,00 (Adesão) </br> em até 3 vezes no cartão</div>-->
           <div class="alert alert-success" role="alert">R$109,59 (boleto mensal) Passeio</div>
           <div class="alert alert-success" role="alert">R$137,19 (boleto mensal) SUV / Utilitário</div>
       </div>
       
       <div class="col-md-3"> 
           <div class="page-header"> Monitoramento +  Roubo + Assist 24 hs + Colisão </div>
           <ul> 
               <li> Localização via internet ou APP</li>
               <li> Central de monitoramento 24hs</li>
               <li> Anti furto virtual</li>
               <li> Indenização 100% FIPE (roubo)</li>
               <li> Assistência 24hs guincho </li>
               <li> Cobertura acidentes  </li>
           </ul>
<!--           <div class="alert alert-info" role="alert">R$299,00 (Adesão) </br> em até 3 vezes no cartão</div>-->
           <div class="alert alert-success" role="alert">R$144,00 (boleto mensal) Passseio</div>
           <div class="alert alert-success" role="alert">R$173,09 (boleto mensal) SUV / Utilitário</div>
       </div>
       
       <?php 
       $propostazap = "*Cliente* {$_POST['nome']}%0D
*Veículo* {$newmodelo['3']}%0D
*FIPE* {$_POST['fipe']}%0D
*Valor* {$_POST['valor']}%0D
*MONITORAMENTO* %0D
_>>Localização via internet ou APP_%0D
_>>Central de monitoramento 24hs_%0D
_>>Anti furto virtual_%0D         
```R$299,00 (Adesão) em até 3 vezes no cartão```%0D
```R$75,00 (boleto mensal) Passeio```%0D
```R$75,00 (boleto mensal) SUV / Utilitário```%0D       
*MONITORAMENTO / ROUBO*%0D        
_>>Localização via internet ou APP_%0D
_>>Central de monitoramento 24hs_%0D
_>>Anti furto virtual_%0D
_>>Indenização 100% FIPE (roubo)_%0D         
```R$299,00 (Adesão)  em até 3 vezes no cartão```%0D
```R$94,96 (boleto mensal) Passeio``` %0D
```R$105,19 (boleto mensal) SUV / Utilitário``` %0D     
*MONITORAMENTO /  ROUBO / ASSIST 24 HS* %0D          
_>>Localização via internet ou APP_%0D
_>>Central de monitoramento 24hs_%0D
_>>Anti furto virtual_%0D
_>>Indenização 100% FIPE (roubo)_%0D
_>>Assistência 24hs guincho _%0D          
```R$299,00 (Adesão)  em até 3 vezes no cartão```%0D
```R$109,59 (boleto mensal) Passeio```%0D
```R$137,19 (boleto mensal) SUV / Utilitário```%0D     
*MONITORAMENTO /  ROUBO / ASSIST 24 HS / COLISÃO* %0D         
_>>Localização via internet ou APP_%0D
_>>Central de monitoramento 24hs_%0D
_>>Anti furto virtual_%0D
_>>Indenização 100% FIPE (roubo)_%0D
_>>Assistência 24hs guincho _%0D
_>>Cobertura acidentes _ %0D   %0D        
```R$299,00 (Adesão)  em até 3 vezes no cartão```%0D
```R$144,00 (boleto mensal) Passseio```%0D
```R$173,09 (boleto mensal) SUV / Utilitário``` %0D"
. "www.rastreadoresprotege.com.br %0D"
. "https://youtu.be/cpwG0xhKw3g"


; ?>
       
       <a href="https://api.whatsapp.com/send?phone=<?= $_POST['whatsapp'] ?>&text=<?=$propostazap ?>" target="_blank"> <bottom class="btn btn-success"> ENVIAR VIA WHATSAPP CELULAR </bottom> </a>
       
       <hr>
       <a href="https://web.whatsapp.com/send?phone=<?= $_POST['whatsapp'] ?>&text=<?=$propostazap ?>" target="_blank"> <bottom class="btn btn-primary"> ENVIAR VIA WHATSAPP WEB </bottom> </a>
        <hr> <hr>
       <?php endif; ?>
       
       
       <?php 
       // r$40.000,00 A r$50.000,00
       if( $filtrovalor >= 3999999 and $filtrovalor <= 4999999 ) :
       ?>
       
        <div class="col-md-3"> 
           <div class="page-header"> Monitoramento </div>
           <ul> 
               <li> Localização via internet ou APP</li>
               <li> Central de monitoramento 24hs</li>
               <li> Anti furto virtual</li>
           </ul>
           <div class="alert alert-info" role="alert">R$299,00 (Adesão) </br> em até 3 vezes no cartão</div>
           <div class="alert alert-success" role="alert">R$65,00 (boleto mensal) Passeio</div>
           <div class="alert alert-success" role="alert">R$65,00 (boleto mensal) SUV / Utilitário</div>
       </div>
       
       <div class="col-md-3"> 
           <div class="page-header"> Monitoramento + Roubo </div>
           <ul> 
               <li> Localização via internet ou APP</li>
               <li> Central de monitoramento 24hs</li>
               <li> Anti furto virtual</li>
               <li> Indenização 100% FIPE (roubo)</li>
           </ul>
           <div class="alert alert-info" role="alert">R$299,00 (Adesão) </br> em até 3 vezes no cartão</div>
           <div class="alert alert-success" role="alert">R$111,45 (boleto mensal) Passeio</div>
           <div class="alert alert-success" role="alert">R$121,94 (boleto mensal) SUV / Utilitário</div>
       </div>
       
       <div class="col-md-3"> 
           <div class="page-header"> Monitoramento +  Roubo + Assist 24 hs </div>
           <ul> 
               <li> Localização via internet ou APP</li>
               <li> Central de monitoramento 24hs</li>
               <li> Anti furto virtual</li>
               <li> Indenização 100% FIPE (roubo)</li>
               <li> Assistência 24hs guincho </li>
           </ul>
<!--           <div class="alert alert-info" role="alert">R$299,00 (Adesão) </br> em até 3 vezes no cartão</div>-->
           <div class="alert alert-success" role="alert">R$126,90 (boleto mensal) Passeio</div>
           <div class="alert alert-success" role="alert">R$178,84 (boleto mensal) SUV / Utilitário</div>
       </div>
       
       <div class="col-md-3"> 
           <div class="page-header"> Monitoramento +  Roubo + Assist 24 hs + Colisão </div>
           <ul> 
               <li> Localização via internet ou APP</li>
               <li> Central de monitoramento 24hs</li>
               <li> Anti furto virtual</li>
               <li> Indenização 100% FIPE (roubo)</li>
               <li> Assistência 24hs guincho </li>
               <li> Cobertura acidentes  </li>
           </ul>
<!--           <div class="alert alert-info" role="alert">R$299,00 (Adesão) </br> em até 3 vezes no cartão</div>-->
           <div class="alert alert-success" role="alert">R$181,35 (boleto mensal) Passseio</div>
           <div class="alert alert-success" role="alert">R$209,84 (boleto mensal) SUV / Utilitário</div>
       </div>
       
       <?php 
       $propostazap = "*Cliente* {$_POST['nome']}%0D
*Veículo* {$newmodelo['3']}%0D
*FIPE* {$_POST['fipe']}%0D
*Valor* {$_POST['valor']}%0D
*MONITORAMENTO* %0D
_>>Localização via internet ou APP_%0D
_>>Central de monitoramento 24hs_%0D
_>>Anti furto virtual_%0D         
```R$299,00 (Adesão) em até 3 vezes no cartão```%0D
```R$65,00 (boleto mensal) Passeio```%0D
```R$65,00 (boleto mensal) SUV / Utilitário```%0D       
*MONITORAMENTO / ROUBO*%0D        
_>>Localização via internet ou APP_%0D
_>>Central de monitoramento 24hs_%0D
_>>Anti furto virtual_%0D
_>>Indenização 100% FIPE (roubo)_%0D         
```R$299,00 (Adesão)  em até 3 vezes no cartão```%0D
```R$111,45 (boleto mensal) Passeio``` %0D
```R$121,94 (boleto mensal) SUV / Utilitário``` %0D     
*MONITORAMENTO /  ROUBO / ASSIST 24 HS* %0D          
_>>Localização via internet ou APP_%0D
_>>Central de monitoramento 24hs_%0D
_>>Anti furto virtual_%0D
_>>Indenização 100% FIPE (roubo)_%0D
_>>Assistência 24hs guincho _%0D          
```R$299,00 (Adesão)  em até 3 vezes no cartão```%0D
```R$126,90 (boleto mensal) Passeio```%0D
```R$178,84 (boleto mensal) SUV / Utilitário```%0D     
*MONITORAMENTO /  ROUBO / ASSIST 24 HS / COLISÃO* %0D         
_>>Localização via internet ou APP_%0D
_>>Central de monitoramento 24hs_%0D
_>>Anti furto virtual_%0D
_>>Indenização 100% FIPE (roubo)_%0D
_>>Assistência 24hs guincho _%0D
_>>Cobertura acidentes _ %0D   %0D        
```R$299,00 (Adesão)  em até 3 vezes no cartão```%0D
```R$181,35 (boleto mensal) Passseio```%0D
```R$209,84 (boleto mensal) SUV / Utilitário``` %0D"
. "www.rastreadoresprotege.com.br %0D"
. "https://youtu.be/cpwG0xhKw3g"


; ?>
       
       <a href="https://api.whatsapp.com/send?phone=<?= $_POST['whatsapp'] ?>&text=<?=$propostazap ?>" target="_blank"> <bottom class="btn btn-success"> ENVIAR VIA WHATSAPP CELULAR </bottom> </a>
       
       <hr>
       <a href="https://web.whatsapp.com/send?phone=<?= $_POST['whatsapp'] ?>&text=<?=$propostazap ?>" target="_blank"> <bottom class="btn btn-primary"> ENVIAR VIA WHATSAPP WEB </bottom> </a>
        <hr> <hr>
       
       <?php endif; ?>
       
       
       <?php 
       //r$50.000,00 a R$70.000,00
       if( $filtrovalor >= 4999999 and $filtrovalor <= 6999999 ) :
       ?>
       
       <div class="col-md-3"> 
           <div class="page-header"> Monitoramento </div>
           <ul> 
               <li> Localização via internet ou APP</li>
               <li> Central de monitoramento 24hs</li>
               <li> Anti furto virtual</li>
           </ul>
           <div class="alert alert-info" role="alert">R$299,00 (Adesão) </br> em até 3 vezes no cartão</div>
           <div class="alert alert-success" role="alert">R$65,00 (boleto mensal) Passeio</div>
           <div class="alert alert-success" role="alert">R$65,00 (boleto mensal) SUV / Utilitário</div>
       </div>
       
       <div class="col-md-3"> 
           <div class="page-header"> Monitoramento + Roubo </div>
           <ul> 
               <li> Localização via internet ou APP</li>
               <li> Central de monitoramento 24hs</li>
               <li> Anti furto virtual</li>
               <li> Indenização 100% FIPE (roubo)</li>
           </ul>
           <div class="alert alert-info" role="alert">R$299,00 (Adesão) </br> em até 3 vezes no cartão</div>
           <div class="alert alert-success" role="alert">R$137,85 (boleto mensal) Passeio</div>
           <div class="alert alert-success" role="alert">R$148,44 (boleto mensal) SUV / Utilitário</div>
       </div>
       
       <div class="col-md-3"> 
           <div class="page-header"> Monitoramento +  Roubo + Assist 24 hs </div>
           <ul> 
               <li> Localização via internet ou APP</li>
               <li> Central de monitoramento 24hs</li>
               <li> Anti furto virtual</li>
               <li> Indenização 100% FIPE (roubo)</li>
               <li> Assistência 24hs guincho </li>
           </ul>
<!--           <div class="alert alert-info" role="alert">R$299,00 (Adesão) </br> em até 3 vezes no cartão</div>-->
           <div class="alert alert-success" role="alert">R$152,85 (boleto mensal) Passeio</div>
           <div class="alert alert-success" role="alert">R$181,34 (boleto mensal) SUV / Utilitário</div>
       </div>
       
       <div class="col-md-3"> 
           <div class="page-header"> Monitoramento +  Roubo + Assist 24 hs + Colisão </div>
           <ul> 
               <li> Localização via internet ou APP</li>
               <li> Central de monitoramento 24hs</li>
               <li> Anti furto virtual</li>
               <li> Indenização 100% FIPE (roubo)</li>
               <li> Assistência 24hs guincho </li>
               <li> Cobertura acidentes  </li>
           </ul>
<!--           <div class="alert alert-info" role="alert">R$299,00 (Adesão) </br> em até 3 vezes no cartão</div>-->
           <div class="alert alert-success" role="alert">R$212,85 (boleto mensal) Passseio</div>
           <div class="alert alert-success" role="alert">R$241,34 (boleto mensal) SUV / Utilitário</div>
       </div>
       
       <?php 
       $propostazap = "*Cliente* {$_POST['nome']}%0D
*Veículo* {$newmodelo['3']}%0D
*FIPE* {$_POST['fipe']}%0D
*Valor* {$_POST['valor']}%0D
*MONITORAMENTO* %0D
_>>Localização via internet ou APP_%0D
_>>Central de monitoramento 24hs_%0D
_>>Anti furto virtual_%0D         
```R$299,00 (Adesão) em até 3 vezes no cartão```%0D
```R$65,00 (boleto mensal) Passeio```%0D
```R$65,00 (boleto mensal) SUV / Utilitário```%0D       
*MONITORAMENTO / ROUBO*%0D        
_>>Localização via internet ou APP_%0D
_>>Central de monitoramento 24hs_%0D
_>>Anti furto virtual_%0D
_>>Indenização 100% FIPE (roubo)_%0D         
```R$299,00 (Adesão)  em até 3 vezes no cartão```%0D
```R$137,85 (boleto mensal) Passeio``` %0D
```R$148,44 (boleto mensal) SUV / Utilitário``` %0D     
*MONITORAMENTO /  ROUBO / ASSIST 24 HS* %0D          
_>>Localização via internet ou APP_%0D
_>>Central de monitoramento 24hs_%0D
_>>Anti furto virtual_%0D
_>>Indenização 100% FIPE (roubo)_%0D
_>>Assistência 24hs guincho _%0D          
```R$299,00 (Adesão)  em até 3 vezes no cartão```%0D
```R$152,85 (boleto mensal) Passeio```%0D
```R$181,34 (boleto mensal) SUV / Utilitário```%0D     
*MONITORAMENTO /  ROUBO / ASSIST 24 HS / COLISÃO* %0D         
_>>Localização via internet ou APP_%0D
_>>Central de monitoramento 24hs_%0D
_>>Anti furto virtual_%0D
_>>Indenização 100% FIPE (roubo)_%0D
_>>Assistência 24hs guincho _%0D
_>>Cobertura acidentes _ %0D   %0D        
```R$299,00 (Adesão)  em até 3 vezes no cartão```%0D
```R$212,85 (boleto mensal) Passseio```%0D
```R$241,34 (boleto mensal) SUV / Utilitário``` %0D"
. "www.rastreadoresprotege.com.br %0D"
. "https://youtu.be/cpwG0xhKw3g"


; ?>
       
       <a href="https://api.whatsapp.com/send?phone=<?= $_POST['whatsapp'] ?>&text=<?=$propostazap ?>" target="_blank"> <bottom class="btn btn-success"> ENVIAR VIA WHATSAPP CELULAR </bottom> </a>
       
       <hr>
       <a href="https://web.whatsapp.com/send?phone=<?= $_POST['whatsapp'] ?>&text=<?=$propostazap ?>" target="_blank"> <bottom class="btn btn-primary"> ENVIAR VIA WHATSAPP WEB </bottom> </a>
        <hr> <hr>
       
       <?php endif; ?>
       
       
       <?php 
       //R$70.000,00 a R$90.000,00
       if( $filtrovalor >= 6999999 and $filtrovalor <= 8999999 ) :
       ?>
       
       <div class="col-md-3"> 
           <div class="page-header"> Monitoramento </div>
           <ul> 
               <li> Localização via internet ou APP</li>
               <li> Central de monitoramento 24hs</li>
               <li> Anti furto virtual</li>
           </ul>
           <div class="alert alert-info" role="alert">R$299,00 (Adesão) </br> em até 3 vezes no cartão</div>
           <div class="alert alert-success" role="alert">R$65,00 (boleto mensal) Passeio</div>
           <div class="alert alert-success" role="alert">R$65,00 (boleto mensal) SUV / Utilitário</div>
       </div>
       
       <div class="col-md-3"> 
           <div class="page-header"> Monitoramento + Roubo </div>
           <ul> 
               <li> Localização via internet ou APP</li>
               <li> Central de monitoramento 24hs</li>
               <li> Anti furto virtual</li>
               <li> Indenização 100% FIPE (roubo)</li>
           </ul>
           <div class="alert alert-info" role="alert">R$299,00 (Adesão) </br> em até 3 vezes no cartão</div>
           <div class="alert alert-success" role="alert">R$144,24 (boleto mensal) Passeio</div>
           <div class="alert alert-success" role="alert">R$154,74 (boleto mensal) SUV / Utilitário</div>
       </div>
       
       <div class="col-md-3"> 
           <div class="page-header"> Monitoramento +  Roubo + Assist 24 hs </div>
           <ul> 
               <li> Localização via internet ou APP</li>
               <li> Central de monitoramento 24hs</li>
               <li> Anti furto virtual</li>
               <li> Indenização 100% FIPE (roubo)</li>
               <li> Assistência 24hs guincho </li>
           </ul>
<!--           <div class="alert alert-info" role="alert">R$299,00 (Adesão) </br> em até 3 vezes no cartão</div>-->
           <div class="alert alert-success" role="alert">R$159,14 (boleto mensal) Passeio</div>
           <div class="alert alert-success" role="alert">R$197,64 (boleto mensal) SUV / Utilitário</div>
       </div>
       
       <div class="col-md-3"> 
           <div class="page-header"> Monitoramento +  Roubo + Assist 24 hs + Colisão </div>
           <ul> 
               <li> Localização via internet ou APP</li>
               <li> Central de monitoramento 24hs</li>
               <li> Anti furto virtual</li>
               <li> Indenização 100% FIPE (roubo)</li>
               <li> Assistência 24hs guincho </li>
               <li> Cobertura acidentes  </li>
           </ul>
<!--           <div class="alert alert-info" role="alert">R$299,00 (Adesão) </br> em até 3 vezes no cartão</div>-->
           <div class="alert alert-success" role="alert">R$219,14 (boleto mensal) Passseio</div>
           <div class="alert alert-success" role="alert">R$247,64 (boleto mensal) SUV / Utilitário</div>
       </div>
       
       <?php 
       $propostazap = "*Cliente* {$_POST['nome']}%0D
*Veículo* {$newmodelo['3']}%0D
*FIPE* {$_POST['fipe']}%0D
*Valor* {$_POST['valor']}%0D
*MONITORAMENTO* %0D
_>>Localização via internet ou APP_%0D
_>>Central de monitoramento 24hs_%0D
_>>Anti furto virtual_%0D         
```R$299,00 (Adesão) em até 3 vezes no cartão```%0D
```R$65,00 (boleto mensal) Passeio```%0D
```R$65,00 (boleto mensal) SUV / Utilitário```%0D       
*MONITORAMENTO / ROUBO*%0D        
_>>Localização via internet ou APP_%0D
_>>Central de monitoramento 24hs_%0D
_>>Anti furto virtual_%0D
_>>Indenização 100% FIPE (roubo)_%0D         
```R$299,00 (Adesão)  em até 3 vezes no cartão```%0D
```R$144,24 (boleto mensal) Passeio``` %0D
```R$154,74 (boleto mensal) SUV / Utilitário``` %0D     
*MONITORAMENTO /  ROUBO / ASSIST 24 HS* %0D          
_>>Localização via internet ou APP_%0D
_>>Central de monitoramento 24hs_%0D
_>>Anti furto virtual_%0D
_>>Indenização 100% FIPE (roubo)_%0D
_>>Assistência 24hs guincho _%0D          
```R$299,00 (Adesão)  em até 3 vezes no cartão```%0D
```R$159,14 (boleto mensal) Passeio```%0D
```R$197,64 (boleto mensal) SUV / Utilitário```%0D     
*MONITORAMENTO /  ROUBO / ASSIST 24 HS / COLISÃO* %0D         
_>>Localização via internet ou APP_%0D
_>>Central de monitoramento 24hs_%0D
_>>Anti furto virtual_%0D
_>>Indenização 100% FIPE (roubo)_%0D
_>>Assistência 24hs guincho _%0D
_>>Cobertura acidentes _ %0D   %0D        
```R$299,00 (Adesão)  em até 3 vezes no cartão```%0D
```R$219,14 (boleto mensal) Passseio```%0D
```R$247,64 (boleto mensal) SUV / Utilitário``` %0D"
. "www.rastreadoresprotege.com.br %0D"
. "https://youtu.be/cpwG0xhKw3g"


; ?>
       
       <a href="https://api.whatsapp.com/send?phone=<?= $_POST['whatsapp'] ?>&text=<?=$propostazap ?>" target="_blank"> <bottom class="btn btn-success"> ENVIAR VIA WHATSAPP CELULAR </bottom> </a>
       
       <hr>
       <a href="https://web.whatsapp.com/send?phone=<?= $_POST['whatsapp'] ?>&text=<?=$propostazap ?>" target="_blank"> <bottom class="btn btn-primary"> ENVIAR VIA WHATSAPP WEB </bottom> </a>
        <hr> <hr>
       
       <?php endif; ?>
       
       
       <?php 
       //R$90.000,00 a R$120.000,00
       if( $filtrovalor >= 8999999 and $filtrovalor <= 11999999 ) :
       ?>
       
       <div class="col-md-3"> 
           <div class="page-header"> Monitoramento </div>
           <ul> 
               <li> Localização via internet ou APP</li>
               <li> Central de monitoramento 24hs</li>
               <li> Anti furto virtual</li>
           </ul>
           <div class="alert alert-info" role="alert">R$299,00 (Adesão) </br> em até 3 vezes no cartão</div>
           <div class="alert alert-success" role="alert">R$65,00 (boleto mensal) Passeio</div>
           <div class="alert alert-success" role="alert">R$65,00 (boleto mensal) SUV / Utilitário</div>
       </div>
       
       <div class="col-md-3"> 
           <div class="page-header"> Monitoramento + Roubo </div>
           <ul> 
               <li> Localização via internet ou APP</li>
               <li> Central de monitoramento 24hs</li>
               <li> Anti furto virtual</li>
               <li> Indenização 100% FIPE (roubo)</li>
           </ul>
           <div class="alert alert-info" role="alert">R$299,00 (Adesão) </br> em até 3 vezes no cartão</div>
           <div class="alert alert-success" role="alert">R$178,64 (boleto mensal) Passeio</div>
           <div class="alert alert-success" role="alert">R$188,14 (boleto mensal) SUV / Utilitário</div>
       </div>
       
       <div class="col-md-3"> 
           <div class="page-header"> Monitoramento +  Roubo + Assist 24 hs </div>
           <ul> 
               <li> Localização via internet ou APP</li>
               <li> Central de monitoramento 24hs</li>
               <li> Anti furto virtual</li>
               <li> Indenização 100% FIPE (roubo)</li>
               <li> Assistência 24hs guincho </li>
           </ul>
<!--           <div class="alert alert-info" role="alert">R$299,00 (Adesão) </br> em até 3 vezes no cartão</div>-->
           <div class="alert alert-success" role="alert">R$188,54 (boleto mensal) Passeio</div>
           <div class="alert alert-success" role="alert">R$212,04 (boleto mensal) SUV / Utilitário</div>
       </div>
       
       <div class="col-md-3"> 
           <div class="page-header"> Monitoramento +  Roubo + Assist 24 hs + Colisão </div>
           <ul> 
               <li> Localização via internet ou APP</li>
               <li> Central de monitoramento 24hs</li>
               <li> Anti furto virtual</li>
               <li> Indenização 100% FIPE (roubo)</li>
               <li> Assistência 24hs guincho </li>
               <li> Cobertura acidentes  </li>
           </ul>
<!--           <div class="alert alert-info" role="alert">R$299,00 (Adesão) </br> em até 3 vezes no cartão</div>-->
           <div class="alert alert-success" role="alert">R$248,54 (boleto mensal) Passseio</div>
           <div class="alert alert-success" role="alert">R$277,04 (boleto mensal) SUV / Utilitário</div>
       </div>
       
       <?php 
       $propostazap = "*Cliente* {$_POST['nome']}%0D
*Veículo* {$newmodelo['3']}%0D
*FIPE* {$_POST['fipe']}%0D
*Valor* {$_POST['valor']}%0D
*MONITORAMENTO* %0D
_>>Localização via internet ou APP_%0D
_>>Central de monitoramento 24hs_%0D
_>>Anti furto virtual_%0D         
```R$299,00 (Adesão) em até 3 vezes no cartão```%0D
```R$65,00 (boleto mensal) Passeio```%0D
```R$65,00 (boleto mensal) SUV / Utilitário```%0D       
*MONITORAMENTO / ROUBO*%0D        
_>>Localização via internet ou APP_%0D
_>>Central de monitoramento 24hs_%0D
_>>Anti furto virtual_%0D
_>>Indenização 100% FIPE (roubo)_%0D         
```R$299,00 (Adesão)  em até 3 vezes no cartão```%0D
```R$178,64 (boleto mensal) Passeio``` %0D
```R$188,14 (boleto mensal) SUV / Utilitário``` %0D     
*MONITORAMENTO /  ROUBO / ASSIST 24 HS* %0D          
_>>Localização via internet ou APP_%0D
_>>Central de monitoramento 24hs_%0D
_>>Anti furto virtual_%0D
_>>Indenização 100% FIPE (roubo)_%0D
_>>Assistência 24hs guincho _%0D          
```R$299,00 (Adesão)  em até 3 vezes no cartão```%0D
```R$188,54 (boleto mensal) Passeio```%0D
```R$212,04 (boleto mensal) SUV / Utilitário```%0D     
*MONITORAMENTO /  ROUBO / ASSIST 24 HS / COLISÃO* %0D         
_>>Localização via internet ou APP_%0D
_>>Central de monitoramento 24hs_%0D
_>>Anti furto virtual_%0D
_>>Indenização 100% FIPE (roubo)_%0D
_>>Assistência 24hs guincho _%0D
_>>Cobertura acidentes _ %0D   %0D        
```R$299,00 (Adesão)  em até 3 vezes no cartão```%0D
```R$248,54 (boleto mensal) Passseio```%0D
```R$277,04 (boleto mensal) SUV / Utilitário``` %0D"
. "www.rastreadoresprotege.com.br %0D"
. "https://youtu.be/cpwG0xhKw3g"


; ?>
       
       <a href="https://api.whatsapp.com/send?phone=<?= $_POST['whatsapp'] ?>&text=<?=$propostazap ?>" target="_blank"> <bottom class="btn btn-success"> ENVIAR VIA WHATSAPP CELULAR </bottom> </a>
       
       <hr>
       <a href="https://web.whatsapp.com/send?phone=<?= $_POST['whatsapp'] ?>&text=<?=$propostazap ?>" target="_blank"> <bottom class="btn btn-primary"> ENVIAR VIA WHATSAPP WEB </bottom> </a>
        <hr> <hr>
       
       <?php endif; ?>
       
       
       <?php
       //R$120.000,00 a R$150.000,00
       if( $filtrovalor >= 11999999 and $filtrovalor <= 14999999 ) :
       ?>
       
       <div class="col-md-3"> 
           <div class="page-header"> Monitoramento </div>
           <ul> 
               <li> Localização via internet ou APP</li>
               <li> Central de monitoramento 24hs</li>
               <li> Anti furto virtual</li>
           </ul>
           <div class="alert alert-info" role="alert">R$299,00 (Adesão) </br> em até 3 vezes no cartão</div>
           <div class="alert alert-success" role="alert">R$65,00 (boleto mensal) Passeio</div>
           <div class="alert alert-success" role="alert">R$65,00 (boleto mensal) SUV / Utilitário</div>
       </div>
       
       <div class="col-md-3"> 
           <div class="page-header"> Monitoramento + Roubo </div>
           <ul> 
               <li> Localização via internet ou APP</li>
               <li> Central de monitoramento 24hs</li>
               <li> Anti furto virtual</li>
               <li> Indenização 100% FIPE (roubo)</li>
           </ul>
           <div class="alert alert-info" role="alert">R$299,00 (Adesão) </br> em até 3 vezes no cartão</div>
           <div class="alert alert-success" role="alert">R$251,34 (boleto mensal) Passeio</div>
           <div class="alert alert-success" role="alert">R$261,84 (boleto mensal) SUV / Utilitário</div>
       </div>
       
       <div class="col-md-3"> 
           <div class="page-header"> Monitoramento +  Roubo + Assist 24 hs </div>
           <ul> 
               <li> Localização via internet ou APP</li>
               <li> Central de monitoramento 24hs</li>
               <li> Anti furto virtual</li>
               <li> Indenização 100% FIPE (roubo)</li>
               <li> Assistência 24hs guincho </li>
           </ul>
<!--           <div class="alert alert-info" role="alert">R$299,00 (Adesão) </br> em até 3 vezes no cartão</div>-->
           <div class="alert alert-success" role="alert">R$256,24 (boleto mensal) Passeio</div>
           <div class="alert alert-success" role="alert">R$284,74 (boleto mensal) SUV / Utilitário</div>
       </div>
       
       <div class="col-md-3"> 
           <div class="page-header"> Monitoramento +  Roubo + Assist 24 hs + Colisão </div>
           <ul> 
               <li> Localização via internet ou APP</li>
               <li> Central de monitoramento 24hs</li>
               <li> Anti furto virtual</li>
               <li> Indenização 100% FIPE (roubo)</li>
               <li> Assistência 24hs guincho </li>
               <li> Cobertura acidentes  </li>
           </ul>
<!--           <div class="alert alert-info" role="alert">R$299,00 (Adesão) </br> em até 3 vezes no cartão</div>-->
           <div class="alert alert-success" role="alert">R$326,24 (boleto mensal) Passseio</div>
           <div class="alert alert-success" role="alert">R$354,74 (boleto mensal) SUV / Utilitário</div>
       </div>
       
       <?php 
       $propostazap = "*Cliente* {$_POST['nome']}%0D
*Veículo* {$newmodelo['3']}%0D
*FIPE* {$_POST['fipe']}%0D
*Valor* {$_POST['valor']}%0D
*MONITORAMENTO* %0D
_>>Localização via internet ou APP_%0D
_>>Central de monitoramento 24hs_%0D
_>>Anti furto virtual_%0D         
```R$299,00 (Adesão) em até 3 vezes no cartão```%0D
```R$65,00 (boleto mensal) Passeio```%0D
```R$65,00 (boleto mensal) SUV / Utilitário```%0D       
*MONITORAMENTO / ROUBO*%0D        
_>>Localização via internet ou APP_%0D
_>>Central de monitoramento 24hs_%0D
_>>Anti furto virtual_%0D
_>>Indenização 100% FIPE (roubo)_%0D         
```R$299,00 (Adesão)  em até 3 vezes no cartão```%0D
```R$251,34 (boleto mensal) Passeio``` %0D
```R$261,84 (boleto mensal) SUV / Utilitário``` %0D     
*MONITORAMENTO /  ROUBO / ASSIST 24 HS* %0D          
_>>Localização via internet ou APP_%0D
_>>Central de monitoramento 24hs_%0D
_>>Anti furto virtual_%0D
_>>Indenização 100% FIPE (roubo)_%0D
_>>Assistência 24hs guincho _%0D          
```R$299,00 (Adesão)  em até 3 vezes no cartão```%0D
```R$256,24 (boleto mensal) Passeio```%0D
```R$284,74 (boleto mensal) SUV / Utilitário```%0D     
*MONITORAMENTO /  ROUBO / ASSIST 24 HS / COLISÃO* %0D         
_>>Localização via internet ou APP_%0D
_>>Central de monitoramento 24hs_%0D
_>>Anti furto virtual_%0D
_>>Indenização 100% FIPE (roubo)_%0D
_>>Assistência 24hs guincho _%0D
_>>Cobertura acidentes _ %0D   %0D        
```R$299,00 (Adesão)  em até 3 vezes no cartão```%0D
```R$326,24 (boleto mensal) Passseio```%0D
```R$354,74 (boleto mensal) SUV / Utilitário``` %0D"
. "www.rastreadoresprotege.com.br %0D"
. "https://youtu.be/cpwG0xhKw3g"


; ?>
       
       <a href="https://api.whatsapp.com/send?phone=<?= $_POST['whatsapp'] ?>&text=<?=$propostazap ?>" target="_blank"> <bottom class="btn btn-success"> ENVIAR VIA WHATSAPP CELULAR </bottom> </a>
       
       <hr>
       <a href="https://web.whatsapp.com/send?phone=<?= $_POST['whatsapp'] ?>&text=<?=$propostazap ?>" target="_blank"> <bottom class="btn btn-primary"> ENVIAR VIA WHATSAPP WEB </bottom> </a>
        <hr> <hr>
       
       <?php endif; ?>
       
       
       
       <?php 
       //laço verifica se é carro ou moto
       else: ?>
       
       <?php
       
       if( $filtrovalor < 799999) :
       ?>
       
       <div class="col-md-4"> 
           <div class="page-header"> Monitoramento </div>
           <ul> 
               <li> Localização via internet ou APP</li>
               <li> Central de monitoramento 24hs</li>
               <li> Anti furto virtual</li>
           </ul>
           <div class="alert alert-info" role="alert">R$299,00 (Adesão) </br> em até 3 vezes no cartão</div>
           <div class="alert alert-success" role="alert">R$65,00 (boleto mensal) Passeio</div>
         
       </div>
       
       <div class="col-md-4"> 
           <div class="page-header"> Monitoramento + Roubo </div>
           <ul> 
               <li> Localização via internet ou APP</li>
               <li> Central de monitoramento 24hs</li>
               <li> Anti furto virtual</li>
               <li> Indenização 100% FIPE (roubo)</li>
           </ul>
           <div class="alert alert-info" role="alert">R$390,00 (Adesão) </br> em até 3 vezes no cartão</div>
           <div class="alert alert-success" role="alert">R$79,00 (boleto mensal) </div>
           
       </div>
       
       <div class="col-md-4"> 
           <div class="page-header"> Monitoramento +  Roubo + Assist 24 hs </div>
           <ul> 
               <li> Localização via internet ou APP</li>
               <li> Central de monitoramento 24hs</li>
               <li> Anti furto virtual</li>
               <li> Indenização 100% FIPE (roubo)</li>
               <li> Assistência 24hs guincho </li>
           </ul>
         <div class="alert alert-info" role="alert">R$399,00 (Adesão) </br> em até 3 vezes no cartão</div>
           <div class="alert alert-success" role="alert">R$150,00 (boleto mensal) </div>
           
       </div>
        
        <?php 
        
        $propostazap = "*Cliente* {$_POST['nome']}%0D
*Veículo* {$newmodelo['3']}%0D
*FIPE* {$_POST['fipe']}%0D
*Valor* {$_POST['valor']}%0D
*Monitoramento* %0D
_>>Localização via internet ou APP_%0D
_>>Central de monitoramento 24hs_%0D
_>>Anti furto virtual_%0D
*R$299,00 (Adesão)  em até 3 vezes no cartão*%0D
*R$65,00 (boleto mensal) Passeio*%0D
*Monitoramento / Roubo*%0D
_>>Localização via internet ou APP_%0D
_>>Central de monitoramento 24hs_%0D
_>>Anti furto virtual_%0D
_>>Indenização 100% FIPE (roubo)_%0D
*R$390,00 (Adesão) em até 3 vezes no cartão*%0D
*R$79,00 (boleto mensal)*%0D 
*Monitoramento /  Roubo / Assist 24 hs*%0D 
_>>Localização via internet ou APP_%0D 
_>>Central de monitoramento 24hs_%0D 
_>>Anti furto virtual_%0D
_>>Indenização 100% FIPE (roubo)_%0D
_>>Assistência 24hs guincho _%0D
*R$399,00 (Adesão) em até 3 vezes no cartão*%0D
*R$150,00 (boleto mensal)*%0D ";

        ?>
        
         <a href="https://api.whatsapp.com/send?phone=<?= $_POST['whatsapp'] ?>&text=<?=$propostazap ?>" target="_blank"> <bottom class="btn btn-success"> ENVIAR VIA WHATSAPP CELULAR </bottom> </a>
       
       <hr>
       <a href="https://web.whatsapp.com/send?phone=<?= $_POST['whatsapp'] ?>&text=<?=$propostazap ?>" target="_blank"> <bottom class="btn btn-primary"> ENVIAR VIA WHATSAPP WEB </bottom> </a>
        <hr> <hr>
       
       
       <?php endif; ?>
       
      
       
       <?php 
       if( $filtrovalor >= 799999 and $filtrovalor <= 1499999) :
       ?>
       
       <div class="col-md-4"> 
           <div class="page-header"> Monitoramento </div>
           <ul> 
               <li> Localização via internet ou APP</li>
               <li> Central de monitoramento 24hs</li>
               <li> Anti furto virtual</li>
           </ul>
           <div class="alert alert-info" role="alert">R$299,00 (Adesão) </br> em até 3 vezes no cartão</div>
           <div class="alert alert-success" role="alert">R$65,00 (boleto mensal) Passeio</div>
         
       </div>
       
       <div class="col-md-4"> 
           <div class="page-header"> Monitoramento + Roubo </div>
           <ul> 
               <li> Localização via internet ou APP</li>
               <li> Central de monitoramento 24hs</li>
               <li> Anti furto virtual</li>
               <li> Indenização 100% FIPE (roubo)</li>
           </ul>
          <div class="alert alert-info" role="alert">R$390,00 (Adesão) </br> em até 3 vezes no cartão</div>
           <div class="alert alert-success" role="alert">R$99,00 (boleto mensal) </div>
           
       </div>
       
       <div class="col-md-4"> 
           <div class="page-header"> Monitoramento +  Roubo + Assist 24 hs </div>
           <ul> 
               <li> Localização via internet ou APP</li>
               <li> Central de monitoramento 24hs</li>
               <li> Anti furto virtual</li>
               <li> Indenização 100% FIPE (roubo)</li>
               <li> Assistência 24hs guincho </li>
           </ul>
           <div class="alert alert-info" role="alert">R$399,00 (Adesão) </br> em até 3 vezes no cartão</div>
           <div class="alert alert-success" role="alert">R$170,00 (boleto mensal) </div>
           
       </div>
        
                <?php 
        
$propostazap = "*Cliente* {$_POST['nome']}%0D
*Veículo* {$newmodelo['3']}%0D
*FIPE* {$_POST['fipe']}%0D
*Valor* {$_POST['valor']}%0D
*Monitoramento* %0D
_>>Localização via internet ou APP_%0D
_>>Central de monitoramento 24hs_%0D
_>>Anti furto virtual_%0D
*R$299,00 (Adesão)  em até 3 vezes no cartão*%0D
*R$65,00 (boleto mensal) Passeio*%0D
*Monitoramento / Roubo*%0D
_>>Localização via internet ou APP_%0D
_>>Central de monitoramento 24hs_%0D
_>>Anti furto virtual_%0D
_>>Indenização 100% FIPE (roubo)_%0D
*R$390,00 (Adesão) em até 3 vezes no cartão*%0D
*R$99,00 (boleto mensal)*%0D 
*Monitoramento /  Roubo / Assist 24 hs*%0D 
_>>Localização via internet ou APP_%0D 
_>>Central de monitoramento 24hs_%0D 
_>>Anti furto virtual_%0D
_>>Indenização 100% FIPE (roubo)_%0D
_>>Assistência 24hs guincho _%0D
*R$399,00 (Adesão) em até 3 vezes no cartão*%0D
*R$170,00 (boleto mensal)*%0D ";

        ?>
        
         <a href="https://api.whatsapp.com/send?phone=<?= $_POST['whatsapp'] ?>&text=<?=$propostazap ?>" target="_blank"> <bottom class="btn btn-success"> ENVIAR VIA WHATSAPP CELULAR </bottom> </a>
       
       <hr>
       <a href="https://web.whatsapp.com/send?phone=<?= $_POST['whatsapp'] ?>&text=<?=$propostazap ?>" target="_blank"> <bottom class="btn btn-primary"> ENVIAR VIA WHATSAPP WEB </bottom> </a>
        <hr> <hr>
       
      
       
       <?php endif; ?>
       
       
       <?php 
       if( $filtrovalor >= 1499999 and $filtrovalor <= 1999999) :
       ?>
       
       <div class="col-md-4"> 
           <div class="page-header"> Monitoramento </div>
           <ul> 
               <li> Localização via internet ou APP</li>
               <li> Central de monitoramento 24hs</li>
               <li> Anti furto virtual</li>
           </ul>
           <div class="alert alert-info" role="alert">R$399,00 (Adesão) </br> em até 3 vezes no cartão</div>
           <div class="alert alert-success" role="alert">R$65,00 (boleto mensal) Passeio</div>
         
       </div>
       
       <div class="col-md-4"> 
           <div class="page-header"> Monitoramento + Roubo </div>
           <ul> 
               <li> Localização via internet ou APP</li>
               <li> Central de monitoramento 24hs</li>
               <li> Anti furto virtual</li>
               <li> Indenização 100% FIPE (roubo)</li>
           </ul>
           <div class="alert alert-info" role="alert">R$450,00 (Adesão) </br> em até 3 vezes no cartão</div>
           <div class="alert alert-success" role="alert">R$149,00 (boleto mensal) </div>
           
       </div>
       
       <div class="col-md-4"> 
           <div class="page-header"> Monitoramento +  Roubo + Assist 24 hs </div>
           <ul> 
               <li> Localização via internet ou APP</li>
               <li> Central de monitoramento 24hs</li>
               <li> Anti furto virtual</li>
               <li> Indenização 100% FIPE (roubo)</li>
               <li> Assistência 24hs guincho </li>
           </ul>
           <div class="alert alert-info" role="alert">R$450,00 (Adesão) </br> em até 3 vezes no cartão</div>
           <div class="alert alert-success" role="alert">R$225,00 (boleto mensal) </div>
           
       </div>
        
                <?php 
        
$propostazap = "*Cliente* {$_POST['nome']}%0D
*Veículo* {$newmodelo['3']}%0D
*FIPE* {$_POST['fipe']}%0D
*Valor* {$_POST['valor']}%0D
*Monitoramento* %0D
_>>Localização via internet ou APP_%0D
_>>Central de monitoramento 24hs_%0D
_>>Anti furto virtual_%0D
*R$299,00 (Adesão)  em até 3 vezes no cartão*%0D
*R$65,00 (boleto mensal) Passeio*%0D
*Monitoramento / Roubo*%0D
_>>Localização via internet ou APP_%0D
_>>Central de monitoramento 24hs_%0D
_>>Anti furto virtual_%0D
_>>Indenização 100% FIPE (roubo)_%0D
*R$390,00 (Adesão) em até 3 vezes no cartão*%0D
*R$149,00 (boleto mensal)*%0D 
*Monitoramento /  Roubo / Assist 24 hs*%0D 
_>>Localização via internet ou APP_%0D 
_>>Central de monitoramento 24hs_%0D 
_>>Anti furto virtual_%0D
_>>Indenização 100% FIPE (roubo)_%0D
_>>Assistência 24hs guincho _%0D
*R$399,00 (Adesão) em até 3 vezes no cartão*%0D
*R$225,00 (boleto mensal)*%0D ";

        ?>
        
         <a href="https://api.whatsapp.com/send?phone=<?= $_POST['whatsapp'] ?>&text=<?=$propostazap ?>" target="_blank"> <bottom class="btn btn-success"> ENVIAR VIA WHATSAPP CELULAR </bottom> </a>
       
       <hr>
       <a href="https://web.whatsapp.com/send?phone=<?= $_POST['whatsapp'] ?>&text=<?=$propostazap ?>" target="_blank"> <bottom class="btn btn-primary"> ENVIAR VIA WHATSAPP WEB </bottom> </a>
        <hr> <hr>
       
      
       
       <?php endif; ?>
       
       
       <?php 
       if( $filtrovalor >= 1999999 and $filtrovalor <= 2999999) :
       ?>
       
       <div class="col-md-4"> 
           <div class="page-header"> Monitoramento </div>
           <ul> 
               <li> Localização via internet ou APP</li>
               <li> Central de monitoramento 24hs</li>
               <li> Anti furto virtual</li>
           </ul>
           <div class="alert alert-info" role="alert">R$399,00 (Adesão) </br> em até 3 vezes no cartão</div>
           <div class="alert alert-success" role="alert">R$65,00 (boleto mensal) Passeio</div>
         
       </div>
       
       <div class="col-md-4"> 
           <div class="page-header"> Monitoramento + Roubo </div>
           <ul> 
               <li> Localização via internet ou APP</li>
               <li> Central de monitoramento 24hs</li>
               <li> Anti furto virtual</li>
               <li> Indenização 100% FIPE (roubo)</li>
           </ul>
           <div class="alert alert-info" role="alert">R$450,00 (Adesão) </br> em até 3 vezes no cartão</div>
           <div class="alert alert-success" role="alert">R$208,00 (boleto mensal) </div>
           
       </div>
       
       <div class="col-md-4"> 
           <div class="page-header"> Monitoramento +  Roubo + Assist 24 hs </div>
           <ul> 
               <li> Localização via internet ou APP</li>
               <li> Central de monitoramento 24hs</li>
               <li> Anti furto virtual</li>
               <li> Indenização 100% FIPE (roubo)</li>
               <li> Assistência 24hs guincho </li>
           </ul>
           <div class="alert alert-info" role="alert">R$450,00 (Adesão) </br> em até 3 vezes no cartão</div>
           <div class="alert alert-success" role="alert">R$284,00 (boleto mensal) </div>
           
       </div>
       
              <?php 
        
$propostazap = "*Cliente* {$_POST['nome']}%0D
*Veículo* {$newmodelo['3']}%0D
*FIPE* {$_POST['fipe']}%0D
*Valor* {$_POST['valor']}%0D
*Monitoramento* %0D
_>>Localização via internet ou APP_%0D
_>>Central de monitoramento 24hs_%0D
_>>Anti furto virtual_%0D
*R$299,00 (Adesão)  em até 3 vezes no cartão*%0D
*R$65,00 (boleto mensal) Passeio*%0D
*Monitoramento / Roubo*%0D
_>>Localização via internet ou APP_%0D
_>>Central de monitoramento 24hs_%0D
_>>Anti furto virtual_%0D
_>>Indenização 100% FIPE (roubo)_%0D
*R$390,00 (Adesão) em até 3 vezes no cartão*%0D
*R$208,00 (boleto mensal)*%0D 
*Monitoramento /  Roubo / Assist 24 hs*%0D 
_>>Localização via internet ou APP_%0D 
_>>Central de monitoramento 24hs_%0D 
_>>Anti furto virtual_%0D
_>>Indenização 100% FIPE (roubo)_%0D
_>>Assistência 24hs guincho _%0D
*R$399,00 (Adesão) em até 3 vezes no cartão*%0D
*R$284,00 (boleto mensal)*%0D ";

        ?>
        
         <a href="https://api.whatsapp.com/send?phone=<?= $_POST['whatsapp'] ?>&text=<?=$propostazap ?>" target="_blank"> <bottom class="btn btn-success"> ENVIAR VIA WHATSAPP CELULAR </bottom> </a>
       
       <hr>
       <a href="https://web.whatsapp.com/send?phone=<?= $_POST['whatsapp'] ?>&text=<?=$propostazap ?>" target="_blank"> <bottom class="btn btn-primary"> ENVIAR VIA WHATSAPP WEB </bottom> </a>
        <hr> <hr>
       
       <?php endif; ?>
       
       
       
       
       
       
       
       
       <?php endif; ?>
       
       
       
   </div>
    
    
    <?php  endif; ?>


    
    <hr>
    
    <table class="table table-condensed table-responsive"> 
        
        <thead> 
            <tr> 
                <th> Data</th>
                <th> Cliente</th>
                <th> Whatsapp</th>
                <th> Veículo</th>
                <th> Modelo</th>
                <th>Ano</th>
                <th> Valor</th>
                <th>Status </th>
                <th>Observação </th>
            </tr>
        </thead>
        
        <tbody> 
          <?php 
       $atual = filter_input(INPUT_GET, 'atual' ,FILTER_VALIDATE_INT );
      $pager = new Pager('index.php?p=orcamento&atual=', 'Primeira', 'Ultima', '1');
      $pager->ExePager($atual, 10);
            
            
            $ver = new Read();
            $ver->ExeRead("propostacarwhats", "WHERE vendedor = :p ORDER BY id DESC LIMIT :limit OFFSET :offset", "p={$_COOKIE['logprot_id_usuario']}&limit={$pager->getLimit()}&offset={$pager->getOffset()}");
            $ver->getResult();
            
            foreach ($ver->getResult() as $value) {
      
                $dataformat = date("d/m/Y H:i:s",  strtotime($value['data']));
            ?>
                    <tr> 
                <th> <?= $dataformat; ?></th>
                <th> <?= $value['nome'] ?></th>
                <th> <?= $value['whatsapp'] ?></th>
                <th> <?= $value['veiculo'] ?></th>
                <th> <?= $value['modelo'] ?></th>
                <th> <?= $value['ano'] ?></th>
                <th> <?= $value['valor'] ?></th>
                <th><?php
                if(empty($value['status'])):
                    echo "<div class='alert alert-info'> Em Atendimento </div>";
                else:
                    if($value['status'] == "1"):
                        echo  "<div class='alert alert-success'> Vendido </div>";
                    endif;
                    if($value['status'] == "2"):
                        echo  "<div class='alert alert-danger'> Não Vendido </div>";
                    endif;
                endif;
                 ?> </th>
                <th><!-- Button trigger modal -->
<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal<?= $value['id'] ?>">
  Observações
</button> 
                <!-- Modal -->
<div class="modal fade" id="myModal<?= $value['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Cliente <?= $value['nome'] ?></br> <?= $value['modelo'] ?> </br><?= $value['valor'] ?> </h4>
      </div>
      <div class="modal-body">
          
                      <?php 
            $filtro = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            
            if($filtro):
                
           
            
            $atu = new Update();
            $atu->ExeUpdate("propostacarwhats", $filtro, "WHERE id = :p", "p={$filtro['id']}");
            $atu->getResult();
            
            if($atu->getResult()):
                echo "<div class='alert alert-success'>Atualizado com sucesso </div>";
                else:
               echo "<div class='alert alert-danger'>ERRO ao atualizar </div>"; 
            endif;
            
             endif;
            //var_dump($filtro);
            ?>
        
        <form action="" method="post"> 
            <div class="form-group"> 
                <textarea name="obs" class="form-control"> <?= $value['obs'] ?> </textarea>
            </div>
            <div class="form-group"> 
                <select class="form-control" name="status"> 
                    <option><?php                if(empty($value['status'])):
                    echo " Em Atendimento";
                else:
                    if($value['status'] == "1"):
                        echo  " Vendido ";
                    endif;
                    if($value['status'] == "2"):
                        echo  " Não Vendido";
                    endif;
                endif; ?> </option>
                    <option value=""> Em Atendimento</option>
                    <option value="1">Vendido </option>
                    <option value="2">Não Vendido </option>
                </select>
            </div>
            <input type="hidden" name="id" value="<?= $value['id'] ?>"/>
            <input type="submit" class="btn btn-primary" value="atualizar" />
        
        </form>
        
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">FECHAR</button>
        
      </div>
    </div>
  </div>
</div>
                
                
                </th>
            </tr>
            <?php } ?>
        </tbody>
    
    
    </table>
    
          <?php 
      $pager->ExePaginator("propostacarwhats");
      
      echo $pager->getPaginator();
      ?>

</main>
<div class="clear"> </div>