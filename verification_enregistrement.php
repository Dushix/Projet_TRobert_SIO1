<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="#">
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
$sql_fk_id = "SELECT * FROM enseignants e WHERE e.Numen= :numen AND e.Nom_enseignant= :Nom AND e.Prenom_enseignant= :Prenom";
$fk_id_verif = $connection->prepare($sql_fk_id);
$fk_id_verif->bindParam(':numen', $numen, PDO::PARAM_STR);
$fk_id_verif->bindParam(':Nom', $nom, PDO::PARAM_STR);
$fk_id_verif->bindParam(':Prenom', $prenom, PDO::PARAM_STR);
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
    $statement->bindParam(':fk_id_enseignant', $fk_id_enseignant, PDO::PARAM_STR);
    $statement->bindParam(':nom', $nom, PDO::PARAM_STR);
    $statement->bindParam(':prenom', $prenom, PDO::PARAM_STR);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->bindParam(':telephone', $telephone, PDO::PARAM_STR);
    $statement->bindParam(':numen', $numen, PDO::PARAM_STR);
    $statement->bindParam(':identifiant', $identifiant, PDO::PARAM_STR);
    $statement->bindParam(':motdepasse', $hashDuMotDePasse, PDO::PARAM_STR);
    $statement->execute() ;

    echo '<table>';
    echo '<tr>';
    echo '<td>Compte créé</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td><a href="Module_authentification.php" >Cliquez ici pour vous connecter.</a></td>';
    echo '</tr>';
    echo '</table>';

} else  {
    echo '<table>';
    echo '<tr>';
    echo '<td>Vous avez déja un compte</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td><a href="Module_authentification.php" >Cliquez ici pour vous connecter.</a></td>';
    echo '</tr>';
    echo '</table>';
}

}else{
    echo '<table>';
    echo '<tr>';
    echo '<td>';
    echo "Vous n'êtes pas enseignant";
    echo'</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td>';
    echo "<br>Ces informations suivantes ont été enregistrée, et pourront étre utilisé contre vous si vous recommencer !!!";
    echo'</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td>';
    echo '-Adresse IP.<br>
    -Adresse Mac.<br>
    -Localisation.<br>
    -Nom de votre Machine.<br>
    -Marque de la Machine.<br>
    -Nom de Session.';
    echo '</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td>';
    echo "<input type='button' value='+' />";
    echo'</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td>';
    echo "<p>Votre Nom, Prénom ou Numen est invalides<p>";
    echo'</td>';
    echo '</tr>';
    echo '</table>';
    echo "
    <script type='text/javascript'>
        var but = document.querySelector('[type=button]');
        var mess = document.querySelector('p');
        mess.style.display = 'none';

        but.addEventListener('click', testvf);
                        function testvf() {
                            mess.style.display = '';
                        }
    </script>";
}
} else {
    echo '<table>';
    echo '<tr>';
    echo '<td>Ton mot de passe est incorrect</td>';
    echo '</tr>';
    echo '</table>';
    $code_err = 762;
    header("Location: Module_enregistrement.php?erreur=$code_err");    
    exit();
}
    } else {
    print_r($_POST);
    // header("Location: Module_enregistrement.php?erreur=$code_err");    
    exit();
    }
?>