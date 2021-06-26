<div class="row">
<!--    <div class="col-md-12"> <botton class="btn btn-primary"> <a href="enviarpropostawebfin" target="_blank" style="text-decoration:none; color:#fff;"> VIDEO TREINAMENTO </a> </botton> </div>-->
    <div class="col-md-6"> 
        <h3 class="page-header">ENVIAR PROPOSTAS </h3>

        <?php
        $form = filter_input_array(INPUT_GET, FILTER_DEFAULT);

        if ($form['enviar']):
             var_dump($form);


            $form['assunto'] = "{$form['assunto']}";
            $form['DestinoNome'] = 'comercial@protegefacil.com.br';
            $form['DestinoEmail'] = "{$form['email']}";

            $enviar = new EnviaProposta();
            $enviar->Enviar($form);
            $enviar->getResult();

            if ($enviar->getResult()):
                echo "<div class=\"alert alert-success\" role=\"alert\">Proposta Enviada sucesso</div>";
                $Dados = [
                    "id_usuario" => $_GET['id_usuario'],
                    "nome" => $_GET['nome'],
                    "email" => $_GET['email'],
                    "titulo" => $_GET['assunto'],
                    "proposta" => $_GET['proposta'],
                    "data" => date("Y-m-d H:i:s"),
                    "relacionado" => $_COOKIE['logprot_id_usuario']
                ];
                $cad = new Create();
                $cad->ExeCreate("sendpropostas", $Dados);
                $cad->getResult();
                
                
                
                
                echo "<div class=\"alert alert-success\" role=\"alert\">Proposta enviada com sucesso</div>";
           // echo "<meta http-equiv=\"refresh\" content=\"10; url=index.php?assunto={$_GET['assunto']}&nome=Marcio&email=mbleusou%40gmail.com&html=16&id_usuario=5&id_orca=22&remarketing=1&p=sendpropostamaster&enviar=sim&sendproposta=ENVIAR\">";
            else:
                echo "<div class=\"alert alert-danger\" role=\"alert\">ERRO ao enviar email</div>";
            //echo "<meta http-equiv=\"refresh\" content=\"3; url=painel.php?p=vendacadastrada&cpf={$form['cpf']}&placa={$form['placa']}\">";
            endif;
        endif;
        ?>
        

        
        <?php 
        
        if(isset($_GET['enviar'])):
            
          echo  $acerto = $_GET['remarketing'] + 1;
            
            $Dados=[
                "remarketing" => $acerto
            ];
            
        $update = new Update();
        $update->ExeUpdate("orcamento", $Dados, "WHERE id_orca = :a", "a={$_GET['id_orca']}");
        $update->getResult();
        
        if($update->getResult()):
            echo "Atualizou com sucesso";
            else:
            echo "Erro ao atualizar";
        endif;
           
        ?>
        
        <?php 
        $newverifica = new Read();
        $newverifica->ExeRead("orcamento", "WHERE remarketing = :a ORDER BY id_orca ASC" , "a=1");
        
        $newverifica->getResult();
        
        ?>
        
        
        Novo Envio : <?= $newverifica->getResult()[0]['nome']; ?>
        
        <meta http-equiv="refresh" content="10; url=index.php?assunto=<?= $_GET['assunto'] ?>&nome=<?= $newverifica->getResult()[0]['nome']; ?>&email=<?= $newverifica->getResult()[0]['email']; ?>&html=<?= $_GET['html'] ?>&id_usuario=<?= $_GET['id_usuario'] ?>&id_orca=<?= $newverifica->getResult()[0]['id_orca']; ?>&remarketing=<?= $newverifica->getResult()[0]['remarketing']; ?>&p=sendpropostamaster&enviar=sim&sendproposta=ENVIAR " />
        
        <p class="btn btn-primary"> Parar tudo </p>
        
        <?php
            else:
                
        $verifica = new Read();
        $verifica->ExeRead("orcamento", "WHERE remarketing = :a ORDER BY id_orca ASC " , "a=1");
        $verifica->getResult();

       ?>


        <form action="" name="form" method="get"> 
            <div class="form-group"> 
                <label>Assunto </label>
                <input type="text" class="form-control" name="assunto" />
            </div>
            <div class="form-group"> 
                <label>Nome </label>
                <input type="text" class="form-control" name="nome" value="<?= $verifica->getResult()[0]['nome'] ?>" />
            </div>
            <div class="form-group"> 
                <label>Email </label>
                <input type="text" class="form-control" name="email" value="<?= $verifica->getResult()[0]['email'] ?>" />
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
                <input type="hidden" name="id_orca"  value="<?= $verifica->getResult()[0]['id_orca'] ?>" />
                <input type="hidden" name="remarketing"  value="<?= $verifica->getResult()[0]['remarketing'] ?>" />
                <input type="hidden" name="p"  value="sendpropostamaster" />
                <input type="hidden" name="enviar"  value="sim" />
<!--                <a href="javascript: submitform()">Envie</a>-->
               <input type="submit" name="sendproposta" class="btn btn-primary" value="ENVIAR" />
            </div>

        </form>
    <script type="text/javascript">
    function submitform() {
        document.form.submit();
    }
</script> 

<?php   endif; ?>
        
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


$proposta = new Read();
$proposta->ExeRead("sendpropostas", "WHERE  id_usuario = :e ORDER BY data DESC LIMIT 10 ", "e={$_COOKIE['logprot_id_usuario']}");
$proposta->getResult();
$proposta->getRowCount();

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

      Total de envios <?php  
      
      $geral = new Read();
      $geral->ExeRead("sendpropostas", "WHERE relacionado = :r", "r={$_COOKIE['logprot_id_usuario']}");
     echo $geral->getRowCount();
      
      ?>  
    </div>

</div>

