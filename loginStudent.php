<?php
    session_start();
    include "../bdd.php";
    include_once "../function.php";

    $email = $_POST['email'];
    $matricule = $_POST['matricule'];
    $rememberMe = isset($_POST['check-connect']);
    
    if (isset($email) && isset($matricule)) {
        if (!empty($email) && !empty($matricule)) {

            $req = "SELECT * FROM users WHERE email = ? AND matricule = ?";
            $req = $bdd->prepare($req);
            $req->execute(array($email, $matricule));
            $ligne = $req->fetchAll();
          
            if ($req->rowCount()>0) {
                foreach($ligne as $key){
                    $_SESSION['epmea_email'] = $key['email'];
                    $_SESSION['epmea_id'] = $key['id_user'];
                    $_SESSION['epmea_nom'] = $key['nom'];
                    $_SESSION['epmea_matricule'] = $key['matricule'];
                    if ($rememberMe) {
                        // Créer les cookies si "Se souvenir de moi" est coché
                        setcookie('usermail', $email, time() + (86400 * 30), "/"); // 86400 = 1 jour
                        setcookie('logged_in', 'true', time() + (86400 * 30), "/");
                        ?>
                        <script>
                            window.location.href=('home.php');
                        </script>
                        <?php
                    }else {
                        ?>
                        <script>
                            window.location.href=('home.php');
                        </script>
                        <?php
                    }
                }
            }else {
                echo "<p class=\"alert alert-danger text-danger\"> <i class=\"fa-solid fa-circle-exclamation\"></i> Wrong Informations!</p>";
            }

        }else {
            echo "<p class=\"alert alert-danger text-danger\"> <i class=\"fa-solid fa-circle-exclamation\"></i> sont vide!</p>";
        }
    }else {
        echo "<p class=\"alert alert-danger text-danger\"> <i class=\"fa-solid fa-circle-exclamation\"></i> n\'existe pas!</p>";
    }

?>