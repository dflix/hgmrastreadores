

<?php
unset($_SESSION["cliente_id"]);
unset($_SESSION["pedido_id"]);
unset($_SESSION["etapa"]);

        $fatura = new \Source\Core\Faturas();
        $fatura->registraFatura();
        
        $atendimento = new Source\Core\Atendimento();
        $atendimento->Cadastra();
        
        $doc = new \Source\Core\Documentos();
        $doc->Upload();
        
        $cobranca = new Source\Core\Cobrancas();
        $cobranca->Upload();
        
        
        
        if(!empty($_GET["delete"])){
            $delete = new \Source\Models\Delete();
            $delete->ExeDelete("app_prevenda", "WHERE id = :a", "a={$_GET["delete"]}");
            $delete->getResult();
            if($delete->getResult()){
               echo "<div class='alert alert-success'> Deletado com Sucesso </div>"; 
            }else{
               echo "<div class='alert alert-danger'> Erro ao deletar </div>";  
            }
        }

//var_dump($_SESSION);
?>

 <script type="text/javascript">
    $(function(){
        $("#valor").maskMoney();
    })
    $(function(){
        $("#valor2").maskMoney();
    })
    </script>



<div class="container-fluid"> 

<!--    <h3 class="border-bottom"> Clientes & Pedidos </h3>-->

    <div class="row"> 

<!--        <div class="col-md-6" style="margin-top: 10px;"> 
            <a href="<?= CONF_URL_APP ?>/contrato" style="text-decoration: none;color:#fff;">  <div class="subscribe btn btn-primary btn-block rounded-pill shadow-sm"> Clientes</div> </a>
        </div>

        <div class="col-md-6" style="margin-top: 10px;"> 
            <a href="<?= CONF_URL_APP ?>/plano" style="text-decoration: none;color:#fff;">   <div class="subscribe btn btn-primary btn-block rounded-pill shadow-sm"> Pedidos</div> </a>
        </div>-->


        <div class="col-md-12"> 
            <h3 class="border-bottom"> Clientes </h3>
            <div class="col-md-3"> 
                <label>Novos Clientes </label></br>
                <p class="btn btn-success"><a href="./?p=cliente_cadastra" style="text-decoration: none; color:#fff;">+ Novo Cliente </a> </p>
            </div>
            <div class="col-md-9 text-right"> 

                           <p class="border-bottom">  </p>
            <form method="post" id="form-pesquisa" action=""> 
                
                <div class="row"> 
                
                    <div class="col-md-8"> 
                        <label>TERMO DE PESQUISA </label>
                        <input type="text" name="q" class="form-control" />
                    </div>
                    <div class="col-md-4"> 
                        <label>FILTRO </label>
                        <select name="query" class="form-control"> 
                            <option value="nome">Nome </option>
                            <option value="cpf">CPF </option>
                            <option value="cnpj">CNPJ </option>
                          
                        </select>
                        <input type="submit" class="btn btn-success" value="buscar"/>
                    </div>
                
                </div>
<!--                <label>Pesquisa Clientes </label>-->
                <!--<input type="text" class="form-control" id="pesquisa" name="pesquisa" placeholder="pesqise por nome, cpf, placa , equipamento, chip ou status" />-->
                <!--<input type="text" class="form-control" id="pesquisa" name="pesquisa" placeholder="pesqise por nome, cpf, placa , equipamento, chip ou status" />-->
            </form>
            
            </div>
            
            <div class="resultado col-md-12"> </div>
            <div class="col-md-12" id="exibe">
                </br>
                <table class="table"> 
                    <thead class="bg-dark" style="color:#fff;"> 
                        <tr>
                        
                            <th>Inicio </th>
                            <th>Cliente </th>
                            <th>Documento</th>
                           
                         

                       
                            <th>Pedidos </th>
                            <th>Cobranças </th>
                            <th>Atendimentos </th>
                            <th>DOC </th>
                            <th>Editar </th>
                            <th>Excluir </th>

                        </tr>
                    </thead>

                    <tbody> 
                        <?php
                        $atual = filter_input(INPUT_GET, 'atual', FILTER_VALIDATE_INT);
                        $pager = new Source\Support\Pager("./?p=cliente&atual=", "Primeiro", "Ultimo", "1");
                        $pager->ExePager($atual, 5);
                        
                        $filtro = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                        
                       // var_dump($filtro);
                        
                        
                        
                        if(!empty($filtro["q"])){
                            
                        $read = new Source\Models\Read();
                        $read->ExeRead("app_clientes", "WHERE {$filtro["query"]}  LIKE '%' :a '%' LIMIT :limit OFFSET :offset", 
                                "a={$filtro["q"]}&limit={$pager->getLimit()}&offset={$pager->getOffset()}");
                        $read->getResult();
                        
                        echo "Sua Busca pelo filtro <b>{$filtro["query"]}</b> com termo <b>{$filtro["q"]}</b> retornou seguintes resultados";
                            
                        }else{

                        $read = new Source\Models\Read();
                        $read->ExeRead("app_clientes", "ORDER BY cadastro DESC LIMIT :limit OFFSET :offset", 
                                "limit={$pager->getLimit()}&offset={$pager->getOffset()}");
                        $read->getResult();
                        
                        }
                        
                        foreach ($read->getResult() as $cliente):
                            ?>
                            <tr> 
                                
                                <td><?= date("d/m/Y",strtotime($cliente["cadastro"])); ?>  </td>
                                <td><?= $cliente["nome"] ?>  </td>
                                <td><?= $cliente["cpf"] ?> <?= $cliente["cnpj"] ?></td>

 
                            <td>  
                                
                               <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pedidos<?= $cliente["cliente_id"] ?>">
  Veiculos
