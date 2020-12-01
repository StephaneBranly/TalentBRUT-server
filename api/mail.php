<?php
    header('Content-Type: application/json');
    include_once("../lib/includes.php");

    $response = array();

    if(isset($_SERVER['HTTP_ORIGIN']) && $_SERVER['HTTP_ORIGIN']==$clientURL)
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json);
    
        $headers = "From: ".$data->from."\r\n";
        $headers .= "Reply-To: ".$data->from." \r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
          
        $subject = "[".$data->tag."] ".$data->object;
        $messageC = $data->message."<br/><div>Message envoye depuis le site.</div>";
    
        if(mail($serverMail, $subject, $messageC, $headers))
        {
            $response["message"] = 'Mail sent'; 
            $response["status"] = 200; 
        }
        else
        {
            $response["message"] = 'Internal Server Error'; 
            $response["status"] = 500; 
        }
    } 
    else 
    {
        $response["message"] = 'Wrong origin'; 
        $response["status"] = 403; 
    }

    echo json_encode($response);
?>
