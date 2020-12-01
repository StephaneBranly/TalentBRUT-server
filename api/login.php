<?php
    include_once("../lib/includes.php");
    header('Content-Type: application/json');

    global $casURL;
    $myUrl = "http://".$_SERVER['HTTP_HOST'].strtok($_SERVER["REQUEST_URI"],'?');
        

    $cas = new Cas($casUrl, $myUrl);


    if(secure_get("ticket"))
    {
        $data = array();
        $ticket=secure_get("ticket");
        $data = $cas->authenticate($ticket);
        $data["token"]=$ticket;
        echo (json_encode($data));
    }
    else 
        $cas->login();
?>