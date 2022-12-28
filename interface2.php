<?php
require ('./ConnectionMySQL.php') ;
$connection = getConnection();


$sql_eleves = "SELECT c.Annee_scolaire_1, c.Annee_scolaire_2, l.code_bts, o.code_option, e.ID_ELEVE, e.nom_eleve, e.prenom_eleve, e.N_Candidat FROM classes c INNER JOIN liste_des_bts l ON c.fk_ID_BTS = l.ID_BTS JOIN eleves e ON e.fk_ID_classe=c.ID_Classe JOIN options_bts o ON e.fk_ID_OPTION = o.ID_OPTION WHERE code_bts='SIO' and c.Nom_classe='SIO2'";
$info_eleves = $connection->prepare($sql_eleves);
$info_eleves->execute();
$info_eleves = $info_eleves->fetchAll();


// $sql_lignes = 'SELECT COUNT(*) AS "lignes" FROM eleves';
// $nombre_lignes = $connection->prepare($sql_lignes);
// $nombre_lignes->execute();
// $nombre_lignes = $nombre_lignes->fetchAll();
// $nom_lign = $nombre_lignes[0]["lignes"];
?>

<html>
    <head>
       <meta charset="utf-8">
        <link rel="stylesheet" href="note.css" media="screen" type="text/css" />
        <title>Note CCF</title>
        <script>
                            var bts = document.querySelector('select[name="bts"]')
                  var option = document.querySelector('select[name="option"]')
        </script>
    </head>
    <body>
        <div>
          <h1>Saisie de Notes CCF</h1>
            <table>
                <tr>
                <th>Année scolaire</th>
                <th>BTS</th>
                <th>Option</th>
                <th>Elèves</th>
                <th>Libelle CCF</th>
                <th>Candidat</th>
                <th>Date examin</th>
                <th>Durée de l’épreuve</th>
                <th>Heure de convocation</th>
                <th>Professeur</th>
                <th>Numen</th>
                <th>Intervenant</th>
                <th>Note obtenue</th>
                <th>COEFF</th>
                <th>Commentaire</th>
                </tr>
                <!-- 14 -->
                <?php 
                foreach ($info_eleves as $key => $value) {
                  foreach ($value as $sous_key => $sous_value) {
                    if($sous_key == "Annee_scolaire_1"){
                      $ann1 = $sous_value;
                    }
                    if($sous_key == "Annee_scolaire_2"){
                      $ann2 = $sous_value;
                    }
                    if($sous_key == "code_bts"){
                      $bts = $sous_value ;
                    }
                    if($sous_key == "code_option"){
                      $option = $sous_value ;
                    }
                    if($sous_key == "ID_ELEVE"){
                      $id_eleve = $sous_value;
                    }
                    if($sous_key == "nom_eleve"){
                      $nom_eleve = $sous_value;
                    }
                    if($sous_key == "prenom_eleve"){
                      $prenom_eleve = $sous_value;
                    }
                    if($sous_key == "N_Candidat"){
                      $N_Candi = $sous_value;
                    }
                  }
                  echo "<tr name='eleve_n$id_eleve'>";
                  echo "<td>$ann1-$ann2</td>";// Année scolaire
                  echo "<td>$bts</td>";// BTS
                  echo "<td>$option</td>";// Option
                  echo "<td><b>$nom_eleve</b> $prenom_eleve</td>";// Elèves
                  echo "<td></td>";// CCF
                  echo "<td>$N_Candi</td>";// Candidat
                  echo "<td></td>";// Date examin
                  echo "<td></td>";// Durée de l’épreuve
                  echo "<td></td>";// Heure de convocation
                  echo "<td></td>";// Professeur
                  echo "<td></td>";// Numen
                  echo "<td></td>";// Intervenant
                  echo "<td></td>";// Note obtenue
                  echo "<td></td>";// COEFF
                  echo "<td></td>";// Commentaire
                  echo '</tr>';
              }
                ?>

            </table>
        </div>
    </body>
</html>