</button>

<!-- Modal -->
<div class="modal fade" id="pedidos<?= $cliente["cliente_id"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cliente ID <?= $cliente["cliente_id"] ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="row">
          <?php
                          $veiculos = new \Source\Models\Read();
                  $veiculos->ExeRead("app_veiculos", "WHERE cliente_id = :a", "a={$cliente["cliente_id"]}");
                  $veiculos->getResult();
                  foreach ($veiculos->getResult() as $valor) {
             ?>
          
           <div class="col-md-6">
               <b>DATA</b> </br> <p><?= $valor["data"] ?></p> </div>
           <div class="col-md-6">
               <p class="btn btn-warning"><a href="./?p=pedido_veiculos&edit=<?= $valor["id"] ?>&cliente=<?= $cliente["cliente_id"] ?>" style="text-decoration:none; color:#fff;">EDITAR</a></p> </div>
              <div class="col-md-3"><b>TIPO </b> </br><?= $valor["tipo"] ?> </p> </div>
              <div class="col-md-3"><b>MARCA</b> </br><?= $valor["marca"] ?> </p> </div>
              <div class="col-md-3"><b>MODELO</b> </br><?= $valor["modelo"] ?></p>  </div>
              <div class="col-md-3"><b>PLACA</b> </br><?= $valor["placa"] ?></p> </div>
              <div class="col-md-3"><b>EMPRESA</b> </br><?= $valor["equipamento_empresa"] ?></p> </div>
              <div class="col-md-3"><b>ID EQUIP</b> </br><?= $valor["equipamento"] ?> </p> </div>
              <div class="col-md-3"><b>CHIP</b> </br><?= $valor["chip"] ?></p> </div>
              <div class="col-md-3"><b>STATUS</b> </br><?= $valor["status"] ?></p> </div>
              <div class="col-md-3"><b>ADESÂO</b> </br><p class="btn btn-success"><a href="adesao.php?id=<?= $valor["id"] ?>" target="_blank" style="text-decoration: none; color:#fff;">Adesão</a></p> </div>
              <div class="col-md-3"><b>CONTRSTO</b> </br><p class="btn btn-info"><a href="contrato_hgm.php?cliente=<?= $valor["id"] ?>&contrato=<?= $valor["id_contrato"] ?>" target="_blank" style="text-decoration: none; color:#fff;">Contrato</a> </p></div>
                      <div class="col-md-3"><b>PLANO</b> </br><?= $valor["plano_desc"] ?></p> </div>
                      <div class="col-md-3"><b>MENSAL</b> </br><?= number_format($valor["plano_valor"] / 100, 2, ".", ",") ?></p> </div>
                      <p class="col-md-12" style="border-bottom:2px solid #ccc;"> </p>
          
                  <?php } ?>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
                               
                                
                                  <hr>
                                     <p class="btn btn-info"><a href="pedido.php?id=<?= $cliente["cliente_id"] ?>" style="text-decoration:none; color:#fff;">+ Novo Pedidos </a> </p>
                                   
                                </td>
                                
                                <td>
                              <?php      
                                     $fatura = new Source\Models\Read();
              $fatura->ExeRead("app_faturas", "WHERE cliente_id = :a", "a={$cliente["cliente_id"]}");
              $fatura->getResult();
              if(!empty($fatura->getResult())){
                  $botao = "btn btn-success";
              }else{
                   $botao = "btn btn-danger";
              }
                ?>                
                                <!-- Button trigger modal -->
