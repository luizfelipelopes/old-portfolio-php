<?php

/**
 * Export [ HELPERS ]
 * Exporta Arquivo em Diversos Formatos
 * @copyright (c) 2017, Luiz Felipe C. Lopes [FLOWSTATE]
 */
class Export {

    public function __construct($Db, $prefix, $formato, $nome = null) {
        $read = new Read;
        $read->FullRead("SELECT " . ($nome ? $prefix . "_name, " : '') . $prefix . "_email FROM " . $Db . " ORDER BY " . $prefix . "_date DESC");
        if ($read->getResult()):
            
            $this->download_send_headers(SITENAME . '-Leads-' . date('Y-m-d H:i:s') . '.' . $formato);

            switch ($formato):
                case 'csv':
                    echo $this->array2Csv($read->getResult());
                    break;
                case 'xls':
                    echo $this->array2Csv($read->getResult());
                    break;
                case 'pdf':
                    echo $this->array2Csv($read->getResult());
                    break;
                default :
                    break;
            endswitch;

            die();
        endif;
    }

    private function array2Csv(array $Array) {

        if (count($Array) == 0):
            return null;
        endif;

        ob_start();
        $df = fopen("php://output", "w");
        fputcsv($df, array_keys(reset($Array)));
        foreach ($Array as $row):
            fputcsv($df, $row);
        endforeach;

        fclose($df);

        return ob_get_clean();
    }

    private function download_send_headers($filename) {

//        DISABILITAR CACHE
        $now = gmdate('D, d M Y H:i:s');
        header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
        header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
        header("Last-Modified: {$now} GMT");

//        FORÇAR DOWLOAD
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");

//        DISPOSIÇÂO E ENNCODING EM RESPOSTA NO CORPO
        header("Content-Disposition: attachment;filename={$filename}");
        header("Content-Transfer-Encoding: binary");
    }

}
