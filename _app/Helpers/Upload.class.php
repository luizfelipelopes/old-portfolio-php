<?php

/**
 * Upload.class [ HELPER ]
 * Responsável por executar upload de imagens, arquivos e mídias no sistema!
 * 
 * @copyright (c) 2016, Luiz Felipe C. Lopes UPINSIDE TECNOLOGIA 
 */
class Upload {

    private $File;
    private $Name;
    private $Send;

    /** IMAGE UPLOAD  */
    private $Width;
    private $Image;

    /** RESULTSET  */
    private $Result;
    private $Error;

    /** DIRETÓRIOS  */
    private $Folder;
    private static $BaseDir;

    public function __construct($BaseDir = null) {
        self::$BaseDir = ((string) $BaseDir ? $BaseDir : '../uploads/');
        // não pode existir e não pode serum diretório
        if (!file_exists(self::$BaseDir) && !is_dir(self::$BaseDir)):
            mkdir(self::$BaseDir, 0777);
        endif;
    }

    public function Image(array $Image, $Name = null, $Width = null, $Folder = null) {
        $this->File = $Image;
        $this->Name = ((string) $Name ? $Name : substr($Image['name'], 0, strrpos($Image['name'], '.')));
        $this->Width = ( (int) $Width ? $Width : 1024);
        $this->Folder = ( (string) $Folder ? $Folder : 'images');

        $this->CheckFolder($this->Folder);
        $this->setFileName();
        $this->UploadImage();
    }

    public function File(array $File, $Name = null, $Folder = null, $MaxFileSize = null) {
        $this->File = $File;
        $this->Name = ((string) $Name ? $Name : substr($File['name'], 0, strrpos($File['name'], '.')));
        $this->Folder = ( (string) $Folder ? $Folder : 'files');
        $MaxFileSize = ((int) $MaxFileSize ? $MaxFileSize : 2);

        $FileAccept = [
            'text/plain',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'application/vnd.ms-powerpoint',
            'application/vnd.openxmlformats-officedocument.presentationml.presentation',
            'application/pdf'
        ];


        if ($this->File['size'] > ($MaxFileSize * (1024 * 1024))):
            $this->Result = false;
            $this->Error = ["Arquivo muito grande, tamanho máximo permitido de {$MaxFileSize}mb", WS_ALERT];
            
            elseif(!in_array($this->File['type'], $FileAccept)):
                $this->Result = false;
                $this->Error = ['Tipo de arquivo não suportado. Envie .PDF ou .DOCX', WS_ALERT];
        else:
            $this->CheckFolder($this->Folder);
            $this->setFileName();
            $this->MoveFile();
        endif;
    }

    
    public function Media(array $Media, $Name = null, $Folder = null, $MaxFileSize = null) {
        $this->File = $Media;
        $this->Name = ((string) $Name ? $Name : substr($Media['name'], 0, strrpos($Media['name'], '.')));
        $this->Folder = ( (string) $Folder ? $Folder : 'medias');
        $MaxFileSize = ((int) $MaxFileSize ? $MaxFileSize : 40);

        $FileAccept = [
            'audio/mp3',
            'video/mp4'
        ];


        if ($this->File['size'] > ($MaxFileSize * (1024 * 1024))):
            $this->Result = false;
            $this->Error = ["Arquivo muito grande, tamanho máximo permitido de {$MaxFileSize}mb", WS_ALERT];
            
            elseif(!in_array($this->File['type'], $FileAccept)):
                $this->Result = false;
                $this->Error = ['Tipo de arquivo não suportado. Envie audio mp3 ou video mp4', WS_ALERT];
        else:
            $this->CheckFolder($this->Folder);
            $this->setFileName();
            $this->MoveFile();
        endif;
    }
    
    
    public function getResult() {
        return $this->Result;
    }

    public function getError() {
        return $this->Error;
    }

    //PRIVATES
    private function CheckFolder($Folder) {
        // Armazrna os indices nas variáveis
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

    // Verifica e monta o nome dos arquivos tratando as strings
    private function setFileName() {
        //strrchr() = Encontra a última ocorrência de um caractere em uma string
        $FileName = Check::Name($this->Name) . strrchr($this->File['name'], '.');
        if (file_exists(self::$BaseDir . $this->Send . $FileName)):
            $FileName = Check::Name($this->Name) . '-' . time() . strrchr($this->File['name'], '.');

        endif;
        $this->Name = $FileName;
//        var_dump($FileName);
    }

    //Realiza o upload de imagens redimensionando a mesma!
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
        endswitch;

        if (!$this->Image):
            $this->Result = false;
            $this->Error = ['Tipo de arquivo inválido, envie imagens JPG ou PNG', WS_ALERT];
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
            endswitch;


            if (!$NewImage):
                $this->Result = false;
                $this->Error = ['Tipo de arquivo inválido, envie imagens JPG ou PNG', WS_ALERT];
            else:
                $this->Result = $this->Send . $this->Name;
                $this->Error = null;
            endif;

            imagedestroy($this->Image);
            imagedestroy($NewImage);

        endif;
    }

    //Envia arquivos e midias
    private function MoveFile() {
        if (move_uploaded_file($this->File['tmp_name'], self::$BaseDir . $this->Send . $this->Name)):
            $this->Result = $this->Send . $this->Name;
            $this->Error = null;
        else:
            $this->Result = false;
            $this->Error = ['Erro ao mover ao arquivo. Favor tente mais tarde!', WS_ALERT];
        endif;
    }

}
