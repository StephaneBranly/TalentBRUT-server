<?php
    include_once("../lib/includes.php");

    global $casURL;
    $myUrl = "http://".$_SERVER['HTTP_HOST'].strtok($_SERVER["REQUEST_URI"],'?');     
    $cas = new Cas($casUrl, $myUrl);    
    $cas->logout();
?>