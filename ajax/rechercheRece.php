<?php
    session_start();
    include_once "../bdd.php";
    include_once "../function.php";

    $outPut = "";
    if (isset($_POST['r'])) {
        $rech = securisation($_POST['r']);

        $req = $bdd->prepare('SELECT * FROM recensement WHERE CONCAT(nom, postnom, prenom, nature, denomination, email) LIKE :rech   ORDER BY nom ASC');
        $req->bindValue(':rech', '%' . $rech . '%', PDO::PARAM_STR);
        $req->execute();

        if ($req->rowCount()>0) {

            $outPut .="<div class='table-responsive'>";
            $outPut .="
            <table class='table table-striped table-bordered table-hover table-sm' id='monTableau'>
                <thead class='headrece'>
                    <tr>
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
            while($envoi=$req->fetch()) {
                
                $outPut .='
                    <tr>
                        <th>'.$envoi['id_rece'].'</th>
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
            $outPut .='<div class="d-flex justify-content-around mt-3">';
            $outPut .='<button id="generatePDF" class="btn btn-primary fw-bold">Générer PDF</button>';
            $outPut .='<button class="btn btn-warning text-white fw-bold ms-3" id="printButton">Imprimer</button>';
            $outPut .='</div>';

            echo $outPut;
        }else {
            echo '<div class="text-secondary my-2 text-center fw-bold">Aucun enregistrement trouvé pour ce recherche</div>';
        }
    }else {
        echo '<div class="text-secondary my-2 text-center fw-bold">Mauvais</div>';
    }
?>