<?php
    session_start();
    include_once "../bdd.php";
    include_once "../function.php";

    $outPut = "";
    if (isset($_POST['r']) && isset($_POST['type'])) {
        $rech = securisation($_POST['r']);
        $type = securisation($_POST['type']);

        $req = "SELECT * FROM patentecom WHERE typePat=? AND concat(nom,nature,denomination,email) LIKE '%{$rech}%' ORDER BY nom ASC ";
        $req = $bdd->prepare($req);
        $req->execute(array($type));

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
                    </tr>
                </thead>
        ";
        $i = 1;
        while($envoi=$req->fetch()) {
            
            $outPut .='
                <tr>
                    <th>'.$i.'</th>
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
                </tr></a>';
            ?>
            
            <?php
            $i++;
        }  
        $outPut .='</table>';
        $outPut .='</div>';
        $outPut .='<div class="d-flex justify-content-around mt-3">';
        $outPut .='<button id="generatePDF" class="btn btn-primary fw-bold">Générer PDF</button>';
        $outPut .='<button class="btn btn-warning text-white fw-bold ms-3" id="printButton">Imprimer</button>';
        $outPut .='</div>';

        echo $outPut;
        }else {
            echo '<div class="text-secondary my-2 text-center fw-bold">Aucun enregistrement trouvé pour ce recherche</div>';
        }
    }

?>