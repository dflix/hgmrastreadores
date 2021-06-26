<div class="col-md-12"> 
    <h3>ATUALIZAR AUTO RESPONDER </h3>
    
    <?php 
    
    $filtro = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    
    if($filtro['sendpostedit']):
        unset($filtro['sendpostedit']);
        
    $atualiza = new Update();
    $atualiza->ExeUpdate("ws_propostas", $filtro,"WHERE id_proposta = :p", "p={$filtro['id_proposta']}");
    $atualiza->getResult();
    
    if($atualiza->getResult()):
        echo "<div class=\"alert alert-success\" role=\"alert\"><B>ATUALIZOU</B> com sucesso</div>";

        else:
             echo "<div class=\"alert alert-danger\" role=\"alert\">ERRO, error, ERROU, fudeu !!! </div>";
        
    endif;
        
       // var_dump($filtro);
        
    endif;
    
    
    
    
    $ver = new Read();
    $ver->ExeRead("ws_propostas", "WHERE id_proposta = :p", "p={$_GET['id']}");
    $ver->getResult();
    ?>

    
    
    <form name="PostForm" action="" method="post" enctype="multipart/form-data" >

            <div class="form-group"> 
                <p class="fonteform"> NOME AUTO RESPONDER </p>
                <input type="text" name="nome_proposta" class="form-control" value="<?= $ver->getResult()[0]['nome_proposta'] ?>" />
            </div>
            <div class="form-group">  
            <p class="fonteform" > HTML DE RESPOSTA </p>
            <textarea name="proposta" class="form-control" id="summernote"> <?= $ver->getResult()[0]['proposta'] ?></textarea>
            </div>
            </br>
            <label> 
                <input type="hidden" name="id_proposta" value="<?= $ver->getResult()[0]['id_proposta'] ?>" />
                <input type="submit" class="btn btn-primary" name="sendpostedit" value="cadastrar" />
            </label>
        </form>
    
</div>
