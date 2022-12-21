<?php

   function conectar() {
        $host = "127.0.0.1";  
        $db   = "qualeaboa";     
        $user = "root";       
        $pass = "";           


        $conn = mysqli_connect("$host","$user","$pass","$db") or die ("problemas na conexão");
        return $conn;
    }

 ?>   