<button type="button" class="<?= $botao ?>" data-toggle="modal" data-target="#exampleModal<?= $cliente["cliente_id"] ?>">
  COBRANÇAS
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal<?= $cliente["cliente_id"] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title <?= $cliente["cliente_id"] ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
           <form method="post" action="" id="receita" class="form">
                                                <input type="hidden" name="modo" value="entrada" />
                                                <div class="col-lg-12"> 
                                                    <p><i class="fas fa-pen-fancy" aria-hidden="true"></i>Descrição </p>
                                                    <input type="text" name="descricao" placeholder="Descrição do Lançamento" value="Cliente ID <?= $cliente["cliente_id"] ?> / <?= $cliente["nome"] ?> " class="form-control" />
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6"> 
                                                        </br>
                                                        <p><i class="far fa-money-bill-alt " ></i> Valor </p>
                                                      
                                                        <input type="text" name="valor" id="valor" class="form-control" />
                                                        
                                                     
                                                    </div>
                                                    <div class="col-lg-6"> 
                                                        </br>
                                                        <p><i class="fa fa-table" aria-hidden="true"></i> Data </p>
                                                        <input type="date" id="date" name="vencimento_em"  class="form-control input-datepicker" />
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6"> 
                                                        </br>
                                                        <p><i class="fa fa-book" ></i> Carteira </p>
                                                        <select name="carteira_id" class="form-control"> 
                                                            <?php 
                                                            $cart = new Source\Models\Read();
                                                            $cart->ExeRead("app_carterias", "ORDER BY wallet DESC");
                                                            $cart->getResult();
                                                            
                                                            foreach ($cart->getResult() as $forcarteira):
                                                            ?>

                                                            <option value="<?= $forcarteira["wallet"] ?>"><?= $forcarteira["wallet"] ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                        </select>

                                                    </div>
                                                    <div class="col-lg-6"> 
                                                        </br>
                                                        <label><i class="fas fa-retweet"></i> Categoria </label>
                                                        <select name="categoria_id" class="form-control"> 
                                                            <?php 
                                                            
                                                            $cat = new Source\Models\Read();
                                                            $cat->ExeRead("app_categorias", "WHERE type = :a", "a=renda");
                                                            $cat->getResult();
                                                            foreach ($cat->getResult() as $forrenda):
                                                       
                                                            ?>

                                                            <option value="<?= $forrenda["id"] ?>"><?= $forrenda["name"] ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                </br>
                                                
                                                 <div class="col-md-12"> 
                                                        <h3> Gerar Boleto PAGARME </h3>
                                                        <select name="boleto" class="form-control"> 
                                                            <option value="1"> Sim </option>
                                                            <option value="0">Não </option>
                                                        </select>
                                                    </div>
                                                <h3> Repetições </h3>

                                                <div class="col-md-12">


                                                    <div class="col-lg-12 col-md-12"> 

                                                        <label><i class="fas fa-retweet"></i> Repetição </label>
                                                        </br>




                                                        <script>



                                                            $(function () {

                                                                $(".camposExtras").hide();
                                                                $(".js_fixa").hide();
                                                                $(".js_parcelas").hide();
                                                                $('input[name="tipo"]').change(function () {
                                                                    if ($('input[name="tipo"]:checked').val() === "Fixa") {
                                                                        $('.js_fixa').show();
                                                                    } else {
                                                                        $('.js_fixa').hide();
                                                                    }
                                                                    if ($('input[name="tipo"]:checked').val() === "Parcela") {
                                                                        $('.js_parcelas').show();
                                                                    } else {
                                                                        $('.js_parcelas').hide();
                                                                    }
                                                                });

                                                            });
                                                        </script>



                                                        <input type="radio" name="tipo" value="Unica" class="form" >  Unica

                                                        <input type="radio" name="tipo" value="Fixa" >  Fixa 

                                                        <input type="radio" name="tipo" value="Parcela" > Parcela

                                                        <!--<div class="camposExtras">
                                                            Aqui vem os dados que é para esconder ou aparecer
                                                        </div>-->

                                                    </div>   
                                                    
                                                   

                                                </div>

                                                <div class="row"> 

                                                    <div class="col-lg-12 js_fixa" id="ocultar"> 
                                                        </br>
                                                        <label class="js_fixa"> Fixas </label>
                                                        <select name="js_fixa" class="form-control"> 
                                                            <option value="0">Selecione periodo  </option>
                                                            <option value="mensal">Mensal </option>
                                                            <option value="anual">Anual </option>

                                                        </select>
                                                    </div>

                                                    <div class="col-lg-12 js_parcelas" id="ocultar"> 
                                                        </br>
                                                        <label class="js_parcelas"> Parcelas </label>
                                                        <select name="js_parcelas" class="form-control"> 
                                                            <?php for ($i = 0; $i < 80; $i++) { ?>
                                                                <option value="<?= $i; ?>"><?= $i; ?> </option>
                                                            <?php } ?>

                                                        </select>
                                                    </div>


                                                </div>
                                                </br>
                                                
                                                <input type="hidden" name="cliente_id" value="<?= $cliente["id"] ?>" />
                                                <input type="hidden" name="cliente" value="<?= $cliente["nome"] ?>" />
                                                <input type="submit" name="submit" value="LANÇAR RECEITAS" class="btn btn-success" />
                                                       </form>

          </br>          </br>
      

          
          <table class="table"> 
              <thead> 
              <th> Vencimento </th>
              <th> Valor </th>
              <th> Status </th>
              <th> Boleto </th>
              <th> Upload Arquivo </th>
              
              </thead>
              
              
                 <tbody> 
              
              <?php 
              $fatura = new Source\Models\Read();
              $fatura->ExeRead("app_faturas", "WHERE cliente_id = :a", "a={$cliente["cliente_id"]}");
              $fatura->getResult();
              if(!empty($fatura->getResult())){
                  $_SESSION["botao"] = "btn btn-success";
              }else{
                   $_SESSION["botao"] = "btn btn-danger";
              }
              
              foreach ($fatura->getResult() as $value) {

              ?>
 
                  <tr>
                      <td> <?= date("d/m/Y" , strtotime($value["vencimento_em"]))  ?> </td>
                      <td>  <?= number_format($value["valor"] / 100, 2, ",", ".")  ?> </td>
              <td>  <?php 
                      if($value["status"] == "unpaid"){
                          echo "<div class='alert alert-danger'> Aberto </div>";
                      }
                      if($value["status"] == "paid"){
                          echo "<div class='alert alert-success'> PAgo </div>";
                      }
                      ?> </td>
              <td> 
              <?php 
              $boleto = new Source\Models\Read();
              $boleto->ExeRead("app_faturas", "WHERE id = :a", "a={$value["id"]}");
              $boleto->getResult();
              if($boleto->getResult()){
              ?>
               
                  <a href="<?= CONF_URL_APP ?>/boletosphp/boleto.php?id=<?= $boleto->getResult()[0]["id"] ?>" target="_blank"> <i class="fas fa-barcode" style="font-size:2em; color:#000;"></i>  </a>
                  
              <?php }else{ ?>
                  
                  <?php echo "boleto não gerado"; 
              }
                  ?>
              </td>
              <td> 
                  
                  <?php
               
                  if(!empty($value["pdf_boleto"])){
                      
                      //echo $value["pdf_boleto"];
                      
                      ?>
                  
                   <a href="<?= CONF_URL_BASE ?>/admin/uploads/<?php echo $value["pdf_boleto"]; ?>" target="_blank">Arquivo Enviado</a>"; 
                
                <?php  }else{ ?>

                  
                 
              
              
                    <form name="form" action="" method="post" enctype="multipart/form-data" >
             <div class="form-group"> 
                    <p> Upload de Documentos </p>
                <input type="file" name="image" class="form-control" />
                </div>
              <div class="form-group"> 
                  <input type="hidden" name="fatura_id" value="<?= $value["id"] ?>" />
                  <input type="submit" name="ENVIAR_COBRANCA" class="btn btn-success" />
              </div>
          
          </form>
                   
                     <?php }  ?>
                  <?php } ?> 
              
              </td>
                  </tr>
                
               
                 
                  
              </tbody>
          
          </table>
          
      </div>
      <div class="modal-footer">
