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

<div class="container">
  <div class="message signup">
    <div class="btn-wrapper">
      <button class="button" id="signup">Sign Up</button>
      <button class="button" id="login"> Login</button>
    </div>
  </div>
  <div class="form form--signup">
    <div class="form--heading">Welcome! Sign Up</div>
    <form autocomplete="off">
      <input type="text" placeholder="Name">
      <input type="email" placeholder="Email">
      <input type="password" placeholder="Password">
      <button class="button">Sign Up</button>
    </form>
  </div>
  <div class="form form--login">
    <div class="form--heading">Welcome back! </div>
    <form autocomplete="off">
      <input type="text" placeholder="Name">
      <input type="password" placeholder="Password">
      <button class="button">Login</button>
    </form>
  </div>
  
</div>


    </body>
 
    <script>
        $("#signup").click(function() {
        $(".message").css("transform", "translateX(100%)");
        if ($(".message").hasClass("login")) {
            $(".message").removeClass("login");
        }
        $(".message").addClass("signup");
        });

        $("#login").click(function() {
        $(".message").css("transform", "translateX(0)");
        if ($(".message").hasClass("login")) {
            $(".message").removeClass("signup");
        }
        $(".message").addClass("login");
        });

    </script>
</html>