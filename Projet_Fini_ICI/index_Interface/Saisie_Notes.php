<?php
if (isset($_POST['soumettre'])){
  $bts_classe = (isset($_POST['bts_classe'])) ? $_POST['bts_classe'] : null;
  $option_classe = (isset($_POST['option_classe'])) ? $_POST['option_classe'] : null;
  $CCF_classe = (isset($_POST['CCF_classe'])) ? $_POST['CCF_classe'] : null;
}
if(!empty($bts_classe)){
  $tabl_bts = [
      'SIO',
      'CI',
      'COM',
      'CG',
      'NDRC',
      'PI',
      'SAM',
      'TOU'
  ];
  $err_bts = true;

  if(!empty($option_classe)&&!empty($CCF_classe)){


      $tabl_option = [
          'SLAM',
          'SISR',
          'Les 2 options'
      ];
      $err_option = true;
  
      $tabl_CCF = [
          'E4',
          'E5SISR',
          'E5SLAM'
      ];
      $err_CCF = true;
  
      foreach($tabl_bts as $tbts){
          if($tbts === $bts_classe){
              $err_bts = false;
          }
      }
  
      foreach($tabl_option as $toption){
          if($toption === $option_classe){
              $err_option = false;
          }
      }
  
      foreach($tabl_CCF as $tCCF){
          if($tCCF === $CCF_classe){
              $err_CCF = false;
          }
      }
  
      if($err_bts == false && $err_option == false && $err_CCF == false){

          require ('./ConnectionMySQL.php') ;
          $connection = getConnection();

          $sql_prof= "SELECT e.ID_ENSEIGNANT, e.Nom_enseignant FROM enseignants e";
          $info_prof = $connection->prepare($sql_prof);
          $info_prof->execute();
          $info_prof = $info_prof->fetchAll();

          $sql_ccf= "SELECT lc.ID_CCF, lc.coefficient FROM liste_epreuves_ccf lc WHERE lc.code_ccf= ? ";
          $info_ccf = $connection->prepare($sql_ccf);
          $info_ccf->bindParam(1, $CCF_classe, PDO::PARAM_STR);
          $info_ccf->execute();
          $info_ccf = $info_ccf->fetchAll();

          $id_ccf = $info_ccf[0]["ID_CCF"];
          $coefficient = $info_ccf[0]["coefficient"];

          $sql_eleves = "SELECT c.Annee_scolaire_1, c.Annee_scolaire_2, l.code_bts, o.code_option, e.ID_ELEVE, e.nom_eleve, e.prenom_eleve, e.N_Candidat, nt.ID_NOTE, nt.NOTE, nt.DATE_EVAL, nt.DUREE_EVAL, nt.HEURE_EVAL, t.Nom_enseignant, nt.Nom_Intervenant, nt.Commentaire 
          FROM classes c INNER JOIN liste_des_bts l ON c.fk_ID_BTS = l.ID_BTS 
          JOIN eleves e ON e.fk_ID_classe=c.ID_Classe 
          JOIN notes_ccf nt ON nt.fk_ID_ELEVE=e.ID_ELEVE 
          JOIN enseignants t ON t.ID_ENSEIGNANT=nt.fk_ID_ENSEIGNANT 
          JOIN options_bts o ON e.fk_ID_OPTION = o.ID_OPTION  
          JOIN liste_epreuves_ccf li ON nt.fk_ID_CCF= li.ID_CCF
          WHERE code_bts= :bts_classe AND li.code_ccf= :CCF_classe ORDER BY e.ID_ELEVE";
          $info_eleves = $connection->prepare($sql_eleves);
          $info_eleves->bindParam(':bts_classe', $bts_classe, PDO::PARAM_STR);
          $info_eleves->bindParam(':CCF_classe', $CCF_classe, PDO::PARAM_STR);
          $info_eleves->execute();
          $info_eleves = $info_eleves->fetchAll();

          $cible_op= true;
          if($option_classe === "Les 2 options"){
            $cible_op= false;
          }



echo "
<html>
    <head>
       <meta charset='utf-8'>
        <link rel='stylesheet' href='Saisie_Notes.css' media='screen' type='text/css' />
        <title>Saisie des Notes</title>
    </head>
    <body>

        <div>
          <h1>Saisie de Notes CCF</h1>
            <table class=container>
                <thead>
                <tr>
                <th>Année scolaire</th>
                <th>BTS</th>
                <th>Option</th>
                <th>Elèves</th>
                <th>Libelle CCF</th>
                <th>Candidat</th>
                <th>Date examen</th>
                <th>Durée de l’épreuve</th>
                <th>Heure de convocation</th>
                <th>Professeur</th>
                <th>Intervenant</th>
                <th>Note obtenue</th>
                <th>COEFF</th>
                <th>Commentaire</th>
                </thead>
                </tr>";

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
                    if($sous_key == "ID_NOTE"){
                      $ID_NOTE = $sous_value;
                    }
                    if($sous_key == "NOTE"){
                      $NOTE = $sous_value;
                    }
                    if($sous_key == "DATE_EVAL"){
                      $DATE_EVAL = $sous_value;
                    }
                    if($sous_key == "HEURE_EVAL"){
                      $HEURE_EVAL = $sous_value;
                    }
                    if($sous_key == "DUREE_EVAL"){
                      $DUREE_EVAL = $sous_value;
                    }
                    if($sous_key == "Nom_enseignant"){
                      $Nom_enseignant = $sous_value;
                    }
                    if($sous_key == "Nom_Intervenant"){
                      $Nom_Intervenant = $sous_value;
                    }
                    if($sous_key == "Commentaire"){
                      $Commentaire = $sous_value;
                    }
                  }

                  echo "<form name='Formulaire_$id_eleve' action='Ajout _Notes.php' method='post'>";
                  echo "<tr>";
                  echo "<div name='eleve_n$id_eleve'>";
                  echo "<td>$ann1-$ann2</td>";// Année scolaire
                  echo "<td>$bts</td>";// BTS
                  echo "<td>$option</td>";// Option
                  echo "<td><b>$nom_eleve</b> $prenom_eleve</td>";// Elèves
                  echo "<td>$CCF_classe</td>";// CCF
                  echo "<td><input name='Candidat$id_eleve' type='text' value='$N_Candi'></td>";// Candidat
                  echo "<td><input name='DATE$id_eleve' min='$ann1-01-01' max='$ann2-12-31' type='date' value='$DATE_EVAL'></td>";// Date examin
                  echo "<td><input name='DUREE$id_eleve' type='time' value='$DUREE_EVAL'></td></td>";// Durée de l’épreuve
                  echo "<td><input name='HEURE$id_eleve' type='time' value='$HEURE_EVAL'></td>";// Heure de convocation
                  echo "<td><select id='eleve$id_eleve' name='prof$id_eleve'>";
                  foreach ($info_prof as $key => $value) {
                      foreach ($value as $sous_key => $sous_value) {
                          if($sous_key == "Nom_enseignant"){
                              $Nom_bdd_enseignant = $sous_value;
                            }
                            if($sous_key == "ID_ENSEIGNANT"){
                              $ID_bdd_ENSEIGNANT = $sous_value;
                            }
                        }
                  echo "<option id='$ID_bdd_ENSEIGNANT'>$Nom_bdd_enseignant</option>";
                  }
                  echo "</select></td>";// Professeur
                  echo "<td><input type='text'  name='Intervenant$id_eleve' value='$Nom_Intervenant'></td>";// Intervenant
                  echo "<td><input value='$NOTE' type='number' name='Note$id_eleve' placeholder='Note' step='0.01' min='0' max='20'></td>";// Note obtenue
                  echo "<td>$coefficient</td>";// COEFF
                  echo "<td><textarea name='Commentaire$id_eleve' placeholder='Sans Commentaire' cols='30' rows='5' minlength='3' maxlength='500' spellcheck>$Commentaire</textarea></td>";// Commentaire
                  echo "<input type='hidden' name='option' value='$option_classe'>";
                  echo "<input type='hidden' name='CCF' value='$CCF_classe'>";
                  echo "<td><input class='submit' type='submit' name='soumettre' value='envoyer'></td>";
                  echo '</tr>';
                  echo "</div>";
                  echo "</from>";


                  //JavaS
                  $doc = "document.querySelector('select#eleve$id_eleve')";
                  echo "<script type='text/javascript'>
                  var doc_sel$id_eleve = $doc;
                  doc_sel$id_eleve.value = '$Nom_enseignant'
                  </script>";

                 
            }
              echo "</table></div></body></html>";
      } else{
          echo "non";
      }
  } else {
      echo '<h1>Le site est en cour de maintenance, merci de revenir en arriére</h1>';
  }
} else {
  echo '<script type="text/javascript">alert("Vous devez remplir tous les champs"); </script>';
}
