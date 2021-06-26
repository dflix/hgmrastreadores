<?php

/**
 *  Navega.class.php[HELPERS]
 * Classe responsavel por verificar url e exibir view
 * @copyright (c) year, Marcio Leite Up
 */
class Navega {

    public $local;
    public $seotags;
    public $incluir;
    public $getinclude;

    function __construct() {

        $this->local = $this->local;
        ;
        $this->incluir = $this->incluir;
        $this->seotags = $this->seotags;
        $this->link = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $this->getinclude = $this->getinclude;



        $this->Local();
        $this->Arquivo();
        $this->SeoTags();
        $this->getInclude();
    }

    public function Local() {
        $this->local = strip_tags(trim(filter_input(INPUT_GET, 'url', FILTER_DEFAULT)));
        $this->local = ($this->local ? $this->local : 'index');
        $this->local = explode("/", $this->local);
    }

    public function Arquivo() {

        if (!empty($this->local[2])) {
            $this->incluir = "single-post-categ.php";
        } else {

            if (!empty($this->local[1])) {
                $this->incluir = "categ.php";
            } else {

                if ($this->local[0] == "categorias") {

                    $this->incluir = "general-categ.php";
                } else {

                    if ($this->local[0] == "index") {

                        $this->incluir = "home.php";
                    } else {
                        if ($this->local[0] == "contato") {

                            $this->incluir = "contato.php";
                        } else {
                            if ($this->local[0] == "buscar") {

                                $this->incluir = "buscar.php";
                            } else {

                                if (!empty($this->local[0])) {

                                    $this->incluir = "single.php";
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    public function SeoTags() {
        /**
         * Se local[2] que são os posts das categorias existir e criar a meta seo
         * manipular a this->incluir que vai incluir arquivo na pagina que seria
         * pagina single-pos-categ.php
         */
        if (!empty($this->local[2])) {
            $read = new Read;
            $read->ExeRead('ws_posts', "WHERE post_name = :p ", "p={$this->local[2]}");
            $read->getResult();

            if (!empty($read->getResult())):
                $this->incluir = "single-post-categ.php";

                $this->seotags = '<title>' . $read->getResult()[0]['post_title'] . '</title>' . "\n";
                $this->seotags .= '<meta name="description" content="' . $read->getResult()[0]['post_description'] . '"/>' . "\n";
                $this->seotags .= '<meta name="robots" content="index, follow" />' . "\n";
                $this->seotags .= '<link rel="canonical" href="' . $this->link . '">' . "\n";
                $this->seotags .= "\n";

                $this->seotags .= '<meta property="og:site_name" content="' . SITENAME . '" />' . "\n";
                $this->seotags .= '<meta property="og:locale" content="pt_BR" />' . "\n";
                $this->seotags .= '<meta property="og:title" content="' . $read->getResult()[0]['post_title'] . '" />' . "\n";
                $this->seotags .= '<meta property="og:description" content="' . $read->getResult()[0]['post_description'] . '" />' . "\n";
                $this->seotags .= '<meta property="og:url" content="' . $this->link . '" />' . "\n";
                $this->seotags .= '<meta property="og:type" content="article" />' . "\n";
                $this->seotags .= "\n";

                //ITEM GROUP (TWITTER)
                $this->seotags .= '<meta itemprop="name" content="' . $read->getResult()[0]['post_title'] . '">' . "\n";
                $this->seotags .= '<meta itemprop="description" content="' . $read->getResult()[0]['post_description'] . '">' . "\n";
                $this->seotags .= '<meta itemprop="url" content="' . $this->link . '">' . "\n";
            /**
             * caso contrario comentario acima retorna a pagina de erro 404
             */
            else:
                $this->incluir = "404.php";

                $this->seotags = '<title>  404 ERROR  </title>' . "\n";
                $this->seotags .= '<meta name="description" content=" ' . SITENAME . ' ' . SITEDESC . '"/>' . "\n";
                $this->seotags .= '<meta name="robots" content="index, follow" />' . "\n";
                $this->seotags .= '<link rel="canonical" href="' . $this->link . '">' . "\n";
                $this->seotags .= "\n";
            endif;
        } else {
            /**
             * Se local[1] que são as categorias existir e criar a meta seo
             * manipular a this->incluir que vai incluir arquivo na pagina
             */
            if (!empty($this->local[1])) {
                $read = new Read;
                $read->ExeRead('ws_categories', "WHERE category_name = :p ", "p={$this->local[1]}");
                $read->getResult();

                if (!empty($read->getResult())):
                    $this->incluir = "categ.php";

                    $this->seotags = '<title>' . $read->getResult()[0]['category_title'] . '</title>' . "\n";
                    $this->seotags .= '<meta name="description" content="' . $read->getResult()[0]['category_description'] . '"/>' . "\n";
                    $this->seotags .= '<meta name="robots" content="index, follow" />' . "\n";
                    $this->seotags .= '<link rel="canonical" href="' . $this->link . '">' . "\n";
                    $this->seotags .= "\n";

                    $this->seotags .= '<meta property="og:site_name" content="' . SITENAME . '" />' . "\n";
                    $this->seotags .= '<meta property="og:locale" content="pt_BR" />' . "\n";
                    $this->seotags .= '<meta property="og:title" content="' . $read->getResult()[0]['category_title'] . '" />' . "\n";
                    $this->seotags .= '<meta property="og:description" content="' . $read->getResult()[0]['category_description'] . '" />' . "\n";
                    $this->seotags .= '<meta property="og:url" content="' . $this->link . '" />' . "\n";
                    $this->seotags .= '<meta property="og:type" content="article" />' . "\n";
                    $this->seotags .= "\n";

                    //ITEM GROUP (TWITTER)
                    $this->seotags .= '<meta itemprop="name" content="' . $read->getResult()[0]['category_title'] . '">' . "\n";
                    $this->seotags .= '<meta itemprop="description" content="' . $read->getResult()[0]['category_description'] . '">' . "\n";
                    $this->seotags .= '<meta itemprop="url" content="' . $this->link . '">' . "\n";
                /**
                 * Caso não exista comentario acima retorna pagina  de erro
                 */
                else:
                    $this->incluir = "404.php";

                    $this->seotags = '<title>  404 ERROR  </title>' . "\n";
                    $this->seotags .= '<meta name="description" content=" ' . SITENAME . ' ' . SITEDESC . '"/>' . "\n";
                    $this->seotags .= '<meta name="robots" content="index, follow" />' . "\n";
                    $this->seotags .= '<link rel="canonical" href="' . $this->link . '">' . "\n";
                    $this->seotags .= "\n";
                endif;
            } else {
                /**
                 * Se $this->local[0] = categorias ela apresenta todas as categorias cadastradas
                 * no sistema  e retorna a pagina general-categ.php.
                 */
                if ($this->local[0] == "categorias") {

                    $this->seotags = '<title>  Categoria do Site ' . SITENAME . ' </title>' . "\n";
                    $this->seotags .= '<meta name="description" content="Aqui vemos todas as categorias do site ' . SITENAME . '"/>' . "\n";
                    $this->seotags .= '<meta name="robots" content="index, follow" />' . "\n";
                    $this->seotags .= '<link rel="canonical" href="' . $this->link . '">' . "\n";
                    $this->seotags .= "\n";
                    $this->incluir = "general-categ.php";
                } else {

                    if ($this->local[0] == "index") {

                        $read = new Read;
                        $read->ExeRead("ws_home", "WHERE post_name = :p", "p=index");
                        $read->getResult();

                        if (!empty($read->getResult())):
                            $this->incluir = "home.php";

                            $this->seotags = '<title>' . $read->getResult()[0]['post_title'] . '</title>' . "\n";
                            $this->seotags .= '<meta name="description" content="' . $read->getResult()[0]['post_description'] . '"/>' . "\n";
                            $this->seotags .= '<meta name="robots" content="index, follow" />' . "\n";
                            $this->seotags .= '<link rel="canonical" href="' . $this->link . '">' . "\n";
                            $this->seotags .= "\n";

                            $this->seotags .= '<meta property="og:site_name" content="' . SITENAME . '" />' . "\n";
                            $this->seotags .= '<meta property="og:locale" content="pt_BR" />' . "\n";
                            $this->seotags .= '<meta property="og:title" content="' . $read->getResult()[0]['post_title'] . '" />' . "\n";
                            $this->seotags .= '<meta property="og:description" content="' . $read->getResult()[0]['post_description'] . '" />' . "\n";
                            $this->seotags .= '<meta property="og:url" content="' . $this->link . '" />' . "\n";
                            $this->seotags .= '<meta property="og:type" content="article" />' . "\n";
                            $this->seotags .= "\n";

                            //ITEM GROUP (TWITTER)
                            $this->seotags .= '<meta itemprop="name" content="' . $read->getResult()[0]['post_title'] . '">' . "\n";
                            $this->seotags .= '<meta itemprop="description" content="' . $read->getResult()[0]['post_description'] . '">' . "\n";
                            $this->seotags .= '<meta itemprop="url" content="' . $this->link . '">' . "\n";

                        endif;
                    } else {

                        if ($this->local[0] == "contato") {

//                        $read = new Read;
//                        $read->ExeRead("ws_home", "WHERE post_name = :p", "p=index");
//                        $read->getResult();


                            $this->incluir = "contato.php";

                            $this->seotags = '<title> Pagina contato de ' . SITENAME . '</title>' . "\n";
                            $this->seotags .= '<meta name="description" content="' . SITEDESC . '"/>' . "\n";
                            $this->seotags .= '<meta name="robots" content="index, follow" />' . "\n";
                            $this->seotags .= '<link rel="canonical" href="' . $this->link . '">' . "\n";
                            $this->seotags .= "\n";

                            $this->seotags .= '<meta property="og:site_name" content="' . SITENAME . '" />' . "\n";
                            $this->seotags .= '<meta property="og:locale" content="pt_BR" />' . "\n";
                            $this->seotags .= '<meta property="og:title" content="' . SITENAME . '" />' . "\n";
                            $this->seotags .= '<meta property="og:description" content="' . SITEDESC . '" />' . "\n";
                            $this->seotags .= '<meta property="og:url" content="' . $this->link . '" />' . "\n";
                            $this->seotags .= '<meta property="og:type" content="article" />' . "\n";
                            $this->seotags .= "\n";

                            //ITEM GROUP (TWITTER)
                            $this->seotags .= '<meta itemprop="name" content="' . SITENAME . '">' . "\n";
                            $this->seotags .= '<meta itemprop="description" content="' . SITEDESC . '">' . "\n";
                            $this->seotags .= '<meta itemprop="url" content="' . $this->link . '">' . "\n";
                        } else {

                            if ($this->local[0] == "buscar") {

//                        $read = new Read;
//                        $read->ExeRead("ws_home", "WHERE post_name = :p", "p=index");
//                        $read->getResult();


                                $this->incluir = "buscar.php";

                                $this->seotags = '<title> Busca de ' . SITENAME . '</title>' . "\n";
                                $this->seotags .= '<meta name="description" content="' . SITEDESC . '"/>' . "\n";
                                $this->seotags .= '<meta name="robots" content="index, follow" />' . "\n";
                                $this->seotags .= '<link rel="canonical" href="' . $this->link . '">' . "\n";
                                $this->seotags .= "\n";

                                $this->seotags .= '<meta property="og:site_name" content="' . SITENAME . '" />' . "\n";
                                $this->seotags .= '<meta property="og:locale" content="pt_BR" />' . "\n";
                                $this->seotags .= '<meta property="og:title" content="' . SITENAME . '" />' . "\n";
                                $this->seotags .= '<meta property="og:description" content="' . SITEDESC . '" />' . "\n";
                                $this->seotags .= '<meta property="og:url" content="' . $this->link . '" />' . "\n";
                                $this->seotags .= '<meta property="og:type" content="article" />' . "\n";
                                $this->seotags .= "\n";

                                //ITEM GROUP (TWITTER)
                                $this->seotags .= '<meta itemprop="name" content="' . SITENAME . '">' . "\n";
                                $this->seotags .= '<meta itemprop="description" content="' . SITEDESC . '">' . "\n";
                                $this->seotags .= '<meta itemprop="url" content="' . $this->link . '">' . "\n";
                            } else {

                                if (!empty($this->local[0])) {

                                    $read = new Read;
                                    $read->ExeRead("ws_posts", "WHERE post_name = :p", "p={$this->local[0]}");
                                    $read->getResult();

                                    if (!empty($read->getRowCount())):
                                        $this->incluir = "single.php";

                                        $this->seotags = '<title>' . $read->getResult()[0]['post_title'] . '</title>' . "\n";
                                        $this->seotags .= '<meta name="description" content="' . $read->getResult()[0]['post_description'] . '"/>' . "\n";
                                        $this->seotags .= '<meta name="robots" content="index, follow" />' . "\n";
                                        $this->seotags .= '<link rel="canonical" href="' . $this->link . '">' . "\n";
                                        $this->seotags .= "\n";

                                        $this->seotags .= '<meta property="og:site_name" content="' . SITENAME . '" />' . "\n";
                                        $this->seotags .= '<meta property="og:locale" content="pt_BR" />' . "\n";
                                        $this->seotags .= '<meta property="og:title" content="' . $read->getResult()[0]['post_title'] . '" />' . "\n";
                                        $this->seotags .= '<meta property="og:description" content="' . $read->getResult()[0]['post_description'] . '" />' . "\n";
                                        $this->seotags .= '<meta property="og:url" content="' . $this->link . '" />' . "\n";
                                        $this->seotags .= '<meta property="og:type" content="article" />' . "\n";
                                        $this->seotags .= "\n";

                                        //ITEM GROUP (TWITTER)
                                        $this->seotags .= '<meta itemprop="name" content="' . $read->getResult()[0]['post_title'] . '">' . "\n";
                                        $this->seotags .= '<meta itemprop="description" content="' . $read->getResult()[0]['post_description'] . '">' . "\n";
                                        $this->seotags .= '<meta itemprop="url" content="' . $this->link . '">' . "\n";
                                    /**
                                     * caso contrario comentario acima retorna a pagina de erro 404
                                     */
                                    else:
                                        $this->incluir = "404.php";

                                        $this->seotags = '<title>  404 ERROR  </title>' . "\n";
                                        $this->seotags .= '<meta name="description" content=" ' . SITENAME . ' ' . SITEDESC . '"/>' . "\n";
                                        $this->seotags .= '<meta name="robots" content="index, follow" />' . "\n";
                                        $this->seotags .= '<link rel="canonical" href="' . $this->link . '">' . "\n";
                                        $this->seotags .= "\n";
                                    endif;
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    public function getInclude() {
        $this->getinclude = $this->getinclude;

        if (file_exists(REQUIRE_PATH . '/' . $this->incluir)):
            $this->getinclude = REQUIRE_PATH . '/' . $this->incluir;
        else:
            echo "Deu merda";
        endif;
    }

}
