<div class="col-md-12"> 
    <?php
    $filtro = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    unset($filtro['files']);
    unset($filtro['cadastra']);
    if ($filtro):


        $cad = new Create();
        $cad->exeCreate("contrato", $filtro);
        $cad->getResult();

        if ($cad->getResult()):
            echo "<div class=\"alert alert-success\" role=\"alert\">cadastro realizado com sucesso</div>";

        else:
            echo "<div class=\"alert alert-danger\" role=\"alert\">Erro ao cadastrar</div>";

        endif;

    endif;


    //var_dump($filtro);
    ?>

    <div class="page-header"> <h3>Inserir Contratos</h3> </div>
    <form name="form" action="" method="post"> 
        <div class="form-group"> 
            <label>Nome Contrato </label>
            <input type="text" class="form-control" name="contrato" />
        </div>
        <div class="form-group">
            <textarea id="summernote" name="termos"> </textarea>
        </div>
        <div class="form-group">
            
            <input type="submit" name="cadastra" class="btn btn-primary" value="CADASTRAR" />
        </div>

    </form>
</div>