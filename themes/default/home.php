
<section class="container_fluid blocohome"> 

    <div class="container"> 

        <div class="infohome col-md-9"> 

            <h1>Rastreador com Seguro </h1>
            <p><b> Carros, motos, caminhão e utilitários </b> </p>
            <p> <b>Proteção Automotiva HGM </b></p>

        </div>
        </br>
        <p class="btn btn-warning btn-lg p-3"> <a href="https://api.whatsapp.com/send?phone=5511957237019" style="text-decoration:none;" target="_blank"> <i class="fab fa-whatsapp"></i> Orçamento via Whatsapp clique aqui... </a> </p>

    </div> 

</section>



<!--      <div class="imgapp"> <img src="./assets/image/home-app.jpg" class="imgapp" /> </div>-->

<div class="container bg-white" itemprop="about">
    <?php
    $content = new \Source\Models\Read();
    $content->ExeRead("app_post_home", "WHERE id = :a", "a=1");
    $content->getResult();

    $readBlog = new \Source\Models\Read();
    $readBlog->ExeRead("app_post", "WHERE categoria != :a ORDER BY id DESC", "a=pagina");
    $blog = $readBlog->getResult();

    $readProd = new \Source\Models\Read();
    $readProd->ExeRead("app_prod", "ORDER BY id DESC LIMIT 6");
    $produto = $readProd->getResult();


    echo $content->getResult()[0]["content"];
    ?>


    <div class="container"   >
        <div class="row">
            <div class="col-md-3"> 
                <header class="header"> 
                    <p style="background: radial-gradient(circle closest-side,#1e4356 0%,#1e4356 98%,rgba(0,0,0,0) 100%); text-align: center; color:#fff; font-size:2.5em; padding: 10px;"><i class="fas fa-motorcycle"></i> </p>
                    <h4 style="color:#1E4356;"> Rastreador com Seguro para Moto </h4>
                    <p> Rastreador com seguro para motos, cobertura roubo furto acidentes </p>
                    <p class="btn btn-primary"> <a href="./rastreador-com-seguro-motos" style="text-decoration:none;color:#fff;">Mais Detalhes </a> </p>
                </header>
            </div>

            <div class="col-md-3"> 
                <header class="header">
                    <p style="background: radial-gradient(circle closest-side,#1e4356 0%,#1e4356 98%,rgba(0,0,0,0) 100%); text-align: center; color:#fff; font-size:2.5em; padding: 10px;"><i class="fas fa-car"></i> </p>
                    <h4 style="color:#1E4356;"> Rastreador com Seguro para Veículos </h4>
                    <p> Rastreador com seguro para motos, cobertura roubo furto acidentes </p>
                    <p class="btn btn-primary"> <a href="./rastreador-com-seguro-veiculos" style="text-decoration:none;color:#fff;">Mais Detalhes </a> </p>
                </header>
            </div>

            <div class="col-md-3"> 
                <header class="header">
                    <p style="background: radial-gradient(circle closest-side,#1e4356 0%,#1e4356 98%,rgba(0,0,0,0) 100%); text-align: center; color:#fff; font-size:2.5em; padding: 10px;"><i class="fas fa-shuttle-van"></i> </p>
                    <h4 style="color:#1E4356;"> Rastreador com Seguro para Utilitários </h4>
                    <p> Rastreador com seguro para motos, cobertura roubo furto acidentes </p>
                    <p class="btn btn-primary"> <a href="./rastreador-com-seguro-utilitarios" style="text-decoration:none;color:#fff;">Mais Detalhes </a> </p>
                </header>
            </div>

            <div class="col-md-3"> 
                <header class="header"> 
                    <p style="background: radial-gradient(circle closest-side,#1e4356 0%,#1e4356 98%,rgba(0,0,0,0) 100%); text-align: center; color:#fff; font-size:2.5em; padding: 10px;"><i class="fas fa-truck-moving"></i> </p>
                    <h4 style="color:#1E4356;"> Rastreador com Seguro para Caminhão </h4>
                    <p> Rastreador com seguro para motos, cobertura roubo furto acidentes </p>
                    <p class="btn btn-primary"> <a href="./rastreador-com-seguro-caminhao" style="text-decoration:none;color:#fff;">Mais Detalhes </a> </p>
                </header>
            </div>



        </div>
    </div>

