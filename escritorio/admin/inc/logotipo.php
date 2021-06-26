<section class="main"> 

    <article>

        <h1>Inserir Logotipo</h1>

        <?php
        $form = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        
        
        
        if($form && $form['sendImage']):
            
            require('models/UploadLogo.class.php');
            $upload = new UploadLogo;
        
            $imagem = $_FILES['imagem'];
            
            $upload->Image($imagem);
            if(!$upload->getResult()):
                WSErro("Erro ao enviar Imagem:<br> <small>{$upload->getError()} </small>", WS_ERROR);
                else:
                    WSErro("Imagem enviada com sucesso><br><small> {$upload->getResult()} </small>", WS_ACCEPT);
            endif;
            
            echo "<hr>";
      
        endif;

        ?>
        
        <hr>
        
        <?php 
        $verimg = new Read;
        $verimg->ExeRead('ws_logotipo', "ORDER BY logo_id DESC Limit 1");
        $verimg->getResult();
        
        foreach ($verimg->getResult() as $puxa) {
            
     echo "<img src=\"../uploads/{$puxa['logo']}\" alt=\"alt da imagem\" title=\"titulo da imagem\" width=\"100\" />";
}
        
       
        
        
        
        ?>

        <h3> aqui vai imagem 
            
            
        </h3>
        
        <hr>

        <form name="fileForm" action="" method="post" enctype="multipart/form-data">
            <label>
                <input type="file" name="imagem"/>
            </label>

            <label>
                <p class="fontform"> AlT da imagem</p>
                <input type="text" name="alt" class="campos"/>
            </label>
            <label>
                <p class="fontform"> Title da imagem</p>
                <input type="text" name="title" class="campos"/>
            </label>
           
            <input type="submit" name="sendImage" value="enviar arquivo!"/>
        </form>



    </article>

</section>