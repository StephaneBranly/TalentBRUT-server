<?php
    header('Content-Type: application/json');
    include_once("../lib/includes.php");

    $response = array();

    if(check_origin())
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json);
    
        if(isset($data->from) && isset($data->tag) && isset($data->object) && isset($data->message))
        {
            $headers = "From: ".$data->from."\r\n";
            $headers .= "Reply-To: ".$data->from." \r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
            
            $subject = "[".$data->tag."] ".$data->object;
            $messageC = $data->message."<br/><div>Message envoye depuis le site.</div>";

            if(mail($serverMail, $subject, $messageC, $headers)) 
                quick_response(200,'Mail sent');
            else       
                quick_response(500,'Internal Server Error');
  
        } 
        else       
            quick_response(501,'Missing parameters');
    } 
    else 
        quick_response(403,'Wrong origin');
?>
