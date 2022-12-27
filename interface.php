<?php
require ('./ConnectionMySQL.php') ;
$connection = getConnection();


$sql_eleves = "SELECT ID_ELEVE, nom_eleve, prenom_eleve, code_bts, code_option FROM eleves INNER JOIN options_bts ON fk_ID_OPTION = ID_OPTION JOIN liste_des_bts ON fk_ID_BTS = ID_BTS";
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
                  echo '<tr>';
                  foreach ($value as $sous_key => $sous_value) {
                    if($sous_key == "ID_ELEVE"){
                      $id_eleve = $sous_value;
                    }
                    if($sous_key == "nom_eleve"){
                      $nom_eleve = $sous_value;
                    }
                    if($sous_key == "prenom_eleve"){
                      $prenom_eleve = $sous_value;
                    }
                    if($sous_key == "code_bts"){
                      $bts = $sous_value ;
                    }
                    if($sous_key == "code_option"){
                      $option = $sous_value ;
                    }
                  }
                  echo "<td></td>";// Année scolaire
                  echo "<td><select id='bts' name='bts_$id_eleve'>
                        <option id='SIO'>SIO</option>
                        <option id='CI'>CI</option>
                        <option id='COM'>COM</option>
                        <option id='CG'>CG</option>
                        <option id='NDRC'>NDRC</option>
                        <option id='PI'>PI</option>
                        <option id='SAM'>SAM</option>
                        <option id='TOU'>TOU</option>
                        </select></td>";// BTS

                  if($bts == "SIO"){
                    echo "<td>
                    <select name='option_$id_eleve'>
                    <option id='SLAM'>SLAM</option>
                    <option id='SISR'>SISR</option>
                    </select>
                    <input name='option_input_$id_eleve' style='display: none;'></td>";// Option
                  }else{
                    echo "<td></td>";// Option
                  }
                  echo "<td><b>$nom_eleve</b> $prenom_eleve</td>";// Elèves
                  echo "<td>
                  <select name='CCF_$id_eleve' multiple>
                  <option id='E4'>E4</option>
                  <option id='E5SISR'>E5SISR</option>
                  <option id='E5SLAM'>E5SLAM</option>
                  </select>
                  <input name='CCF_input_$id_eleve' style='display: none;'></td>";// CCF
                  echo "<td></td>";// Candidat
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


                  $nom_bts = "bts_$id_eleve";
                  $cible_bts = "name=$nom_bts";
                  $doc_bts = "document.querySelector('select[$cible_bts]')";

                  $nom_option = "option_$id_eleve";
                  $cible_option = "name=$nom_option";
                  $doc_option = "document.querySelector('select[$cible_option]')";

                  $nom_CCF = "CCF_$id_eleve";
                  $cible_CCF = "name=$nom_CCF";
                  $doc_CCF = "document.querySelector('select[$cible_CCF]')";

                  // input
                  $nom_input_option = "option_input_$id_eleve";
                  $cible_input_option = "name=$nom_input_option";
                  $doc_input_option = "document.querySelector('input[$cible_input_option]')";

                  $nom_input_CCF = "CCF_input_$id_eleve";
                  $cible_input_CCF = "name=$nom_input_CCF";
                  $doc_input_CCF = "document.querySelector('input[$cible_input_CCF]')";

                  echo "<script>
                  var doc_bts_n$id_eleve = $doc_bts
                  var doc_option_n$id_eleve = $doc_option
                  var doc_CCF_n$id_eleve = $doc_CCF
                  doc_input_option_n$id_eleve = $doc_input_option
                  doc_input_CCF_n$id_eleve = $doc_input_CCF

                  doc_bts_n$id_eleve.options.$bts.selected = true
                  doc_option_n$id_eleve.options.$option.selected = true

                  doc_bts_n$id_eleve.onchange = function()
                  {  
                    var select_n$id_eleve = doc_bts_n$id_eleve.options.selectedIndex

                    if(doc_bts_n$id_eleve.options[select_n$id_eleve].value == 'SIO'){
                      // input
                      doc_input_option_n$id_eleve.style.display = 'none';
                      doc_input_CCF_n$id_eleve.style.display = 'none';

                      doc_option_n$id_eleve.style.display = '';
                      doc_CCF_n$id_eleve.style.display = '';
                    } else{
                      // input
                      doc_input_option_n$id_eleve.style.display = '';
                      doc_input_CCF_n$id_eleve.style.display = '';

                      doc_option_n$id_eleve.style.display = 'none';
                      doc_CCF_n$id_eleve.style.display = 'none';
                    }
                  }
                  doc_option_n$id_eleve.onchange = function()
                  {  
                    var select_n$id_eleve = doc_option_n$id_eleve.options.selectedIndex

                    if(doc_option_n$id_eleve.options[select_n$id_eleve].value == 'SLAM'){
                      doc_CCF_n$id_eleve.options.E5SLAM.style.display = '';
                      doc_CCF_n$id_eleve.options.E5SISR.style.display = 'none';

                    } else{

                      doc_CCF_n$id_eleve.options.E5SLAM.style.display = 'none';
                      doc_CCF_n$id_eleve.options.E5SISR.style.display = '';
                    }
                  }
                  </script>";

              }
                ?>

            </table>
        </div>
    </body>
</html>
