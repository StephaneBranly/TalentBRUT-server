<?php
    header('Content-Type: application/json');
    include_once("../lib/includes.php");

    session_start();

    $response['user']=secure_session('user');
    $response['status']=200;
    
    if(secure_session('connected')==true)
    {
        $response['message']="connected";
        $response['connected']=true;
    }
    else
    {
        $response['message']="not connected";
        $response['connected']=false;
    }

    echo json_encode($response);
   
?>