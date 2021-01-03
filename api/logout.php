<?php
    include_once("../lib/includes.php");

    session_start();
    $_SESSION['connected']=false;
    $_SESSION['user']=false;
    $_SESSION['prenom']=false;
    global $casURL;
    $myUrl = "http://".$_SERVER['HTTP_HOST'].strtok($_SERVER["REQUEST_URI"],'?');     
    $cas = new Cas($casUrl, $myUrl);    
    $cas->logout();
?>