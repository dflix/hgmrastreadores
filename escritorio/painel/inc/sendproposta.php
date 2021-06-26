<div class="row">
    <div class="col-md-12"> <botton class="btn btn-primary"> <a href="enviarpropostawebfin" target="_blank" style="text-decoration:none; color:#fff;"> VIDEO TREINAMENTO </a> </botton> </div>
    <div class="col-md-6"> 
        <h3 class="page-header">ENVIAR PROPOSTAS </h3>

        <?php
        $form = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if ($form):
            // var_dump($form);


            $form['assunto'] = "{$form['assunto']}";
            $form['DestinoNome'] = 'comercial@protegefacil.com.br';
            $form['DestinoEmail'] = "{$form['email']}";

            $enviar = new EnviaProposta();
            $enviar->Enviar($form);
            $enviar->getResult();

            if ($enviar->getResult()):
                echo "<div class=\"alert alert-success\" role=\"alert\">Proposta Enviada sucesso</div>";
                $Dados = [
                    "id_usuario" => $_POST['id_usuario'],
                    "nome" => $_POST['nome'],
                    "email" => $_POST['email'],
                    "titulo" => $_POST['assunto'],
                    "proposta" => $_POST['proposta'],
                    "data" => date("Y-m-d H:i:s"),
                    "relacionado" => $_COOKIE['logprot_id_usuario']
                ];
                $cad = new Create();
                $cad->ExeCreate("sendpropostas", $Dados);
                $cad->getResult();
            //echo "<meta http-equiv=\"refresh\" content=\"3; url=painel.php?p=vendacadastrada&cpf={$form['cpf']}\">";
            else:
                echo "<div class=\"alert alert-danger\" role=\"alert\">ERRO ao enviar email</div>";
            //echo "<meta http-equiv=\"refresh\" content=\"3; url=painel.php?p=vendacadastrada&cpf={$form['cpf']}&placa={$form['placa']}\">";
            endif;
        endif;
        ?>


        <form action="" name="form" method="post"> 
            <div class="form-group"> 
                <label>Assunto </label>
                <input type="text" class="form-control" name="assunto" />
            </div>
            <div class="form-group"> 
                <label>Nome </label>
                <input type="text" class="form-control" name="nome" />
            </div>
            <div class="form-group"> 
                <label>Email </label>
                <input type="text" class="form-control" name="email" />
            </div>
            <div class="form-group"> 
                <label>Proposta </label>
                <select name="html" class="form-control"> 
<?php
$ler = new Read();
$ler->ExeRead("proposta", "WHERE relacionado = :r ", "r={$_COOKIE['logprot_id_usuario']}");
$ler->getResult();
foreach ($ler->getResult() as $valor) {
    ?>
                        <option value="<?= $valor['id_proposta'] ?>"> <?= $valor['nome_proposta'] ?> </option>

                    <?php } ?>

                </select>
            </div>
            <div class="form-group"> 
                <input type="hidden" name="id_usuario"  value="<?= $_COOKIE['logprot_id_usuario'] ?>" />
                <input type="submit" name="sendproposta" class="btn btn-primary" value="ENVIAR" />
            </div>

        </form>
    </div>

    <div class="col-md-6"> 
        <h3 class="page-header">PROPOSTAS ENVIADAS </h3>

        <table class="table-bordered table"> 
            <thead> 
                <tr> 
                    <th>Data </th>
                    <th>Cliente</th>
                    <th>Email</th>
                    <th>Proposta</th>
                </tr>
            </thead>
            <tbody> 
<?php
$atual = filter_input(INPUT_GET, 'atual', FILTER_VALIDATE_INT);
$pager = new Pager('index.php?p=sendproposta&atual=', 'Primeira', 'Ultima', '1');
$pager->ExePager($atual, 10);

$proposta = new Read();
$proposta->ExeRead("sendpropostas", "WHERE  id_usuario = :e LIMIT :limit OFFSET :offset ", "e={$_COOKIE['logprot_id_usuario']}&limit={$pager->getLimit()}&offset={$pager->getOffset()}");
$proposta->getResult();

foreach ($proposta->getResult() as $value) {

?>
                <tr> 
                    <td> <?= date("d/m/Y H:i:s" , strtotime($value['data']))  ?> </td>
                    <td> <?= $value['nome'] ?> </td>
                    <td> <?= $value['email'] ?> </td>
                    <td>  <?= $value['proposta'] ?>
                    
                        <?php 
//$viewprop = new Read();
//$viewprop->ExeRead("proposta", "WHERE id_proposta = :r", "r={$value['proposta']}");
//$viewprop->getResult();
//
//echo $viewprop->getResult()[0]['nome_proposta'];
?>
                    
                    </td>
                </tr>
                
                
                <div class="modal fade" id="janela<?= $value['proposta'] ?>">
        
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            
            <!-- cabecalho -->
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">
                <span>&times;</span>
              </button>
             
            </div>

            <!-- corpo -->
            <div class="modal-body">

               

            </div>

            <!-- rodape -->
            <div class="modal-footer">

             

            </div>

          </div>
        </div>

      </div>
                
                <?php } ?>
            </tbody>

        </table>
        
            <?php
    $pager->ExePaginator("sendpropostas");

    echo $pager->getPaginator();
    ?>
        
    </div>

</div>