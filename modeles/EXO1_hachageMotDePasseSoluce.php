<?php
session_start();

require "./ConnectionMySQL.php" ;
// Si il y a une entrée 'soumettre' comme clef dans la variable superglobale $_POST
// alors on valorise $utilisateur à la valeur correspondante à la clef identifiant
// si elle existe et à null sinon
// Pareil pour $password
// Autrement dit: si l'utilisateur a entré du texte pour le champ de formulaire
// ce texte va dans la variable utilisateur
// Et si il a saisi quelque chose dans le champ motDePasse ce texte va dans le
// variable $password

if (isset($_POST['soumettre'])){
    $utilisateur = (isset($_POST['identifiant'])) ? $_POST['identifiant'] : null;
    $password = (isset($_POST['motDePasse'])) ? $_POST['motDePasse'] : null;
}

if(!empty($utilisateur)&&!empty($password)){

// hachage du mot de passe avec la fonction password_hash PHP et
// l'algorithme le plus fort PASSWORD_ARGON2ID
$hashDuMotDePasse = password_hash($password, PASSWORD_DEFAULT);

$nom = $_POST['nom'] ;
$prenom = $_POST['prenom'] ;
$email = $_POST['email'] ;
$telephone = $_POST['telephone'] ;

$connection = getConnection();
$statement = $connection->prepare("INSERT INTO COMPTES(identifiant,motDePasse, nom, prenom, email, telephone) VALUES(:identifiant,:motDePasse,:nom,:prenom,:email,:telephone)");

$statement->bindParam(':identifiant', $utilisateur, PDO::PARAM_STR);
$statement->bindParam(':motDePasse', $hashDuMotDePasse, PDO::PARAM_STR);
$statement->bindParam(':nom', $nom, PDO::PARAM_STR);
$statement->bindParam(':prenom', $prenom, PDO::PARAM_STR);
$statement->bindParam(':email', $email, PDO::PARAM_STR);
$statement->bindParam(':telephone', $telephone, PDO::PARAM_STR);

$statement->execute() ;

$_SESSION['utilisateur']=$utilisateur ;
$_SESSION['estValide']=true ;

header('Location: ../vues/EXO3_sessionsForEver.php');    
}

else
{
session_destroy();
header('Location: ../vues/EXO1_FormulaireEnregistrement.html');    
exit();
}
