<?php
    header('Content-Type: application/json');
    include_once("../lib/includes.php");

    $response = array();

    if(check_origin())
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        if($data->token)
        {
            $myUrl = "http://".$_SERVER['HTTP_HOST'].strtok($_SERVER["REQUEST_URI"],'?');
            $cas = new Cas($casUrl, $myUrl);
            $response = $cas->authenticate($data->token);
            echo (json_encode($response));
        }
        else       
            quick_response(501,'Missing parameters');
    
    }
    else 
        quick_response(403,'Wrong origin');
?>