<?php
    function check_origin()
    {
        $clientURL = "https://assos.utc.fr";
        return (isset($_SERVER['HTTP_ORIGIN']) && $_SERVER['HTTP_ORIGIN']==$clientURL);
    }

    function quick_response($status,$message)
    {
        $response = array();
        $response["message"] = $message; 
        $response["status"] = $status; 
        echo json_encode($response);
    }
?>