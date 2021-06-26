<main> 

    <h1> Assistência 24 horas </h1>
    <?php 
   //require('../../_app/Config.inc.php');
    $form = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    if($form && $form['sendassist']):
        unset($form['sendassist']);
    
    $inserir = new Create();
    $inserir->exeCreate("assist_protege", $form);
    $inserir->getResult();
    
    if($inserir->getResult()):
        echo "<b>Registro cadastrado com sucesso</b>";
    else:
        echo "<b>ERRO no cadastro</b>";
    endif;

    
    endif;
    
    var_dump($form);
    ?>
    
    <form name="assitencia" action="" method="post" enctype="multipart/form-data" > 
        
        <label> 
            <p> Descrição do plano de assitencia 24hs</p>
            <input type="text" name="descricao" />
        </label>
        </br>
        <label> 
            <p> Valor</p>
            <input type="text" name="valor" placeholder="inserir .(ponto) ao invés de ,(virgula) = 19.90" />
        </label>
        </br>
        <label> 
            <input type="submit" name="sendassist" value="CADASTRAR" />
        </label>
        </br>
    
    
    </form>
    
    
    <hr><hr> </br> </br>
    
    <?php 
    
    $deleta = filter_input(INPUT_GET, 'del', FILTER_VALIDATE_INT);
               
    
   
    if(isset($deleta)):
        
        $deletar = new Delete();
    $deletar->ExeDelete("assist_protege", "WHERE id = :p", "p={$deleta}");
    $deletar->getResult();
    if($deletar->getResult()):
        echo "Registro removido com sucesso";
    else:
        echo "ERRO ao remover registro";
    endif;
        
    endif;
    
    $exibe = new Read();
    $exibe->ExeRead("assist_protege", "ORDER BY id DESC");
    $exibe->getResult();
    
    foreach ($exibe->getResult() as $value) {
        
        echo "    <section> 
        <article> 
            <p><b> Tipo de Plano:{$value['descricao']} </b> >> <b> Valor:{$value['valor']} </b> >> <a href=\"index.php?p=assistencia&del={$value['id']}\">Deletar</a> </p>
                </br>
        </article>
    </section>
    <section> <hr> </br> ";
            
        
    }
    
    ?>
    
    
   
      
</main>
</br> </br></br> </br>