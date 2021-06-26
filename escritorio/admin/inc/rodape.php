<section class="main"> 
    <header>  <h1>Rodapé do Site</h1> 
    <?php 
    $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    if(!empty($post['sendpost'])):
        unset($post['sendpost']);
    
    $cadastra = new Create;
    $cadastra->ExeCreate('ws_footer', $post);
    $cadastra->getResult();
    
    if(!empty($cadastra->getResult())):
        WSErro("Cadastro com sucesso", WS_ACCEPT);
    else:
        WSErro("Erro de cadastro", WS_ERROR);
    endif;
    
    
    endif;
    
    if(!empty($_GET['del'])):
        
        $del = new Delete();
    $del->ExeDelete('ws_footer', "WHERE id_footer = :p", "p={$_GET['del']}");
    $del->getResult();
    
        if(!empty($del->getResult())):
        WSErro("Cadastro Excluido com sucesso.", WS_ACCEPT);
    else:
        WSErro("Erro ao excluir", WS_ERROR);
    endif;
    
    
        
    endif;
    
    ?>
    </header>
    <article>
        <form action="" method="post" enctype="multipart/form-data"> 
            <label> 
                <p> Titulo do Bloco </p>
                <input type="text" name="title_footer" class="campos" />
            </label>
            
                        <label> 
                <p> Script ou textos </p>
                <input type="text" name="script_footer"  class="camposdescription"/> 
            </label>
        <input type="submit" value="CADASTRAR" name="sendpost" />
        </form>
        
                <div class="blocoformulariotop">
            <div class="blocoformulario20"> Titulo Rodapé </div>
            <div class="blocoformulario70"> Script Rodape </div>
            
            <div class="blocoformulario5">Deletar </div>
            <div class="clear"> </div>
        </div>
        
        <?php 
        $read = new Read;
        $read->ExeRead("ws_footer");
        $read->getResult();
        
        if(!empty($read->getResult())):
            
            foreach ($read->getResult() as $footer) {
                           echo "  <div class=\"blocoformulario\">
            <div class=\"blocoformulario20\"> {$footer['title_footer']} </div>
            <div class=\"blocoformulario70\"> {$footer['script_footer']} </div>
            
            <div class=\"blocoformulario5\"><a href=\"painel.php?p=rodape&del={$footer['id_footer']}\"> Deletar </a> </div>
            <div class=\"clear\"> </div>
        </div>"; 
            }

        endif;
        
        ?>

        <article>
            </section>