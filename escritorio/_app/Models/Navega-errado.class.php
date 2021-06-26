<?php

/**
 *  Navega.class.php[HELPERS]
 * Classe responsavel por verificar url e exibir view
 * @copyright (c) year, Marcio Leite Up
 */
class Navegaerrado {

    public $local;
    public $data;
    public $seotags;
    public $conteudo;
    public $incluir;
    public $patch;

    function __construct() {


        $this->conteudo = $this->conteudo;
        $this->data = $this->data;
        $this->local = $this->local;
        $this->incluir = $this->incluir;

        $this->seotags = $this->seotags;
        $this->incluir = $this->incluir;
        $this->patch = $this->patch;

        $this->Conteudo();
        $this->Data();
        $this->settags();
        $this->Seotags();
        $this->Incluir();
        $this->Local();
    }
    
    public function Local() {
        $this->local = strip_tags(trim(filter_input(INPUT_GET, 'url', FILTER_DEFAULT)));
        $this->local = ($this->local ? $this->local : 'index');
        $this->local = explode('/', $this->local);
        return $this->local;
        
        $this->pagcat = $this->local[2];

        $this->categoria = $this->local[1];

        $this->pagina = $this->local[0];
        
    }
    public function Incluir() {
        
        if(!empty($this->local[2])){
           $this->incluir = "single-post-categ.php";  
        }else{
           
            if(!empty($this->local[1])){
               $this->incluir = "categ.php";   
            }else{
                
                if($this->local[0] == "categorias"){
                    
                    $this->incluir = "general-categ.php";
                    
                }else{
                    
                    if(!empty($this->local[0])){
                        
                        $this->incluir = "single.php";
                        
                    }else{
                        
                        if(empty($this->local[0])){
                            
                            $this->incluir = "home.php";
                        }
                    }
                    
                }
                
                
            }
            
        }
            
    }

    public function Conteudo() {
        $conteudo = new Read;
        $conteudo->ExeRead('ws_posts', "WHERE post_name = :p", "p={$this->pagina}");
        $conteudo->getResult();
        $this->conteudo = $conteudo->getResult();
        return $this->conteudo;
    }

