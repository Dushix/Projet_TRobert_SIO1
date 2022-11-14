<!DOCTYPE html>
<html>

    <head>
    <link rel="stylesheet" href="http://localhost/bkrid/Formulair.css">
    <title>Module d’enregistrement et d’authentification </title>
    
    </head>

    <body>
        <form name="Formulaire" action="AnalyseFormulaire.php" method="post">
            <table>
                <tr>
                    <td>Saisissez votre nom :</td>
                    <td><input type="text" name="nom" pattern="[a-zA-ZÀ-ÿ-.]{2,64}" required></td>
                </tr>

                <tr>
                    <td>Saisissez votre prénom :</td>
                    <td><input type="text" name="prenom" minlength="2" pattern="[a-zA-ZÀ-ÿ-.]{2,32}" required></td>
                </tr>

                <tr>
                    <td>Saisissez votre email :</td>
                    <td><input type="text" name="email" placeholder="example@example.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="Merci de fournir une adresse valide" required></td>
                </tr>

                <tr>
                    <td>Saisissez votre télephone :</td>
                    <td><input type="tel" name="telephone" maxlength="10" pattern="[0-9]{10}" required></td>
                </tr>

                <tr>
                    <td>Saisissez votre nom d'utilisateur :</td>
                    <td><input type="text" placeholder="Entrer le nom d'utilisateur" name="username" minlength="5" pattern="[a-z0-9]{5,16}"required></td>
                </tr>

                <tr>
                    <td>Mot de passe (8 characters minimum):</td>
                    <td><input type="password" name="password" placeholder="Entrer le mot de passe" minlength="8" required></td>
                </tr>

                <tr>
                    <td>Confirmation du Mot de passe :</td>
                    <td><input type="password" name="confirm_password" placeholder="Confirmation du Mot de passe" minlength="8" required></td>
                </tr>
        </form>
        <from>
            <tr>
                <td><input type="button" name="verification" value="OK" /></td>
                <td><input class="inv" type="submit" name="soumettre" value="OK"/></td>
            </tr>
            <script>
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
                            alert ("NON");  
                        }
                    }

            </script>   
        </from>

    </body>

</html>