<!--        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>-->
      </div>
    </div>
  </div>
</div>
                                
                                
                                </td>
                                <td>
                                
                                    <!-- Button trigger modal -->
<button type="button" class="btn btn-dark" data-toggle="modal" data-target="#ModalAtendimento<?= $cliente["cliente_id"] ?>">
  Atendimento
</button>

<!-- Modal -->
<div class="modal fade" id="ModalAtendimento<?= $cliente["cliente_id"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal Atendimento <?= $cliente["cliente_id"] ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          
          <form method="post" action="" class="form"> 
              <div class="form-group"> 

                  <input type="hidden" name="cliente_id" value="<?= $cliente["cliente_id"] ?>"  />                  
                  <input type="hidden" name="user_id" value="<?= $_SESSION["user_id"] ?>"  />
                  <input type="hidden" name="date" value="<?= date("Y-m-d H:i:s") ?>"  />
              </div>
              <div class="form-group"> 
                  <label> Ocorrência</label>
                  <textarea name="ocorrencia" class="form-control"> </textarea>
              </div>
              <div class="form-group"> 
                  <input type="submit" name="cadastrar" class="btn btn-success" />
              </div>
              
          </form>
          
          <table class="table"> 
          
              <thead> 
                  <tr> 
                      <th>Data </th>
                      <th>Ocorrencia </th>
                      <th>Atendente </th>
                  </tr>
              </thead>
              
              <tbody> 
                  
                  <?php 
                  $atendimento = new Source\Models\Read();
                  $atendimento->ExeRead("app_atendimento", "WHERE cliente_id = :a", "a={$cliente["cliente_id"]}");
                  $atendimento->getResult();
                  foreach ($atendimento->getResult() as $atende) {
                  ?>
                  <tr> 
                      <td><?= date( "d/m/Y H:i:s", strtotime($atende["data"]))  ?> </td>
                      <td><?= $atende["ocorrencia"] ?> </td>
                      <td><?php $atende["user_id"];
                      
                      $nome = new Source\Models\Read();
                      $nome->ExeRead("usuarios", "WHERE id = :a", "a={$atende["user_id"]}");
                      $nome->getResult();
                      
                      echo $nome->getResult()[0]["first_name"] . " " . $nome->getResult()[0]["last_name"] ;
                      ?> </td>
                  </tr>
                  <?php } ?>
                  
              
              </tbody>
          
          </table>
       
      </div>
      <div class="modal-footer">