</div>
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

<div class="container-fluid bg-white" itemscope itemtype="https://schema.org/Article"> 


    <div class="row">
        <div class="col-lg-11 mx-auto">
            <h3 class="text-center"> Blog </h3>
            <!-- FIRST EXAMPLE ===================================-->
            <div class="row py-5">
                <?php
                foreach ($blog as $valBlog) {
                    ?>  
                    <div class="col-lg-4">
                        <figure class="rounded p-3 bg-white shadow-sm">
                            <img src="<?= CONF_URL_BASE ?>/admin/uploads/<?= $valBlog["imagem"] ?>" title="<?= $valBlog["title"] ?>" alt="<?= $valBlog["title"] ?>" itemprop="image" class="w-100 card-img-top">
                            <figcaption class="p-4 card-img-bottom">
                                <a href="<?= CONF_URL_BASE ?>/<?= $valBlog["slug"] ?>" title="<?= $valBlog["pagina"] ?>" style="text-decoration: none;">  <h2 class="h5 font-weight-bold mb-2 font-italic" itemprop="headline"><?= $valBlog["pagina"] ?></h2> </a>
                                <p class="mb-0 text-small text-muted font-italic" ><?= $valBlog["description"] ?></p>
                                <p class="mb-0 text-small text-muted font-italic" ><span itemprop="author">Autor: HGM Rastreadores </span> <span itemprop="datePublished">Data:<?= date("d/m/Y", strtotime($valBlog["data"])); ?> </span> </p>
                                <!--<p class="mb-0 text-small text-muted font-italic" itemscope itemtype="https://schema.org/Person" itemprop="publisher"><a href="https://www.facebook.com/HGM-Rastreadores-105538388175491" itemprop="url"> <span itemprop="name">HGN Rastreadores </span> </a></p>-->
                                <buttom class="btn btn-info"><a href="<?= CONF_URL_BASE ?>/<?= $valBlog["slug"] ?>" style="text-decoration: none; color:#fff;"> Saiba Mais ... </a></buttom>
                            </figcaption>
                        </figure>
                    </div>

                <?php } ?>

            </div>
        </div>
    </div>
</div>

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


<script>

    $("form['register").on("submit", function (event) {
        event.preventDefault();
        console.log($(this).serialize());
    });

</script>


<script>

    $('#myCarousel').carousel({
        interval: 3000,
    })

    $("form['register").on("submit", function (event) {
        event.preventDefault();
        console.log($(this).serialize());
    });

</script>

