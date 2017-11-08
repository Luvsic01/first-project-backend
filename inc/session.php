<?php
session_start();
if (isset($_SESSION['ip'])){
    if ( $_SESSION['ip'] != $_SERVER["REMOTE_ADDR"] ){
        header("Location: index.php");
    }
}