


<section class="main"> 
                    
                    <article>
                        
                        <h1> Editar Postagem </h1>
                        
                                                <div class="blocoecateg"> 
                        
                            <div class="datablocotop"> 
                            DATA
                            </div>
                            
                            <div class="categoriablocotop"> 
                            CATEGORIA
                            </div>
                            
                            <div class="descricaoblocotop"> 
                            TITULO DO POST
                            </div>
                                                    <div class="editarblocotop"> 
                            SEO
                            </div> 
                         <div class="editarblocotop"> 
                            EDIT
                            </div>
                            <div class="deletarblocotop"> 
                           DEL
                            </div>
                        </div>
                        
                        
                        <?php 
                        
           $deleta = filter_input(INPUT_GET ,'del', FILTER_VALIDATE_INT);
          if(isset($deleta)):       
         require('models/AdminPost.class.php');
         $del = new AdminPost;
         $del->ExeDelete($deleta);
         $del->gbRemove($deleta);
         
        
         
            if (!$del->getResult()):
                WSErro($del->getError()[0], $del->getError()[1]);
            else:
                echo "A categoria {$del->getResult()} foi deletada com sucesso";
                
            endif;
        
           endif; 
            
                        
                        
         $Atual = filter_input(INPUT_GET, 'atual' , FILTER_VALIDATE_INT);// dessa forma pegamos o parametro pelo get
   
        $Pager = new Pager('painel.php?p=epost&atual=', 'Primeira', 'Ultima' ,'1');
        $Pager->ExePager($Atual, 5);
                        
                        $read = new Read;
                       
                          $read->ExeRead('ws_posts', 'ORDER BY post_id DESC LIMIT :limit OFFSET :offset', "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");
                        $read->getResult();
                        
                        foreach ($read->getResult() as $exibe) {
                           $data =date('d/m/Y H:i:s' , strtotime($exibe['post_date'])) ;
                           
                            echo "
                                
                            <div class='blocoecateg'> 
                        
                            <div class='databloco'> 
                            {$data}
                            </div>
                            
                            <div class='categoriabloco'> 
                            {$exibe['post_category']}
                            </div>
                            
                            <div class='descricaobloco'> 
                            {$exibe['post_title']}
                            </div>
                            
                         <div class='editarbloco'> 
                            <a href='painel.php?p=seo&idpost={$exibe['post_id']}'> <img src='icons/act_view.png' /></a>
                            </div>
                            
                         <div class='editarbloco'> 
                            <a href='painel.php?p=apost&idpost={$exibe['post_id']}'> <img src='icons/act_edit.png' /></a>
                            </div>
                            <div class='deletarbloco'> 
                          <a href='painel.php?p=epost&del={$exibe['post_id']}'> <img src='icons/act_delete.png' /> </a>
                            </div>
                        </div>";
                            
                            
                        }
                        
                        ?>
                        
                        
 <?php 

        
        $Pager->ExePaginator('ws_posts');
        echo $Pager->getPaginator();
 
 ?>
                        
                        
                        <article>
                            </section>