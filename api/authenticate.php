<?php
    header('Content-Type: application/json');
    include_once("../lib/includes.php");
    session_start();

    if(check_origin())
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        if($data->token)
        {
            $response['user']=secure_session('user');
            $response['status']=200;
            $response['message']="Connected";
            echo json_encode($response);
        }
        else       
            quick_response(501,'Missing parameters');
    
    }
    else 
        quick_response(403,'Wrong origin');
?>