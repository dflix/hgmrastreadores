<?php

namespace Source\Models;

class Rota {

    private $url;

    public function __construct() {

        $url = $_SERVER['HTTP_HOST'] . $_SERVER["REQUEST_URI"];


        $this->url = $url;

        $this->includes();
    }

    public function includes() {
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

            include'./themes/default/home.php';
        } else {

            if ($tratar['2'] == "produtos" && !empty($tratar['3'])) {

                include'./themes/default/single-products.php';
            } else {

                if ($tratar['2'] == "frete") {

                    include'./themes/default/freight.php';
                } else {


                    if ($tratar['2'] == "pedidos") {

                        include'./themes/default/pedidos.php';
                    } else {

                        if ($tratar['2'] == "monitoramento") {

                            include'./themes/default/monitoramento.php';
                        } else {

                            if ($tratar['2'] == "pagamento") {

                                include'./themes/default/payment.php';
                            } else {

                                if ($tratar['2'] == "blog") {

                                    include'./themes/default/blog.php';
                                } else {




                                    if ($tratar['2'] == "entrar") {

                                        include'./themes/default/login.php';
                                    } else {



                                        if ($tratar['2'] == "entrar_cliente") {

                                            include'./themes/default/login_cliente.php';
                                        } else {

                                            if ($tratar['2'] == "cadastrar") {

                                                include'./themes/default/register.php';
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

                                                    include'./themes/default/repass.php';
                                                } else {

                                                    if ($tratar['2'] == "esqueceu-senha") {

                                                        include'./themes/default/forget.php';
                                                    } else {

                                                        if ($tratar['2'] == "produtos") {

                                                            include'./themes/default/products.php';
                                                        } else {

                                                            if ($tratar['2'] == "contato") {

                                                                include'./themes/default/contact.php';
                                                            } else {

                                                                if ($tratar['2'] == "produtos") {

                                                                    include'./themes/default/products.php';
                                                                } else {

                                                                    if ($tratar['2'] == "carrinho") {

                                                                        include'./themes/default/card.php';
                                                                    } else {


                                                                        if ($tratar['2'] == "carrinho&acao={$acao}") {

                                                                            include'./themes/default/card.php';
                                                                        } else {


                                                                            if ($tratar['2'] == "carrinho&acao={$acao}&id={$param}") {

                                                                                include'./themes/default/card.php';
                                                                            } else {

                                                                                if ($tratar['2'] == "pagamento") {

                                                                                    include'./themes/default/payment.php';
                                                                                } else {





                                                                                    if ($tratar['2']) {

                                                                                        include'./themes/default/single.php';
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
    }

}
