<?php
foreach ($_POST as $key => $value) {
    if ($key==="utilisateur") {
        $utilisateur = $value;
    }
    if ($key==="password") {
        $password = $value;
    }
}

// Verification de l utilisateur
require ('./ConnectionMySQL.php') ;
$sql = "select identifiant from comptes where identifiant= ?";
$connection = getConnection();
$verif = $connection->query($sql);
$verif->bindParam(1, $utilisateur, PDO::PARAM_STR);
$verif_id = $verif->fetchall();
print_r($verif_id);
$err_id = true;
// foreach ($verif_id as $key1 => $value1) {
//     foreach ($value1 as $key2 => $value2) {
//         if ($key2 == "email"){
//             if ($value2 == $nom) {
//                 $err_id = false;
//             }
//         }
//     }
// }

// recuperation du mots de passe
if ( $err_id == false) {

    $sql = "select identifiant, motDePasse from comptes where identifiant= ?";
    // ->bindParam(1, $utilisateur, PDO::PARAM_STR);
    $connection = getConnection();
    $verif = $connection->query($sql);
    $verif_pasword = $verif->fetchall();

    $hashDuMotDePasse = password_hash($password, PASSWORD_DEFAULT);
    print_r($verif_pasword);
    $err_pasword = true;
<<<<<<< HEAD
    // foreach ( $verif_pasword as $key => $value) {
    //     foreach ( $value as $sousKey => $sousValue) {
    //         if ($sousKey == "MotdePasse") {
    //             if (password_verify(string $sousValue, string $hashDuMotDePasse) == TRUE) {
    //                 $err_pasword = false;
    //             }
    //         }
    //     }
    // }
=======
    foreach ( $verif_pasword as $key => $value) {
        foreach ( $value as $sousKey => $sousValue) {
            if ($sousKey == "MotdePasse") {
                if (password_verify(string $sousValue, string $hashDuMotDePasse) == TRUE) {
                    $err_pasword = false;
                }
            }
        }
    }
>>>>>>> 41ad967ba86bd2045d0b35f603ba17af5412b9c5

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
