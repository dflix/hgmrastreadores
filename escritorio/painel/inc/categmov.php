


<main> 

    <div class="page-header">
        <h3> Categorias </h3>
    </div>

    <div class="col-md-12"> 

        <?php
        if (isset($_GET['del'])):

            $a = date("Y");
            $m = date("m");

            $vermov = new Read();
            $vermov->ExeRead("caixa", "WHERE categoria = :c AND YEAR(data) = :a AND MONTH(data) = :m ", "c={$_GET['del']}&a={$a}&m={$m}");
            $vermov->getResult();

            if ($vermov->getResult()):
                
                echo "<div class=\"alert alert-danger\" role=\"alert\">Categoria não pode ser excluida pois contém movimentos</div>";
            else:


                $del = new Delete();
                $del->ExeDelete("categmov", "WHERE id_categ = :p", "p={$_GET['del']}");
                $del->getResult();

                if ($del->getResult()):
                    echo "<div class=\"alert alert-success\" role=\"alert\">Categoria <b>EXCLUIDA</b> com sucesso ...</div>";

                else:

                    echo "<div class=\"alert alert-danger\" role=\"alert\">ERRO ao excluir categoria</div>";

                endif;
            endif;

        endif;

        $filtro = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if ($filtro && $filtro['sendcateg']):

            unset($filtro['sendcateg']);

            $create = new Create();
            $create->ExeCreate("categmov", $filtro);
            $create->getResult();


            if ($create->getResult()):

                echo "<div class=\"alert alert-success\" role=\"alert\">Categoria cadastrada com sucesso ...</div>";

            else:

                echo "<div class=\"alert alert-danger\" role=\"alert\">ERRO ao cadastrar categoria</div>";

            endif;


        endif;



        var_dump($filtro);
        ?>

        <form method="post" name="icateg" class="form"> 

            <div class="form-group"> 
                <label>CATEGORIA </label>
                <input type="text" class="form-control" name="categoria" />    
            </div>
            <div class="form-group form-inline"> 
                <label>TIPO </label>
                <select name="tipo" class="form-control"> 
                    <option value="#">SELECIONE OPÇÃO </option>
                    <option value="1">ENTRADA </option>
                    <option value="2">SAIDA </option>
                </select>
            </div>
            <input type="submit" name="sendcateg" value="cadastrar" class="btn btn-primary" />

        </form>

    </div>

    <div class="col-md-6"> 

        <h3> ENTRADAS </h3>

        <table class="table table-striped table-bordered table-hover table-condensed">
            <thead>
                <tr>
                    <th>CATEGORIA</th>
                    <th>TIPO</th>
                    <th>DEL</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $read = new Read();
                $read->ExeRead("categmov", "WHERE tipo = :t", "t=1");
                $read->getResult();

                foreach ($read->getResult() as $value) {
                    ?>
                    <tr>
                        <td><?= $value['categoria'] ?></td>
                        <td><?= $value['tipo'] ?></td>
                        <td><a href="index.php?p=categmov&del=<?= $value['id_categ'] ?>" class="btn btn-danger">deletar</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

    </div>
    <div class="col-md-6"> 

        <h3> SAIDAS </h3>

        <table class="table table-striped table-bordered table-hover table-condensed">
            <thead>
                <tr>
                    <th>CATEGORIA</th>
                    <th>TIPO</th>
                    <th>DEL</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $read = new Read();
                $read->ExeRead("categmov", "WHERE tipo = :t", "t=2");
                $read->getResult();

                foreach ($read->getResult() as $value) {
                    ?>
                    <tr>
                        <td><?= $value['categoria'] ?></td>
                        <td><?= $value['tipo'] ?></td>
                        <td><a href="index.php?p=categmov&del=<?= $value['id_categ'] ?>" class="btn btn-danger">deletar</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>


    </div>


</main>

