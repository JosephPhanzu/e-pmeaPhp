<?php

    session_start();
    include_once "session.php";

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

    <style>
        .sticky-fixed-bottom {
        position: sticky;
        bottom: 0;
        width: 100%;
        background-color: #f8f9fa; /* Couleur de fond pour visibilité */
        }

        /* Pour les écrans md et plus, le comportement devient sticky en bas */
        @media (min-width: 768px) {
        .sticky-fixed-bottom {
            position: fixed;
        }
        }
    </style>

<body style="background:#232e4c;" class="p-1">
    <div class="central-block container-fluid">
        <div class="row header text-white text-center">
            <div class="col-12 mt-3">
                <div class="row d-flex justify-content-center">
                    <img src="images/logos/kinshasa.jpg" class="img-fluid w-sm-50" id="logoH" alt="logo">
                </div>
            </div>
        </div>
        <div class="container section text-center">
            <div class="row d-flex justify-content-center mt-5">
                <a href="fiche.php" type="button" class="btn d-flex justify-content-center" style="width:max-content;"><div class="rounded-3 rounded-top-0 col-11 col-sm-7 text-center p-2" id="add-student">
                    <div class="rounded-bottom fw-bold rounded-top-0 bg-white p-5 fw-bolder">
                        DIVISION URBAINE DE L'ENTREPREUNARIAT PETITES, MOYENNES ENTREPRISES ET ARTISANATS <br><span><< E-PMEA >></span>
                    </div>
                </div></a>
            </div>
        </div>
        <div class="container footer d-flex justify-content-center mt-5 mb-0 .sticky-fixed-bottom">
            <div class="text-footer text-white text-center">
                <p>VENTE PATENTE EXERCICE <br> 2024</p>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function(){

        });
    </script>
</body>
</html>