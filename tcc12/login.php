<?php
session_start();
include('banco.php');

$host = "127.0.0.1";  
$db   = "qualeaboa";     
$user = "root";       
$pass = ""; 

$conn = mysqli_connect("$host","$user","$pass","$db") or die ("problemas na conexão");

if(empty($_POST['login']) || empty($_POST['password'])) {
    header('Location: index.php');
    exit();
}

$login = mysqli_real_escape_string($conn, $_POST['login']);
$senha = mysqli_real_escape_string($conn, $_POST['password']);

$query = "select login from usuario where login = '$login' and senha = '$senha'";

$result = mysqli_query($conn, $query);

$row = mysqli_num_rows($result);

if($row == 1) {
    $_SESSION['login'] = $login;
    header('Location: principal.php');
    exit();
} else {
    $_SESSION['nao_autenticado'] = true;    
    header('Location: index.php');
    exit();
}

?>