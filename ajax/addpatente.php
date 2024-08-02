<?php
    session_start();
    include_once "../bdd.php";
    include_once "../function.php";
    include_once "../session.php";
    
    $email = securisation($_POST['email']);
    $nom = securisation($_POST['nom']);
    $nature = securisation($_POST['nature']);
    $denomination = securisation($_POST['denomination']);
    $categorie = securisation($_POST['categorie']);
    $a_acti = securisation($_POST['avenu_acti']);
    $n_acti = securisation($_POST['numero_acti']);
    $q_acti = securisation($_POST['quartier_acti']);
    $c_acti = securisation($_POST['commune_acti']);
    $a_resi = securisation($_POST['avenu_resi']);
    $n_resi = securisation($_POST['numero_resi']);
    $q_resi = securisation($_POST['quartier_resi']);
    $c_resi = securisation($_POST['commune_resi']);
    $taux = securisation($_POST['taux']);
    $penalite = securisation($_POST['penalite']);
    $tel = securisation($_POST['tel']);
    $type_pat = securisation($_POST['type_pat']);
    
    $nom_fichier = $_FILES['photo']['name'];
    
    $fileExtension = pathinfo($nom_fichier, PATHINFO_EXTENSION);
    $newFileName = 'photo_GST' . time() . '.' . $fileExtension;
    
    $nom_temp = $_FILES['photo']['tmp_name'];
    
    $emplacement ='../public/fichierUploade/fpatente/'.$newFileName;
    
    $img1='public/fichierUploade/fpatente/'.$newFileName;
    
    $id = $id_session;

    $temps = time();

    if (isset($email) && isset($nom) && isset($tel) && isset($c_resi) && isset($q_resi) && isset($n_resi) && isset($a_resi) && isset($c_acti) && isset($q_acti) && isset($n_acti) && isset($a_acti) && isset($categorie) && isset($denomination) && isset($nature) && isset($taux) && isset($penalite)) {

        if (!empty($email) && !empty($nom) && !empty($tel) && !empty($c_resi) && !empty($q_resi) && !empty($n_resi) && !empty($a_resi) && !empty($c_acti) && !empty($q_acti) && !empty($n_acti) && !empty($a_acti) && !empty($categorie) && !empty($denomination) && !empty($nature) && !empty($taux) && !empty($penalite)) {

            if (preg_match('/(@gmail.com)$/i', $email)) {
                if (preg_match('/(.jpg)$/i', $newFileName) || preg_match('/(.jpeg)$/i', $newFileName) || preg_match('/(.png)$/i', $newFileName)) {
                    if (move_uploaded_file($nom_temp, $emplacement)) {
                        
                        $req = "SELECT * FROM patentecom WHERE email = ? AND nom = ? AND tel = ?";
                        $req = $bdd->prepare($req);
                        $req->execute(array($email,$nom,$tel));
        
                        if ($req->rowCount()>0) {
                             echo "<p class=\"alert alert-danger text-danger\"> <i class=\"fa-solid fa-circle-exclamation\"></i> L'esnregistré existe déjà</p>";
                        }else {
                            $req = "INSERT INTO patentecom(nom,nature,denomination,categorie,av_actiP,num_actiP,quertier_actP,commune_actiP,email,tel,av_resiP,num_resiP,quartier_resiP,commune_resiP,taux,penalite,typePat,photo,id_user) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        
                            $req = $bdd->prepare($req);
                            $req->bindValue(1, $nom, PDO::PARAM_STR);
                            $req->bindValue(2, $nature, PDO::PARAM_STR);
                            $req->bindValue(3, $denomination, PDO::PARAM_STR);
                            $req->bindValue(4, $categorie, PDO::PARAM_STR);
                            $req->bindValue(5, $a_acti, PDO::PARAM_STR);
                            $req->bindValue(6, $n_acti, PDO::PARAM_STR);
                            $req->bindValue(7, $q_acti, PDO::PARAM_STR);
                            $req->bindValue(8, $c_acti, PDO::PARAM_STR);
                            $req->bindValue(9, $email, PDO::PARAM_STR);
                            $req->bindValue(10, $tel, PDO::PARAM_INT);
                            $req->bindValue(11, $a_resi, PDO::PARAM_STR);
                            $req->bindValue(12, $n_resi, PDO::PARAM_STR);
                            $req->bindValue(13, $q_resi, PDO::PARAM_STR);
                            $req->bindValue(14, $c_resi, PDO::PARAM_STR);
                            $req->bindValue(15, $taux, PDO::PARAM_INT);
                            $req->bindValue(16, $penalite, PDO::PARAM_INT);
                            $req->bindValue(17, $type_pat, PDO::PARAM_STR);
                            $req->bindValue(18, $img1, PDO::PARAM_STR);
                            $req->bindValue(19, $id, PDO::PARAM_INT);
                            $req->execute();
        
                            if ($req) {
                                echo "<p class=\"alert alert-success text-success my-2\"><i class=\"fa-solid fa-circle-check\"></i> Enregistrement éffectué</p>";
                            }else {
                                echo "<p class=\"alert alert-danger text-danger\"> <i class=\"fa-solid fa-circle-exclamation\"></i> L'E-mail que vous avez entré existe déjà!</p>";
                            }
                            $req->closeCursor();
                        }
                    }
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