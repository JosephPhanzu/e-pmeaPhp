<?php
    session_start();
    include_once "../bdd.php";
    include_once "../function.php";
    include_once "../session.php";
    
    $outPut = "";
    if (isset($_POST['page']) && isset($_POST['id'])) {
        $page = intval($_POST['page']);
        $id = intval($_POST['id']);
    }

    $req = $bdd->prepare("SELECT * FROM recensement");
    $req->execute();
    $totalItems = $req->rowCount();
    // echo $totalItems;

    $messageParPage = 15;
    $debut = ($page - 1) * $messageParPage;

    $req = "SELECT * FROM recensement WHERE id_user = :id ORDER BY nom ASC LIMIT :debut, :messageParPage";
    $req = $bdd->prepare($req);
    $req->bindValue(":id", $id, PDO::PARAM_INT);
    $req->bindValue(':debut', $debut, PDO::PARAM_INT);
    $req->bindValue(':messageParPage', $messageParPage, PDO::PARAM_INT);

    $req->execute();
    
    if ($req->rowCount()>0) {

        $outPut .="<div class='table-responsive'>";
        $outPut .="
        <table class='table table-striped table-bordered table-hover table-sm' id='monTableau'>
            <thead class='headrece'>
                <tr style='background-color: red;'>
                    <th class='text-uppercase'>N°</th>
                    <th class='text-uppercase'>Nom</th>
                    <th class='text-uppercase'>Postnom</th>
                    <th class='text-uppercase'>Prénom</t>
                    <th class='text-uppercase'>Nature</th>
                    <th class='text-uppercase'>Dénomination</th>
                    <th class='text-uppercase'>Forme juridique</th>
                    <th class='text-uppercase'>Tél</th>
                    <th class='text-uppercase'>Sexe</th>
                    <th class='text-uppercase'>AV. N° Act.</th>
                    <th class='text-uppercase'>Quart. Act</th>
                    <th class='text-uppercase'>Commune Act.</th>
                    <th class='text-uppercase'>AV. N° Rés.</th>
                    <th class='text-uppercase'>Quart. Rés</th>
                    <th class='text-uppercase'>Commune Rés.</th>
                    <th class='text-uppercase'>Type Rec.</th>
                    <th class='text-uppercase'>Montant.</th>
                </tr>
            </thead>
    ";
    $i = 1;
        while($envoi=$req->fetch(PDO::FETCH_ASSOC)) {
            
            $outPut .='
                <tr>
                    <th>'.$i.'</th>
                    <td class="text-uppercase">'.$envoi['nom'].'</td>
                    <td class="text-uppercase">'.$envoi['postnom'].'</td>
                    <td class="text-capitalize">'.$envoi['prenom'].'</td>
                    <td class="text-capitalize">'.$envoi['nature'].'</td>
                    <td>'.$envoi['denomination'].'</td>
                    <td class="text-capitalize">'.$envoi['forme_juri'].'</td>
                    <td>'.$envoi['tel'].'</td>
                    <td class="text-uppercase">'.$envoi['sexe'].'</td>
                    <td class="text-capitalize">'.$envoi['av_acti'].' '.$envoi['num_acti'].'</td>
                    <td class="text-capitalize">'.$envoi['quartier_acti'].'</td>
                    <td class="text-capitalize">'.$envoi['commune_acti'].'</td>
                    <td class="text-capitalize">'.$envoi['av_resi'].' '.$envoi['num_resi'].'</td>
                    <td class="text-capitalize">'.$envoi['quertier_resi'].'</td>
                    <td class="text-capitalize">'.$envoi['commune_resi'].'</td>
                    <td class="text-capitalize">'.$envoi['type_rece'].'</td>
                    <td>'.$envoi['montant'].'</td>
                </tr></a>';
            ?>
            
            <?php
            $i++;
        }  
        $outPut .='</table>';
        $outPut .='</div>';
        $outPut .='
            <div class="pagination justify-content-around" id="pagination" style="margin:0;padding:0;">

                <button type="button" class="btn text-primary rounded-5" id="prev-btn-annonce"><i class="fa-solid fa-backward"></i> Préc.</button>
                <button type="button" class="btn text-primary rounded-5" id="next-btn-annonce">Suiv. <i class="fa-solid fa-forward"></i></button>
                
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

    $req = $bdd->prepare("SELECT count(*) AS total FROM recensement");
    $req->execute();
    $totalItems = $req->fetchColumn();

    $totalPages = ceil($totalItems / $messageParPage);
    $totalPages = intval($totalPages);
    echo '<input type="hidden" id="total-pages" value='.$totalPages.'>';

?>