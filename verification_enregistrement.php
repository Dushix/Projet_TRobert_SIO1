<?php
foreach ($_POST as $key => $value) {
    if ($key==="nom") {
            $nom = $value;
            // echo " $value";
    }
    if ($key==="prenom") {
        $prenom = $value;
        //echo " $prenom";
    }
    if ($key==="email") {
        $email = $value;
        // echo " $value";
    }
    if ($key==="telephone") {
        $telephone = $value;
        // echo " $value";
    }
    if ($key==="username") {
        $username= $value;
        // echo " $value";
    }
    if ($key==="password") {
        $password = $value;
        // echo " $value";
    }
    if ($key==="confirm_password") {
        $confirm_password = $value;
        // echo " $value";
    }
}
if ("$password" == "$confirm_password") {

// Verification
require ('./ConnectionMySQL.php') ;
$vfsql = "SELECT email FROM prof";
$connection = getConnection();
$verif = $connection->query($vfsql);
$prof = $verif->fetchall();


$erreur = false;
foreach ($prof as $key1 => $value1) {
    foreach ($value1 as $key2 => $value2) {
        if ($key2 === "email"){
            if ($value2 === $email) {
                $erreur = true;
                break;
            }
        }
    }
    if ($erreur === true) {
        break;
    }
}
if ($erreur === false) {
    $hashDuMotDePasse = password_hash($password, PASSWORD_DEFAULT);

    $connection = getConnection();
    $statement = $connection->prepare("INSERT INTO COMPTES(nom,prenom,email,telephone,identifiant,MotDePasse) VALUES(:nom,:prenom,:email,:telephone,:identifiant,:MotDePasse");
    // echo ("$statement");                                 VALUES('$nom', '$prenom', '$email', '$telephone', '$username', '$password');";
    $statement->bindParam(':nom', $nom, PDO::PARAM_STR);
    $statement->bindParam(':prenom', $prenom, PDO::PARAM_STR);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->bindParam(':telephone', $telephone, PDO::PARAM_STR);
    $statement->bindParam(':identifiant', $username, PDO::PARAM_STR);
    $statement->bindParam(':MotDePasse', $hashDuMotDePasse, PDO::PARAM_STR);
    // echo ("<br>$statement");
    $connection->query($statement);

    echo '<table>';
    echo '<tr>';
    echo '<td>Compte créé</td>';
    echo '</tr></table>';
    echo '</table>';

} else  {
    echo '<table>';
    echo '<tr>';
    echo '<td>Tu as déja un compte</td>';
    echo '</tr>';
    echo '</table>';
}

} else {
    echo '<table>';
    echo '<tr>';
    echo '<td>Ton mots de passe est incorrect</td>';
    echo '</tr>';
    echo '</table>';
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