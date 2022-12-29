<?php 
if (isset($_GET['erreur'])){
    $erreur = (isset($_GET['erreur'])) ? $_GET['erreur'] : null;
} if(!empty($erreur)){
    echo($erreur);
    if("$erreur"==="862"){
        echo '<script type="text/javascript">alert("Vous devez remplir tous les champs"); </script>';
    }

    if("$erreur"==="99"){
        echo '<script type="text/javascript">alert("identifiant ou mots de passe incorrect");</script>';
    }

}
?>
<html>
    <head>
       <meta charset="utf-8">
        <link rel="stylesheet" href="authentification.css" media="screen" type="text/css" />
        <title>Module d’authentification</title>
    </head>
    <body>
        <div>
            <!-- zone de connexion -->
            <div class="back">
                <form action="verification_authentification.php" method="POST">
                    <div class="divinput">
                        <h1>Connexion</h1>
                        
                        <label><b>Nom d'utilisateur</b></label>
                        <input class="inputc" type="text" placeholder="Entrer le nom d'utilisateur" name="identifiant" required>
                        <br>
                        <label><b>Mot de passe</b></label>
                        <input class="inputc" type="password" placeholder="Entrer le mot de passe" name="motDePasse" required>
                        <br>
                        <br>
                        <input class="submit" type="submit" name="soumettre" value='LOGIN' >
                        <br>
                        <br>
                        <br>
                        <br>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>