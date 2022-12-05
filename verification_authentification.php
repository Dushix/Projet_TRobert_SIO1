<?php
foreach ($_POST as $key => $value) {
    if ($key==="nom") {
            $nom = $value;
    }
    if ($key==="password") {
        $password = $value;
    }
}

// Verification de l email
require ('./ConnectionMySQL.php') ;
$sql = "SELECT email FROM prof";
$connection = getConnection();
$verif = $connection->query($sql);
$verif_email = $verif->fetchall();

$err_email = true;
foreach ($verif_email as $key1 => $value1) {
    foreach ($value1 as $key2 => $value2) {
        if ($key2 == "email"){
            if ($value2 == $nom) {
                $err_email = false;
            }
        }
    }
}

// recuperation du mots de passe
if ( $err_email == false) {

    $sql = "SELECT MotdePasse FROM prof WHERE email = '$nom'";
    $connection = getConnection();
    $verif = $connection->query($sql);
    $verif_pasword = $verif->fetchall();

    $hashDuMotDePasse = password_hash($password, PASSWORD_DEFAULT);
    $err_pasword = true;
    foreach ( $verif_pasword as $key => $value) {
        foreach ( $value as $key2 => $value2) {
            if ($key2 == "MotdePasse") {
                if (password_verify($value2) == $hashDuMotDePasse) {
                    $err_pasword = false;
                }
            }
        }
    }

    if ( $err_pasword == false) {

            echo("C'est Bon");

        } else {
            echo '<table>';
            echo '<tr>';
            echo '<td>email ou mots de passe incorrect</td>';
            echo '</tr>';
            echo '</table>';
        }

} else { 
    echo '<table>';
    echo '<tr>';
    echo '<td>email ou mots de passe incorrect</td>';
    echo '</tr>';
    echo '</table>';
}

// $sql = "SELECT MotdePasse FROM prof";
// $verif = $connection->query($sql);
// $verif_pasword = $verif->fetchall();

// $err_pasword = 1;
// foreach ($verif_pasword as $key1 => $value1) {
//     foreach ($value1 as $key2 => $value2) {
//         if ($key2 === "MotdePasse"){
//             if ($value2 === $password) {
//                 $err_pasword = 0;
//             }
//         }
//     }
// }
// if ($err_pasword == 0) {
//     echo "bien pw";
// } else { echo "NON pw";}


?>
