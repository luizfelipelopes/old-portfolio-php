<?php

require('../../_app/Config.inc.php');

$estado = (int) strip_tags(trim($_POST['estado']));

sleep(1);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cardi";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM app_cidades WHERE estado_id = '". $estado . "'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<option value=\"{$row['cidade_id']}\"> {$row['cidade_nome']} </option>";
    }
} else {
    echo "0 results";
}
$conn->close();


//$readCityes = "SELECT * FROM app_cidades WHERE estado_id = 'estado'";


//echo "<option value=\"\" disabled selected> Selecione a cidade </option>";
//$readCityes->ExeRead("app_cidades", "WHERE estado_id = :uf", "uf={$estado}");



//echo "<option value=\"\" disabled selected> Selecione a cidade </option>";
//foreach ($readCityes->getResult() as $cidades):
//    extract($cidades);
//    echo "<option value=\"{$cidade_id}\"> {$cidade_nome} </option>";
//endforeach;
