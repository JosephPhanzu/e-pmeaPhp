<?php

    if (isset($_SESSION['epmea_id'])) {
        $id_session = $_SESSION['epmea_id'];
        $nom_session = $_SESSION['epmea_nom'];
        $email_session = $_SESSION['epmea_email'];
        $matricule_session = $_SESSION['epmea_matricule'];
    }else{
        $id_session = NULL;
        $session_value = NULL;
        $nom_session = NULL;
        $prenom_session = NULL;
        $email_session = NULL;
        header("location:index.php");
    }
?>