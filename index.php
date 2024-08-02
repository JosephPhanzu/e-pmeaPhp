<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    
    <!--Lien pour la création de l'application mobile-->
    <link rel="manifest" href="/manifest.json">

    <!-- Fontawesome CSS CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- MDB CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css" rel="stylesheet">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="images/logos/favicon.png"/>
</head>
<body style="background:#232e4c;" class="p-1">
  
        <div class="container header text-white">
            <div class="row d-flex justify-content-center">
                <div class="container d-flex justify-content-center col-12">
                    <img src="images/logos/EPMEA.png" class="img-fluid" id="logo2" alt="logo">
                </div>
                <div class="row d-flex justify-content-center">
                    <div class="chapeau-text d-flex justify-content-center col-12 col-md-7 text-center fw-bolder">
                        <span class="text-danger fs-6 fs-md-3">DIVISION URBAINE DE <span class="fs-6 fs-md-2 text-white text-center">L'ENTREPREUNARIAT PETITES, MOYENNES ENTREPRISES ET ARTISANATS</span></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid section text-center col-md-5 mt-1">
            <form action="" autocomplete="off" id="connexion-student" class="rounded form-inline py-3 bg-light border-4 border-primary">
                <div class="form-title text-start ps-2">
                    <p class="text-primary"><i class="fa-solid fa-lock text-primary fs-4 me-2"></i>Identifiez-vous</p><hr>
                </div>
                <div class="container text-secondary text-wrap">
                <div class="form-outline">
                        <input type="email" autocomplete="off" name="email" class="form-control form-control-lg shadow-none rounded-0" id="email">
                        <label for="email" class="form-label">E-mail</label>
                    </div><br>
                    <div class="form-outline">
                        <input type="text" autocomplete="off" name="matricule" class="form-control form-control-lg shadow-none rounded-0" id="matricule">
                        <label for="matricule" class="form-label">Matricule</label>
                    </div><br>
                    <div class="form-check text-start">
                        <input type="checkbox" class="form-check-input" name="check-connect" id="check-connect">
                        <label class="form-check-label" for="check-connect">Se souvenir de moi</label>
                    </div>
                    </div><br>
                    <div class="container">
                        <div id="info" class="text-start"></div>
                    </div>
                    <div class="container">
                        <button class="btn btn-primary btn-block btn-lg col-12 shadow" id="btn-connect">
                            <div class="spinner-border text-white" id="spinner" role="status" style="display:none; width:30px; height:30px">
                                <span class="sr-only">Loader...</span>
                            </div>
                            <span id="connexion-text"><i class="fa-solid fa-unlock text-white me-2"></i>Connexion</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="container footer d-flex justify-content-center">
            <div class="text-footer text-white">
                <p>VENTE PATENTE EXERCICE 2024</p>
            </div>
        </div>
    <!-- Jquery Js -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <!-- MDB JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"></script>
    <script>
        $(document).ready(function(){
            
            // La configuration du service-worker pa l'application mobile
            if ('serviceWorker' in navigator) {
                navigator.serviceWorker.register('/service-worker.js').then(function(registration) {
                  console.log('Service Worker registered with scope:', registration.scope);
                }).catch(function(error) {
                  console.log('Service Worker registration failed:', error);
                });
            }
            
            // Destruction de la session lorsqu'on retourne dans la page de connexion
            $(document).ready(function(){
                $.ajax({
                    url : 'deconnexion.php',
                    method : 'POST',
                    success : function(data){
                        console.log(data);
                    }
                });
            });

            // let email = $('#email').val(""),
            //     mdp_valeur = $('#matricule').val("");

            var matricule = $('#matricule');
            //     checkForm = $('#check-connect');

            // checkForm.change(function(e) {
            //     if(e.target.checked === true) {
            //         mdp.val('');
            //         mdp.attr("disabled", true);
            //     }
            //     if(e.target.checked === false) {
            //         mdp.removeAttr('disabled');
            //     }
            // });

            $('#connexion-student').submit(function(e){
                e.preventDefault();
                var formData = new FormData(this);

                let email = $('#email').val(),
                    matriculeVal = matricule.val();
                
                if (email != "" && matriculeVal != "") {
                    $('#spinner').show();
                    $('#connexion-text').hide();
                    var reg = /(@epmea.cd)$/i,
                        reg1 = /(@ipmea.cd)$/i
                    if (reg.test(email) || reg1.test(email)) {
                        $.ajax({
                            url : "ajax/loginStudent.php",
                            method : "POST",
                            data : $(this).serialize(),
                            success : function(datas){
                                $('#spinner').hide();
                                $('#connexion-text').show();
                                $('#info').html(datas);
                            }
                        });
                    }else{
                        $('#info').addClass('alert alert-danger text-danger');
                        $('#info').html("<i class=\"fa-solid fa-circle-exclamation\"></i> E-mail incorrecte!");
                        $('#spinner').hide();
                        $('#connexion-text').show();
                    }
                }else{
                    $('#info').addClass('alert alert-danger text-danger');
                    $('#info').html("<i class=\"fa-solid fa-circle-exclamation\"></i> Renseignez toutes les champs svp!");
                }
                

            });

        });
    </script>
</body>
</html>