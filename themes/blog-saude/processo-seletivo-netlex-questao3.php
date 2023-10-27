<?php

/**
 * Questão 3
 */
$file = 'in.txt'; // Recebe nome do arquivo de entrada
$str = file_get_contents($file); // Lê o arquivo de entrada
$array = file($file); // Transforma cada linha do arquivo em posição de array

$numCaracteres = $array[0]; // Recupera o número máximo de caracteres permitido por linha 
$texto = $array[1]; // Recupera o texto completo

/**
 * quebrarTexto: Método responsável pela quebra do texto em linhas de acordo com o número máximo de caracteres (passado por parâmetro) e sem a quebra de plavras
 * e texto (passado por parâmetro)
 * @param String $texto
 * @param int $numCaracteres
 * @return Array
 */
function quebrarTexto($texto, $numCaracteres) {

    $palavras = explode(' ', $texto); // Transforma cada palavra do texto em uma possição de array
    $coletorPalavra = ''; // inicializa a variável responsável por concatenar as palavras do texto
    $lastIndex = count($palavras) - 1; // recupera o ultimo indice do array com as palavras do texto
    $i = 0; // contador

    foreach ($palavras as $palavra):

        if (strlen($coletorPalavra . $palavra) < $numCaracteres): // Se as palavras concatenadas com a plavra atual da iteração tiverem o número de caracteres menor que o máximo permitido
            $coletorPalavra .= (!empty($coletorPalavra) ? ' ' : '') . $palavra; // Continuará concatenando 
        elseif (strlen($coletorPalavra . $palavra) == $numCaracteres): // Senão se as palavras concatenadas com a plavra atual da iteração tiverem o número de caracteres igual ao máximo permitido
            $coletorPalavra .= (!empty($coletorPalavra) ? ' ' : '') . $palavra; // Concatena com a palavra atual
            $linha[] = $coletorPalavra; // Essa concatenação é inserida em uma posição de array chamada linha que armazenará a nova linha criada
            $coletorPalavra = ''; // Reinicializa o concatenador de palavras
        else: // Caso contrário, ou seja, se as palavras concatenadas com a plavra atual da iteração tiverem o número de caracteres maior que o máximo permitido
            $linha[] = $coletorPalavra; // Armazena em uma nova posição do array as palavras concatenadas até o momento
            ($i == $lastIndex ? $linha[] = $palavra : $coletorPalavra = $palavra); // Se for a última palavra do texto, ela é inserida em uma nova possição do array linha. Caso contrário, o concatenador de plavra será reinicializado com a palavra atual, aguardando as próximas palavras serem concatenadas
        endif;

        $i++; // Incremento para verificar quando será a última palavra
    endforeach;

    return $linha;
}

/**
 * escreverArquivo; Método responsável por escrever o arquivo de acordo com o nome do arquivo e com o conteúdeo passado por parâmetro
 * @param Array $conteudo
 * @param String $nomeArquivo
 */
function escreverArquivo($conteudo, $nomeArquivo) {

    // Escreve o arquivo linha a linha de acordo com o array passado por parâmetro
    foreach ($conteudo as $registro):
        file_put_contents($nomeArquivo, $registro . PHP_EOL, FILE_APPEND);
    endforeach;
}

// Recupera o texto formatado com a quebra de texto
$saida = quebrarTexto($texto, $numCaracteres);

// Escreve o resultado da formatação no arquivo "out.txt"
escreverArquivo($saida, 'out.txt');
?>