<?php

if(session_status() == PHP_SESSION_NONE) {
    session_start();
}

$sql = new PDO("mysql:host=localhost;dbname=mini_login_owner;charset=utf8", "root", "root");
$sql->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

?>
