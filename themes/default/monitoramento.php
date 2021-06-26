
<script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=5ee2605daf41c40012be9344&product=inline-share-buttons" async="async"></script>

<header class="container backwhite"> 


    
       <!-- ======= About Section ======= -->
    <section class="about" data-aos="fade-up">
      <div class="container">
          
           <section class="page-section " >
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
          <h2>Monitoramento</h2>
          <hr class="divider light my-4">
          <p class=" mb-4">Área de usuários para monitoramento</p>
          <a class="btn btn-primary btn-xl js-scroll-trigger" href="http://ap2.stc.srv.br/admin/hgm" target="_blank"> Localize seu veículo</a>
          <hr class="divider light my-4">
          <p class=" mb-4">Baixe o APP</p>
          <a class="btn btn-success btn-xl js-scroll-trigger" href="https://play.google.com/store/apps/details?id=br.com.stctecnologia.movit&hl=pt_BR" target="_blank"> BAIXAR APP</a>
        </div>
      </div>
    </div>
  </section>
    
</header>
    
    <h5 class="border-bottom"> Compartilhe nas redes sociais </h5>
<div class="sharethis-inline-share-buttons"></div>
      </header>
      

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
             
      
   
  