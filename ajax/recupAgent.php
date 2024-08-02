<?php
    session_start();
    include_once "../bdd.php";
    include_once "../function.php";
    include_once "../session.php";

    $outPut = "";

    if (isset($_POST['page'])) {
        $page = intval($_POST['page']);
    }
    $req = $bdd->prepare("SELECT * FROM users");
    $req->execute();
    $totalItems = $req->rowCount();

    $messageParPage = 20;
    $debut = ($page - 1) * $messageParPage;

    $req = "SELECT * FROM users ORDER BY nom ASC LIMIT :debut, :messageParPage";
    $req = $bdd->prepare($req);
    $req->bindValue(':debut', $debut, PDO::PARAM_INT);
    $req->bindValue(':messageParPage', $messageParPage, PDO::PARAM_INT);
    $req->execute();

    if ($req->rowCount()>0) {
        $outPut .="<h3 class='mt-4 text-capitalize text-center'>Listes des Agents</h3>";
        $outPut .="<div class='table-responsive'>";
        $outPut .="
        <table class='table table-striped table-bordered table-hover table-sm' id='monTableau'>
            <thead>
                <tr class='text-center'>
                    <th class='text-uppercase'>N°</th>
                    <th class='text-uppercase' style='width:100px;'>Noms</th>
                    <th class='text-uppercase'>E-mail</th>
                    <th class='text-uppercase'>Code Agent</th>
                    <th class='text-uppercase'>Fonction</th>
                    <th class='text-uppercase'>Commune</th>
                    <th class='text-uppercase'>Tél.</th>
                    <th class='text-uppercase'>Sexe</th>
                    <th class='text-uppercase'></th>
                </tr>
            </thead>
    ";
    $i = 1;
        while($envoi=$req->fetch()) {
            
            $outPut .='
                <tr>
                    <th>'.$i.'</th>
                    <td class="text-capitalize nomTableau" style="width:250px;">'.$envoi['nom'].' '.$envoi['postnom'].' '.$envoi['prenom'].'</td>
                    <td>'.$envoi['email'].'</td>
                    <td class="text-capitalize">'.$envoi['matricule'].'</td>
                    <td class="text-capitalize">'.$envoi['fonction'].'</td>
                    <td class="text-capitalize">'.$envoi['communeA'].'</td>
                    <td class="text-capitalize">'.$envoi['telephoneA'].'</td>
                    <td class="text-capitalize">'.$envoi['sexeA'].'</td>
                    <td class=""><span class="d-flex justify-content-center align-items-center h-100"><a class="btn btn-danger" href="enregistrementAgent.php?id='.$envoi['id_user'].'">Enregistrement</a></span></td>
                </tr></a>';
            ?>
            
            <?php
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
        
        echo $outPut;
    }else {
        echo '<div class="text-secondary my-2 text-center fw-bold">Aucun enregistrement pour l\'instant</div>';
    }

    $req = $bdd->prepare("SELECT count(*) AS total FROM users");
    $req->execute();
    $totalItems = $req->fetchColumn();
    
    $totalPages = ceil($totalItems / $messageParPage);
    $totalPages = intval($totalPages);
    echo '<input type="hidden" id="total-pages" value='.$totalPages.'>';
    
    $req->closeCursor();
?>