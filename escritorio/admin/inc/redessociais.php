<section class="main"> 

    <header>
        <h1>Inserir Redes Sociais</h1>
        <?php 
        
        $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        
       if(isset($post)):
           
       
        if(!empty($post['SendForm'])):
            unset($post['SendForm']);
        endif;
        
        $update = new Update;
        $update->ExeUpdate('ws_social', $post , "WHERE ws_socialid = :p", "p=1");
        $update->getResult();
        
        if(!empty($update->getResult())):
            WSErro("Dados atualizados com sucesso", WS_ACCEPT);
 
            else:
            WSErro("Deu merda", WS_ERROR);
        endif;
        endif;
        
         
         echo "<hr>";
         $ler = new Read;
         $ler->ExeRead('ws_social', "WHERE ws_socialid = :p", "p=1");
         $ler->getResult();
         
         
         
        ?>
        
        <header>
            <article>

                <form name="PostSend" action="" method="post" enctype="multipart/form-data" >

                    <label> 
                        <p class="fontform"> Facebook </p>
                        <input type="text" name="facebooklink" class="campos" value="<?php print_r ($ler->getResult()[0]['facebooklink']); ?>" />
                    </label>
                    <label> 
                        
                                        <label> 
                        <p class="fontform"> Twitter </p>
                        <input type="text" name="twitterlink" class="campos" value="<?php print_r ($ler->getResult()[0]['twitterlink']); ?>" />
                    </label>
                    <label> 
                        <p class="fontform"> G+ </p>
                        <input type="text" name="googlelink" class="campos" value="<?php print_r ($ler->getResult()[0]['googlelink']); ?>" />
                    </label>
                    <label> 
                        <p class="fontform"> Youtube </p>
                        <input type="text" name="youtubelink" class="campos" value="<?php print_r ($ler->getResult()[0]['youtubelink']); ?>" />
                    </label>
                    <label> 
                        <p class="fontform"> Instagram </p>
                        <input type="text" name="instagramlink" class="campos" value="<?php print_r ($ler->getResult()[0]['instagramlink']); ?>"  />
                    </label>
                    <label> 
                        <p class="fontform"> Linkedin </p>
                        <input type="text" name="linkedinlink" class="campos" value="<?php print_r ($ler->getResult()[0]['linkedinlink']); ?>" />
                    </label>
                    <br>
                    <input type="submit" name="SendForm" value="Atualizar Redes Sociais" />

                </form>

                <article>
                    </section>