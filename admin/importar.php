<div class="container-fluid">
    
    <?php 
    
    $importar = new Source\Core\ImportarCelular();
    $importar->cadastra();
    
    ?>

        <div class="col-md-6" style="margin-top: 10px;"> 
            <a href="<?= CONF_URL_APP ?>/?p=importar" style="text-decoration: none;color:#fff;">  <div class="subscribe btn btn-primary btn-block rounded-pill shadow-sm"> Importar Contatos</div> </a>
        </div>

        <div class="col-md-6" style="margin-top: 10px;"> 
            <a href="<?= CONF_URL_APP ?>/?p=marketing" style="text-decoration: none;color:#fff;">   <div class="subscribe btn btn-primary btn-block rounded-pill shadow-sm"> ENviar</div> </a>
        </div>

      
    <div class="row"> 
    
        <h3 class="col-md-12">Importar Arquivos</h3>
    
        <form action="" method="post" enctype="multipart/form-data"> 
        
            <label> Arquivo </label>
            <input type="file" name="arquivo" /></br></br>
            
            <input type="submit" name="cadastro" value="cadastrar" />
            
        </form>
        
    </div>
    
    

</div>

