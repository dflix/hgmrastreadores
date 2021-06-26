

<section class="main"> 

    <article>

        <h1> Inserir Categorias</h1>

        <?php
        $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (!empty($data['SendPostForm'])):
            unset($data['SendPostForm']);

            require('models/AdminCategory.class.php');
            $cadastra = new AdminCategory;
            $cadastra->ExeCreate($data);

            if (!$cadastra->getResult()):
                WSErro($cadastra->getError()[0], $cadastra->getError()[1]);
            else:
                echo "<script>location.href='painel.php?p=ecateg';</script>";
                
            endif;
        endif;
       

        ?>

        <form name="PostForm" action="" method="post" enctype="multipart/form-data" >
            
            

            <label class="label">
                <p class="fontform">Titulo:</p>
                <input type="text" name="category_title" value="" class="campos" />
            </label>

            <label class="label">
                <p class="fontform"><b>SEO</b> Descrição da categoria:</p>
                <input type="text" name="category_description" rows="5" value="" maxlength="156" class="camposdescription" />
            </label>

            <label class="label">
                <p class="fontform">Categoria:</p>
      <label>
          <select name="category_parent" id="select" class="campos">
              <option value="0">  Selecionar Categoria </option>
          <?php 
          $read = new Read;
          $read->ExeRead('ws_categories');
          foreach($read->getResult() as $categ):
              
         
            extract($categ);
          
          echo "<option value='{$categ['category_id']}'>  {$categ['category_title']} </option>";
          
          endforeach;
          ?>
    

</select>
            <label class="label">
                <p class="fontform">Descrição da Categoria </p>
                <textarea name="category_content" class="js_editor" rows="5"><?php if (isset($data)) echo $data['category_content']; ?></textarea>
            </label>

          <input type="hidden" name="category_date" value="<?= date('d/m/Y H:i:s'); ?>" />

            <input type="submit" class="btn green" value="Cadastrar Categoria" name="SendPostForm" />                              



        </form>

        <article>
            </section>