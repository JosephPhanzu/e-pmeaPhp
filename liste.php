<?php

    session_start();
    include "session.php";
    include_once "bdd.php";
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listes</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="shortcut icon" type="image/png" href="images/logos/favicon.png"/>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            #monTableau, #monTableau * {
                visibility: visible;
            }
            #monTableau {
                position: absolute;
                left: 0;
                top: 0;
            }
        }
        .table .headrece th {
            background-color: #3982a6; /* Remplacez par la couleur de votre choix */
            color: white; /* Couleur du texte de l'entête */
        }
        .table .headartisa>tr th {
            background-color: #264d14; /* Remplacez par la couleur de votre choix */
            color: white; /* Couleur du texte de l'entête */
        }
        .table .headcommerce>tr th {
            background-color: #161648; /* Remplacez par la couleur de votre choix */
            color: white; /* Couleur du texte de l'entête */
        }
    </style>

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
    <div class="container-fluid container-md section">
        <div class="row d-flex mt-4 d-flex justify-content-center">
            <form action="" id="form-recensement" class="form-inline mt-3 py-3 px-0 bg-light border border-primary">
                <div class="container text-secondary text-wrap">
                    <fieldset>
                        <legend class="text-secondary fw-bolder text-uppercase">Listes d'Enregistrés</legend>
                        <div class="form-group">
                            <div class="d-flex row justify-content-center">
                                <input type="radio" class="btn-check" name="liste" id="recense" autocomplete="off" value="recense">
                                <label class="btn fw-bold my-1 col-10 col-md-3 text-white mx-0 mx-md-2" style="background:#3982a6;" for="recense">Recensés</label>

                                <input type="radio" class="btn-check" name="liste" id="artisanale" autocomplete="off" value="artisanale">
                                <label class="btn fw-bold my-1 col-10 col-md-3 text-white mx-0 mx-md-2" style="background:#264d14;" for="artisanale">Artisanales</label>

                                <input type="radio" class="btn-check" name="liste" id="commerce" autocomplete="off" value="commerciale">
                                <label class="btn fw-bold my-1 col-10 col-md-3 text-white mx-0 mx-md-2" style="background:#121341;" for="commerce">Commerciales</label>         
                            </div>
                        </div><br>
                    </fieldset>
                    <div class='d-flex mb-3 justify-content-center'>
                        <div class='row col-11 col-md-5 bg-white rounded-5' id='zone-recherche' style="display:none">
                            <form class='form-inline w-auto my-auto'>
                                <div class='input-group border border-secondary rounded-5' id='input-group'>
                                    <input autocomplete='off' name='recherchePat' type='search' class='form-control shadow-none border-0 rounded-0 rounded-start' placeholder='Rechercher un Enregistrement' style='min-width: 225px;'/>
                                    <span class='input-group-text border-0 bg-white'><i class='fas fa-search'></i></span>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div id="info" class="text-start"></div>
                    <div id="infoR" class="text-start"></div>
                </div>
            </form>
        </div>
    </div>
    <div class="container footer d-flex justify-content-center">
        <div class="text-footer text-white">
            <p>VENTE PATENTE EXERCICE 2024</p>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function(){

            $(document).on('click','#printButton', function(e){
                e.preventDefault();
                window.print();
            });
            
            $(document).on('click','#generatePDF', function(e){
                e.preventDefault();
                // Utilisation de html2canvas pour capturer le tableau
                html2canvas(document.querySelector("#monTableau"), { scale: 1 }).then(canvas => {
                    // Récupération de l'image du tableau capturé
                    const imgData = canvas.toDataURL('image/png', 0.60);
                    const pdf = new jspdf.jsPDF('p', 'mm', 'a4');

                    // Dimensions de la page A4 en mm
                    let pageWidth = 210;
                    let pageHeight = 297;
                    
                    // Calculer la hauteur de l'image pour qu'elle conserve les proportions
                    let imgWidth = pageWidth - 0; // Marge de 10mm de chaque côté
                    let imgHeight = (canvas.height * imgWidth) / canvas.width;
                    
                    // Vérifier si l'image dépasse la hauteur de la page
                    if (imgHeight > pageHeight - 20) { // Marge de 10mm en haut et en bas
                        imgHeight = pageHeight - 0;
                        imgWidth = (canvas.width * imgHeight) / canvas.height;
                    }
                    
                    let x = (pageWidth - imgWidth) / 2;
                    let y = 10; //
                    
                    // Ajout de l'image au PDF
                    pdf.addImage(imgData, 'PNG', x, y, imgWidth, imgHeight);
                    pdf.save("tableau.pdf");
                });
            });
            // La bordure info au champ de recherche
            $('#input-group').click(function(){
                $(this).addClass('border-info');
            });

            // au choix d'un type de fiche
            $('input[type=radio][name=liste]').click(function() {
                var valeur = $(this).val(),
                    typePat = $('#artisanale').val(),
                    typePat1 = $('#commerce').val();

                var currentPage = 1,
                totalPages = 1;
                $('#zone-recherche').show();
                    
                if (valeur.includes("recense")) {
                    $('input[type=search]').attr('id','rechercheRece');
                    $('input[type=search]').val("");
                    $('#input-group').removeClass('border-info');
                    $('#infoR').hide();
                    $('#info').show();
                    function recupRece(page) {
                        $.ajax({
                            url : 'ajax/recupRece.php',
                            type : 'POST',
                            data : {page : page},
                            success : function(datas){
                                $('#info').html(datas);

                                totalPages = $('#total-pages').val();
                                totalPages = parseInt(totalPages);
                            }
                        });        
                    }
                    recupRece(currentPage);

                }else if (valeur.includes("artisanale")) {
                    $('input[type=search]').attr('id','recherchePat');
                    $('input[type=search]').val("");
                    $('#input-group').removeClass('border-info');
                    $('#infoR').hide();
                    $('#info').show();
                    type = "artisanale";
                    function recupPat(page) {
                        $.ajax({
                            url : 'ajax/recupPatent.php',
                            type : 'POST',
                            data : {type : typePat, page : page},
                            success : function(datas){
                                $('#info').html(datas);
                                totalPages = $('#total-pages').val();
                                totalPages = parseInt(totalPages);
                            }
                        });        
                    }
                    recupPat(currentPage);
                }else if (valeur.includes("commercial")) {
                    $('input[type=search]').attr('id','recherchePat');
                    $('input[type=search]').val("");
                    $('#input-group').removeClass('border-info');
                    $('#infoR').hide();
                    $('#info').show();
                    type = "commerciale";
                    function recupPatC(page) {
                        $.ajax({
                            url : 'ajax/recupPatent.php',
                            type : 'POST',
                            data : {type : typePat1, page : page},
                            success : function(datas){
                                $('#info').html(datas);
                                totalPages = $('#total-pages').val();
                                totalPages = parseInt(totalPages);
                            }
                        });        
                    }
                    recupPatC(currentPage);
                }else{
                    
                }
                //La fonction Fin de pages
                function verificationPage(){
                    if (currentPage == totalPages) {
                        $('#next-btn-annonce').attr('disabled');
                    }
                    if (currentPage == 1) {
                        $('#prev-btn-annonce').attr('disabled');
                    }
                    verificationPage();
                }
                
                //L'appuis sur suiv
                $(document).on('click','#next-btn-annonce,#next-btn-artisanal,#next-btn-com', function(){
                    if (currentPage < totalPages) {
                        currentPage++;
                        if ($(this).is('#next-btn-annonce')) {
                            recupRece(currentPage);
                        } else if ($(this).is('#next-btn-artisanal')) {
                            recupPat(currentPage);
                        } else if ($(this).is('#next-btn-com')) {
                            recupPatC(currentPage);
                        }
                        verificationPage();
                    }
                });
                //L'appuis sur préc
                $(document).on('click','#prev-btn-annonce,#prev-btn-artisanal,#prev-btn-com', function(){
                    if (currentPage > 1) {
                        currentPage--;
                        if ($(this).is('#prev-btn-annonce')) {
                            recupRece(currentPage);
                        } else if ($(this).is('#prev-btn-artisanal')) {
                            recupPat(currentPage);
                        } else if ($(this).is('#prev-btn-com')) {
                            recupPatC(currentPage);
                        }
                        verificationPage();
                    }
                });
            });
            // Recherche d'enregistrement
            $(document).on('keyup', '#rechercheRece,#recherchePat', function(){
                var r = $(this).val();
                if ($(this).is('#rechercheRece')) {
                    if (r != "") {
                        $.ajax({
                            url : 'ajax/rechercheRece.php',
                            type : 'post',
                            data : {r : r},
                            success : function(datas){
                                $('#infoR').show();
                                $('#infoR').html(datas);
                                $('#info').hide();
                            }
                        });
                    }else{
                        $('#infoR').hide();
                        $('#info').show();
                    }
                }else if($(this).is('#recherchePat')){
                    if (r != "") {
                        $.ajax({
                            url : 'ajax/recherchePat.php',
                            type : 'post',
                            data : {r : r, type : type},
                            success : function(datas){
                                $('#infoR').show();
                                $('#infoR').html(datas);
                                $('#info').hide();
                            }
                        });
                    }else{
                        $('#infoR').hide();
                        $('#info').show();
                    }
                }
            });
        })
    </script>
</body>
</html>