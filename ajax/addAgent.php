<?php
    session_start();
    include_once "../bdd.php";
    include_once "../function.php";
    include_once "../session.php";
    
    $nom = securisation($_POST['nom']);
    $postnom = securisation($_POST['postnom']);
    $prenom = securisation($_POST['prenom']);
    $email = securisation($_POST['email']);
    $commune = securisation($_POST['commune']);
    $tel = securisation($_POST['tel']);
    $sexe = securisation($_POST['sexe']);
   
    $temps = time();

    if (isset($postnom) && isset($nom) && isset($prenom) && isset($email) && isset($commune) && isset($tel)  && isset($sexe)) {

        if (!empty($postnom) && !empty($nom) && !empty($prenom) && !empty($email) && !empty($commune) && !empty($tel) && !empty($sexe)) {

            $fonction = "agent";
            // Avoir l'initiale d'un mot
            function getInitial($mot){
                $mot = str_split($mot);
                $mot = shuffle($mot);
                $mot = implode('', $mot);
                return strtoupper($mot[0]);
            }

            $req = "SELECT * FROM users";
            $req = $bdd->prepare($req);
            $req->execute();

            $tot = $req->rowCount();

            $matricule = '2024AT'.getInitial($nom). getInitial($postnom) . getInitial($prenom) . 'N' . $tot++;
                        
            $req = "SELECT * FROM users WHERE nom = ? AND prenom = ? AND matricule = ?";
            $req = $bdd->prepare($req);
            $req->execute(array($nom,$prenom,$matricule));

            if ($req->rowCount()>0) {
                    echo "<p class=\"alert alert-danger text-danger\"> <i class=\"fa-solid fa-circle-exclamation\"></i> L'esnregistré existe déjà</p>";
            }else {

                $req = "INSERT INTO users(nom,postnom,prenom,fonction,email,matricule,communeA,telephoneA,sexeA) VALUES(:nom, :post, :pre, :fonction, :email, :matricule, :commune, :tel, :sexe)";

                $req = $bdd->prepare($req);
                $req->bindValue(':nom', $nom, PDO::PARAM_STR);
                $req->bindValue(':post', $postnom, PDO::PARAM_STR);
                $req->bindValue(':pre', $prenom, PDO::PARAM_STR);
                $req->bindValue(':fonction', $fonction, PDO::PARAM_STR);
                $req->bindValue(':email', $email, PDO::PARAM_STR);
                $req->bindValue(':matricule', $matricule, PDO::PARAM_STR);
                $req->bindValue(':commune', $commune, PDO::PARAM_STR);
                $req->bindValue(':tel', $tel, PDO::PARAM_INT);
                $req->bindValue(':sexe', $sexe, PDO::PARAM_STR);
                $req->execute();

                if ($req) {
                    echo "<p class=\"alert alert-success text-success my-2\"><i class=\"fa-solid fa-circle-check\"></i> Enregistrement éffectué</p>";
                }else {
                    echo "<p class=\"alert alert-danger text-danger\"> <i class=\"fa-solid fa-circle-exclamation\"></i> L'E-mail que vous avez entré existe déjà!</p>";
                }
                $req->closeCursor();
            } 
        }else {
            echo "<p class=\"alert alert-danger text-danger\"> <i class=\"fa-solid fa-circle-exclamation\"></i> Toutes les informations sont obligatoire!</p>";
        }
    }else {
        echo "<p class=\"alert alert-danger text-danger\"> <i class=\"fa-solid fa-circle-exclamation\"></i> Les Champs n'existe pas!</p>";
    }

?>