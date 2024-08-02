<?php
    session_start();
    include_once "../bdd.php";
    include_once "../function.php";
    include_once "../session.php";
    
    $email = securisation($_POST['email']);
    $nom = securisation($_POST['nom']);
    $postnom = securisation($_POST['postnom']);
    $prenom = securisation($_POST['prenom']);
    $nature = securisation($_POST['nature']);
    $denomination = securisation($_POST['denomination']);
    $forme = securisation($_POST['forme']);
    $sexe = securisation($_POST['sexe']);
    $a_acti = securisation($_POST['avenu_acti']);
    $n_acti = securisation($_POST['numero_acti']);
    $q_acti = securisation($_POST['quartier_acti']);
    $c_acti = securisation($_POST['commune_acti']);
    $a_resi = securisation($_POST['avenu_resi']);
    $n_resi = securisation($_POST['numero_resi']);
    $q_resi = securisation($_POST['quartier_resi']);
    $c_resi = securisation($_POST['commune_resi']);
    $type_rece = securisation($_POST['type_rece']);
    $montant = securisation($_POST['montant']);
    $tel = securisation($_POST['tel']);
    
    $nom_fichier = $_FILES['photo']['name'];
    
    $fileExtension = pathinfo($nom_fichier, PATHINFO_EXTENSION);
    $newFileName = 'photo_GST' . time() . '.' . $fileExtension;
    
    $nom_temp = $_FILES['photo']['tmp_name'];
    
    $emplacement ='../public/fichierUploade/recense/'.$newFileName;
    
    $img1='public/fichierUploade/recence/'.$newFileName;

    $temps = time();

    if (isset($email) && isset($nom) && isset($prenom) && isset($postnom) && isset($tel) && isset($montant) && isset($type_rece) && isset($c_resi) && isset($q_resi) && isset($n_resi) && isset($a_resi) && isset($c_acti) && isset($q_acti) && isset($n_acti) && isset($a_acti) && isset($sexe) && isset($forme) && isset($denomination) && isset($nature)) {

        if (!empty($email) && !empty($nom) && !empty($prenom) && !empty($postnom) && !empty($tel) && !empty($montant) && !empty($type_rece) && !empty($c_resi) && !empty($q_resi) && !empty($n_resi) && !empty($a_resi) && !empty($c_acti) && !empty($q_acti) && !empty($n_acti) && !empty($a_acti) && !empty($sexe) && !empty($forme) && !empty($denomination) && !empty($nature)) {

            if (preg_match('/(@gmail.com)$/i', $email)) {
                if (preg_match('/(.jpg)$/i', $newFileName) || preg_match('/(.jpeg)$/i', $newFileName) || preg_match('/(.png)$/i', $newFileName)) {
                    if (move_uploaded_file($nom_temp, $emplacement)) {
                        $req = "SELECT * FROM recensement WHERE email = ? AND denomination = ?";
                        $req = $bdd->prepare($req);
                        $req->execute(array($email,$denomination));
        
                        if ($req->rowCount()>0) {
                            echo "<p class=\"alert alert-danger text-danger\"> <i class=\"fa-solid fa-circle-exclamation\"></i> L'esnregistré existe déjà</p>";
                        }else {

                            $id = $id_session;

                            $req = "INSERT INTO recensement(nom,postnom,prenom,nature,denomination,forme_juri,sexe,email,tel,av_acti,num_acti,quartier_acti,commune_acti,av_resi,num_resi,quertier_resi,commune_resi,type_rece,montant,photo,id_user) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        
                            $req = $bdd->prepare($req);

                            $req->bindValue(1, $nom, PDO::PARAM_STR);
                            $req->bindValue(2, $postnom, PDO::PARAM_STR);
                            $req->bindValue(3, $prenom, PDO::PARAM_STR);
                            $req->bindValue(4, $nature, PDO::PARAM_STR);
                            $req->bindValue(5, $denomination, PDO::PARAM_STR);
                            $req->bindValue(6, $forme, PDO::PARAM_STR);
                            $req->bindValue(7, $sexe, PDO::PARAM_STR);
                            $req->bindValue(8, $email, PDO::PARAM_STR);
                            $req->bindValue(9, $tel, PDO::PARAM_INT);
                            $req->bindValue(10, $a_acti, PDO::PARAM_STR);
                            $req->bindValue(11, $n_acti, PDO::PARAM_STR);
                            $req->bindValue(12, $q_acti, PDO::PARAM_STR);
                            $req->bindValue(13, $c_acti, PDO::PARAM_STR);
                            $req->bindValue(14, $a_resi, PDO::PARAM_STR);
                            $req->bindValue(15, $n_resi, PDO::PARAM_STR);
                            $req->bindValue(16, $q_resi, PDO::PARAM_STR);
                            $req->bindValue(17, $c_resi, PDO::PARAM_STR);
                            $req->bindValue(18, $type_rece, PDO::PARAM_STR);
                            $req->bindValue(19, $montant, PDO::PARAM_INT);
                            $req->bindValue(20, $img1, PDO::PARAM_STR);
                            $req->bindValue(21, $id, PDO::PARAM_INT);

                            $req->execute();
        
                            if ($req) {
                                echo "<p class=\"alert alert-success text-success my-2\"><i class=\"fa-solid fa-circle-check\"></i> Enregistrement éffectué</p>";
                            }else {
                                echo "<p class=\"alert alert-danger text-danger\"> <i class=\"fa-solid fa-circle-exclamation\"></i> L'E-mail que vous avez entré existe déjà!</p>";
                            }
                            $req->closeCursor();
                        }
                    }else{
                            echo "<p class=\"alert alert-danger text-danger\"> <i class=\"fa-solid fa-circle-exclamation\"></i> Problème lors du téléverssement du fichier</p>";
                        }
                }else{
                    echo "<p class=\"alert alert-danger text-danger\"> <i class=\"fa-solid fa-circle-exclamation\"></i> Fichier incorrecte! Assurez vous que votre photo soit png,jpg ou jpeg</p>";
                }
            }else {
                echo "<p class=\"alert alert-danger text-danger\"> <i class=\"fa-solid fa-circle-exclamation\"></i> E-mail incorrecte! Assurez vous que votre E-mail se termine par @gmail.com</p>";
                ?>
                    <script>
                        $('#email').addClass('is-invalid');
                    </script>
                <?php
            }  
        }else {
            echo "<p class=\"alert alert-danger text-danger\"> <i class=\"fa-solid fa-circle-exclamation\"></i> Toutes les informations sont obligatoire!</p>";
        }
    }else {
        echo "<p class=\"alert alert-danger text-danger\"> <i class=\"fa-solid fa-circle-exclamation\"></i> Les Champs n'existe pas!</p>";
    }

?>