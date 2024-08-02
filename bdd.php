<?php

    try {
        $bdd = new PDO('mysql:host=localhost;dbname=e-pmea','root','');
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (Exception $e) {
        die("Erreur de connection : ". $e->getMessage());
        
    }

?>