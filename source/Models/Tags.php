<?php

namespace Source\Models;

class Tags {

    private $url;

    public function __construct() {

        $url = $_SERVER['HTTP_HOST'] . $_SERVER["REQUEST_URI"];

        $this->url = $url;

        $this->includesTag();
    }

    public function includesTag() {
        //home
        $tratar = explode("/", $this->url);


        if (!empty($_GET["acao"])) {
            $acao = $_GET["acao"];
        } else {
            $acao = null;
        }

        if (!empty($_GET["id"])) {
            $param = $_GET["id"];
        } else {
            $param = null;
        }

        if (empty($tratar['2'])) {

            echo $seo = "<meta property='og:type' content='article'/>
<meta property='og:site_name' content='HGM Rastreadores'/>
<meta property='og:locale' content='pt_BR'/>


<title>" . CONF_SITE_TITLE . "</title>
<meta name='description' content='" . CONF_SITE_DESC . "'/>
<meta name='robots' content='index, follow'/>
<link rel='canonical' href='" . CONF_URL_BASE . "'/>

<meta property='og:title' content='" . CONF_SITE_TITLE . "'/>
<meta property='og:description' content='" . CONF_SITE_DESC . "'/>
<meta property='og:url' content='" . CONF_URL_BASE . "'/>
<meta property='og:image' content='" . CONF_URL_BASE . "/assets/image/footer-bg.jpg'/>

<meta name='twitter:title' content='" . CONF_SITE_TITLE . "'/>
<meta name='twitter:description' content='" . CONF_SITE_DESC . "'/>
<meta name='twitter:url' content='" . CONF_URL_BASE . "'/>
<meta name='twitter:image' content='" . CONF_URL_BASE . "/assets/image/footer-bg.jpg'/>

<meta itemprop='name' content='" . CONF_SITE_TITLE . "'/>
<meta itemprop='description' content='" . CONF_SITE_DESC . "'/>
<meta itemprop='url' content='" . CONF_URL_BASE . "'/>
<meta itemprop='image' content='" . CONF_URL_BASE . "/assets/image/footer-bg.jpg'/> ";
        } else {

            if ($tratar['2'] == "frete") {

                echo $seo = "<meta property='og:type' content='article'/>
<meta property='og:site_name' content='HGM Rastreadores'/>
<meta property='og:locale' content='pt_BR'/>


<title>Frete " . CONF_SITE_TITLE . "</title>
<meta name='description' content='Frete " . CONF_SITE_DESC . "'/>
<meta name='robots' content='index, follow'/>
<link rel='canonical' href='" . CONF_URL_BASE . "'/>

<meta property='og:title' content='Frete " . CONF_SITE_TITLE . "'/>
<meta property='og:description' content='Frete " . CONF_SITE_DESC . "'/>
<meta property='og:url' content='" . CONF_URL_BASE . "'/>
<meta property='og:image' content='" . CONF_URL_BASE . "/assets/image/footer-bg.jpg'/>

<meta name='twitter:title' content='Frete " . CONF_SITE_TITLE . "'/>
<meta name='twitter:description' content='Frete " . CONF_SITE_DESC . "'/>
<meta name='twitter:url' content='" . CONF_URL_BASE . "'/>
<meta name='twitter:image' content='" . CONF_URL_BASE . "/assets/image/footer-bg.jpg'/>

<meta itemprop='name' content='Frete " . CONF_SITE_TITLE . "'/>
<meta itemprop='description' content='Frete " . CONF_SITE_DESC . "'/>
<meta itemprop='url' content='" . CONF_URL_BASE . "'/>
<meta itemprop='image' content='" . CONF_URL_BASE . "/assets/image/footer-bg.jpg'/> ";
            } else {


                if ($tratar['2'] == "pedidos") {

                    echo $seo = "<meta property='og:type' content='article'/>
<meta property='og:site_name' content='HGM Rastreadores'/>
<meta property='og:locale' content='pt_BR'/>


<title>Pedidos " . CONF_SITE_TITLE . "</title>
<meta name='description' content='Pedidos " . CONF_SITE_DESC . "'/>
<meta name='robots' content='index, follow'/>
<link rel='canonical' href='" . CONF_URL_BASE . "'/>

<meta property='og:title' content='Pedidos " . CONF_SITE_TITLE . "'/>
<meta property='og:description' content='Pedidos " . CONF_SITE_DESC . "'/>
<meta property='og:url' content='" . CONF_URL_BASE . "'/>
<meta property='og:image' content='" . CONF_URL_BASE . "/assets/image/footer-bg.jpg'/>

<meta name='twitter:title' content='Pedidos " . CONF_SITE_TITLE . "'/>
<meta name='twitter:description' content='Pedidos " . CONF_SITE_DESC . "'/>
<meta name='twitter:url' content='" . CONF_URL_BASE . "'/>
<meta name='twitter:image' content='" . CONF_URL_BASE . "/assets/image/footer-bg.jpg'/>

<meta itemprop='name' content='Pedidos " . CONF_SITE_TITLE . "'/>
<meta itemprop='description' content='Pedidos " . CONF_SITE_DESC . "'/>
<meta itemprop='url' content='" . CONF_URL_BASE . "'/>
<meta itemprop='image' content='" . CONF_URL_BASE . "/assets/image/footer-bg.jpg'/> ";
                } else {

                    if ($tratar['2'] == "pagamento") {

                        echo $seo = "<meta property='og:type' content='article'/>
<meta property='og:site_name' content='HGM Rastreadores'/>
<meta property='og:locale' content='pt_BR'/>


<title>Pagamento " . CONF_SITE_TITLE . "</title>
<meta name='description' content='Pagamento " . CONF_SITE_DESC . "'/>
<meta name='robots' content='index, follow'/>
<link rel='canonical' href='" . CONF_URL_BASE . "'/>

<meta property='og:title' content='Pagamento " . CONF_SITE_TITLE . "'/>
<meta property='og:description' content='Pagamento " . CONF_SITE_DESC . "'/>
<meta property='og:url' content='" . CONF_URL_BASE . "'/>
<meta property='og:image' content='" . CONF_URL_BASE . "/assets/image/footer-bg.jpg'/>

<meta name='twitter:title' content='Pagamento " . CONF_SITE_TITLE . "'/>
<meta name='twitter:description' content='Pagamento " . CONF_SITE_DESC . "'/>
<meta name='twitter:url' content='" . CONF_URL_BASE . "'/>
<meta name='twitter:image' content='" . CONF_URL_BASE . "/assets/image/footer-bg.jpg'/>

<meta itemprop='name' content='Pagamento " . CONF_SITE_TITLE . "'/>
<meta itemprop='description' content='Pagamento " . CONF_SITE_DESC . "'/>
<meta itemprop='url' content='" . CONF_URL_BASE . "'/>
<meta itemprop='image' content='" . CONF_URL_BASE . "/assets/image/footer-bg.jpg'/> ";
                    } else {

                        if ($tratar['2'] == "blog") {

                            echo $seo = "<meta property='og:type' content='article'/>
<meta property='og:site_name' content='HGM Rastreadores'/>
<meta property='og:locale' content='pt_BR'/>


<title>Blog" . CONF_SITE_TITLE . "</title>
<meta name='description' content='Blog" . CONF_SITE_DESC . "'/>
<meta name='robots' content='index, follow'/>
<link rel='canonical' href='" . CONF_URL_BASE . "'/>

<meta property='og:title' content='Blog" . CONF_SITE_TITLE . "'/>
<meta property='og:description' content='Blog" . CONF_SITE_DESC . "'/>
<meta property='og:url' content='" . CONF_URL_BASE . "'/>
<meta property='og:image' content='" . CONF_URL_BASE . "/assets/image/footer-bg.jpg'/>

<meta name='twitter:title' content='Blog" . CONF_SITE_TITLE . "'/>
<meta name='twitter:description' content='Blog" . CONF_SITE_DESC . "'/>
<meta name='twitter:url' content='" . CONF_URL_BASE . "'/>
<meta name='twitter:image' content='" . CONF_URL_BASE . "/assets/image/footer-bg.jpg'/>

<meta itemprop='name' content='Blog" . CONF_SITE_TITLE . "'/>
<meta itemprop='description' content='Blog" . CONF_SITE_DESC . "'/>
<meta itemprop='url' content='" . CONF_URL_BASE . "'/>
<meta itemprop='image' content='" . CONF_URL_BASE . "/assets/image/footer-bg.jpg'/> ";
                        } else {

                            if ($tratar['2'] == "produtos" && !empty($tratar['3'])) {

                                $produtos = new Read();
                                $produtos->ExeRead("app_prod", "WHERE slug = :a", "a={$tratar['3']}");
                                $produtos->getResult();

                                $imagem = new Read();
                                $imagem->ExeRead("app_prod_var", "WHERE produto_id = :a", "a={$produtos->getResult()[0]["id"]}");
                                $imagem->getResult();


                                echo $seo = "<meta property='og:type' content='article'/>
<meta property='og:site_name' content='HGM Rastreadores'/>
<meta property='og:locale' content='pt_BR'/>


<title>" . $produtos->getResult()[0]["titulo"] . "</title>
<meta name='description' content='" . $produtos->getResult()[0]["descricao"] . "'/>
<meta name='robots' content='index, follow'/>
<link rel='canonical' href='" . CONF_URL_BASE . "/produtos/" . $produtos->getResult()[0]["slug"] . "'/>

<meta property='og:title' content='" . $produtos->getResult()[0]["titulo"] . "'/>
<meta property='og:description' content='" . $produtos->getResult()[0]["descricao"] . "'/>
<meta property='og:url' content='" . CONF_URL_BASE . "'/>
<meta property='og:image' content='" . CONF_URL_BASE . "/uploads/" . $imagem->getResult()[0]["imagem"] . "'/>

<meta name='twitter:title' content='" . $produtos->getResult()[0]["titulo"] . "'/>
<meta name='twitter:description' content='" . $produtos->getResult()[0]["descricao"] . "'/>
<meta name='twitter:url' content='" . CONF_URL_BASE . "/produtos/" . $produtos->getResult()[0]["slug"] . "'/>
<meta name='twitter:image' content='" . CONF_URL_BASE . "/uploads/" . $imagem->getResult()[0]["imagem"] . "'/>

<meta itemprop='name' content='" . $produtos->getResult()[0]["titulo"] . "'/>
<meta itemprop='description' content='" . $produtos->getResult()[0]["descricao"] . "'/>
<meta itemprop='url' content='" . CONF_URL_BASE . "/produtos/" . $produtos->getResult()[0]["slug"] . "'/>
<meta itemprop='image' content='" . CONF_URL_BASE . "/uploads/" . $imagem->getResult()[0]["imagem"] . "'/> ";
                            } else {


                                if ($tratar['2'] == "entrar") {

                                    echo $seo = "<meta property='og:type' content='article'/>
<meta property='og:site_name' content='HGM Rastreadores'/>
<meta property='og:locale' content='pt_BR'/>


<title>Entrar " . CONF_SITE_TITLE . "</title>
<meta name='description' content='Entrar " . CONF_SITE_DESC . "'/>
<meta name='robots' content='index, follow'/>
<link rel='canonical' href='" . CONF_URL_BASE . "'/>

<meta property='og:title' content='Entrar " . CONF_SITE_TITLE . "'/>
<meta property='og:description' content='Entrar " . CONF_SITE_DESC . "'/>
<meta property='og:url' content='" . CONF_URL_BASE . "'/>
<meta property='og:image' content='" . CONF_URL_BASE . "/assets/image/footer-bg.jpg'/>

<meta name='twitter:title' content='Entrar " . CONF_SITE_TITLE . "'/>
<meta name='twitter:description' content='Entrar " . CONF_SITE_DESC . "'/>
<meta name='twitter:url' content='" . CONF_URL_BASE . "'/>
<meta name='twitter:image' content='" . CONF_URL_BASE . "/assets/image/footer-bg.jpg'/>

<meta itemprop='name' content='Entrar " . CONF_SITE_TITLE . "'/>
<meta itemprop='description' content='Entrar " . CONF_SITE_DESC . "'/>
<meta itemprop='url' content='" . CONF_URL_BASE . "'/>
<meta itemprop='image' content='" . CONF_URL_BASE . "/assets/image/footer-bg.jpg'/> ";
                                } else {


                                    if ($tratar['2'] == "entrar_cliente") {

                                        echo $seo = "<meta property='og:type' content='article'/>
<meta property='og:site_name' content='HGM Rastreadores'/>
<meta property='og:locale' content='pt_BR'/>


<title>Entrar  " . CONF_SITE_TITLE . "</title>
<meta name='description' content='Entrar " . CONF_SITE_DESC . "'/>
<meta name='robots' content='index, follow'/>
<link rel='canonical' href='" . CONF_URL_BASE . "'/>

<meta property='og:title' content='Entrar " . CONF_SITE_TITLE . "'/>
<meta property='og:description' content='Entrar " . CONF_SITE_DESC . "'/>
<meta property='og:url' content='" . CONF_URL_BASE . "'/>
<meta property='og:image' content='" . CONF_URL_BASE . "/assets/image/footer-bg.jpg'/>

<meta name='twitter:title' content='Entrar " . CONF_SITE_TITLE . "'/>
<meta name='twitter:description' content='Entrar " . CONF_SITE_DESC . "'/>
<meta name='twitter:url' content='" . CONF_URL_BASE . "'/>
<meta name='twitter:image' content='" . CONF_URL_BASE . "/assets/image/footer-bg.jpg'/>

<meta itemprop='name' content='Entrar " . CONF_SITE_TITLE . "'/>
<meta itemprop='description' content='Entrar " . CONF_SITE_DESC . "'/>
<meta itemprop='url' content='" . CONF_URL_BASE . "'/>
<meta itemprop='image' content='" . CONF_URL_BASE . "/assets/image/footer-bg.jpg'/> ";
                                    } else {

                                        if ($tratar['2'] == "cadastrar") {

                                            echo $seo = "<meta property='og:type' content='article'/>
<meta property='og:site_name' content='HGM Rastreadores'/>
<meta property='og:locale' content='pt_BR'/>


<title>Cadastrar " . CONF_SITE_TITLE . "</title>
<meta name='description' content='Cadastrar " . CONF_SITE_DESC . "'/>
<meta name='robots' content='index, follow'/>
<link rel='canonical' href='" . CONF_URL_BASE . "'/>

<meta property='og:title' content='Cadastrar " . CONF_SITE_TITLE . "'/>
<meta property='og:description' content='Cadastrar " . CONF_SITE_DESC . "'/>
<meta property='og:url' content='" . CONF_URL_BASE . "'/>
<meta property='og:image' content='" . CONF_URL_BASE . "/assets/image/footer-bg.jpg'/>

<meta name='twitter:title' content='Cadastrar " . CONF_SITE_TITLE . "'/>
<meta name='twitter:description' content='Cadastrar " . CONF_SITE_DESC . "'/>
<meta name='twitter:url' content='" . CONF_URL_BASE . "'/>
<meta name='twitter:image' content='" . CONF_URL_BASE . "/assets/image/footer-bg.jpg'/>

<meta itemprop='name' content='Cadastrar " . CONF_SITE_TITLE . "'/>
<meta itemprop='description' content='Cadastrar " . CONF_SITE_DESC . "'/>
<meta itemprop='url' content='" . CONF_URL_BASE . "'/>
<meta itemprop='image' content='" . CONF_URL_BASE . "/assets/image/footer-bg.jpg'/> ";
                                        } else {

                                            if ($tratar['2'] == "esqueceu-senha") {

                                                echo $seo = "<meta property='og:type' content='article'/>
<meta property='og:site_name' content='HGM Rastreadores'/>
<meta property='og:locale' content='pt_BR'/>


<title>Esqueceu Senha " . CONF_SITE_TITLE . "</title>
<meta name='description' content='Esqueceu Senha " . CONF_SITE_DESC . "'/>
<meta name='robots' content='index, follow'/>
<link rel='canonical' href='" . CONF_URL_BASE . "'/>

<meta property='og:title' content='Esqueceu Senha " . CONF_SITE_TITLE . "'/>
<meta property='og:description' content='Esqueceu Senha " . CONF_SITE_DESC . "'/>
<meta property='og:url' content='" . CONF_URL_BASE . "'/>
<meta property='og:image' content='" . CONF_URL_BASE . "/assets/image/footer-bg.jpg'/>

<meta name='twitter:title' content='Esqueceu Senha " . CONF_SITE_TITLE . "'/>
<meta name='twitter:description' content='Esqueceu Senha " . CONF_SITE_DESC . "'/>
<meta name='twitter:url' content='" . CONF_URL_BASE . "'/>
<meta name='twitter:image' content='" . CONF_URL_BASE . "/assets/image/footer-bg.jpg'/>

<meta itemprop='name' content='Esqueceu Senha " . CONF_SITE_TITLE . "'/>
<meta itemprop='description' content='Esqueceu Senha " . CONF_SITE_DESC . "'/>
<meta itemprop='url' content='" . CONF_URL_BASE . "'/>
<meta itemprop='image' content='" . CONF_URL_BASE . "/assets/image/footer-bg.jpg'/> ";
                                            } else {

                                                if (!empty($_GET["email"])) {
                                                    $email = $_GET["email"];
                                                } else {
                                                    $email = null;
                                                }
                                                if (!empty($_GET["token"])) {
                                                    $token = $_GET["token"];
                                                } else {
                                                    $token = null;
                                                }

                                                if ($tratar['2'] == "recuperar-senha&email={$email}&token={$token}") {

                                                    echo $seo = "<meta property='og:type' content='article'/>
<meta property='og:site_name' content='HGM Rastreadores'/>
<meta property='og:locale' content='pt_BR'/>


<title>Recueprar Senha " . CONF_SITE_TITLE . "</title>
<meta name='description' content='Esqueceu Senha " . CONF_SITE_DESC . "'/>
<meta name='robots' content='index, follow'/>
<link rel='canonical' href='" . CONF_URL_BASE . "'/>

<meta property='og:title' content='Esqueceu Senha " . CONF_SITE_TITLE . "'/>
<meta property='og:description' content='Esqueceu Senha " . CONF_SITE_DESC . "'/>
<meta property='og:url' content='" . CONF_URL_BASE . "'/>
<meta property='og:image' content='" . CONF_URL_BASE . "/assets/image/footer-bg.jpg'/>

<meta name='twitter:title' content='Esqueceu Senha " . CONF_SITE_TITLE . "'/>
<meta name='twitter:description' content='Esqueceu Senha " . CONF_SITE_DESC . "'/>
<meta name='twitter:url' content='" . CONF_URL_BASE . "'/>
<meta name='twitter:image' content='" . CONF_URL_BASE . "/assets/image/footer-bg.jpg'/>

<meta itemprop='name' content='Esqueceu Senha " . CONF_SITE_TITLE . "'/>
<meta itemprop='description' content='Esqueceu Senha " . CONF_SITE_DESC . "'/>
<meta itemprop='url' content='" . CONF_URL_BASE . "'/>
<meta itemprop='image' content='" . CONF_URL_BASE . "/assets/image/footer-bg.jpg'/> ";
                                                } else {


                                                    if ($tratar['2'] == "produtos") {


                                                        echo $seo = "<meta property='og:type' content='article'/>
<meta property='og:site_name' content='HGM Rastreadores'/>
<meta property='og:locale' content='pt_BR'/>


<title>Produtos " . CONF_SITE_TITLE . "</title>
<meta name='description' content='Produtos " . CONF_SITE_DESC . "'/>
<meta name='robots' content='index, follow'/>
<link rel='canonical' href='" . CONF_URL_BASE . "'/>

<meta property='og:title' content='Produtos " . CONF_SITE_TITLE . "'/>
<meta property='og:description' content='Produtos " . CONF_SITE_DESC . "'/>
<meta property='og:url' content='" . CONF_URL_BASE . "'/>
<meta property='og:image' content='" . CONF_URL_BASE . "/assets/image/footer-bg.jpg'/>

<meta name='twitter:title' content='Produtos " . CONF_SITE_TITLE . "'/>
<meta name='twitter:description' content='Produtos " . CONF_SITE_DESC . "'/>
<meta name='twitter:url' content='" . CONF_URL_BASE . "'/>
<meta name='twitter:image' content='" . CONF_URL_BASE . "/assets/image/footer-bg.jpg'/>

<meta itemprop='name' content='Produtos " . CONF_SITE_TITLE . "'/>
<meta itemprop='description' content='Produtos " . CONF_SITE_DESC . "'/>
<meta itemprop='url' content='" . CONF_URL_BASE . "'/>
<meta itemprop='image' content='" . CONF_URL_BASE . "/assets/image/footer-bg.jpg'/> ";
                                                    } else {


                                                        if ($tratar['2'] == "contato") {


                                                            echo $seo = "<meta property='og:type' content='article'/>
<meta property='og:site_name' content='HGM Rastreadores'/>
<meta property='og:locale' content='pt_BR'/>


<title>Contato " . CONF_SITE_TITLE . "</title>
<meta name='description' content='Contato " . CONF_SITE_DESC . "'/>
<meta name='robots' content='index, follow'/>
<link rel='canonical' href='" . CONF_URL_BASE . "'/>

<meta property='og:title' content='Produtos " . CONF_SITE_TITLE . "'/>
<meta property='og:description' content='Contato " . CONF_SITE_DESC . "'/>
<meta property='og:url' content='" . CONF_URL_BASE . "'/>
<meta property='og:image' content='" . CONF_URL_BASE . "/assets/image/footer-bg.jpg'/>

<meta name='twitter:title' content='Contato " . CONF_SITE_TITLE . "'/>
<meta name='twitter:description' content='Contato " . CONF_SITE_DESC . "'/>
<meta name='twitter:url' content='" . CONF_URL_BASE . "'/>
<meta name='twitter:image' content='" . CONF_URL_BASE . "/assets/image/footer-bg.jpg'/>

<meta itemprop='name' content='Contato " . CONF_SITE_TITLE . "'/>
<meta itemprop='description' content='Contato " . CONF_SITE_DESC . "'/>
<meta itemprop='url' content='" . CONF_URL_BASE . "'/>
<meta itemprop='image' content='" . CONF_URL_BASE . "/assets/image/footer-bg.jpg'/> ";
                                                        } else {

                                                            if ($tratar['2'] == "monitoramento") {


                                                                echo $seo = "<meta property='og:type' content='article'/>
<meta property='og:site_name' content='HGM Rastreadores'/>
<meta property='og:locale' content='pt_BR'/>


<title>Monitoramento " . CONF_SITE_TITLE . "</title>
<meta name='description' content='Monitoramento " . CONF_SITE_DESC . "'/>
<meta name='robots' content='index, follow'/>
<link rel='canonical' href='" . CONF_URL_BASE . "'/>

<meta property='og:title' content='Monitoramento " . CONF_SITE_TITLE . "'/>
<meta property='og:description' content='Monitoramento " . CONF_SITE_DESC . "'/>
<meta property='og:url' content='" . CONF_URL_BASE . "'/>
<meta property='og:image' content='" . CONF_URL_BASE . "/assets/image/footer-bg.jpg'/>

<meta name='twitter:title' content='Monitoramento " . CONF_SITE_TITLE . "'/>
<meta name='twitter:description' content='Monitoramento " . CONF_SITE_DESC . "'/>
<meta name='twitter:url' content='" . CONF_URL_BASE . "'/>
<meta name='twitter:image' content='" . CONF_URL_BASE . "/assets/image/footer-bg.jpg'/>

<meta itemprop='name' content='Monitoramento " . CONF_SITE_TITLE . "'/>
<meta itemprop='description' content='Monitoramento " . CONF_SITE_DESC . "'/>
<meta itemprop='url' content='" . CONF_URL_BASE . "'/>
<meta itemprop='image' content='" . CONF_URL_BASE . "/assets/image/footer-bg.jpg'/> ";
                                                            } else {

                                                                if ($tratar['2'] == "carrinho") {

                                                                    echo $seo = "<meta property='og:type' content='article'/>
<meta property='og:site_name' content='HGM Rastreadores'/>
<meta property='og:locale' content='pt_BR'/>


<title>Carrinho " . CONF_SITE_TITLE . "</title>
<meta name='description' content='Carrinho " . CONF_SITE_DESC . "'/>
<meta name='robots' content='index, follow'/>
<link rel='canonical' href='" . CONF_URL_BASE . "'/>

<meta property='og:title' content='Carrinho " . CONF_SITE_TITLE . "'/>
<meta property='og:description' content='Carrinho " . CONF_SITE_DESC . "'/>
<meta property='og:url' content='" . CONF_URL_BASE . "'/>
<meta property='og:image' content='" . CONF_URL_BASE . "/assets/image/footer-bg.jpg'/>

<meta name='twitter:title' content='Carrinho " . CONF_SITE_TITLE . "'/>
<meta name='twitter:description' content='Carrinho " . CONF_SITE_DESC . "'/>
<meta name='twitter:url' content='" . CONF_URL_BASE . "'/>
<meta name='twitter:image' content='" . CONF_URL_BASE . "/assets/image/footer-bg.jpg'/>

<meta itemprop='name' content='Carrinho " . CONF_SITE_TITLE . "'/>
<meta itemprop='description' content='Carrinho " . CONF_SITE_DESC . "'/>
<meta itemprop='url' content='" . CONF_URL_BASE . "'/>
<meta itemprop='image' content='" . CONF_URL_BASE . "/assets/image/footer-bg.jpg'/> ";
                                                                } else {


                                                                    if ($tratar['2'] == "carrinho&acao={$acao}") {

                                                                        echo $seo = "<meta property='og:type' content='article'/>
<meta property='og:site_name' content='HGM Rastreadores'/>
<meta property='og:locale' content='pt_BR'/>


<title>Carrinho " . CONF_SITE_TITLE . "</title>
<meta name='description' content='Carrinho " . CONF_SITE_DESC . "'/>
<meta name='robots' content='index, follow'/>
<link rel='canonical' href='" . CONF_URL_BASE . "'/>

<meta property='og:title' content='Carrinho " . CONF_SITE_TITLE . "'/>
<meta property='og:description' content='Carrinho " . CONF_SITE_DESC . "'/>
<meta property='og:url' content='" . CONF_URL_BASE . "'/>
<meta property='og:image' content='" . CONF_URL_BASE . "/assets/image/footer-bg.jpg'/>

<meta name='twitter:title' content='Carrinho " . CONF_SITE_TITLE . "'/>
<meta name='twitter:description' content='Carrinho " . CONF_SITE_DESC . "'/>
<meta name='twitter:url' content='" . CONF_URL_BASE . "'/>
<meta name='twitter:image' content='" . CONF_URL_BASE . "/assets/image/footer-bg.jpg'/>

<meta itemprop='name' content='Carrinho " . CONF_SITE_TITLE . "'/>
<meta itemprop='description' content='Carrinho " . CONF_SITE_DESC . "'/>
<meta itemprop='url' content='" . CONF_URL_BASE . "'/>
<meta itemprop='image' content='" . CONF_URL_BASE . "/assets/image/footer-bg.jpg'/> ";
                                                                    } else {


                                                                        if ($tratar['2'] == "carrinho&acao={$acao}&id={$param}") {

                                                                            echo $seo = "<meta property='og:type' content='article'/>
<meta property='og:site_name' content='HGM Rastreadores'/>
<meta property='og:locale' content='pt_BR'/>


<title>Carrinho " . CONF_SITE_TITLE . "</title>
<meta name='description' content='Carrinho " . CONF_SITE_DESC . "'/>
<meta name='robots' content='index, follow'/>
<link rel='canonical' href='" . CONF_URL_BASE . "'/>

<meta property='og:title' content='Carrinho " . CONF_SITE_TITLE . "'/>
<meta property='og:description' content='Carrinho " . CONF_SITE_DESC . "'/>
<meta property='og:url' content='" . CONF_URL_BASE . "'/>
<meta property='og:image' content='" . CONF_URL_BASE . "/assets/image/footer-bg.jpg'/>

<meta name='twitter:title' content='Carrinho " . CONF_SITE_TITLE . "'/>
<meta name='twitter:description' content='Carrinho " . CONF_SITE_DESC . "'/>
<meta name='twitter:url' content='" . CONF_URL_BASE . "'/>
<meta name='twitter:image' content='" . CONF_URL_BASE . "/assets/image/footer-bg.jpg'/>

<meta itemprop='name' content='Carrinho " . CONF_SITE_TITLE . "'/>
<meta itemprop='description' content='Carrinho " . CONF_SITE_DESC . "'/>
<meta itemprop='url' content='" . CONF_URL_BASE . "'/>
<meta itemprop='image' content='" . CONF_URL_BASE . "/assets/image/footer-bg.jpg'/> ";
                                                                            ;
//            
                                                                        } else {



                                                                            if ($tratar['2']) {


                                                                                $paginas = new Read();
                                                                                $paginas->ExeRead("app_post", "WHERE slug = :a", "a={$tratar['2']}");
                                                                                $paginas->getResult();



                                                                                echo $seo = "<meta property='og:type' content='article'/>
<meta property='og:site_name' content='HGM Rastreadores'/>
<meta property='og:locale' content='pt_BR'/>


<title>" . $paginas->getResult()[0]["title"] . "</title>
<meta name='description' content='" . $paginas->getResult()[0]["description"] . "'/>
<meta name='robots' content='index, follow'/>
<link rel='canonical' href='" . CONF_URL_BASE . "/" . $paginas->getResult()[0]["slug"] . "'/>

<meta property='og:title' content='" . $paginas->getResult()[0]["title"] . "'/>
<meta property='og:description' content='" . $paginas->getResult()[0]["description"] . "'/>
<meta property='og:url' content='" . CONF_URL_BASE . "/" . $paginas->getResult()[0]["slug"] . "'/>
<meta property='og:image' content='" . CONF_URL_BASE . "/uploads/" . $paginas->getResult()[0]["imagem"] . "'/>

<meta name='twitter:title' content='" . $paginas->getResult()[0]["title"] . "'/>
<meta name='twitter:description' content='" . $paginas->getResult()[0]["description"] . "'/>
<meta name='twitter:url' content='" . CONF_URL_BASE . "/" . $paginas->getResult()[0]["slug"] . "'/>
<meta name='twitter:image' content='" . CONF_URL_BASE . "/uploads/" . $paginas->getResult()[0]["imagem"] . "'/>

<meta itemprop='name' content='" . $paginas->getResult()[0]["title"] . "'/>
<meta itemprop='description' content='" . $paginas->getResult()[0]["description"] . "'/>
<meta itemprop='url' content='" . CONF_URL_BASE . "/" . $paginas->getResult()[0]["slug"] . "'/>
<meta itemprop='image' content='" . CONF_URL_BASE . "/uploads/" . $paginas->getResult()[0]["imagem"] . "'/> ";
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }

}
