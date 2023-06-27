<?php
//host - localhost
//user - hoot
//password - senha
//db - nome do banco

define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DB', 'test');

$charset = 'utf8';
$conn = mysqli_connect(HOST, USER, PASS, DB)
or die('Conexão falhou...');
?>