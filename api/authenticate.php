<?php
    header('Content-Type: application/json');
    include_once("../lib/includes.php");

    session_start();

    $response['user']=secure_session('user');
    $response['status']=200;
    $response['connected']=secure_session('connected');
    if(secure_session('connected'))
        $response['message']="connected";
    else
        $response['message']="not connected";

    echo json_encode($response);
   
?>