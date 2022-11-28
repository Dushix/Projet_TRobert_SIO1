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
    if ($key==="numen") {
        $numen = $value;
        // echo " $value";
    }
    if ($key==="identifiant") {
        $identifiant= $value;
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
    $statement = $connection->prepare("INSERT INTO COMPTES(nom,prenom,email,telephone,Numen,identifiant,MotDePasse) VALUES(:nom,:prenom,:email,:telephone,:numen,:identifiant,:motdepasse)");
    // echo ("$statement");                                 VALUES('$nom', '$prenom', '$email', '$telephone', '$username', '$password');";
    $statement->bindParam(':nom', $nom, PDO::PARAM_STR);
    $statement->bindParam(':prenom', $prenom, PDO::PARAM_STR);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->bindParam(':telephone', $telephone, PDO::PARAM_STR);
    $statement->bindParam(':numen', $numen, PDO::PARAM_STR);
    $statement->bindParam(':identifiant', $identifiant, PDO::PARAM_STR);
    $statement->bindParam(':motdepasse', $hashDuMotDePasse, PDO::PARAM_STR);
    // echo ("<br>$statement");
    // echo ("$nom, $prenom, $email, $telephone, $username, $hashDuMotDePasse");
    // print_r($statement);
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

// var_dump($not);
// foreach ($not as $key1 => $value1) {
//     foreach ($value1 as $key2 => $value2) {
//         if ($key2 === "note"){
//             echo "<br> Note $key1 est de $value2 / 20";
//         }
//     }
// }

?>