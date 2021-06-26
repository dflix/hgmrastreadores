<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Classe responsavel por inserir, editar e excluir produtos da loja virtual
 *
 * @author Marcio Leite
 */
class InsertProduts {

    private $File;
    private $Name;
    private $Send;

    /** IMAGE UPLOAD   */
    private $Width;
    private $Image;

    /** RESULTSET  */
    private $Result;
    private $Error;

    /** DIRETORIOS  */
    private $Folder;
    private static $BaseDir;
    private $Data;
    private $Galery;

    const Entity = "ws_prod";

    function __construct() {
        self::$BaseDir = ((string) $BaseDir ? $BaseDir : '../uploads/');
        if (!file_exists(self::$BaseDir) && !is_dir(self::$BaseDir)):
            mkdir(self::$BaseDir, 0777);
        endif;
    }

    public function exeCreate(array $Dados) {
        $this->Data = $this->Data;
    }

    public function image(array $Image, $Name = null, $Widht = null, $Folder = null) {
        $this->File = $Image;
        $this->Name = ((string) $Name ? $Name : substr($Image['name'], 0, strrpos($Image['name'], '.')) );
        $this->Width = ( (int) $Widht ? $Widht : 1024);
        $this->Folder = ((string) $Folder ? $Folder : 'images');

        $this->CheckFolder($this->Folder);
        $this->setFileName();
        $this->UploadImage();
        $this->setData();
        $this->Verifica();
        $this->Cadastra();
        
    }

    public function gbSend(array $Images, $Postid) {
        $this->Post = $Postid;
        $this->Galery = $Images;



        $ImageName = new Read;
        $ImageName->ExeRead(self::Entity, "WHERE prod_id = :p", "p={$this->Post}");
        if (!$ImageName->getResult()):
            $this->Error = ["Erro ao enviar galeria, indica {} não encontrado no banco", WS_ERROR];
            $this->Result = false;
        else:

            $ImageName = $ImageName->getResult()[0]['prod_slug'];

            $gbFiles = array();
            $gbCount = count($this->Galery['tmp_name']);
            $gbKeys = array_keys($this->Galery);

            for ($gb = 0; $gb < $gbCount; $gb++):
                foreach ($gbKeys as $Keys):
                    $gbFiles[$gb][$Keys] = $this->Galery[$Keys][$gb];
                endforeach;

            endfor;

            $gbSend = new Upload;

            $i = 0;
            $u = 0;

            foreach ($gbFiles as $gbUpload) {
                $i++;
                $ImgName = "{$ImageName}-gb-{$this->Post}-" . (substr(md5(time() + $i), 0, 5));
                $gbSend->Image($gbUpload, $ImgName);
                if ($gbSend->getResult()):
                    $gbImage = $gbSend->getResult();
                    $gbCreate = ["post_id" => $this->Post, "gallery_image" => $gbImage, "gallery_date" => date('Y-m-d H:i:s')];
                    $insertgb = new Create;
                    $insertgb->ExeCreate("ws_posts_gallery", $gbCreate);
                   


                endif;
            }

            //var_dump($gbFiles);

        endif;

        //var_dump($Images);
    }

    public function getResult() {
        return $this->Result;
    }

    public function getError() {
        return $this->Error;
    }

    //PRIVATES




    private function CheckFolder($Folder) {
        list($y, $m) = explode('/', date('Y/m'));
        $this->CreateFolder("{$Folder}");
        $this->CreateFolder("{$Folder}/{$y}");
        $this->CreateFolder("{$Folder}/{$y}/{$m}/");
        $this->Send = "{$Folder}/{$y}/{$m}/";
    }

    private function CreateFolder($Folder) {
        if (!file_exists(self::$BaseDir . $Folder) && !is_dir(self::$BaseDir . $Folder)):
            mkdir(self::$BaseDir . $Folder, 0777);
        endif;
    }

    private function setFileName() {
        $FileName = Check::Name($this->Name) . strrchr($this->File['name'], '.');
        if (file_exists(self::$BaseDir . $this->Send . $FileName)):
            $FileName = Check::Name($this->Name) . '-' . time() . strrchr($this->File['name'], '.');


        endif;
        $this->Name = $FileName;
    }

    private function UploadImage() {
        switch ($this->File['type']):
            case 'image/jpg':
            case 'image/jpeg':
            case 'image/pjpeg':
                $this->Image = imagecreatefromjpeg($this->File['tmp_name']);
                break;

            case 'image/png':
            case 'image/x-png':
                $this->Image = imagecreatefrompng($this->File['tmp_name']);
                break;
        endswitch;

        if (!$this->Image):
            $this->Result = false;
            $this->Error = 'Tipo de arquivo invalido envie arquivo .jpg ou .png';
        else:
            $x = imagesx($this->Image);
            $y = imagesy($this->Image);
            $ImageX = ( $this->Width < $x ? $this->Width : $x);
            $ImageH = ($ImageX * $y) / $x;

            $NewImage = imagecreatetruecolor($ImageX, $ImageH);
            imagealphablending($NewImage, false);
            imagesavealpha($NewImage, true);
            imagecopyresampled($NewImage, $this->Image, 0, 0, 0, 0, $ImageX, $ImageH, $x, $y);

            switch ($this->File['type']):
                case 'image/jpg':
                case 'image/jpeg':
                case 'image/pjpeg':
                    imagejpeg($NewImage, self::$BaseDir . $this->Send . $this->Name);
                    break;

                case 'image/png':
                case 'image/x-png':
                    imagepng($NewImage, self::$BaseDir . $this->Send . $this->Name);
                    break;
            endswitch;

            if (!$NewImage):
                $this->Result = false;
                $this->Error = 'Tipo de arquivo invalido envie arquivo .jpg ou .png';
            else:

                $this->Result = $this->Send . $this->Name;
                $this->Error = null;

            endif;
            imagedestroy($this->Image);
            imagedestroy($NewImage);

        endif;
    }

    private function setData() {
        
      $valor = $_POST['prod_valor'];
      
      $valor = str_replace("," , "" , $valor);
      $valor = str_replace("." , "", $valor );

        $this->Data['prod_categ'] = $_POST['prod_categ'];
        $this->Data['prod_slug'] = Check::Name($_POST['prod_nome']);
        $this->Data['prod_nome'] = $_POST['prod_nome'];
        $this->Data['prod_title'] = $_POST['prod_title'];
        $this->Data['prod_description'] = $_POST['prod_description'];
        $this->Data['prod_desc_curta'] = $_POST['prod_desc_curta'];
        $this->Data['prod_content'] = $_POST['prod_content'];
        $this->Data['prod_cover'] = $this->Result;
        $this->Data['prod_status'] = $_POST['prod_status'];
        //$this->Data['prod_valor'] = str_replace(",", "", $_POST['prod_valor']);
        $this->Data['prod_valor'] = $valor;
    }

    private function Verifica() {
        $verifica = new Read;
        $verifica->ExeRead(self::Entity, "WHERE prod_nome = :p", "p={$this->Data['prod_nome']}");
        $verifica->getResult();
        if (!empty($verifica->getResult())):
            $this->Data['prod_slug'] = Check::Name($_POST['prod_nome']) . '-' . $verifica->getRowCount();
        endif;
    }

    private function Cadastra() {
        $cadastra = new Create;
        $cadastra->ExeCreate(self::Entity, $this->Data);
        $cadastra->getResult();
        if ($cadastra->getResult()):
            echo "cadastrado";
        else:
            echo "deu merda";
        endif;
    }

}
