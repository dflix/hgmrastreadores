
<script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=5ee2605daf41c40012be9344&product=inline-share-buttons" async="async"></script>

<header class="container backwhite"> 

    
    <h3> Contato </h3>
    
    <p><i class="fas fa-at"></i> E-mail: contato@hgmrastreadores.com.br </p>
    <p><i class="fas fa-phone"></i> Administrativo: (11)9 7661-5304 </p>
    <p><i class="fas fa-mobile-alt"></i> Roubo ou Furto: 0800 7170 707 </p>
    
    </br> </br>
    
    <div class="row content-fluid"> 

        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3654.6153233252267!2d-46.556235285020364!3d-23.653943484636965!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ce42e008d247ff%3A0x6456abca86b642f7!2sAv.%20Gago%20Coutinho%2C%20544%20-%20Santa%20Maria%2C%20Santo%20Andr%C3%A9%20-%20SP%2C%2009070-000!5e0!3m2!1spt-BR!2sbr!4v1623769409858!5m2!1spt-BR!2sbr" width="100%" height="600" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    
    </div>
    
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
             
      
   
  