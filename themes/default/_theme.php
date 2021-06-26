<?PHP 
session_start();
require "./vendor/autoload.php";
?>
<!doctype html>
<html lang="pt-br" itemscope itemtype="https://schema.org/WebSite">
  <head>
   
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?php 
    $tag = new \Source\Models\Tags();
    //$tag->includesTag();
    ?>
    
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-165131903-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-165131903-1');
</script>


    </script>
    
    <script src="<?=CONF_URL_BASE ?>/_cdn/node_modules/jquery/dist/jquery.min.js"> </script>
    
     <link rel="shortcut icon" href="<?=CONF_URL_BASE ?>/assets/image/favicon.png" />
     <link rel="stylesheet" href="<?=CONF_URL_BASE ?>/_cdn/node_modules/bootstrap/dist/css/bootstrap.min.css" />
     <link rel="stylesheet" href="<?=CONF_URL_BASE ?>/_cdn/css/bootstrap-custom.css" />
     <link rel="stylesheet" href="<?=CONF_URL_BASE ?>/_cdn/css/website.css" />
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" >
     
  </head>
  <body>

<nav class="navbar navbar-expand-lg navbar-dark bg-front static-top">
  <div class="container">
      <?php 
      $logo = new Source\Models\Read();
      $logo->ExeRead("app_logo", "WHERE id = :a", "a=1");
      $logo->getResult();
      ?>
      <a class="navbar-brand" href="<?=CONF_URL_BASE ?>">
        
          <img src="<?=CONF_URL_APP ?>/uploads/<?= $logo->getResult()[0]["logo"] ?>" width="125" alt="HGM Rastreadores com Seguro" title="HGM Rastreadores com Seguro">
        </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="<?=CONF_URL_BASE ?>/">Home
                <span class="sr-only">(current)</span>
              </a>
        </li>
        <?php
        $pagina = new Source\Models\Read();
        $pagina->ExeRead("app_post", "WHERE categoria = :a", "a=pagina");
        $pagina->getResult();
        foreach ($pagina->getResult() as $pg) {
//        ?>
        <li class="nav-item">
          <a class="nav-link" href="<?=CONF_URL_BASE ?>/<?= $pg["slug"] ?>"><?= $pg["pagina"] ?></a>
        </li>
        <?php  } ?>
 <li class="nav-item dropdown">
     <?php 
     $categoria = new Source\Models\Read();
     $categoria->ExeRead("app_post_categ", "ORDER BY id DESC" );
     $categoria->getResult();
     foreach ($categoria->getResult() as $cat) {

     ?>
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?= $cat["categoria"] ?>
        </a>
     
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <?php
            $pcat = new Source\Models\Read();
            $pcat->ExeRead("app_post", "WHERE categoria = :a", "a={$cat["slug"]}");
            $pcat->getResult();
            foreach ($pcat->getResult() as $vpcat) {
            ?>
          <a class="dropdown-item" href="<?=CONF_URL_BASE ?>/<?= $vpcat["slug"] ?>"><?= $vpcat["pagina"] ?></a>
            <?php  } ?>
        
        </div>
      </li>
      
     <?php } ?>
      
       <li class="nav-item">
          <a class="nav-link" href="<?=CONF_URL_BASE ?>/monitoramento">Monitoramento</a>
        </li>
       <li class="nav-item">
          <a class="nav-link" href="<?=CONF_URL_BASE ?>/blog">Blog</a>
        </li>
       <li class="nav-item">
          <a class="nav-link" href="<?=CONF_URL_BASE ?>/contato">Contato</a>
        </li>
<!--       <li class="nav-item">
          <a class="nav-link" href="<?=CONF_URL_BASE ?>/produtos">Produtos</a>
        </li>-->


        <?php 
        if(!empty($_SESSION["carrinho"])){
        ?>
        
        
                        <a class="btn btn-info btn-sm ml-3" href="<?=CONF_URL_BASE ?>/carrinho">
                    <i class="fa fa-shopping-cart"></i> Carrinho
                    <span class="badge badge-light">3</span>
                </a>
        <?php } ?>
        <?php 
        if(!empty($_SESSION["nivel"])){
        ?>
<!--               <li class="nav-item">
          <a class="nav-link" href="<?=CONF_URL_BASE ?>/pedidos"> Minhas Cobranças</a>
        </li>-->
        <?php  } ?>
  
      </ul>
        
         <ul class="nav navbar-nav navbar-right">
             <li>
        <button type="button" class="btn btn-warning "><a href="<?=CONF_URL_BASE_ADMIN ?>/escritorio" style="text-decoration: none; color:#fff;"><i class="fas fa-tachometer-alt"></i> Admin </a></button>
        </li>
