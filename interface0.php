<?php 
if (isset($_POST['soumettre'])){
    $bts_classe = (isset($_POST['bts_classe'])) ? $_POST['bts_classe'] : null;
}
$err_bts = true;
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
    foreach($tabl_bts as $tbts){
      if($tbts === $bts_classe){
          $err_bts = false;
      }
  }
} else
    
?>
    <html>
    <head>
       <meta charset="utf-8">
        <link rel="stylesheet" href="note.css" media="screen" type="text/css" />
        <title>Note CCF</title>
    </head>
    <body>
    <form name="Formulaire" action="interface2.php" method="post">
        <div>
        <form name="rep" action="interface0.php" method="post">
          <td> 
          <label name="bts_classe">Quelle BTS voulez vous voir : </label>
            <select name="bts_classe">
              <option id="0">--Choisissez le BTS--</option>
              <option id="SIO">SIO</option>
              <option id="CI">CI</option>
              <option id="COM">COM</option>
              <option id="CG">CG</option>
              <option id="NDRC">NDRC</option>
              <option id="PI">PI</option>
              <option id="SAM">SAM</option>
              <option id="TOU">TOU</option>
            </select>
          </td>
        </from>
          <?php

            if($err_bts == false){

              require ('./ConnectionMySQL.php') ;
              $connection = getConnection();
              $sql_classe = "SELECT Nom_classe FROM classes INNER JOIN liste_des_bts  ON fk_ID_BTS = ID_BTS WHERE code_bts='$bts_classe'";
              $info_classe = $connection->prepare($sql_classe);
              $info_classe->execute();
              $info_classe = $info_classe->fetchAll();

              print_r($info_classe);
            }
          ?>

          <td>
          <label name="option_classe">Dans quelle option : </label>
            <select name='option_classe'>
              <option id='0'>--Choisissez l'option-</option>
              <option id='SLAM'>SLAM</option>
              <option id='SISR'>SISR</option>
              <option id='les2'>Les 2 options</option>
            </select>
          </td>
          <td>
          <label name="CCF_classe">Pour quelle Épreuve : </label>
            <select name='CCF_classe'>
              <option id='0'>--Choisissez l'épreuve--</option>
              <option id='E4'>E4</option>
              <option id='E5SISR'>E5SISR</option>
              <option id='E5SLAM'>E5SLAM</option>
            </select>
          </td>
          <td><input type="submit" name="soumettre" value="OK"/></td>

          <script>
                  var doc_bts_cl = document.querySelector('select[name="bts_classe"]')
                  var doc_labelop_cl = document.querySelector('label[name="option_classe"]')
                  var doc_option_cl = document.querySelector('select[name="option_classe"]')

                  var doc_labelep_cl = document.querySelector('label[name="CCF_classe"]')
                  var doc_CCF_cl = document.querySelector('select[name="CCF_classe"]')

                  doc_bts_cl.onchange = function()
                  {
                    if(doc_bts_cl.value == 'SIO'){
                      doc_option_cl.style.display = '';
                      doc_labelop_cl.style.display = '';

                      doc_CCF_cl.style.display = '';
                      doc_labelep_cl.style.display = '';

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
                          doc_CCF_cl.options.E5SISR.style.display = '';
                          doc_CCF_cl.options.E5SLAM.style.display = ''
                        }
                      }
                      document.forms['rep'].submit();
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
            </script>

        </div>
      </from>
    </body>
</html>
