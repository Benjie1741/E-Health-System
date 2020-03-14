<?php
$dsn = 'mysql:host=localhost;dbname=ehealth3';
$user = 'root';
$password = '';
try { 
$pdo = new PDO($dsn, $user, $password); 
$pdo ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
$pdo ->exec("SET CHARACTER SET utf8");
}
catch (PDOException $e) { 
echo 'Connection failed again: ' . $e->getMessage();
}
?>