<!--        <li>
        <button type="button" class="btn btn-success "><a href="<?=CONF_URL_BASE ?>/entrar_cliente" style="text-decoration: none; color:#fff;"><i class="fas fa-user"></i> Area do Cliente</a></button>
        </li> -->
    </ul>
    </div>
  </div>
</nav>
      
      
    
  <?php 
  $rota = new \Source\Models\Rota();
  ?>
    
      
            
      <footer class="footer bg-front" itemscope itemtype="https://schema.org/WPFooter"> 
          
         
          
          <div class="container" > 
              <div class="row"> 
              
                  <div class="col-md-4" itemprop="accessModeSufficient"> 
                      <h4 class="border-bottom" style="color:#fff;">INSTITUCIONAL </h4>
                      
                      <p><a href="<?= CONF_URL_BASE ?>" style="text-decoration: none; color:#fff;"> Home</a></p>
                      <?php 
                      $read = new \Source\Models\Read();
                      $read->ExeRead("app_post", "WHERE categoria = :a", "a=produtos");
                      $read->getResult();
                      foreach ($read->getResult() as $footer) {
 
                      ?>
                      <p><a href="<?= CONF_URL_BASE ?>/<?= $footer["slug"] ?>" style="text-decoration: none; color:#fff;"> <?= $footer["pagina"] ?></a></p>
                      <?php  } ?>
               
                  </div>
                  
                  
                  <div class="col-md-4"> 
                      <h4 class="border-bottom" style="color:#fff;">CONTATO </h4>
                      <p style="color:#fff;"><i class="fas fa-phone"></i> TeleVendas: (11)9 9534-7531</p>
                      <p style="color:#fff;"><i class="fas fa-phone"></i> Roubo e Furto : 0800 7170 707</p>
                      
                  
                  <p style="color:#fff;"> <i class="fas fa-at"></i> contato@hgmrastreadores.com.br </p>
                  
                  <p style="color:#fff;" itemprop="contentLocation"> Av Gago Coutinho , 544 sala 01 </br>
                      Santo André - SP </br>
    09070-000 (sede própria) </p>
                  </div>
                  <div class="col-md-4" itemprop="associatedMedia"> 
                      <h4 class="border-bottom" style="color:#fff;">SOCIAL </h4>
                      <a href="https://www.youtube.com/channel/UCZSImg6tYvyaG9irg32clew" target="_blank"> <p style="color:#fff;"> <i class="fab fa-youtube"></i> Youtube </p> </a>
                      <a href="https://www.facebook.com/HGM-Rastreadores-105538388175491" target="_blank"> <p style="color:#fff;"> <i class="fab fa-facebook"></i> Facebook </p> </a>
                      
                      
                      
                  </div>
              </div>
          
          </div>
      </footer>
    
      

           <!-- Bootstrap CSS -->
<!--   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" >
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" >
    <link rel="stylesheet" href="<?=CONF_URL_BASE ?>/assets/css/style.css" />-->
      
      
<!--              <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->

<script src="<?=CONF_URL_BASE ?>/_cdn/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"> </script>
<script src="<?=CONF_URL_BASE ?>/_cdn/node_modules/bootstrap/dist/js/bootstrap.min.js"> </script>

<!--    <link rel="stylesheet" href="<?=CONF_URL_BASE ?>/assets/js/jquery.form.js" />
    <link rel="stylesheet" href="<?=CONF_URL_BASE ?>/assets/js/jquery.min.js" />-->
    <link rel="stylesheet" href="<?=CONF_URL_BASE ?>/assets/js/scripts.js" />

  </body>
</html>