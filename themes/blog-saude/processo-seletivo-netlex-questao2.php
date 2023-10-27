<?php

// Código-Fonte em PHP - Questão 2
$itemLista = ["João", "Maria", "José"];

foreach ($itemLista as $item):

    echo $item . ' é um' . ($item == "João" || $item == "José" ? "" : "a") . " alun" . ($item == "João" || $item == "José" ? "o" : "a") . PHP_EOL;

endforeach;

?>