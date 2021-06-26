

<div class="container-fluid"> 
    <div class="row"> 
        
        <?php 
        
        $logo = new Source\Core\Logotipo();
        $logo->Logo();
            
        ?>

<!--        <div class="col-md-4" style="margin-top: 10px;"> 
            <a href="<?= CONF_URL_APP ?>/?p=post-categ" style="text-decoration: none;color:#fff;">  <div class="subscribe btn btn-primary btn-block rounded-pill shadow-sm"> Categorias</div> </a>
        </div>

        <div class="col-md-4" style="margin-top: 10px;"> 
            <a href="<?= CONF_URL_APP ?>/?p=post" style="text-decoration: none;color:#fff;">   <div class="subscribe btn btn-primary btn-block rounded-pill shadow-sm"> Post</div> </a>
        </div>

        <div class="col-md-4" style="margin-top: 10px;"> 
            <a href="<?= CONF_URL_APP ?>/?p=post-home" style="text-decoration: none;color:#fff;">   <div class="subscribe btn btn-primary btn-block rounded-pill shadow-sm"> Home</div> </a>
        </div>-->
    </div>
    <div class="row"> 

        <div class="col-md-12"> 
            <form name="form" action="" method="post" enctype="multipart/form-data" >
                <div class="form-group"> 
                    <p> Imagem de Capa </p>
                <input type="file" name="image" class="form-control" />
                </div>
               
                <input type="submit" name="submit" value="cadastrar"  class="btn btn-success" />


            </form>
        </div>


        <hr>
        <hr>
        <hr>
        
        <?php 
        $logo = new Source\Models\Read();
        $logo->ExeRead("app_logo", "WHERE id = :a", "a=1");
        $logo->getResult();
        ?>
        
        <img src="<?=CONF_URL_APP ?>/uploads/<?= $logo->getResult()[0]["logo"] ?>" />


    </div>