    public function Data() {

        $this->data = ["{$this->pagina}", "Descrição do pagina {$this->pagina}", $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], HOME . "imagens/agluma.png"];
    }

    private function settags() {
        $this->tags['Title'] = $this->data[0];
        $this->tags['Description'] = $this->data[1];
        $this->tags['Link'] = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $this->tags['Image'] = $this->data[3];
    }

    private function Seotags() {

//        if (!empty($this->local[2])):
//
//            $read = new Read;
//            $read->ExeRead('ws_posts', "WHERE post_name = :p", "p={$this->local[2]}");
//            $read->getResult();
//
//            if (empty($read->getResult())):
//                $this->local[2] = "404";
//
//            endif;
//
//            if ($this->local[2] == "404"):
//                $this->seotags = '<title>  404 ERROR  </title>' . "\n";
//                $this->seotags .= '<meta name="description" content=" ' . SITENAME . ' ' . SITEDESC . '"/>' . "\n";
//                $this->seotags .= '<meta name="robots" content="index, follow" />' . "\n";
//                $this->seotags .= '<link rel="canonical" href="' . $this->tags['Link'] . '">' . "\n";
//                $this->seotags .= "\n";
//
//            else:
//
//                $this->seotags = '<title>' . $read->getResult()[0]['post_title'] . '</title>' . "\n";
//                $this->seotags .= '<meta name="description" content="' . $read->getResult()[0]['post_description'] . '"/>' . "\n";
//                $this->seotags .= '<meta name="robots" content="index, follow" />' . "\n";
//                $this->seotags .= '<link rel="canonical" href="' . $this->tags['Link'] . '">' . "\n";
//                $this->seotags .= "\n";
//
//                $this->seotags .= '<meta property="og:site_name" content="' . SITENAME . '" />' . "\n";
//                $this->seotags .= '<meta property="og:locale" content="pt_BR" />' . "\n";
//                $this->seotags .= '<meta property="og:title" content="' . $read->getResult()[0]['post_title'] . '" />' . "\n";
//                $this->seotags .= '<meta property="og:description" content="' . $read->getResult()[0]['post_description'] . '" />' . "\n";
//                $this->seotags .= '<meta property="og:image" content="' . $this->tags['Image'] . '" />' . "\n";
//                $this->seotags .= '<meta property="og:url" content="' . $this->tags['Link'] . '" />' . "\n";
//                $this->seotags .= '<meta property="og:type" content="article" />' . "\n";
//                $this->seotags .= "\n";
//
////ITEM GROUP (TWITTER)
//                $this->seotags .= '<meta itemprop="name" content="' . $read->getResult()[0]['post_title'] . '">' . "\n";
//                $this->seotags .= '<meta itemprop="description" content="' . $read->getResult()[0]['post_description'] . '">' . "\n";
//                $this->seotags .= '<meta itemprop="url" content="' . $this->tags['Link'] . '">' . "\n";
//            endif;
//
//        elseif (!empty($this->local[1])):
//
//            $read = new Read;
//            $read->ExeRead('ws_categories', "WHERE category_name = :p", "p={$this->local[1]}");
//            $read->getResult();
//
//            if (empty($read->getResult())):
//                $this->local[1] = "404";
//
//            endif;
//
//
//            if ($this->local[1] == "404"):
//                $this->seotags = '<title>  404 ERROR  </title>' . "\n";
//                $this->seotags .= '<meta name="description" content=" ' . SITENAME . ' ' . SITEDESC . '"/>' . "\n";
//                $this->seotags .= '<meta name="robots" content="index, follow" />' . "\n";
//                $this->seotags .= '<link rel="canonical" href="' . $this->tags['Link'] . '">' . "\n";
//                $this->seotags .= "\n";
//
//            else:
//
//
//                $this->seotags = '<title>' . $read->getResult()[0]['category_title'] . '</title>' . "\n";
//                $this->seotags .= '<meta name="description" content="' . $read->getResult()[0]['category_description'] . '"/>' . "\n";
//                $this->seotags .= '<meta name="robots" content="index, follow" />' . "\n";
//                $this->seotags .= '<link rel="canonical" href="' . $this->tags['Link'] . '">' . "\n";
//                $this->seotags .= "\n";
//
//                $this->seotags .= '<meta property="og:site_name" content="' . SITENAME . '" />' . "\n";
//                $this->seotags .= '<meta property="og:locale" content="pt_BR" />' . "\n";
//                $this->seotags .= '<meta property="og:title" content="' . $read->getResult()[0]['category_title'] . '" />' . "\n";
//                $this->seotags .= '<meta property="og:description" content="' . $read->getResult()[0]['category_description'] . '" />' . "\n";
//                $this->seotags .= '<meta property="og:image" content="' . $this->tags['Image'] . '" />' . "\n";
//                $this->seotags .= '<meta property="og:url" content="' . $this->tags['Link'] . '" />' . "\n";
//                $this->seotags .= '<meta property="og:type" content="article" />' . "\n";
//                $this->seotags .= "\n";
//
////ITEM GROUP (TWITTER)
//                $this->seotags .= '<meta itemprop="name" content="' . $read->getResult()[0]['category_title'] . '">' . "\n";
//                $this->seotags .= '<meta itemprop="description" content="' . $read->getResult()[0]['category_description'] . '">' . "\n";
//                $this->seotags .= '<meta itemprop="url" content="' . $this->tags['Link'] . '">' . "\n";
//
//            endif;
//
//        elseif ($this->local[0] == "categorias"):
//            $this->seotags = '<title>  Categoria do Site ' . SITENAME . ' </title>' . "\n";
//            $this->seotags .= '<meta name="description" content="Aqui vemos todas as categorias do site ' . SITENAME . '"/>' . "\n";
//            $this->seotags .= '<meta name="robots" content="index, follow" />' . "\n";
//            $this->seotags .= '<link rel="canonical" href="' . $this->tags['Link'] . '">' . "\n";
//            $this->seotags .= "\n";
//            $this->incluir = "general-categ.php";
//
//        
//
//        elseif (!empty($this->local[0])):
//            $read = new Read;
//            $read->ExeRead('ws_posts', "WHERE post_name = :p", "p={$this->local[0]}");
//            $read->getResult();
//
//            if (!$read->getResult()):
//                $this->local[0] = "404";
//
//            endif;
//            
//            elseif (empty($this->local[0])):
//
//            $this->local[0] = "index";
//            $read = new Read;
//            $read->ExeRead('ws_home', "WHERE post_name = :p", "p=index");
//            $read->getResult();
//
//
//
//
//            $this->seotags = '<title>' . $read->getResult()[0]['post_title'] . '</title>' . "\n";
//            $this->seotags .= '<meta name="description" content="' . $read->getResult()[0]['post_description'] . '"/>' . "\n";
//            $this->seotags .= '<meta name="robots" content="index, follow" />' . "\n";
//            $this->seotags .= '<link rel="canonical" href="' . $this->tags['Link'] . '">' . "\n";
//            $this->seotags .= "\n";
//
//            $this->seotags .= '<meta property="og:site_name" content="' . SITENAME . '" />' . "\n";
//            $this->seotags .= '<meta property="og:locale" content="pt_BR" />' . "\n";
//            $this->seotags .= '<meta property="og:title" content="' . $read->getResult()[0]['post_title'] . '" />' . "\n";
//            $this->seotags .= '<meta property="og:description" content="' . $read->getResult()[0]['post_description'] . '" />' . "\n";
//            $this->seotags .= '<meta property="og:image" content="' . $this->tags['Image'] . '" />' . "\n";
//            $this->seotags .= '<meta property="og:url" content="' . $this->tags['Link'] . '" />' . "\n";
//            $this->seotags .= '<meta property="og:type" content="article" />' . "\n";
//            $this->seotags .= "\n";
//
////ITEM GROUP (TWITTER)
//            $this->seotags .= '<meta itemprop="name" content="' . $read->getResult()[0]['post_title'] . '">' . "\n";
//            $this->seotags .= '<meta itemprop="description" content="' . $read->getResult()[0]['post_description'] . '">' . "\n";
//            $this->seotags .= '<meta itemprop="url" content="' . $this->tags['Link'] . '">' . "\n";
//
//            if ($this->local[0] == "404"):
//
//                $this->seotags = '<title>  ERROR 404 </title>' . "\n";
//                $this->seotags .= '<meta name="description" content="' . SITEDESC . ' ' . SITENAME . '"/>' . "\n";
//                $this->seotags .= '<meta name="robots" content="index, follow" />' . "\n";
//                $this->seotags .= '<link rel="canonical" href="' . $this->tags['Link'] . '">' . "\n";
//                $this->seotags .= "\n";
//
//            else:
//
//
//                $this->seotags = '<title>' . $read->getResult()[0]['post_title'] . '</title>' . "\n";
//                $this->seotags .= '<meta name="description" content="' . $read->getResult()[0]['post_description'] . '"/>' . "\n";
//                $this->seotags .= '<meta name="robots" content="index, follow" />' . "\n";
//                $this->seotags .= '<link rel="canonical" href="' . $this->tags['Link'] . '">' . "\n";
//                $this->seotags .= "\n";
//
//                $this->seotags .= '<meta property="og:site_name" content="' . SITENAME . '" />' . "\n";
//                $this->seotags .= '<meta property="og:locale" content="pt_BR" />' . "\n";
//                $this->seotags .= '<meta property="og:title" content="' . $read->getResult()[0]['post_title'] . '" />' . "\n";
//                $this->seotags .= '<meta property="og:description" content="' . $read->getResult()[0]['post_description'] . '" />' . "\n";
//                $this->seotags .= '<meta property="og:image" content="' . $this->tags['Image'] . '" />' . "\n";
//                $this->seotags .= '<meta property="og:url" content="' . $this->tags['Link'] . '" />' . "\n";
//                $this->seotags .= '<meta property="og:type" content="article" />' . "\n";
//                $this->seotags .= "\n";
//
////ITEM GROUP (TWITTER)
//                $this->seotags .= '<meta itemprop="name" content="' . $read->getResult()[0]['post_title'] . '">' . "\n";
//                $this->seotags .= '<meta itemprop="description" content="' . $read->getResult()[0]['post_description'] . '">' . "\n";
//                $this->seotags .= '<meta itemprop="url" content="' . $this->tags['Link'] . '">' . "\n";
//
//            endif;
//
//
//
//
//
//        endif;
    }

   

}
