<section class="main">

    <header> 
        <?php
        $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if ($post):

            require('models/AdminBanner.class.php');
            $upload = new AdminBanner;

            $imagem = $_FILES['imagem'];

            $upload->Image($imagem);
            if (!$upload->getResult()):
                WSErro("Erro ao enviar Imagem:<br> <small>{$upload->getError()} </small>", WS_ERROR);
            else:
                WSErro("Imagem enviada com sucesso><br><small> {$upload->getResult()} </small>", WS_ACCEPT);
            endif;

            echo "<hr>";

        endif;
        ?>
        <h1> Banners</h1>
    </header>

    <article>

        <form name="fileForm" action="" method="post" enctype="multipart/form-data">
            <label>
                <input type="file" name="imagem"/>
            </label>

            <label>
                <p class="fontform"> Descrição da imagem</p>
                <textarea name="description" maxlength="200" class="camposdescription"> </textarea>
            </label>
            <label>
                <p class="fontform"> Link da Imagem</p>
                <input type="text" name="link" class="campos"/>
            </label>
            </br>
            <input type="submit" name="sendImage" value="enviar arquivo!"/>
        </form>
        
        </hr>
        
        <div class="blocobannertop"> 
            <div class="blocobanner50"> Imagem </div>
            <div class="blocobanner40"> Descrição</div>
            <div class="blocobanner5" > Editar </div>
            <div class="blocobanner5" > Deletar </div>
        </div>
        
        <?php 
        
        $read = new Read;
        $read->ExeRead('ws_banner');
        $read->getResult();
        $link = "http://www.www.rastreadoresprotege.com.br/uploads";
        if(!empty($read->getResult())):
            
            foreach ($read->getResult() as $banner) {
            extract($banner);
            
            echo "        
            <div class=\"blocobanner\"> 
            <div class=\"blocobanner50\"> <img src=\"http://www.rastreadoresprotege.com.br/uploads/{$banner['imagem']}\" width=\"100%\" /> </div>
            <div class=\"blocobanner40\"> {$banner['description']}</div>
            <div class=\"blocobanner5\" ><a href=\"painel.php?p=banner&del={$banner['id_banner']}&caminho={$banner['imagem']}\"> <img src=\"icons/act_delete.png\" /> </a></div>
            
            <div class=\"clear\"> </div>
        </div>
        ";
                
            }
            
        endif;
        $caminho = "../uploads/";
        $del = $_GET["del"];
        $caminho2 = $_GET["caminho"];
        
       echo $arquivo = $caminho . $caminho2;
        $deleta = new Delete;
        $deleta->ExeDelete('ws_banner', "WHERE id_banner = :p", "p={$del}");
        $deleta->getResult();
        if(isset($arquivo)):
         unlink('../uploads/'.$_GET["caminho"].''); 
        
        endif;
        
 
        
   
        
        
        
        ?>
        


</section>