<!--        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>-->
      </div>
    </div>
  </div>
</div>
                                
                                
                                </td>
                                
                                <td> 
                                
                                
                                <!-- Button trigger modal -->
<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#ModalDoc<?= $cliente["cliente_id"] ?>">
  Doc
</button>

<!-- Modal -->
<div class="modal fade" id="ModalDoc<?= $cliente["cliente_id"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cliente ID <?= $cliente["cliente_id"] ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
          
          <form name="form" action="" method="post" enctype="multipart/form-data" >
             <div class="form-group"> 
                    <p> Upload de Documentos</p>
                <input type="file" name="image" class="form-control" />
                </div>
              <div class="form-group"> 
                  <input type="hidden" name="cliente_id" value="<?= $cliente["cliente_id"] ?>" />
                  <input type="submit" name="ENVIAR ARQUIVO" class="btn btn-success" />
              </div>
          
          </form>
          
          <div class="row"> 
              
              <?php 
              $doc = new Source\Models\Read();
              $doc->ExeRead("app_documento", "WHERE cliente_id = :a", "a={$cliente["cliente_id"]}");
              $doc->getResult();
              
              foreach ($doc->getResult() as $documento) {

              ?>
          
              <div class="col-md-4"> 
                  <a href="<?= CONF_URL_BASE ?>/admin/uploads/<?= $documento["arquivo"] ?>" target="_blank">  <img src="<?= CONF_URL_BASE ?>/admin/uploads/<?= $documento["arquivo"] ?>" width="100px" /> </a>
              
              </div>
              
              <?php } ?>
          
          </div>
          
      </div>
      <div class="modal-footer">
<!--        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>-->
      </div>
    </div>
  </div>
</div>
                                
                                
                                
                                </td>
                               
                                <td><p class="btn btn-info"><a style="text-decoration: none; color:#fff;" href="./?p=cliente_cadastra&edit=<?= $cliente["cliente_id"] ?>">Editar</a></p> </td>
                                <td><p class="btn btn-danger"><a style="text-decoration: none; color:#fff;" href="./?p=cliente&delete=<?= $cliente["cliente_id"] ?>">Excluir</a></p> </td>
                            </tr>
                        <?php endforeach; ?> 


                    </tbody>

                </table>
                
                <?php
                    $pager->ExePaginator("app_prevenda");
                    echo $pager->getPaginator();
                    ?>

            </div>
        </div>


    </div> 
</div> 



<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>

        <script type="text/javascript">

                    $(function () {
                        $("#pesquisa").keyup(function () {
                            //Recuperar o valor do campo
                            var pesquisa = $(this).val();

                            //Verificar se há algo digitado
                            if (pesquisa != '') {
                                var dados = {
                                    palavra: pesquisa
                                }
                                $.post("<?= CONF_URL_BASE ?>/process/buscaCliente.php", dados, function (retorna) {
                                    //Mostra dentro da ul os resultado obtidos 
                                    $(".resultado").html(retorna);
                                    $("#exibe").hide();
                                });
                            }
                        });
                    });

        </script>

