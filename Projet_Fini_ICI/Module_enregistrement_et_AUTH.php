<?php 
if (isset($_GET['erreur'])){
    $erreur = (isset($_GET['erreur'])) ? $_GET['erreur'] : null;
} if(!empty($erreur)){
    if("$erreur"==="862"){
        echo '<script type="text/javascript">alert("Vous devez remplir tous les champs"); </script>';
    }

    if("$erreur"==="762"){
        echo '<script type="text/javascript">alert("Votre mot de passe est incorrect");</script>';
    }

    if("$erreur"==="99"){
        echo '<script type="text/javascript">alert("identifiant ou mots de passe incorrect");</script>';
    }

}
?>
<html>

    <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./Module_enregistrement_et_AUTH.css">
    <title>Module d’enregistrement</title>

    </head>
</html>

        <form name="Formulaire" action="verification_enregistrement.php" method="post">
            <div class="container">
            <div class="message signup">
                <div class="btn-wrapper">
                <button class="button" id="signup">S'enregistrer</button>
                <button class="button" id="login">Se connecter</button>
                </div>
            </div>

            <!-- Enregistrement -->
            <div class="form form--signup">
                <div class="form--heading">Bonjour! Enregistrez-vous</div>
                <form autocomplete="off">
                <input type="text" placeholder="Nom" name="nom" pattern="[a-zA-ZÀ-ÿ-.]{2,64}" title="Merci de fournir votre nom" required>
                <input type="text" placeholder="Prenom" name="prenom" minlength="2" pattern="[a-zA-ZÀ-ÿ-.]{2,32}" title="Merci de fournir votre prenom" required>
                <input type="email" placeholder="Email"  name="email"  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="Merci de fournir une adresse valide." required>
                <input type="tel" placeholder="Telephone" name="telephone" maxlength="10" pattern="[0-9]{10}" required>
                <input type="text" placeholder="Numen" name="numen" minlength="13" maxlength="13" pattern="[a-zA-0-9]{13}" required>
                <input type="text" placeholder="Identifiant" name="identifiant" minlength="4" pattern="[a-zA-Z0-9]{4,16}"required>
                <input type="password" placeholder="mot de passe" class="vide" name="password" minlength="8" required>
                <input type="password" placeholder="Confirmation de mot de passe" class="vide" name="confirm_password" minlength="8" required>
                <button type="button" id="button" value="OK">S'enregistrer</button>
                <input hidden type="submit" name="soumettre" value="OK"/>

                <script type="text/javascript">
                    var pas = document.querySelector('[name="password"]');
                    var con = document.querySelector('[name="confirm_password"]');
                    var sub = document.querySelector('[type="submit"]');
                    var but = document.querySelector('[type="button"]');


         
                    but.addEventListener('click', testvf);
                    function testvf() {
                        if (pas.value === con.value ) {
                            sub.click() 
                        } else {
                            pas.id = "erreurpass";                  
                            alert ("Votre mot de passe ne correspond pas avec la confirmation du Mot de passe");  
                        }   
                    }
                </script>
                </form>
            </div>

            <!-- Autentification -->
            <div class="form form--login">
                <div class="form--heading">Content de vous revoir! </div>
                <form action="verification_authentification.php" method="POST">
                <input type="text" placeholder="Identifiant" class="inputc" name="identifiant" required>
                <input type="password" placeholder="Mot de passe" class="inputc" name="motDePasse" required>
                <button class="submit" name="soumettre" value='LOGIN'>Se connecter</button>
                </form>
            </div>
            </div>
        </form>
    </body>
</html>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="enregistrement.js"></script>
