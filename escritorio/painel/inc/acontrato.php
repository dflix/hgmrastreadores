<div class="col-md-12"> 
    <?php
    $filtro = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    unset($filtro['files']);
    unset($filtro['cadastra']);
    if ($filtro):


        $cad = new Update();
        $cad->ExeUpdate("contrato", $filtro, "WHERE id_contrato = :a", "a={$filtro['id_contrato']}");
     
        $cad->getResult();

        if ($cad->getResult()):
            echo "<div class=\"alert alert-success\" role=\"alert\">atualização realizado com sucesso</div>";

        else:
            echo "<div class=\"alert alert-danger\" role=\"alert\">Erro ao atualizar</div>";

        endif;

    endif;


    //var_dump($filtro);
    ?>

    <div class="page-header"> <h3>Atualizar Contratos</h3> </div>
    <form name="form" action="" method="post"> 
        
        <?php 
        $print = new Read();
        $print->ExeRead("contrato", "WHERE id_contrato = :a", "a={$_GET['contrato']}");
        $print->getResult();
        ?>
        <div class="form-group"> 
            <label>Nome Contrato </label>
            <input type="text" class="form-control" name="contrato" value="<?= $print->getResult()[0]['contrato'] ?>" />
        </div>
        <div class="form-group">
            <textarea id="summernote" name="termos"> <?= $print->getResult()[0]['termos'] ?> </textarea>
        </div>
        <div class="form-group">
            <input type="hidden" name="id_contrato" value="<?= $print->getResult()[0]['id_contrato'] ?>" />
            <input type="submit" name="cadastra" class="btn btn-primary" value="CADASTRAR" />
        </div>

    </form>
</div>