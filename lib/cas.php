<?php
    class Cas
    {
        private $url;
        private $casUrl;

        public function __construct($casUrl, $url)
        {
            $this->url = $url;
            $this->casUrl = $casUrl;
        }

        public function login()
        {
            header('Location: '.$this->casUrl.'login?service='.$this->url);
        }

        public function logout()
        {
            header('Location: '.$this->casUrl.'logout?service='.$this->url);
        }

        public function authenticate($token)
        {
            $response = file_get_contents($this->casUrl.'serviceValidate?service='.$this->url.'&ticket='.$_GET['ticket']);
            if (empty($response)) return -1;

            $user = Xml::parseCasReturn($response);
            if (empty($user)) return -1;
            if ($user == -1) return -1;

            return $user;
        }
    }

    class Xml
    {
        public static function parseCasReturn($data)
        {
            $XmlParsed = simplexml_load_string($data, "SimpleXMLElement", 0, "cas", true);
            $response = Array();
            try {
                //$user = $XmlParsed->authenticationSuccess->user;
                $response['user'] = (string) $XmlParsed->authenticationSuccess->user;
                $response['mail'] = (string) $XmlParsed->authenticationSuccess->attributes->mail;
                $response['nom'] = (string) $XmlParsed->authenticationSuccess->attributes->sn;
                $response['prenom'] = (string) $XmlParsed->authenticationSuccess->attributes->givenName;
                $response["message"] = "OK"; 
                $response["status"] = 200; 
            }
            catch (Exception $e) {
                $response["message"] = "error"; 
                $response["status"] = 500; 
            }

            return $response;
        }
    }


    function is_connected($user, $token)
    {
        global $casURL;
        $myUrl = "http://".$_SERVER['HTTP_HOST'].strtok($_SERVER["REQUEST_URI"],'?');
        $cas = new Cas($casUrl, $myUrl);
        return ($user = $cas->authenticate());
    }
?>