<?php
echo session_save_path();
session_start();
if (isset($_POST['soumettre'])){
    $utilisateur = (isset($_POST['identifiant'])) ? $_POST['identifiant'] : null;
    $password = (isset($_POST['motDePasse'])) ? $_POST['motDePasse'] : null;
}

if(!empty($utilisateur)&&!empty($password)){

// Verification de l utilisateur
require ('./ConnectionMySQL.php') ;
$sql = "select identifiant, motDePasse from comptes where identifiant= :identifiant";
$connection = getConnection();
$instructions = $connection->prepare($sql);
$instructions->bindParam(':identifiant', $utilisateur, PDO::PARAM_STR);
$instructions->execute();
$resultat = $instructions->fetchAll() ;

$code_err = 0;
if ( $resultat == NULL) {
    session_destroy();
    $code_err = 99;
    echo '<table>';
    echo '<tr>';
    echo '<td>identifiant ou mots de passe incorrect</td>';
    echo '</tr>';
    echo '</table>';
    header('Location: ./Module_authentification.html'); 
} else {

    $hashDuMotDePasse = $resultat[0]["motDePasse"];

}
$pass_verif = password_verify($password, $hashDuMotDePasse);

if ($pass_verif == true){
    $_SESSION['identifiant'] = "$utilisateur";
    $_SESSION['hashDuMotDePasse'] = "$hashDuMotDePasse";
    echo '<table>';
    echo '<tr>';
    echo '<td>Le mot de passe est valide</td>';
    echo '</tr>';
    echo '</table>';
        } else {
            session_destroy();
            $code_err = 99;
            echo '<table>';
            echo '<tr>';
            echo '<td>identifiant ou mots de passe incorrect</td>';
            echo '</tr>';
            echo '</table>';
            header('Location: ./Module_authentification.html');  
            }
    } 


else {
session_destroy();
$code_err = 862;
echo '<script type="text/javascript">alert("Vous devez remplir tous les champs"); </script>';
header('Location: ./Module_authentification.html');
}

?>
