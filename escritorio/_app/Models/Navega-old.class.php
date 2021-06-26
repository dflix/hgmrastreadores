<?php

/**
 *  Navega.class.php[HELPERS]
 * Classe responsavel por verificar url e exibir view
 * @copyright (c) year, Marcio Leite Up
 */
class Navegaold {

    public $data;
    public $pagina;
    public $categoria;
    public $pagcat;
    public $tags;
    public $seotags;
    
   

    function __construct() {
        
        $this->data = $this->data;
        $this->pagina = $this->pagina;
        $this->categoria = $this->categoria;
        $this->pagcat = $this->pagcat;
        $this->tags = $this->tags;
        $this->seotags = $this->seotags;
        $this->Capturar();
        $this->Data();
        $this->setTags();
        $this->SeoTags();
    }

    public function Capturar() {
        $base = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $trata = str_replace(HOME, "", $base);

        $urlE = explode('/', $trata);

        if (isset($urlE[3])):
            $pagcat = $this->pagcat = $urlE[3];
        endif;

        if (isset($urlE[2])):
            $categoria = $this->categoria = $urlE[2];
        endif;

        if (isset($urlE[1])):
            $pagina = $this->pagina = $urlE[1];
        endif;

        if (empty($this->pagina)):
            $this->pagina = "index";
        endif;
    }

