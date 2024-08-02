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
    <title>Recensement</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="shortcut icon" type="image/png" href="images/logos/favicon.png"/>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>
<body style="background:#232e4c;" class="p-0 p-md-2">
    <div class="nav py-2 bg-light rounded-bottom sticky-top shadow-lg">
        <div class="container-fluid nav-text d-flex justify-content-center">
            <p class="chapeau-text1">FICHE DE RECENSEMENT EXERCICE 2024</p>
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
                            <label for="postnom" class="form-label">Post-Nom</label>
                        </div><br>
                        <div class="form-floating border">
                            <input type="text" name="prenom" placeholder="Prenom" class="form-control shadow-none rounded-0" id="prenom">
                            <label for="prenom" class="form-label">Prenom</label>
                        </div><br>
                        <div class="form-floating border">
                            <input type="text" name="nature" placeholder="nature" class="form-control shadow-none rounded-0" id="nature">
                            <label for="nature" class="form-label">Nature d'activité</label>
                        </div><br>
                        <div class="form-floating border">
                            <input type="text" name="denomination" placeholder="denomination" class="form-control shadow-none rounded-0" id="denomination">
                            <label for="denomination" class="form-label">Dénomition commerciale</label>
                        </div><br>
                        <div class="form-floating border">
                            <select class="form-select border-0 shadow-sm" name="forme" id="forme">
                                <option value="" disable selected hidden>---Forme juridique---</option>
                                <option value="est">Est</option>
                                <option value="sarl">Sarl</option>
                                <option value="coopération">Coopération</option>
                                <option value="autres">Autres</option>
                            </select>
                        </div><br>
                        <div class="form-floating border">
                            <select class="form-select border-0 shadow-sm" name="sexe" id="sexe">
                                <option value="" disable selected hidden>---Sexe---</option>
                                <option value="m">M</option>
                                <option value="f">F</option>
                            </select>
                        </div><br>
                        <div class="form-floating border-none border-bottom">
                            <input type="email" name="email" placeholder="Entez votre E-mail" class="form-control shadow-none rounded-0" id="email">
                            <label for="email" class="form-label">Email Ex: nomprenom@gmail.com</label>
                        </div><br>
                        
                        <div class="form-floating border">
                            <input type="tel" name="tel" placeholder="000-000-000" class="form-control shadow-none rounded-0" maxlength="9" id="tel">
                            <label for="tel" class="form-label">Téléphone Ex: 899999999</label>
                        </div><br>
                        <fieldset>
                            <legend>Adresse d'activité</legend>
                            <div class="form-floating border">
                                <input type="text" name="avenu_acti" placeholder="Entez la nationalite de l'étudiant" class="form-control shadow-none rounded-0" id="avenu_acti">
                                <label for="avenu_acti" class="form-label">Avenue ou Pavillion</label>
                            </div><br>
                            <div class="form-floating border">
                                <input type="text" name="numero_acti" placeholder="Entez la nationalite de l'étudiant" class="form-control shadow-none rounded-0" id="numero_acti">
                                <label for="numero_acti" class="form-label">Numéro</label>
                            </div><br>
                            <div class="form-floating border">
                                <input type="text" name="quartier_acti" placeholder="Entez la nationalite de l'étudiant" class="form-control shadow-none rounded-0" id="quartier_acti">
                                <label for="quartier_acti" class="form-label">Quartier</label>
                            </div><br>
                            <div class="form-floating border">
                                <input type="text" name="commune_acti" placeholder="Entez la nationalite de l'étudiant" class="form-control shadow-none rounded-0" id="commune_acti">
                                <label for="commune_acti" class="form-label">Commune</label>
                            </div><br>
                        </fieldset>
                        <fieldset>
                            <legend>Adresse Résidentielle</legend>
                            <div class="form-floating border">
                                <input type="text" name="avenu_resi" placeholder="Entez la nationalite de l'étudiant" class="form-control shadow-none rounded-0" id="avenu_resi">
                                <label for="avenu_resi" class="form-label">Avenue ou Pavillion</label>
                            </div><br>
                            <div class="form-floating border">
                                <input type="text" name="numero_resi" placeholder="Entez la nationalite de l'étudiant" class="form-control shadow-none rounded-0" id="numero_resi">
                                <label for="numero_resi" class="form-label">Numéro</label>
                            </div><br>
                            <div class="form-floating border">
                                <input type="text" name="quartier_resi" placeholder="Entez la nationalite de l'étudiant" class="form-control shadow-none rounded-0" id="quartier_resi">
                                <label for="quartier_resi" class="form-label">Quartier</label>
                            </div><br>
                            <div class="form-floating border">
                                <input type="text" name="commune_resi" placeholder="Entez la nationalite de l'étudiant" class="form-control shadow-none rounded-0" id="commune_resi">
                                <label for="commune_resi" class="form-label">Commune</label>
                            </div><br>
                        </fieldset>
                        <fieldset>
                            <legend class="text-danger">Recensement Type</legend>
                            <div class="form-group border bg-white p-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="type_rece" id="type_physique" value="physique" checked>
                                    <label class="form-check-label" for="type_physique">
                                        Personne Physique non patentée
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="type_rece" id="type_moral" value="morale">
                                    <label class="form-check-label" for="type_moral">
                                        Personne Morale
                                    </label>
                                </div>
                            </div><br>
                        </fieldset>
                        <div class="form-floating border bg-white p-2">
                            <input type="hidden" name="montant" placeholder="Entez la nationalite de l'étudiant" class="form-control shadow-none rounded-0" id="montant">
                             <p for="montant" id="champ_physique" class="form-text fw-bold fs-5">Personne Physique 70.000 Fc</p>
                             <p for="montant" style="display:none;" id="champ_morale" class="form-text fw-bold fs-5">Personne Morale 112.000 Fc</p>
                        </div><br>
                        
                        <!--Capturer, Prendre une photo-->
                        <div class="d-flex justify-content-center">
                            <div data-mdb-ripple-init class="btn btn-info col-10 col-md-8">
                                <label class="form-label fw-bold text-white" for="customFile2"><i class="fa-solid fa-camera fs-5 me-2"></i>Prendre une Photo</label>
                                <input type="file" name="photo" class="form-control d-none" id="customFile2" />
                            </div>
                        </div>
                        
                        <!--La prévisualisation de la photo-->
                        <div class="d-flex justify-content-center border-2 border-primary my-2">
                            <img id="preview" src="#" alt="Prévisualisation de l'image" class="img-fluid w-75" height="150" style="display: none;"/>
                            <label class="custom-file-label" for="preview"></label>
                        </div>
                        
                        <div class="d-flex justify-content-around group-btn">
                            <button class="btn btn-primary col-10 col-md-8 btn-lg">
                                <div class="spinner-border text-white" id="spinner" role="status" style="display:none; width:30px; height:30px">
                                    <span class="sr-only">Loader...</span>
                                </div>
                                <span id="connexion-text"><i class="fa-sharp fa-solid fa-user-plus me-1"></i>Enregistrer</span>
                            </button>
                            <a href="fiche.php" type="button" class="btn btn-success col-10 btn-lg shadow" id="btn-back" style="display:none;">
                                <span>OK</span>
                            </a>
                        </div>
                        
                        <!--L'affichage des reponse ajax-->
                        <div class="container mt-3">
                            <div id="info" class="text-start"></div>
                        </div>
                        
                        
                        <div class="container mt-3 d-flex justify-content-center">
                            <p class="text-danger col-10 col-md-4 text-center">
                                NB: Toutes recettes due à la patente ou fiche de recensement est versé à la banque
                            </p>
                        </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.5/cropper.min.js"></script>
    <script>
        $(document).ready(function(){
            
            // Mettre à jour le label du champ de fichier avec le nom du fichier sélectionné
            //   $('#customFile2').on('change', function() {
            //     var fileName = $(this).val().split('\\').pop();
            //     $(this).next('.custom-file-label').addClass('selected').html(fileName);
        
            //     // Prévisualiser l'image sélectionnée
            //     if (this.files && this.files[0]) {
            //       var reader = new FileReader();
            //       reader.onload = function(e) {
            //         $('#preview').attr('src', e.target.result).show();
            //       }
            //       reader.readAsDataURL(this.files[0]);
            //     }
            //   });
              // Prévisualiser et recadrer l'image
                $('#customFile2').on('change', function() {
                    var file = this.files[0];
                    if (file) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        var image = $('#preview');
                        image.attr('src', e.target.result).show();

                        // Détruire l'ancien cropper si nécessaire
                        if (cropper) {
                        cropper.destroy();
                        }

                        // Initialiser le cropper
                        cropper = new Cropper(image[0], {
                        aspectRatio: 1,
                        viewMode: 1,
                        responsive: true,
                        background: false,
                        autoCropArea: 1,
                        crop: function(event) {
                            // Vous pouvez obtenir les données de recadrage ici si nécessaire
                        }
                        });
                    }
                    reader.readAsDataURL(file);
                    }
                });
            
            // Le choix du type de recenssement
            $('input[type=radio][name=type_rece]').change(function() {
                if (this.value === 'morale') {
                    $('#champ_physique').hide();
                    $('#champ_morale').show();
                    $('#montant').val(120000);
                }else if(this.value === 'physique') {
                    $('#champ_morale').hide();
                    $('#champ_physique').show();
                    $('#montant').val(70000);
                }
            });
            
            // à l'envoi du formulaire
            $('#form-recensement').submit(function(e){
                e.preventDefault();
                $('#spinner').show();
                $('#connexion-text').hide();
        
                var formData = new FormData(this);
                
                $.ajax({
                    url : "ajax/addrecensement.php",
                    type : "POST",
                    data : formData,
                    success : function(datas){
                        var test = "Enregistrement éffectué";
                        $('#spinner').hide();
                        $('#connexion-text').show();
                        $('#info').html(datas);
                        if(datas.includes(test)){
                            $('#btn-back').show();
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
        })
    </script>
</body>
</html>