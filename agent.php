<?php

    session_start();
    include "session.php";
    include_once "bdd.php";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout Agents</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="shortcut icon" type="image/png" href="images/logos/favicon.png"/>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <style>
        .table thead th {
            background-color: #4CAF50; /* Remplacez par la couleur de votre choix */
            color: white; /* Couleur du texte de l'entête */
        }
    </style>
</head>
<body style="background:#232e4c;" class="p-0 p-md-2">
    <div class="nav py-2 bg-light rounded-bottom sticky-top shadow-lg">
        <div class="container-fluid nav-text d-flex justify-content-center">
            <p class="chapeau-text1">AJOUT AGENTS</p>
        </div>
        <!-- <div class="container-fluid d-flex justify-content-around">
            <div class="nav-item">
                <a href="deconnexion.php" class="btn btn-danger"><i class="fa-solid fa-right-from-bracket fs-5"></i> Quitter</a>
            </div>
            <div class="nav-item">
                <a href="home.php" class="btn btn-primary"><i class="fa-solid fa-house fs-5"></i> Accueil</a>
            </div>
        </div> -->
    </div>
    <div class="container-fluid container-md">
        <div class="section">
            
            <div class="row">
                <form action="" id="form-recensement" class="form-inline mt-3 py-3 px-0 bg-light border border-primary">
                    <div class="container text-secondary text-wrap">
                        
                        <div class="form-floating border">
                            <input type="text" name="nom" placeholder="Entez votre nom" class="form-control shadow-none rounded-0" id="nom">
                            <label for="nom" class="form-label">Nom</label>
                        </div><br>
                        <div class="form-floating border">
                            <input type="text" name="postnom" placeholder="Entez votre postnom" class="form-control shadow-none rounded-0" id="postnom">
                            <label for="postnom" class="form-label">Post-nom</label>
                        </div><br>
                        <div class="form-floating border">
                            <input type="text" name="prenom" placeholder="Entez votre nom" class="form-control shadow-none rounded-0" id="prenom">
                            <label for="prenom" class="form-label">Prénom</label>
                        </div><br>
                        <div class="form-floating border">
                            <input type="email" name="email" placeholder="E-mail" class="form-control shadow-none rounded-0" id="email">
                            <label for="email" class="form-label">E-mail</label>
                        </div><br>
                        <div class="form-floating border">
                            <input type="text" name="commune" placeholder="E-mail" class="form-control shadow-none rounded-0" id="commune">
                            <label for="commune" class="form-label">Commune</label>
                        </div><br>
                        <div class="form-floating border">
                            <input type="tel" name="tel" placeholder="000-000-000" class="form-control shadow-none rounded-0" maxlength="9" id="tel">
                            <label for="tel" class="form-label">Téléphone Ex: 899999999</label>
                        </div><br>
                        <div class="form-floating border">
                            <select class="form-select border-0 shadow-sm" name="sexe" id="sexe">
                                <option value="" disable selected hidden>---Sexe---</option>
                                <option value="M">M</option>
                                <option value="F">F</option>
                            </select>
                        </div><br>
                        
                        <!-- Bouton envoie -->
                        <div class="d-flex justify-content-around group-btn">
                            <button class="btn btn-primary col-10 col-md-8 btn-lg" id="btn-recense">
                                <div class="spinner-border text-white" id="spinner" role="status" style="display:none; width:30px; height:30px">
                                    <span class="sr-only">Loader...</span>
                                </div>
                                <span id="connexion-text"><i class="fa-sharp fa-solid fa-user-plus me-1"></i>Enregistrer</span>
                            </button>
                            <a href="" type="button" class="btn btn-success col-10 btn-lg shadow" id="btn-ok" style="display:none;">
                                <span>OK</span>
                            </a>
                        </div>
                        
                        <!--L'affichage des reponse ajax-->
                        <div class="container mt-3">
                            <div id="info" class="text-start"></div>
                        </div>
                    </div>
                    <div class="container">
                        <div id="contenu"></div>
                    </div>
                </form>
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
            var currentPage = 1,
                totalPages = 1;

            function recupAgent(page) {
                $.ajax({
                    url : 'ajax/recupAgent.php',
                    type : 'POST',
                    data : {page : page},
                    success : function(datas){
                        $('#contenu').html(datas);
                    }
                });
            }
            recupAgent(currentPage);
            // à l'envoie de données
            $('#form-recensement').submit(function(e){
                e.preventDefault();
                // alert('hello');
                $('#spinner').show();
                $('#connexion-text').hide();

                var formData = new FormData(this);
                
                $.ajax({
                    url : "ajax/addAgent.php",
                    type : "POST",
                    data : formData,
                    success : function(datas){
                        var test = "Enregistrement éffectué";
                        $('#spinner').hide();
                        $('#connexion-text').show();
                        $('#info').html(datas);
                        if(datas.includes(test)){
                            $('#btn-ok').show();
                            $('#btn-recense').hide();
                        }
                        $('#form-ajoutEtudiant').reset();
                        formData = new formData();
                    },
                    error : function (datas){
                        alert("Désolé");
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            });

            $('#btn-ok').click(function (e){
                e.preventDefault();
                location.reload();
            });
        })
    </script>
</body>
</html>