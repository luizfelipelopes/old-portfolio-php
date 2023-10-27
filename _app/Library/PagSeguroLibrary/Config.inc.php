<?php
//include 'Helpers/Check.class.php';

$servername = HOST;
$username = USER;
$password = PASS;
$dbname = DBSA;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM " .CONFIGURACOES. " WHERE config_id ='1'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        extract($row);
    }
} else {
    echo "0 results";
}
$conn->close();


//$readConfig = new Read;
//$readConfig->ExeRead(CONFIGURACOES, "WHERE config_id = :id", "id=1");
//if($readConfig->getResult()):
//    extract($readConfig->getResult()[0]);
//endif;

/**
 * PAGSEGURO
 */

define('PAGSEGURO_ENV', 'sandbox');
//define('PAGSEGURO_ENV', $config_ambiente);
define('PAGSEGURO_EMAIL', $config_email);
define('CUSTO_FRETE', $config_frete);


/**
 * SANDBOX (AMBIENTE  DE TESTE)
 */

define('PAGSEGURO_TOKEN_SANDBOX', $config_token_sandbox); //Token SandBox
define('PAGSEGURO_APP_ID_SANDBOX', $config_app_id_sandbox); // Id do APP SandBox
define('PAGSEGURO_APP_KEY_SANDBOX', $config_app_key_sandbox); // Chave ddo AP SandBox


/**
 * PRODUCTION (AMBIENTE REAL)
 */
//CARDI
//define('PAGSEGURO_TOKEN_PRODUCTION', $config_token_production); //Token Production
//define('PAGSEGURO_APP_ID_PRODUCTION', $config_app_id_production); // Id do APP Production
//define('PAGSEGURO_APP_KEY_PRODUCTION', $config_app_key_production); // Chave ddo AP Production

//MEU
define('PAGSEGURO_TOKEN_PRODUCTION', 'FCE16581F58F400FB2FE3062FC015A2A'); //Token Production
define('PAGSEGURO_APP_ID_PRODUCTION', ''); // Id do APP Production
define('PAGSEGURO_APP_KEY_PRODUCTION', ''); // Chave ddo AP Production