    public function Data() {

        $this->data = ["{$this->pagina}", "Descrição do pagina {$this->pagina}", $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], HOME . "imagens/agluma.png"];
    }

    private function setTags() {
        $this->tags['Title'] = $this->data[0];
        $this->tags['Description'] = $this->data[1];
        $this->tags['Link'] = $this->data[2];
        $this->tags['Image'] = $this->data[3];
    }

    private function SeoTags() {


        if (!empty($this->pagcat)):

            $read = new Read;
            $read->ExeRead('ws_posts', "WHERE post_name = :p", "p={$this->pagcat}");
            $read->getResult();


            $this->seotags = '<title>' . $read->getResult()[0]['post_title'] . '</title>' . "\n";
            $this->seotags .= '<meta name="description" content="' . $read->getResult()[0]['post_description'] . '"/>' . "\n";
            $this->seotags .= '<meta name="robots" content="index, follow" />' . "\n";
            $this->seotags .= '<link rel="canonical" href="' . $this->tags['Link'] . '">' . "\n";
            $this->seotags .= "\n";

            $this->seotags .= '<meta property="og:site_name" content="' . SITENAME . '" />' . "\n";
            $this->seotags .= '<meta property="og:locale" content="pt_BR" />' . "\n";
            $this->seotags .= '<meta property="og:title" content="' . $read->getResult()[0]['post_title'] . '" />' . "\n";
            $this->seotags .= '<meta property="og:description" content="' . $read->getResult()[0]['post_description'] . '" />' . "\n";
            $this->seotags .= '<meta property="og:image" content="' . $this->Tags['Image'] . '" />' . "\n";
            $this->seotags .= '<meta property="og:url" content="' . $this->Tags['Link'] . '" />' . "\n";
            $this->seotags .= '<meta property="og:type" content="article" />' . "\n";
            $this->seotags .= "\n";

            //ITEM GROUP (TWITTER)
            $this->seotags .= '<meta itemprop="name" content="' . $read->getResult()[0]['post_title'] . '">' . "\n";
            $this->seotags .= '<meta itemprop="description" content="' . $read->getResult()[0]['post_description'] . '">' . "\n";
            $this->seotags .= '<meta itemprop="url" content="' . $this->Tags['Link'] . '">' . "\n";

        elseif (!empty($this->categoria)):

            $read = new Read;
            $read->ExeRead('ws_categories', "WHERE category_name = :p", "p={$this->categoria}");
            $read->getResult();


            $this->seotags = '<title>' . $read->getResult()[0]['category_title'] . '</title>' . "\n";
            $this->seotags .= '<meta name="description" content="' . $read->getResult()[0]['category_description'] . '"/>' . "\n";
            $this->seotags .= '<meta name="robots" content="index, follow" />' . "\n";
            $this->seotags .= '<link rel="canonical" href="' . $this->tags['Link'] . '">' . "\n";
            $this->seotags .= "\n";

            $this->seotags .= '<meta property="og:site_name" content="' . SITENAME . '" />' . "\n";
            $this->seotags .= '<meta property="og:locale" content="pt_BR" />' . "\n";
            $this->seotags .= '<meta property="og:title" content="' . $read->getResult()[0]['category_title'] . '" />' . "\n";
            $this->seotags .= '<meta property="og:description" content="' . $read->getResult()[0]['category_description'] . '" />' . "\n";
            $this->seotags .= '<meta property="og:image" content="' . $this->tags['Image'] . '" />' . "\n";
            $this->seotags .= '<meta property="og:url" content="' . $this->tags['Link'] . '" />' . "\n";
            $this->seotags .= '<meta property="og:type" content="article" />' . "\n";
            $this->seotags .= "\n";

            //ITEM GROUP (TWITTER)
            $this->seotags .= '<meta itemprop="name" content="' . $read->getResult()[0]['category_title'] . '">' . "\n";
            $this->seotags .= '<meta itemprop="description" content="' . $read->getResult()[0]['category_description'] . '">' . "\n";
            $this->seotags .= '<meta itemprop="url" content="' . $this->tags['Link'] . '">' . "\n";
            
             elseif ($this->pagina == "categoria"):
            $this->seotags = '<title>  Categoria do Site '.SITENAME.' </title>' . "\n";
            $this->seotags .= '<meta name="description" content="Aqui vemos todas as categorias do site '.SITENAME.'"/>' . "\n";
            $this->seotags .= '<meta name="robots" content="index, follow" />' . "\n";
            $this->seotags .= '<link rel="canonical" href="' . $this->tags['Link'] . '">' . "\n";
            $this->seotags .= "\n";

        elseif (!empty($this->pagina)):
            $read = new Read;
            $read->ExeRead('ws_posts', "WHERE post_name = :p", "p={$this->pagina}");
            $read->getResult();


            $this->seotags = '<title>' . $read->getResult()[0]['post_title'] . '</title>' . "\n";
            $this->seotags .= '<meta name="description" content="' . $read->getResult()[0]['post_description'] . '"/>' . "\n";
            $this->seotags .= '<meta name="robots" content="index, follow" />' . "\n";
            $this->seotags .= '<link rel="canonical" href="' . $this->tags['Link'] . '">' . "\n";
            $this->seotags .= "\n";

            $this->seotags .= '<meta property="og:site_name" content="' . SITENAME . '" />' . "\n";
            $this->seotags .= '<meta property="og:locale" content="pt_BR" />' . "\n";
            $this->seotags .= '<meta property="og:title" content="' . $read->getResult()[0]['post_title'] . '" />' . "\n";
            $this->seotags .= '<meta property="og:description" content="' . $read->getResult()[0]['post_description'] . '" />' . "\n";
            $this->seotags .= '<meta property="og:image" content="' . $this->Tags['Image'] . '" />' . "\n";
            $this->seotags .= '<meta property="og:url" content="' . $this->Tags['Link'] . '" />' . "\n";
            $this->seotags .= '<meta property="og:type" content="article" />' . "\n";
            $this->seotags .= "\n";

            //ITEM GROUP (TWITTER)
            $this->seotags .= '<meta itemprop="name" content="' . $read->getResult()[0]['post_title'] . '">' . "\n";
            $this->seotags .= '<meta itemprop="description" content="' . $read->getResult()[0]['post_description'] . '">' . "\n";
            $this->seotags .= '<meta itemprop="url" content="' . $this->Tags['Link'] . '">' . "\n";



        elseif (empty($this->pagina)):
            $this->pagina = "index";
            $read = new Read;
            $read->ExeRead('ws_posts', "WHERE post_name = :p", "p=index");
            $read->getResult();


            $this->seotags = '<title>' . $read->getResult()[0]['post_title'] . '</title>' . "\n";
            $this->seotags .= '<meta name="description" content="' . $read->getResult()[0]['post_description'] . '"/>' . "\n";
            $this->seotags .= '<meta name="robots" content="index, follow" />' . "\n";
            $this->seotags .= '<link rel="canonical" href="' . $this->tags['Link'] . '">' . "\n";
            $this->seotags .= "\n";

            $this->seotags .= '<meta property="og:site_name" content="' . SITENAME . '" />' . "\n";
            $this->seotags .= '<meta property="og:locale" content="pt_BR" />' . "\n";
            $this->seotags .= '<meta property="og:title" content="' . $read->getResult()[0]['post_title'] . '" />' . "\n";
            $this->seotags .= '<meta property="og:description" content="' . $read->getResult()[0]['post_description'] . '" />' . "\n";
            $this->seotags .= '<meta property="og:image" content="' . $this->Tags['Image'] . '" />' . "\n";
            $this->seotags .= '<meta property="og:url" content="' . $this->Tags['Link'] . '" />' . "\n";
            $this->seotags .= '<meta property="og:type" content="article" />' . "\n";
            $this->seotags .= "\n";

            //ITEM GROUP (TWITTER)
            $this->seotags .= '<meta itemprop="name" content="' . $read->getResult()[0]['post_title'] . '">' . "\n";
            $this->seotags .= '<meta itemprop="description" content="' . $read->getResult()[0]['post_description'] . '">' . "\n";
            $this->seotags .= '<meta itemprop="url" content="' . $this->Tags['Link'] . '">' . "\n";



        endif;
    }

}
