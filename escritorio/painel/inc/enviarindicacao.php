<main> 

    <h1> Enviar Indicações </h1>
    <?php
    //require('../../_app/Config.inc.php');
    $form = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if ($form):



        $cadastra = new Create();
        $cadastra->ExeCreate("leadafiliado", $form);
        $cadastra->getResult();

        if ($cadastra->getResult()):

            echo "<div class=\"alert alert-success\" role=\"alert\">Indicação cadastrada com sucesso</div>";

        else:

            echo "<div class=\"alert alert-danger\" role=\"alert\">ERRO ao cadastrar indicação</div>";

        endif;
    endif;

    // var_dump($form);
    ?>

    <form name="assitencia" action="" method="post" enctype="multipart/form-data" > 

        <div class="form-group"> 
            <p>Nome </p>
            <input type="text" name="nome" class="form-control" />
        </div>

        <div class="form-group"> 
            <p>Telefone 1 </p>
            <input type="text" name="tel1" class="form-control" />
        </div>

        <div class="form-group"> 
            <p>Telefone 2 </p>
            <input type="text" name="tel2" class="form-control" />
        </div>

        <div class="form-group"> 
            <p>Email </p>
            <input type="text" name="email" class="form-control" />
        </div>

        <div class="form-group"> 
            <p>Veiculo </p>
            <input type="text" name="veiculo" class="form-control" />
        </div>

        <div class="form-group"> 
            <input type="hidden" name="afiliado" value="<?= $_COOKIE['logprot_id_usuario'] ?>" />
            <input type="hidden" name="relacionado" value="<?= $_COOKIE['logprot_relacionado'] ?>" />
            <input type="hidden" name="status" value="1" />
            <input type="hidden" name="data" value="<?= date("Y-m-d H:i:s") ?>" />
            <input type="submit" class="btn btn-success" value="enviar" />
        </div>


    </form>




    <hr>

    <table class="table table-striped table-bordered table-hover table-condensed"> 

        <thead> 
            <tr> 
                <td>Data </td>
                <td>Nome </td>
                <td>Email </td>
                <td>Telefone 1 </td>
                <td>Telefone 2 </td>
                <td>Veiculo </td>
                <td>Status </td>
                <td>Historico </td>
            </tr>
        </thead>

        <tbody> 
            <?php
            $atual = filter_input(INPUT_GET, 'atual', FILTER_VALIDATE_INT);
            $pager = new Pager('index.php?p=eacasp&atual=', 'Primeira', 'Ultima', '1');
            $pager->ExePager($atual, 10);

            $ver = new Read();
            $ver->ExeRead("leadafiliado", "WHERE afiliado = :r", "r={$_SESSION['id_usuario']}");
            $ver->getResult();

            foreach ($ver->getResult() as $valor) {
                ?>
                <tr> 
                    <td><?=  date("d/m/Y H:i:s" , strtotime($valor['data'])) ?> </td>
                    <td><?= $valor['nome'] ?> </td>
                    <td> <?= $valor['email'] ?>  </td>
                    <td> <?= $valor['tel1'] ?>  </td>
                    <td> <?= $valor['tel2'] ?>  </td>
                    <td><?= $valor['veiculo'] ?>  </td>
                    <td><?php $status = $valor['status'];
                            if ($status == "1"):
                                echo "<div class=\"alert alert-info\" role=\"alert\">Aguardando Atendimento</div>";
                            endif;
                            if ($status == "2"):
                                echo "<div class=\"alert alert-warning\" role=\"alert\">Em Atendimento</div>";
                            endif;
                            if ($status == "3"):
                                echo "<div class=\"alert alert-success\" role=\"alert\">Vendido</div>";
                            endif;
                            if ($status == "4"):
                                echo "<div class=\"alert alert-danger\" role=\"alert\">Não Vendido</div>";
                            endif;
                    
                    ?> </td>
                    <td> <?= $valor['historico'] ?> </td>
                </tr>

<?php } ?>
        </tbody>

    </table>

<?php
$pager->ExePaginator("leadafiliado");

echo $pager->getPaginator();
?>



</main>
