


<section class="main"> 
                    
                    <article>
                        
                        <h1> Editar Categorias</h1>
                        
                                                <div class="blocoecateg"> 
                        
                            <div class="datablocotop"> 
                            DATA
                            </div>
                            
                            <div class="categoriablocotop"> 
                            CATEGORIA
                            </div>
                            
                            <div class="descricaoblocotop"> 
                            DESCRIÇÃO
                            </div>
                            
                         <div class="editarblocotop"> 
                            EDIT
                            </div>
                            <div class="deletarblocotop"> 
                           DEL
                            </div>
                        </div>
                        
                        
                        <?php 
                        
                        
         $deleta = filter_input(INPUT_GET, 'del', FILTER_VALIDATE_INT);
         if(isset($deleta)):       
         require('models/AdminCategory.class.php');
         $del = new AdminCategory;
         $del->ExeDelete($deleta);
         
            if (!$del->getResult()):
                WSErro($del->getError()[0], $del->getError()[1]);
            else:
                echo "A categoria {$del->getResult()} foi deletada com sucesso";
                
            endif;
        
           endif;             
                        
                        
         $Atual = filter_input(INPUT_GET, 'atual' , FILTER_VALIDATE_INT);// dessa forma pegamos o parametro pelo get
   
        $Pager = new Pager('painel.php?p=ecateg&atual=', 'Primeira', 'Ultima' ,'1');
        $Pager->ExePager($Atual, 5);
                        
                        $read = new Read;
                       
                          $read->ExeRead('ws_categories', 'ORDER BY category_id DESC LIMIT :limit OFFSET :offset', "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");
                        $read->getResult();
                        
                        foreach ($read->getResult() as $exibe) {
                           $data =date('d/m/Y' , strtotime($exibe['category_date'])) ;
                           
                            echo "
                                
                            <div class='blocoecateg'> 
                        
                            <div class='databloco'> 
                            {$data}
                            </div>
                            
                            <div class='categoriabloco'> 
                            {$exibe['category_title']}
                            </div>
                            
                            <div class='descricaobloco'> 
                            {$exibe['category_description']}
                            </div>
                            
                         <div class='editarbloco'> 
                            <a href='painel.php?p=acateg&idcateg={$exibe['category_id']}'> <img src='icons/act_edit.png' /></a>
                            </div>
                            <div class='deletarbloco'> 
                          <a href='painel.php?p=ecateg&del={$exibe['category_id']}'> <img src='icons/act_delete.png' /> </a>
                            </div>
                        </div>";
                            
                            
                        }
                        
                        ?>
                        
                        
 <?php 

        
        $Pager->ExePaginator('ws_categories');
        echo $Pager->getPaginator();
 
 ?>
                        
                        
                        <article>
                            </section>