<style> 

    #myCarousel .carousel-item .mask {
        position: absolute;
        top: 0;
        left:0;
        height:100%;
        width: 100%;
        background-attachment: fixed;
    }
    #myCarousel h4{
        font-size:50px;
        margin-bottom:15px;
        color:#ffc107;
        line-height:100%;
        letter-spacing:0.5px;
        font-weight:600;
    }
    #myCarousel p{
        font-size:18px;
        margin-bottom:15px;
        color:#fff;
    }
    #myCarousel .carousel-item a{background:#FF0000; font-size:14px; color:#FFF; padding:13px 32px; display:inline-block; }
    #myCarousel .carousel-item a:hover{background:#FF0010; text-decoration:none;  }

    #myCarousel .carousel-item h4{-webkit-animation-name:fadeInLeft; animation-name:fadeInLeft;} 
    #myCarousel .carousel-item p{-webkit-animation-name:slideInRight; animation-name:slideInRight;} 
    #myCarousel .carousel-item a{-webkit-animation-name:fadeInUp; animation-name:fadeInUp;}
    #myCarousel .carousel-item .mask img{-webkit-animation-name:slideInRight; animation-name:slideInRight; display:block; height:auto; max-width:100%;}
    #myCarousel h4, #myCarousel p, #myCarousel a, #myCarousel .carousel-item .mask img{-webkit-animation-duration: 1s;
                                                                                       animation-duration: 1.2s;
                                                                                       -webkit-animation-fill-mode: both;
                                                                                       animation-fill-mode: both;
    }
    #myCarousel .container {max-width: 1430px;  }
    #myCarousel .carousel-item{height:100%; min-height:550px; }
    #myCarousel{position:relative; z-index:1; background:#1E4356; background-size:cover; }

    .carousel-control-next, .carousel-control-prev{height:40px; width:40px; padding:12px; top:50%; bottom:auto; transform:translateY(-50%); background-color: #f47735; }


    .carousel-item {
        position: relative;
        display: none;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        width: 100%;
        transition: -webkit-transform .6s ease;
        transition: transform .6s ease;
        transition: transform .6s ease,-webkit-transform .6s ease;
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
        -webkit-perspective: 1000px;
        perspective: 1000px;
    }
    .carousel-fade .carousel-item {
        opacity: 0;
        -webkit-transition-duration: .6s;
        transition-duration: .6s;
        -webkit-transition-property: opacity;
        transition-property: opacity
    }
    .carousel-fade .carousel-item-next.carousel-item-left, .carousel-fade .carousel-item-prev.carousel-item-right, .carousel-fade .carousel-item.active {
        opacity: 1
    }
    .carousel-fade .carousel-item-left.active, .carousel-fade .carousel-item-right.active {
        opacity: 0
    }
    .carousel-fade .carousel-item-left.active, .carousel-fade .carousel-item-next, .carousel-fade .carousel-item-prev, .carousel-fade .carousel-item-prev.active, .carousel-fade .carousel-item.active {
        -webkit-transform: translateX(0);
        -ms-transform: translateX(0);
        transform: translateX(0)
    }
    @supports (transform-style:preserve-3d) {
        .carousel-fade .carousel-item-left.active, .carousel-fade .carousel-item-next, .carousel-fade .carousel-item-prev, .carousel-fade .carousel-item-prev.active, .carousel-fade .carousel-item.active {
            -webkit-transform:translate3d(0, 0, 0);
            transform:translate3d(0, 0, 0)
        }
    }
    .carousel-fade .carousel-item-left.active, .carousel-fade .carousel-item-next, .carousel-fade .carousel-item-prev, .carousel-fade .carousel-item-prev.active, .carousel-fade .carousel-item.active {
        -webkit-transform: translate3d(0,0,0);
        transform: translate3d(0,0,0);
    }



    @-webkit-keyframes fadeInLeft {
        from {
            opacity: 0;
            -webkit-transform: translate3d(-100%, 0, 0);
            transform: translate3d(-100%, 0, 0);
        }

        to {
            opacity: 1;
            -webkit-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
        }
    }

    @keyframes fadeInLeft {
        from {
            opacity: 0;
            -webkit-transform: translate3d(-100%, 0, 0);
            transform: translate3d(-100%, 0, 0);
        }

        to {
            opacity: 1;
            -webkit-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
        }
    }

    .fadeInLeft {
        -webkit-animation-name: fadeInLeft;
        animation-name: fadeInLeft;
    }

    @-webkit-keyframes fadeInUp {
        from {
            opacity: 0;
            -webkit-transform: translate3d(0, 100%, 0);
            transform: translate3d(0, 100%, 0);
        }

        to {
            opacity: 1;
            -webkit-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            -webkit-transform: translate3d(0, 100%, 0);
            transform: translate3d(0, 100%, 0);
        }

        to {
            opacity: 1;
            -webkit-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
        }
    }

    .fadeInUp {
        -webkit-animation-name: fadeInUp;
        animation-name: fadeInUp;
    }

    @-webkit-keyframes slideInRight {
        from {
            -webkit-transform: translate3d(100%, 0, 0);
            transform: translate3d(100%, 0, 0);
            visibility: visible;
        }

        to {
            -webkit-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
        }
    }

    @keyframes slideInRight {
        from {
            -webkit-transform: translate3d(100%, 0, 0);
            transform: translate3d(100%, 0, 0);
            visibility: visible;
        }

        to {
            -webkit-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
        }
    }

    .slideInRight {
        -webkit-animation-name: slideInRight;
        animation-name: slideInRight;
    }





</style>



