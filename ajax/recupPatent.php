<?php
    session_start();
    include_once "../bdd.php";
    include_once "../function.php";
    include_once "../session.php";

  
    if (isset($_POST['type'])) {
        $type = $_POST['type'];
    }else {
        $type = NULL;
    }
    $outPut = "";

    $id = $id_session;

    if (isset($_POST['page'])) {
        $page = intval($_POST['page']);
    }
    
    $req = $bdd->prepare("SELECT * FROM patentecom WHERE typePat = ?");
    $req->execute(array($type));
    $totalItems = $req->rowCount();

    $messageParPage = 7;
    $debut = ($page - 1) * $messageParPage;

    $req = "SELECT fonction FROM users WHERE id_user = :id";
    $req = $bdd->prepare($req);
    $req->bindValue(":id", $id);
    $req->execute();

    $resultat = $req->fetch();

    if ($resultat['fonction'] != "admin") {
        $req = "SELECT * FROM patentecom WHERE typePat = :typePat AND id_user = :id ORDER BY nom ASC LIMIT :debut, :messageParPage";
        $req = $bdd->prepare($req);
        $req->bindValue(":typePat", $type, PDO::PARAM_STR);
        $req->bindValue(":id", $id, PDO::PARAM_INT);
        $req->bindValue(':debut', $debut, PDO::PARAM_INT);
        $req->bindValue(':messageParPage', $messageParPage, PDO::PARAM_INT);
    }else{
        $req = "SELECT * FROM patentecom WHERE typePat = :typePat ORDER BY nom ASC LIMIT :debut, :messageParPage";
        $req = $bdd->prepare($req);
        $req->bindValue(":typePat", $type, PDO::PARAM_STR);
        $req->bindValue(':debut', $debut, PDO::PARAM_INT);
        $req->bindValue(':messageParPage', $messageParPage, PDO::PARAM_INT);
    }

    $req->execute();

    if ($req->rowCount()>0) {

        if ($type === "artisanale") {
            $class = "headartisa";
        }else {
            $class = "headcommerce";
        }
        
        $outPut .="<div class='table-responsive'>";
        $outPut .="
        <table class='table table-striped table-bordered table-hover table-sm' id='monTableau'>
            <thead class='".$class."'>
                <tr>
                    <th class='text-uppercase'>N°</th>
                    <th class='text-uppercase'>Nom</th>
                    <th class='text-uppercase'>Nature</th>
                    <th class='text-uppercase'>Dénomination</th>
                    <th class='text-uppercase'>Tél</th>
                    <th class='text-uppercase'>AV. N° Act.</th>
                    <th class='text-uppercase'>Quart. Act.</th>
                    <th class='text-uppercase'>Commune Act.</th>
                    <th class='text-uppercase'>AV. N° Rés.</th>
                    <th class='text-uppercase'>Quart. Rés.</th>
                    <th class='text-uppercase'>Commune Rés.</th>
                    <th class='text-uppercase'>Taux.</th>
                    <th class='text-uppercase'>Pénalité.</th>
                    <th class='text-uppercase'>Photo.</th>
                </tr>
            </thrad>
    ";
    $i = 1;
        while($envoi=$req->fetch(PDO::FETCH_ASSOC)) {
            $modalId = "popup-photo-" . $i;
            
            $outPut .='
                <tr>
                    <td>'.$i.'</td>
                    <td class="text-capitalize">'.$envoi['nom'].'</td>
                    <td class="text-capitalize">'.$envoi['nature'].'</td>
                    <td>'.$envoi['denomination'].'</td>
                    <td>'.$envoi['tel'].'</td>
                    <td class="text-capitalize">'.$envoi['av_actiP'].' '.$envoi['num_actiP'].'</td>
                    <td>'.$envoi['quertier_actP'].'</td>
                    <td>'.$envoi['commune_actiP'].'</td>
                    <td class="text-capitalize">'.$envoi['av_resiP'].' '.$envoi['num_resiP'].'</td>
                    <td>'.$envoi['quartier_resiP'].'</td>
                    <td>'.$envoi['commune_resiP'].'</td>
                    <td>'.$envoi['taux'].'</td>
                    <td>'.$envoi['penalite'].'</td>
                    <td data-bs-toggle="modal" id="photo-click" class="'.$envoi['id_patente'].'" data-bs-target="#'.$modalId.'"><img src="'.$envoi['photo'].'" class="img-fluid" alt="photo"/></td>
                </tr></a>';
            ?>
            
            <?php
            $outPut .='
            <div class="modal fade" id="'.$modalId.'">
                <div class="modal-dialog modal-dialog-centered p-sm-3 modal-md">
                    <div class="modal-content bg-white rounded col-6 h-25">
                        <img src="'.$envoi['photo'].'" alt="Photo" width="400" height="300" class="img-fluid"/>
                    </div>
                </div>
            </div>
            ';
            $i++;
        }  
        $outPut .='</table>';
        $outPut .='</div>';
        $outPut .='
            <div class="pagination justify-content-around" id="pagination" style="margin:0;padding:0;">

                <button type="button" class="btn text-primary rounded-5" id="prev-btn-artisanal"><i class="fa-solid fa-backward"></i> Préc.</button>

                <button type="button" class="btn text-primary rounded-5" id="next-btn-artisanal">Suiv. <i class="fa-solid fa-forward"></i></button>
                
            </div>
        ';
        $outPut .='<div class="d-flex justify-content-around mt-3">';
        $outPut .='<button id="generatePDF" class="btn btn-primary fw-bold">Générer PDF</button>';
        $outPut .='<button class="btn btn-warning text-white fw-bold ms-3" id="printButton">Imprimer</button>';
        $outPut .='</div>';

        echo $outPut;
    }else {
        echo '<div class="text-secondary my-2 text-center fw-bold">Aucun enregistrement pour l\'instant</div>';
    }

    $req = $bdd->prepare("SELECT count(*) AS total FROM patentecom WHERE typePat = ?");
    $req->execute(array($type));
    $totalItems = $req->fetchColumn();

    $totalPages = ceil($totalItems / $messageParPage);
    $totalPages = intval($totalPages);
    echo '<input type="hidden" id="total-pages" value='.$totalPages.'>';
    $req->closeCursor();

?>