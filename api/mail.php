<?php
    include_once("../lib/includes.php");
    
    $from = secure_post('from');
    $headers = "From: ".$from."\r\n";
    $headers .= "Reply-To: ".$from." \r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    

    $subject = "[".secure_post("category")."] ".secure_post("object");
    $message = secure_post('message');
    mail("stephane.branly@etu.utc.fr", $subject, $message, $headers);
?>
