<?php


define('CODIGO_CONTRATO_CORREIOS', '08082650');
define('SENHA_CONTRATO_CORREIOS', '564321');
define('API_SHIPPING_URL', 'http://ws.correios.com.br/calculador/');
define('API_SHIPPING_KEY', ['nCdEmpresa' => CODIGO_CONTRATO_CORREIOS, 'sDsSenha' => SENHA_CONTRATO_CORREIOS]);
define('API_SHIPPING_ENDPOINT_PRECO_PRAZO', 'CalcPrecoPrazo.aspx');
define('API_SHIPPING_ENDPOINT_PRECO', 'CalcPreco.aspx');
define('API_SHIPPING_ENDPOINT_PRAZO', 'CalcPrazo.aspx');


/*
define("PRECO_PRAZO", "preco_prazo");
define("PRECO", "preco");
define("PRAZO", "prazo");
define('CALC_PRECO_PRAZO_CORREIOS', 'http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx');
define('CALC_PRECO_CORREIOS', 'http://ws.correios.com.br/calculador/CalcPreco.aspx');
define('CALC_PRAZO_CORREIOS', 'http://ws.correios.com.br/calculador/CalcPreco.aspx');
*/