<?php
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
    $code_err = 99;
    echo '<table>';
    echo '<tr>';
    echo '<td>identifiant ou mots de passe incorrect</td>';
    echo '</tr>';
    echo '</table>';
} else {

    $hashDuMotDePasse = $resultat[0]["motDePasse"];

}
$pass_verif = password_verify($password, $hashDuMotDePasse);

if ($pass_verif == true){
    echo '<table>';
    echo '<tr>';
    echo '<td>Le mot de passe est valide</td>';
    echo '</tr>';
    echo '</table>';
    $value8 ="$utilisateur";
    setcookie("TestCookie", $value, time()+3600)
    echo($_COOKIE["$utilisateur"];);
        } else {
            $code_err = 99;
            echo '<table>';
            echo '<tr>';
            echo '<td>identifiant ou mots de passe incorrect</td>';
            echo '</tr>';
            echo '</table>';
            }
    } 


else {
$code_err = 862;
echo '<script type="text/javascript">alert("Vous devez remplir tous les champs"); </script>';
}

?>
