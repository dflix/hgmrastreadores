<main>
    <div class="page-header"> 
        <h3> Indicações HGM </h3>

        <?php
        if (isset($_GET['del'])):

            $deleta = new Delete();
            $deleta->ExeDelete("app_leads", "WHERE id = :a", "a={$_GET['del']}");
            $deleta->getResult();

            if ($deleta->getResult()):
                echo "<div class=\"alert alert-success\" role=\"alert\">Indicação deletada com sucesso</div>";
            else:
                echo "<div class=\"alert alert-danger\" role=\"alert\">Erro ao deletar indicação</div>";
            endif;

        endif;


        $filtro = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if ($filtro && $filtro['sendorca']):
            unset($filtro['sendorca']);

            $update = new Update();
            $update->ExeUpdate("app_leads", $filtro, "WHERE id = :o", "o={$filtro['id']}");
            $update->getResult();

            if ($update->getResult()):

                echo "<div class=\"alert alert-success\" role=\"alert\">Registro atualizado com sucesso</div>";

            else:

                echo "<div class=\"alert alert-danger\" role=\"alert\">ERRO</div>";
            endif;

        endif;
        ?>


    </div> 

    <div class="col-md-12"> 

        <table class="table table-striped table-bordered table-hover table-condensed">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Veiculo</th>
                    <th>Valor</th>
               
                    <th>Telefone</th>
                   
                    <th>Status</th>
                    <th>Atendimento</th>
                    <?php
                    if ($_COOKIE['logprot_nivel'] <> "2") {
                        ?>
                        <th>Vendedor</th>
                        <th>Deletar</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
<!--   				<tr>
                            <td>Notebook 980</td>
                            <td>HP</td>
                            <td>R$ 1.800,00</td>
                    </tr>

                    </tr>-->


                <!--    <div class="background dez"> Data </div>
                    <div class="background vinte">Nome </div>
                    <div class="background vinte">Email </div>
                    <div class="background dez">Veiculo </div>
                    <div class="background dez">Valor </div>
                    <div class="background dez">Celular </div>
                    <div class="background dez">Telefone </div>
                    <div class="background dez">Vendedor </div>
                    <hr>
                    <div class="clear"> </div>-->

                <?php
                $atual = filter_input(INPUT_GET, 'atual', FILTER_VALIDATE_INT);
                $pager = new Pager('index.php?p=indicacao&atual=', 'Primeira', 'Ultima', '1');
                $pager->ExePager($atual, 10);

                if ($_COOKIE['logprot_nivel'] == "2"):
                    $exibe = new Read();
                    $exibe->ExeRead("app_leads", "WHERE vendedor = :p ORDER BY id DESC LIMIT :limit OFFSET :offset", "p={$_COOKIE['logprot_id_usuario']}&limit={$pager->getLimit()}&offset={$pager->getOffset()}");
                    $exibe->getResult();

                else:

                    $exibe = new Read();
                    $exibe->ExeRead("app_leads", "ORDER BY id DESC LIMIT :limit OFFSET :offset", "limit={$pager->getLimit()}&offset={$pager->getOffset()}");
                    $exibe->getResult();

                endif;



                foreach ($exibe->getResult() as $value) {
                    ?>
                    <tr>
                        <td> <?php
                $data = $value['data'];
                $exibedata = date('d/m/Y H:i:s', strtotime($data));
                echo $exibedata;
                    ?>  </td>
                        <td><span class="branquinho">.</span><b><?php echo $value['nome']; ?> </b></td>
                        <td><span class="branquinho">.</span><?php echo $value['email']; ?> </td>
                        <td><span class="branquinho">.</span><?php echo $value['modelo']; ?> </td>
                        <td><span class="branquinho">.</span><b><?php
                        echo $value['valor'];


                    ?> </b> </td>
                      
                        <td><span class="branquinho">.</span><?php echo $value['telefone']; ?> </td>
                    

                        <td> <?php
                            $status = $value['status'];
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
                            ?>  </td>

                        <td> 
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal<?= $value['id'] ?>">
                                Atendimento
                            </button>
                        </td>

                        <!-- Modal -->
                <div class="modal fade" id="myModal<?= $value['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Orçamento numero <?= $value['id'] ?> </h4>
                            </div>
                            <div class="modal-body">
    <?php
    $modal = new Read();
    $modal->ExeRead("app_leads", "WHERE id = :r", "r={$value['id']}");
    $modal->getResult();
    ?>

                                <div class="col-md-12"> 
                                    <h3> AFILIADO <?php
//                                $pxaff = $modal->getResult()[0]['aff'];
//
//                                $aff = new Read();
//                                $aff->ExeRead("usuario", "WHERE id_usuario = :i", "i={$pxaff}");
//                                $aff->getResult();
//
//                                echo $aff->getResult()[0]['nome'];
                                ?></h3>

                                        <?php
                                        $vstatus = $modal->getResult()[0]['status'];

                                        if ($vstatus == "1"):
                                            echo "<div class=\"alert alert-info\" role=\"alert\">Aguardando Atendimento</div>";
                                        endif;
                                        if ($vstatus == "2"):
                                            echo "<div class=\"alert alert-warning\" role=\"alert\">Em Atendimento</div>";
                                        endif;
                                        if ($vstatus == "3"):
                                            echo "<div class=\"alert alert-success\" role=\"alert\">Vendido</div>";
                                        endif;
                                        if ($vstatus == "4"):
                                            echo "<div class=\"alert alert-danger\" role=\"alert\">Não Vendido</div>";
                                        endif;
                                        ?>

                                </div>

                                <div class="row"> 
                                    <div class="col-md-6"><b> Nome :</b></br> <?= $modal->getResult()[0]['nome'] ?>  </div>
                                    <div class="col-md-6"><b> E-mail :</b></br> <?= $modal->getResult()[0]['email'] ?>  </div>
                                    <div class="col-md-3"><b> Telefone :</b></br> <?= $modal->getResult()[0]['telefone'] ?>  </div>
                                   
                                    <div class="col-md-3"><b> Veiculo :</b></br> <?= $modal->getResult()[0]['modelo'] ?>  </div>
                                    <div class="col-md-3"><b> Valor :</b></br> <?= $modal->getResult()[0]['valor'] ?>  </div>

                                </div>

                                <div class="col-md-12"> 
                                    <h3>HISTORICO DE ATENDIMENTO </h3>
                                    <p> <?php
                                if ($modal->getResult()[0]['historico']):
                                    echo $modal->getResult()[0]['historico'];
                                else:
                                    echo "Não possui histórico de atendimentos";
                                endif;
                                ?> </p>
                                </div>
                                <hr>
                                <div class="col-md-12"> 

                                    <form action="" method="post"> 
                                        <h3>ATUALIZAR HISTÓRICO DE ATENDIMENTO </h3>
                                        <div class="form-group"> 
                                            <textarea name="historico"  class="form-control"> <?= $modal->getResult()[0]['historico'] ?>  </textarea>
                                        </div>
                                        <div class="form-group"> 
                                            <select name="status" class="form-control"> 
                                                <option value="0">Selecione status </option>
                                                <option value="1">Aguardando atendimento </option>
                                                <option value="2">Em atendimento </option>
                                                <option value="3">Vendido </option>
                                                <option value="4">Não vendido </option>
                                            </select>
                                        </div>

                                        <div class="col-md-12"> 
                                            <input type="hidden" name="id_orca" value="<?= $modal->getResult()[0]['id'] ?>" />
                                            <input type="submit" name="sendorca" value="CADASTRAR" class="btn btn-primary" />
                                        </div>
                                    </form> 

                                </div>



                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                <!--        <button type="button" class="btn btn-primary">Save changes</button>-->
                            </div>
                        </div>
                    </div>
                </div>

    <?php
    if ($_COOKIE['logprot_nivel'] <> "2") {
        ?>

                    <td><span class="branquinho">.</span><?php
        $vend = new Read();
        $vend->ExeRead("usuario", "WHERE id_usuario= :p", "p={$value['vendedor']}");
        $vend->getResult();

        if ($vend->getResult()):
            echo "<p class=\"azul\">{$vend->getResult()[0]['nome']}</p>";
        else:
            echo "<p class=\"azul\"><b>Selecione Vendedor</b></p>";
        endif;
        ?>

                        <?php
                        $form = filter_input_array(INPUT_POST, FILTER_DEFAULT);

                        if ($form && $form['indicacao']):
                            unset($form['indicacao']);

                            $indicar = new Update();
                            $indicar->ExeUpdate("app_leads", $form, "WHERE id= :p", "p={$form['id']}");
                            $indicar->getResult();

                            if ($indicar->getResult()):
                                echo "Indicação enviada com sucesso para usuario {$form['vendedor']}";
                                echo "<meta http-equiv=\"refresh\" content=0;url=\"index.php?p=indicacao\">";
                            endif;


                        endif;
                        ?>

                        <form action="" method="post" class="form"> 

                            <label> 
                                <select name="vendedor" class="form-control"> 
                                    <option value="#"> Selecione Vendedor</option>
                        <?php
                        $loopvend = new Read();
                        $loopvend->ExeRead("usuario", "WHERE nivel = :p", "p=2");
                        $loopvend->getResult();

                        foreach ($loopvend->getResult() as $valor) {
                            echo "<option value=\"{$valor['id_usuario']}\"> {$valor['nome']}</option>";
                        }
                        ?>

                                </select>
                            </label>
                            <input type="hidden" name="id" value="<?php echo $value['id']; ?>" />

                            <input type="submit" value="enviar" name="indicacao" class="btn btn-success" />

                        </form>





                    </td>

                    <td> <a href="index.php?p=indicacao&del=<?= $value['id'] ?>"><span class="glyphicon glyphicon-remove" style="font-size: 2.0em; color: #F00;"> </span></a> </td>
    <?php } ?>
                </tr>



<?php } ?>

            </tbody>
        </table>

<?php
$pager->ExePaginator("orcamento");

echo $pager->getPaginator();
?>


    </div>

</main>


