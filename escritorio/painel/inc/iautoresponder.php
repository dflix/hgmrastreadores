<div class="col-md-12"> 
    <h3>INSERIR AUTO RESPONDER </h3>
     <?php
        $form = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($form['sendpost'])):
            unset($form['sendpost']);

            $cadastra = new Create;
            $cadastra->ExeCreate('ws_propostas', $form);
            $cadastra->getResult();

            if (!empty($cadastra->getResult())):
                WSErro("Auto Responder cadastrado com sucesso", WS_ACCEPT);
            else:
                WSErro("Deu merda ai", WS_ERROR);
            endif;
        endif;
        //var_dump($form);
        ?>
    
    
    <form name="PostForm" action="" method="post" enctype="multipart/form-data" >

            <div class="form-group"> 
                <p class="fonteform"> NOME AUTO RESPONDER </p>
                <input type="text" name="nome_proposta" class="form-control" value="" />
            </div>
            <div class="form-group">  
            <p class="fonteform" > HTML DE RESPOSTA </p>
            <textarea name="proposta" class="form-control" id="summernote"> </textarea>
            </div>
            </br>
            <label> 
                <input type="submit" class="btn btn-primary" name="sendpostedit" value="cadastrar" />
            </label>
        </form>
    
</div>
