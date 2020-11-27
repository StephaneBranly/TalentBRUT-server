<?php
    include_once("../lib/includes.php");

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
    
        mail("stephane.branly@etu.utc.fr", $subject, $messageC, $headers);
    } 
?>
