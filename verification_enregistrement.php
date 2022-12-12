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

// Verification
require ('./ConnectionMySQL.php') ;

$connection = getConnection();
$sql_id = "SELECT identifiant FROM comptes WHERE identifiant= ?";
$identifiant_verif = $connection->prepare($sql_id);
$identifiant_verif->bindParam(1, $identifiant, PDO::PARAM_STR);
$identifiant_verif->execute();
$resultat = $identifiant_verif->fetchAll();

$erreur = true;
if ($resultat == NULL){
    $erreur = false;
}



if ($erreur === false) {
    $hashDuMotDePasse = password_hash($password, PASSWORD_DEFAULT);

    $statement = $connection->prepare("INSERT INTO COMPTES(nom,prenom,email,telephone,Numen,identifiant,MotDePasse) VALUES(:nom,:prenom,:email,:telephone,:numen,:identifiant,:motdepasse)");
    // echo($nom, $prenom, $email, $telephone, $utilisateur, $password);
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
    echo '<td>Tu as déja un compte</td>';
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
    echo '<tr>';
    echo '<a href="Module_enregistrement.html?errCode=5" >Clique ici pour revenir à ...</a>';
    echo '</tr>';
    echo '</table>';
    echo '<script>var clk = document.querySelector("a");clk.click();</script>';
}
    } else {
    $code_err = 862;
    echo '<script type="text/javascript">alert("Vous devez remplir tous les champs"); </script>';
    }
// var_dump($not);
// foreach ($not as $key1 => $value1) {
//     foreach ($value1 as $key2 => $value2) {
//         if ($key2 === "note"){
//             echo "<br> Note $key1 est de $value2 / 20";
//         }
//     }
// }

?>