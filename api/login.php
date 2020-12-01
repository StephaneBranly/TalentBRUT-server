<?php
    session_start();
    include_once("../lib/includes.php");

    $_SESSION['from']=secure_post('from');



    global $casURL;    
    $myUrl = "http://".$_SERVER['HTTP_HOST'].strtok($_SERVER["REQUEST_URI"],'?');
    $cas = new Cas($casUrl, $myUrl);      

    if(secure_get("ticket"))
    {

        $ticket=secure_get("ticket");
        $data = $cas->authenticate($ticket);

        if ($data == -1 || $data=="") {
            $cas->login();
        }
        else {
            $data["token"]=$ticket;
            $_SESSION['user'] = $data['user'];
            $_SESSION['prenom'] = $data['prenom'];
            $last_page = secure_session('from');
            if($last_page) echo "<script type='text/javascript'>setTimeout(\"{document.location.href='$last_page';};\", 2000);</script>";
        }
    }
    else 
        $cas->login();
?>