<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();

//CONFIGURAÇÕES DO BANCO #################################### 
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DBSA', 'cardi');

define('HOME', 'http://localhost/work/ProjetoCardi/');

require_once './_app/Library/PagSeguroLibrary/PagSeguroLibrary.php';
require './_app/Helpers/BuscaRapida.class.php';
require './_app/Helpers/Check.class.php';
require './_app/Models/PagSeguro.class.php';
require './_app/Conn/Conn.class.php';
require './_app/Conn/Read.class.php';

//$adminPagSeguro = new PagSeguro();
//$adminPagSeguro->ExeTransacao($_SESSION['userlogin']);
//var_dump($_SESSION['userlogin']);
