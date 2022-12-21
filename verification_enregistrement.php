<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="enregistrement.css">
    <title>Module d’enregistrement</title>
    
</head>
<?php
if (isset($_POST['soumettre'])){
    $nom = (isset($_POST['nom'])) ? $_POST['nom'] : null;
    $prenom = (isset($_POST['prenom'])) ? $_POST['prenom'] : null;
    $email = (isset($_POST['email'])) ? $_POST['email'] : null;
    $telephone = (isset($_POST['telephone'])) ? $_POST['telephone'] : null;
    $numen = (isset($_POST['numen'])) ? $_POST['numen'] : null;
    $identifiant = (isset($_POST['identifiant'])) ? $_POST['identifiant'] : null;
    $password = (isset($_POST['password'])) ? $_POST['password'] : null;
    $confirm_password = (isset($_POST['confirm_password'])) ? $_POST['confirm_password'] : null;
}
if(!empty($nom)&&!empty($prenom)&&!empty($password)&&!empty($email)&&!empty($telephone)&&!empty($numen)&&!empty($identifiant)&&!empty($password)&&!empty($confirm_password)){
if ("$password" == "$confirm_password") {

// Verification du Numen
require ('./ConnectionMySQL.php') ;

$connection = getConnection();
$sql_fk_id = "SELECT Numen FROM enseignants WHERE Numen= ?";
$fk_id_verif = $connection->prepare($sql_fk_id);
$fk_id_verif->bindParam(1, $numen, PDO::PARAM_STR);
$fk_id_verif->execute();
$resultat_fk_id = $fk_id_verif->fetchAll();

$erreur_ens = true;
if ($resultat_fk_id != NULL){
    $erreur_ens = false;
}

if($erreur_ens == false){

// Verification si il a pas 2 compts

$sql_id = "SELECT identifiant FROM comptes WHERE identifiant= ?";
$identifiant_verif = $connection->prepare($sql_id);
$identifiant_verif->bindParam(1, $identifiant, PDO::PARAM_STR);
$identifiant_verif->execute();
$resultat = $identifiant_verif->fetchAll();

$erreur = true;
if ($resultat == NULL){
    $erreur = false;
}

//Récupéretion de id enseignant
$sql_id_ens = "SELECT ID_ENSEIGNANT FROM enseignants WHERE Numen= ?";
$id_ens = $connection->prepare($sql_id_ens);
$id_ens->bindParam(1, $numen, PDO::PARAM_STR);
$id_ens->execute();
$id_enseignant = $id_ens->fetchAll();

$fk_id_enseignant = $id_enseignant[0]["ID_ENSEIGNANT"];

if ($erreur === false) {
    $hashDuMotDePasse = password_hash($password, PASSWORD_DEFAULT);

    $statement = $connection->prepare("INSERT INTO COMPTES(fk_id_enseignant,nom,prenom,email,telephone,Numen,identifiant,MotDePasse) VALUES(:fk_id_enseignant,:nom,:prenom,:email,:telephone,:numen,:identifiant,:motdepasse)");
    // echo($nom, $prenom, $email, $telephone, $utilisateur, $password);
    $statement->bindParam(':fk_id_enseignant', $fk_id_enseignant, PDO::PARAM_STR);
    $statement->bindParam(':nom', $nom, PDO::PARAM_STR);
    $statement->bindParam(':prenom', $prenom, PDO::PARAM_STR);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->bindParam(':telephone', $telephone, PDO::PARAM_STR);
    $statement->bindParam(':numen', $numen, PDO::PARAM_STR);
    $statement->bindParam(':identifiant', $identifiant, PDO::PARAM_STR);
    $statement->bindParam(':motdepasse', $hashDuMotDePasse, PDO::PARAM_STR);
    // echo ("<br>$statement");
    // echo ("$nom, $prenom, $email, $telephone, $username, $hashDuMotDePasse");
    //     print_r($statement);
    $statement->execute() ;
    // $connection->query($statement);

    echo '<table>';
    echo '<tr>';
    echo '<td>Compte créé</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td><a href="#" >Clique ici pour revenir à ...</a></td>';
    echo '</tr>';
    echo '</table>';

} else  {
    echo '<table>';
    echo '<tr>';
    echo '<td>Vous avez déja un compte</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td><a href="#" >Clique ici pour revenir à ...</a></td>';
    echo '</tr>';
    echo '</table>';
}

}else{
    echo '<table>';
    echo '<tr>';
    echo '<td>';
    echo "vous n'êtes pas enseignant";
    echo'</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td><a href="#" >Clique ici pour revenir à ...</a></td>';
    echo '</tr>';
    echo '</table>';
}
} else {
    echo '<table>';
    echo '<tr>';
    echo '<td>Ton mots de passe est incorrect</td>';
    echo '</tr>';
    echo '</table>';
    header('Location: Module_enregistrement.html');    
    exit();
}
    } else {
    $code_err = 862;
    header("Location: Module_enregistrement.html?erreur=$code_err");    
    exit();
    }
?>