<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
if($_SERVER["REQUEST_METHOD"]==="POST"){
    if (isset($_POST['btnlimpar'])){
        header('Location:'."../logout.php");
    }
    exit();
}