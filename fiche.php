<?php

    session_start();
    include "session.php";
    include_once "bdd.php";

    $req = "SELECT * FROM users WHERE id_user = :id";
    $req = $bdd->prepare($req);
    $req->bindValue(":id", $id_session);
    $req->execute();

    $resultat = $req->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="shortcut icon" type="image/png" href="images/logos/favicon.png"/>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>
<body style="background:#232e4c;" class="p-0 p-md-2">
        
    <div class="container-fluid header py-1 text-white bg-white shadow-lg">
        <div class="container col-12 d-flex" style="margin:0;padding:0;">
            <div class="logo-block d-inline" style="margin:0;padding:0;">
                <img src="images/logos/EPMA.png" class="img-fluid mt-3 mt-md-3" id="logo" alt="logo">
            </div>
            <div class="text-dark fw-bold text-center" style="margin:0;padding:0;">
                <p class="chapeau-text d-flex justify-content-center mt-1 mt-md-5" style="margin:0;padding:0;">
                    DIVISION URBAINE DE L'ENTREPREUNARIAT PETITES, MOYENNES ENTREPRISES ET ARTISANATS
                </p>
            </div>
            <div class="logo-block d-inline" style="margin:0;padding:0;">
                <img src="images/logos/03Sfond.png" class="img-fluid mt-2 mt-md-2" id="logoKin" alt="logo">
            </div>
        </div>
    </div>
    <div class="nav py-2 bg-light d-flex justify-content-around rounded-bottom sticky-top">
        <div class="nav-item">
            <a href="deconnexion.php" class="btn btn-danger"><i class="fa-solid fa-right-from-bracket fs-5"></i> Quitter</a>
        </div>
        <div class="nav-item">
            <a href="home.php" class="btn btn-primary"><i class="fa-solid fa-house fs-5"></i> Accueil</a>
        </div>
    </div>
    <div class="container-fluid section">

        <div class="row d-flex mt-4 d-flex justify-content-center">
            <a href="recensement.php" role="button" class="btn col-md-4"><div class="rounded-3 rounded-top-0 text-center pb-0 mx-3 my-sm-2" id="add-student">
                <div class="card-text">
                    <i class="fa-solid fa-layer-group text-white m-4"></i>
                </div>
                <div class="rounded-bottom fw-bold rounded-top-0 bg-white p-2 mb-0 text-secondary">
                    FICHE DE RECENSEMENT EXERCICE 2024
                </div>
            </div></a>
            <a href="fpatente.php" role="button" class="btn col-md-4"><div class="rounded-3 rounded-top-0 text-center pb-0 mx-3 my-sm-2" id="add-personnel">
                <div class="card-text">
                    <i class="fa-solid fa-layer-group text-white m-4"></i>
                </div>
                <div class="rounded-bottom fw-bold rounded-top-0 bg-white p-2 mb-0 text-secondary">
                    FICHE DE PATENTE ARTISANALE EXERCICE 2024
                </div>
            </div></a>
            <a href="fcomercial.php" role="button" class="btn col-md-4"><div class="rounded-3 rounded-top-0 text-center pb-0 mx-3 my-sm-2" id="forum-btn">
                <div class="card-text">
                    <i class="fa-solid fa-layer-group text-white m-4"></i>
                </div>
                <div class="rounded-bottom fw-bold rounded-top-0 bg-white p-2 mb-0 text-secondary">
                    FICHE DE PATENTE COMMERCIALE EXERCICE 2024
                </div>
            </div></a>
            <a href="liste.php" role="button" class="btn col-md-4"><div class="rounded-3 rounded-top-0 text-center pb-0 mx-3 my-sm-2" id="bibliotheque">
                <div class="card-text">
                    <i class="fa-solid fa-list text-white m-4"></i>
                </div>
                <div class="rounded-bottom fw-bold rounded-top-0 bg-white p-2 mb-0 text-secondary">
                    LISTE D'ENREGISTREMENTS
                </div>
            </div></a>
            <?php
                if ($resultat['fonction'] == "admin") {
                    ?>
                <a href="agent.php" role="button" class="btn col-md-4"><div class="rounded-3 rounded-top-0 text-center pb-0 mx-3 my-sm-2" id="ajoutAgentsF">
                    <div class="card-text">
                        <i class="fa-sharp fa-solid fa-user-plus text-white m-4"></i>
                    </div>
                    <div class="rounded-bottom fw-bold rounded-top-0 bg-white p-2 mb-0 text-secondary">
                        AJOUT AGANTS
                    </div>
                </div></a>
                    <?php
                }
            ?>
        </div>
    </div>
    <div class="container footer d-flex justify-content-center mt-5 mb-0 .sticky-fixed-bottom">
        <div class="text-footer text-white text-center">
            <p>VENTE PATENTE EXERCICE <br> 2024</p>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function(){
            
        })
    </script>
</body>
</html>