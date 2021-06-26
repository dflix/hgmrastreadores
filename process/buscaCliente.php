<?php
session_start();
include '../vendor/autoload.php';

//var_dump($_POST["palavra"]);
?>


 <div class="col-md-12" >
                </br>
               
                        <?php
                        $filtro = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$_SESSION["busca"] = $filtro["palavra"];
                        
                        $atual = filter_input(INPUT_GET, 'atual', FILTER_VALIDATE_INT);
                        $pager = new Source\Support\Pager("./?p=cliente&atual=", "Primeiro", "Ultimo", "1");
                        $pager->ExePager($atual, 5);

                        $read = new Source\Models\Read();
                        $read->ExeRead("app_clientes", "WHERE nome LIKE '%' :a '%' OR cpf LIKE '%' :a '%' OR cnpj LIKE '%' :a '%'  LIMIT :limit OFFSET :offset", 
                                "a={$_SESSION["busca"]}&limit={$pager->getLimit()}&offset={$pager->getOffset()}");
                        $read->getResult();
                        if($read->getResult()){
                            echo " <table class=\"table\"> 
                    <thead class=\"bg-dark\" style=\"color:#fff;\"> 
                        <tr>
                            <th>Tipo </th>
                            <th>Cliente </th>
                            <th>Documento</th>
                            <th>Pedidos </th>
                            <th>Novo Pedidos </th>
                            <th>Cobranças </th>
                            <th>Atendimentos </th>
                            <th>Doc </th>
                            <th>Editar </th>
                            <th>Excluir </th>

                        </tr>
                    </thead>

                    <tbody> ";
                            
                            
                        foreach ($read->getResult() as $cliente):
                            ?>
                            <tr> 
                                <td><?php
                                if($cliente["tipo"] == "1"){
                                    echo "<b>FISICA</b>";
                                }
                                if($cliente["tipo"] == "2"){
                                    echo "<b>JURIDICA</b>";
                                }
                                $cliente["tipo"] ?> </td>
                                <td><?= $cliente["nome"] ?>  </td>
                                <td><?= $cliente["cpf"] ?> <?= $cliente["cnpj"] ?></td>
                               <!-- Modal Pedidos -->
                                <td>
                                <!-- Button trigger modal -->
<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#Modal<?= $cliente["id"] ?>">
  Pedidos
</button>

<!-- Modal -->
<div class="modal fade" id="Modal<?= $cliente["id"] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pedidos <?= $cliente["id"] ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <h3> Pedidos</h3>
          
          
          
          
          <div class="accordion" id="accordionExample">
              
           <?php 
           $view = new \Source\Models\Read();
           $view->ExeRead("app_pedidos", "WHERE cliente_id = :a AND user_id = :b", "a={$cliente["cliente_id"]}&b={$_SESSION["user_id"]}");
           $view->getResult();
           $i=0;
           foreach ($view->getResult() as $pedido) {
               $i++;
           ?>   
              
  <div class="card">
    <div class="card-header" id="headingOne">
      <h2 class="mb-0">
        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse<?= $i ?>" aria-expanded="false" aria-controls="collapseOne">
            Pedido nº <?= $pedido["pedido_id"] ?> - data <?= date("d/m/Y H:i:s" , strtotime($pedido["data"]));  ?> - cliente <?= $pedido["cliente_id"] ?>
        </button>
      </h2>
    </div>

    <div id="collapse<?= $i ?>" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
          <!-- Veiculos -->
          <?php 
          $rveiculos = new \Source\Models\Read();
          $rveiculos->ExeRead("app_veiculos", "WHERE pedido_id = :a AND cliente_id = :b AND user_id = :c", 
                  "a={$pedido["pedido_id"]}&b={$pedido["cliente_id"]}&c={$_SESSION["user_id"]}");
          $rveiculos->getResult();
          if($rveiculos->getResult()){
          foreach ($rveiculos->getResult() as $veiculos) {

          ?>
          <div class="row">
          <p class="col-md-4">Tipo: <?= $veiculos["tipo"] ?> </p>
          <p class="col-md-4">Modelo: <?= $veiculos["modelo"] ?> </p>
          <p class="col-md-4">Marca: <?= $veiculos["marca"] ?> </p>
          <p class="col-md-4">Ano: <?= $veiculos["ano"] ?> </p>
          <p class="col-md-4">Cor: <?= $veiculos["cor"] ?> </p>
          <p class="col-md-4">Placa: <?= $veiculos["placa"] ?> </p>
          <p class="col-md-4">Chassi: <?= $veiculos["chassi"] ?> </p>
          <p class="col-md-4">Renavam <?= $veiculos["renavam"] ?> </p>
          <p class="col-md-4">FIPE: <?= $veiculos["fipe"] ?> </p>
          <p class="col-md-4">Valor <?= $veiculos["valor"] ?> </p>
          <p class="col-md-4">Plano: <?php 
          $plano = new \Source\Models\Read();
          $plano->ExeRead("app_planos_user", "WHERE id = :a", "a={$veiculos["plano_id"]}");
        // echo $plano->getResult()[0]["plano"];
           ?> </p>
          <p class="col-md-4"> 
          Mensal <?php // $plano->getResult()[0]["valor"]?>
          </p>
          </div>
          
          <div class="row"> 
              <p class="col-md-12 border-bottom"><b>Itens do Pedido</b></p>
              <?php 
              $item = new \Source\Models\Read();
              $item->ExeRead("app_itens", "WHERE user_id = :a AND pedido_id = :b", 
                      "a={$_SESSION["user_id"]}&b={$pedido["pedido_id"]}");
                      $item->getResult();
                      if(!empty($item->getResult())){
                      foreach ($item->getResult() as $itens) {
              ?>
              
              <p class="col-md-4">QTD: <?= $itens["qtd"] ?> </p>
              <p class="col-md-4">Item: <?= $itens["descricao"] ?> </p>
              <p class="col-md-4">Valor Unit:<?= $itens["valor_unit"] ?> </p>
              
                      <?php }}else{ ?>
              <p class="alert alert-warning"> Não existem itens cadastrados no pedido </p>
                      <?php } ?>       
          </div>
          <?php }} ?>
          
          <div class="col-md-12"> 
              <div class="row"> 
                  <div class="col-md-12"> <b>Documentos</b> </div>
                  <div class="col-md-3"><a href="<?=CONF_URL_BASE ?>/documentos/adesao.php?pedido=<?= $pedido["pedido_id"] ?>&cliente=<?= $pedido["cliente_id"] ?>" target="_blank">Adesão</a> </div>
                  <div class="col-md-3"><a href="<?=CONF_URL_BASE ?>/documentos/ordem-servico.php?pedido=<?= $pedido["pedido_id"] ?>" target="_blank">Ordem Serviço</a> </div>
                  <div class="col-md-3"><a href="<?=CONF_URL_BASE ?>/documentos/contrato.php?pedido=<?= $pedido["pedido_id"] ?>" target="_blank">Contrato</a> </div>
                  <div class="col-md-3"><a href="<?=CONF_URL_BASE ?>/documentos/recibo.php?pedido=<?= $pedido["pedido_id"] ?>" target="_blank">Recibo</a> </div>
              
              </div>
          </div>
          
      </div>
    </div>
  </div>
              
              <?php } ?>      
              

</div>
  
          
      </div>
      <div class="modal-footer">
     
      </div>
    </div>
  </div>
</div>
                                    
                                </td>
                                
                                 <!--Fim Modal Pedidos -->
                                
                                <!-- envia os dados via post para cadastro do pedido -->
                                <td>
                                    <form action="./?p=pedido" method="post"> 
                                        <input type="hidden" name="cliente_id" value="<?= $cliente["cliente_id"] ?>" />
                                        <input type="submit" name="submit" value="+ Novo Pedido"class="btn btn-success" />
                                    </form> </td>
                                
                                
                                <td><p class="btn btn-primary"> COBRANÇAS</p> </td>
                                <td><p class="btn btn-dark"> ATENDIMENTOS</p> </td>
                                <td><p class="btn btn-warning"> DOC</p> </td>
                                <td><p class="btn btn-info"><a style="text-decoration: none; color:#fff;" href="./cliente/cadastra&edit=<?= $cliente["cliente_id"] ?>">Editar</a></p> </td>
                                <td><p class="btn btn-danger">Excluir</p> </td>
                            </tr>
                        <?php endforeach; ?> 
                        <?php } else { ?>
                            
                    <div class="col-md-12 alert alert-warning"> Nenhum resultado encontrado </div>   
                        <?php } ?>

                    </tbody>

                </table>
                
                <?php
                    $pager->ExePaginator("app_clientes");
                    echo $pager->getPaginator();
                    ?>

            </div>


       
