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
            echo "gg";
            require ('./ConnectionMySQL.php') ;
            $connection = getConnection();


            $sql_classe = "SELECT Nom_classe FROM classes INNER JOIN liste_des_bts  ON fk_ID_BTS = ID_BTS WHERE code_bts='$bts_classe'";
            $info_classe = $connection->prepare($sql_classe);
            $info_classe->execute();
            $info_classe = $info_classe->fetchAll();
            print_r($info_classe);

            echo "
            <td><select name='option'>";
            foreach ($info_classe as $key => $value) {
                foreach ($value as $sous_key => $sous_value) {
                    if($sous_key == "Nom_classe"){
                        $Nom_cl = $sous_value;
                      }
                }
                echo "<option id='$Nom_cl'>$Nom_cl</option>";
    
            }
            echo "</td>/select>";




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
                            <th>Ann??e scolaire</th>
                            <th>BTS</th>
                            <th>Option</th>
                            <th>El??ves</th>
                            <th>Libelle CCF</th>
                            <th>Candidat</th>
                            <th>Date examin</th>
                            <th>Dur??e de l?????preuve</th>
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
                              echo "<td></td>";// Ann??e scolaire
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
                              echo "<td><b>$nom_eleve</b> $prenom_eleve</td>";// El??ves
                              echo "<td>
                              <select name='CCF_$id_eleve' multiple>
                              <option id='E4'>E4</option>
                              <option id='E5SISR'>E5SISR</option>
                              <option id='E5SLAM'>E5SLAM</option>
                              </select>
                              <input name='CCF_input_$id_eleve' style='display: none;'></td>";// CCF
                              echo "<td></td>";// Candidat
                              echo "<td></td>";// Date examin
                              echo "<td></td>";// Dur??e de l?????preuve
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
            


                          <?php
        } else{
            echo "non";
        }
    } else {
        echo '<h1>Le site est en cour de maintenance, merci de revenir en arri??re</h1>';
    }
} else {
    echo '<script type="text/javascript">alert("Vous devez remplir tous les champs"); </script>';
}
?>