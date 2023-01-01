<?php 
session_start();
if ( isset($_SESSION['identifiant']) && isset($_SESSION['hashDuMotDePasse'])){
  $identifiant = (isset($_SESSION['identifiant'])) ? $_SESSION['identifiant'] : null;
  $hashDuMotDePasse = (isset($_SESSION['hashDuMotDePasse'])) ? $_SESSION['hashDuMotDePasse'] : null;
}

$resultat = "";
if(!empty($identifiant)&&!empty($hashDuMotDePasse)){
require ('../ConnectionMySQL.php') ;
$sql = "SELECT c.id_compte FROM comptes c WHERE c.identifiant= :identifiant AND  c.MotDePasse= :hashDuMotDePasse";
$connection = getConnection();
$instructions = $connection->prepare($sql);
$instructions->bindParam(':identifiant', $identifiant, PDO::PARAM_STR);
$instructions->bindParam(':hashDuMotDePasse', $hashDuMotDePasse, PDO::PARAM_STR);
$instructions->execute();
$resultat = $instructions->fetchAll() ;
}

if($resultat == NULL || $resultat == ""){
  session_destroy();
  echo '<body><table>';
    echo '<tr>';
    echo '<td>';
    echo "Les brigands cherchant à accéder à des ressources protégées";
    echo'</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td>';
    echo "<br>Ces informations suivantes ont été enregistrée, et pourront étre utilisé contre vous si vous recommencer !!!";
    echo'</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td>';
    echo '-Adresse IP.<br>
    -Adresse Mac.<br>
    -Localisation.<br>
    -Nom de votre Machine.<br>
    -Marque de la Machine.<br>
    -Nom de Session.';
    echo '</td>';
    echo '</tr>';
    echo '</table></body>';
} else {
  $erreur = '';
  if (isset($_GET['erreur'])){
        $erreur = (isset($_GET['erreur'])) ? $_GET['erreur'] : null;
    } if(empty($erreur)){
        if("$erreur"=="0"){
            echo '<script type="text/javascript">alert("Modification sauvegardé avec Succès"); </script>';
        }
    }


echo "
<html>
    <head>
       <meta charset='utf-8'>
        <link rel='stylesheet' href='interface0b.css' media='screen' type='text/css' />
        <title>Accueil enseignant</title>
    </head>
    <body>
    <form name='Formulaire' action='Saisie_Notes.php' method='post'>
        <div>
          <td> 
          <label name='bts_classe'>Quelle BTS voulez vous voir : </label>
          <br>
            <select name='bts_classe'>
              <option id='0'>--Choisissez le BTS--</option>
              <option id='SIO'>SIO</option>
              <option id='CI'>CI</option>
              <option id='COM'>COM</option>
              <option id='CG'>CG</option>
              <option id='NDRC'>NDRC</option>
              <option id='PI'>PI</option>
              <option id='SAM'>SAM</option>
              <option id='TOU'>TOU</option>
            </select>
            <br>
          </td>
          <td>
          <label name='option_classe'>Dans quelle option : </label>
          <br>
            <select name='option_classe'>
              <option id='0'>--Choisissez l'option-</option>
              <option id='SLAM'>SLAM</option>
              <option id='SISR'>SISR</option>
              <option id='les2'>Les 2 options</option>
            </select>
            <br>
          </td>
          <td>
          <label name='CCF_classe'>Pour quelle Épreuve : </label>
          <br>
            <select name='CCF_classe'>
              <option id='0'>--Choisissez l'épreuve--</option>
              <option id='E4'>E4</option>
              <option id='E5SISR'>E5SISR</option>
              <option id='E5SLAM'>E5SLAM</option>
            </select>
            <br>
          </td>
          <td><input type='submit' name='soumettre' value='OK'/></td>

          <script>
                  var doc_bts_cl = document.querySelector('select[name=bts_classe]')
                  var doc_labelop_cl = document.querySelector('label[name=option_classe]')
                  var doc_option_cl = document.querySelector('select[name=option_classe]')

                  var doc_labelep_cl = document.querySelector('label[name=CCF_classe]')
                  var doc_CCF_cl = document.querySelector('select[name=CCF_classe]')

                  doc_bts_cl.onchange = function()
                  {
                    if(doc_bts_cl.value == 'SIO'){
                      doc_option_cl.style.display = '';
                      doc_labelop_cl.style.display = '';

                      doc_CCF_cl.style.display = '';
                      doc_labelep_cl.style.display = '';

                    } else {
                      doc_option_cl[0].selected = true;
                      doc_option_cl.value = 'rien';
                      doc_option_cl.style.display = 'none';
                      doc_labelop_cl.style.display = 'none';

                      doc_CCF_cl[0].selected = true;
                      doc_CCF_cl.value = 'rien';
                      doc_CCF_cl.style.display = 'none';
                      doc_labelep_cl.style.display = 'none';
                    }
                  }
                  doc_option_cl.onchange = function(){
                        if(doc_option_cl.options.SLAM.selected){
                          doc_CCF_cl.options[0].selected = true;
                          doc_CCF_cl.options.E5SISR.style.display = 'none';
                          doc_CCF_cl.options.E5SLAM.style.display = '';

                        }else if(doc_option_cl.options.SISR.selected){
                          doc_CCF_cl.options.E5SISR.style.display = '';
                          doc_CCF_cl.options[0].selected = true;
                          doc_CCF_cl.options.E5SLAM.style.display = 'none';
                        } else {
                          doc_CCF_cl.options.E5SISR.style.display = 'none';
                          doc_CCF_cl.options[0].selected = true;
                          doc_CCF_cl.options.E5SLAM.style.display = 'none';
                        }
                      }
            </script>

        </div>
      </from>
    </body>
</html>";
}
?>
