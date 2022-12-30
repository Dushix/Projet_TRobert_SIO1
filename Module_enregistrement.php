<?php 
if (isset($_GET['erreur'])){
    $erreur = (isset($_GET['erreur'])) ? $_GET['erreur'] : null;
} if(!empty($erreur)){
    echo($erreur);
    if("$erreur"==="862"){
        echo '<script type="text/javascript">alert("Vous devez remplir tous les champs"); </script>';
    }

    if("$erreur"==="762"){
        echo '<script type="text/javascript">alert("Votre mot de passe est incorrect");</script>';
    }

}
?>
<!DOCTYPE html>
<html>

    <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="enregistrement.css">
    <title>Module d’enregistrement</title>

    </head>

    <body>
        <!--<div class="back">
            <form name="Formulaire" action="verification_enregistrement.php" method="post">
                <table>
                    <tr>
                        <td>Saisissez votre nom :</td>
                        <td><input type="text" name="nom" pattern="[a-zA-ZÀ-ÿ-.]{2,64}" title="Merci de fournir votre nom" required></td>
                    </tr>

                    <tr>
                        <td>Saisissez votre prénom :</td>
                        <td><input type="text" name="prenom" minlength="2" pattern="[a-zA-ZÀ-ÿ-.]{2,32}" title="Merci de fournir votre prenom" required></td>
                    </tr>

                    <tr>
                        <td>Saisissez votre email :</td>
                        <td><input type="text" name="email" placeholder="example@example.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="Merci de fournir une adresse valide." required></td>
                    </tr>

                    <tr>
                        <td>Saisissez votre télephone :</td>
                        <td><input type="tel" name="telephone" maxlength="10" pattern="[0-9]{10}" required></td>
                    </tr>

                    <tr>
                        <td>Saisissez NUMEN :</td>
                        <td><input type="text" name="numen" minlength="13" maxlength="13" pattern="[a-zA-0-9]{13}" required></td>
                    </tr>

                    <tr>
                        <td>Saisissez votre identifiant :</td>
                        <td><input type="text" placeholder="Entrer le nom d'utilisateur" name="identifiant" minlength="4" pattern="[a-zA-Z0-9]{4,16}"required></td>
                    </tr>

                    <tr>
                        <td>Mot de passe (8 characters minimum):</td>
                        <td><input class="vide" type="password" name="password" placeholder="Entrer le mot de passe" minlength="8" required></td>
                    </tr>

                    <tr>
                        <td>Confirmation du Mot de passe :</td>
                        <td><input class="vide" type="password" name="confirm_password" placeholder="Confirmation du Mot de passe" minlength="8" required></td>
                    </tr>
                    <tr id="log">

                    </tr>

                    <tr>
                        <td><input type="button" name="verification" value="OK" /></td>
                        <td><input hidden type="submit" name="soumettre" value="OK"/></td>
                    </tr>
            </form>
        </div>
            <script type="text/javascript">
                    var pas = document.querySelector('[name="password"]');
                    var con = document.querySelector('[name="confirm_password"]');
                    var sub = document.querySelector('[type="submit"]');
                    var but = document.querySelector('[type="button"]');

                    but.addEventListener('click', testvf);

                    function testvf() {
                        if (pas.value === con.value ) {
                            sub.click()
                            // $('.button').prop('disabled', false);
                            // document.forms["Formulaire"].submit();  
                        } else {
                            pas.id = "erreurpass";                  
                            alert ("Votre mot de passe ne correspond pas avec la confirmation du Mot de passe");  
                        }
                    }

            </script>-->
        <form name="Formulaire" action="verification_enregistrement.php" method="post">
            <div class="container">
            <div class="message signup">
                <div class="btn-wrapper">
                <button class="button" id="signup">S'enregistrer</button>
                <button class="button" id="login">Se connecter</button>
                </div>
            </div>
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
                <button class="button" name="verification" value="OK">S'enregistrer</button>
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
                            // $('.button').prop('disabled', false);
                            // document.forms["Formulaire"].submit();  
                        } else {
                            pas.id = "erreurpass";                  
                            alert ("Votre mot de passe ne correspond pas avec la confirmation du Mot de passe");  
                        }
                    }
                </script>
                </form>
            </div>
            <div class="form form--login">
                <div class="form--heading">Content de vous revoir! </div>
                <form autocomplete="off">
                <input type="text" placeholder="Name">
                <input type="password" placeholder="Password">
                <button class="button">Se connecter</button>
                </form>
            </div>
            </div>
        </form>
    </body>
</html>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="enregistrement.js"></script>