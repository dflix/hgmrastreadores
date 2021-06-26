<?php

/**
 * Upload.class [ HELPER ]
 * Reponsável por executar upload do logotipo;
 * 
 * @copyright (c) 2014, Robson V. Leite UPINSIDE TECNOLOGIA
 */
class UploadLogo {

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

    function __construct($BaseDir = null) {

        self::$BaseDir = ((string) $BaseDir ? $BaseDir : '../uploads/');
        if (!file_exists(self::$BaseDir) && !is_dir(self::$BaseDir)):
            mkdir(self::$BaseDir, 0777);
        endif;
    }

    public function Image(array $Image, $Name = null, $Width = null, $Folder = null) {
        $this->File = $Image;
        $this->Name = ( (string) $Name ? $Name : substr($Image['name'], 0, strrpos($Image['name'], '.')));
        $this->Width = ((int) $Width ? $Width : 1024 );
        $this->Folder = ( (int) $Folder ? $Folder : 'images');

        $this->CheckFolder($this->Folder);
        $this->setFileName();
        $this->uploadImage();
        $this->inserir();
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

    //realiza o upload de imagens e redimensiona a mesma

    private function uploadImage() {

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

//                //aqui coloco função para inserir no banco
//
//                $cadastra = new Create;
//                $cadastra->ExeCreate('ws_logotipo', $this->Result);
//                $cadastra->getResult();

                

            endif;
            imagedestroy($this->Image);
            imagedestroy($NewImage);

        endif;
    }
    
    private function inserir() {
        
        $dados =  [ 
            logo => $this->Result,
            alt => $_POST['alt'],
            title => $_POST['title']
        ];
                $cadastra = new Create;
                $cadastra->ExeCreate('ws_logotipo', $dados);
                $cadastra->getResult();
                
                if(!empty($cadastra->getResult())):
                    echo "Cadastrado com sucesso no banco de dados no caminho {$this->Result} ";
                    else:
                        echo "Deu merda";
                endif;
        
    }

}
