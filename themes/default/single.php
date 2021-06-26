
<script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=5ee2605daf41c40012be9344&product=inline-share-buttons" async="async"></script>

<header class="container backwhite" itemprop="about" > 

    
    <?php 
    
    $url = $_SERVER['HTTP_HOST'] . $_SERVER["REQUEST_URI"];
     
     $tratar = explode("/", $url);
     
    // var_dump($tratar);
     
     $read = new Source\Models\Read();
     $read->ExeRead("app_post", "WHERE slug = :a", "a={$tratar["2"]}");
     $read->getResult();
    
    ?>
    
    <img src="<?=CONF_URL_BASE ?>/admin/uploads/<?= $read->getResult()[0]["imagem"]?>" width="100%" alt="<?= $read->getResult()[0]["title"]?>" title="<?= $read->getResult()[0]["title"]?>" /> 
    
    <?= $read->getResult()[0]["content"]?>
    
    </br> </br>
</header>

<div class="row container-fluid bg-front"> 

    <div class="container row">
        <div class="col-md-6"  >
            <div class="embed-responsive embed-responsive-16by9"  itemprop="image">
                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/uspchoEVyyI?rel=0" allowfullscreen></iframe>
            </div>
        </div>
        <div class="col-md-6">
            <p style="font-size:1.5em; color:white; "> <i class="fab fa-whatsapp"></i> Orçamento em seu Whatsapp </p>
           
            <p class="btn btn-warning btn-block p-3"> <a href="https://api.whatsapp.com/send?phone=5511957237019" style="text-decoration:none;" target="_blank"> <i class="fab fa-whatsapp"></i> Orçamento via Whatsapp clique aqui... </a> </p>
        </div>
    </div>

</div>
    
<section class="container-fluid bg bg-white">
    <h3 class="text-center header" style="color:#CCC;"> Compartilhe nas redes sociais </h3>
<div class="sharethis-inline-share-buttons"></div>
</section>
      

<script>



    $(function () {

        $('select[name=veiculo]').change(function () {
            $.post("<?= CONF_URL_BASE ?>/admin/marca.php",
                    {veiculo: $(this).val()},
                    function (veiculo) {

                        $('select[name=marca1]').html(veiculo)

                    })
        });

        $('select[name=marca1]').change(function () {
            $.post("<?= CONF_URL_BASE ?>/admin/modelo.php",
                    {marca: $(this).val()},
                    function (marca) {

                        $('select[name=modelo1]').html(marca)

                    })
        });

        $('select[name=modelo1]').change(function () {
            $.post("<?= CONF_URL_BASE ?>/admin/ano.php",
                    {modelo: $(this).val()},
                    function (modelo) {

                        $('select[name=ano1]').html(modelo)

                    })
        });

        $('select[name=ano1]').change(function () {
            $.post("<?= CONF_URL_BASE ?>/admin/ano.php",
                    {modelo: $(this).val()},
                    function (modelo) {

                        $('select[name=fipe]').html(modelo)

                    })
        });

        $('select[name=ano1]').change(function () {
            $.post("<?= CONF_URL_BASE ?>/admin/codigofipe.php",
                    {fipe: $(this).val()},
                    function (fipe) {

                        $('select[name=fipe]').html(fipe)

                    })
        });

        $('select[name=ano1]').change(function () {
            $.post("<?= CONF_URL_BASE ?>/admin/preco.php",
                    {valor: $(this).val()},
                    function (valor) {

                        $('select[name=valor]').html(valor)

                    })
        });

        $('select[name=plano]').change(function () {
            $.post("<?= CONF_URL_BASE ?>/admin/plano_desc.php",
                    {plano: $(this).val()},
                    function (plano) {

                        $('select[name=plano_desc]').html(plano)

                    })
        });

        $('select[name=plano]').change(function () {
            $.post("<?= CONF_URL_BASE ?>/admin/plano_valor.php",
                    {valorplan: $(this).val()},
                    function (valorplan) {

                        $('select[name=plano_valor]').html(valorplan)

                    })
        });





    });





</script>
             
      
   
  