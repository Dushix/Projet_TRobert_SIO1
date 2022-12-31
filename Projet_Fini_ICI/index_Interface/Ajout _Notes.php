<?php
require ('./ConnectionMySQL.php') ;
$connection = getConnection();

if (isset($_POST['soumettre'])){
    $option = (isset($_POST['option'])) ? $_POST['option'] : null;
    $CCF = (isset($_POST["CCF"])) ? $_POST["CCF"] : null;
    $POST = $_POST;
 
}

if($option === "SISR" || $option === "SLAM"){
    $sql_option= "SELECT e.ID_ELEVE FROM eleves e INNER JOIN options_bts o ON o.ID_OPTION=e.fk_ID_OPTION WHERE o.code_option= ?";
    $info_option = $connection->prepare($sql_option);
    $info_option->bindParam(1, $option, PDO::PARAM_STR);
    $info_option->execute();
    $info_option = $info_option->fetchAll();

    } else {
    $sql_option= "SELECT e.ID_ELEVE FROM eleves e INNER JOIN options_bts o ON o.ID_OPTION=e.fk_ID_OPTION";
    $info_option = $connection->prepare($sql_option);
    $info_option->execute();
    $info_option = $info_option->fetchAll();

}


$sql_CCF= "SELECT ID_CCF FROM liste_epreuves_ccf l WHERE l.code_ccf= ? ";
$info_CCF = $connection->prepare($sql_CCF);
$info_CCF->bindParam(1, $CCF, PDO::PARAM_STR);
$info_CCF->execute();
$info_CCF = $info_CCF->fetchAll();

$id_CCF = $info_CCF[0]["ID_CCF"];

              
    foreach ($info_option as $key => $value) {
        foreach ($value as $sous_key => $sous_value) {
            if($sous_key == "ID_ELEVE"){
                $ID_ELEVE = $sous_value;
        }
    }
    if (isset($POST['soumettre'])){
        $Candidat = (isset($POST["Candidat$ID_ELEVE"])) ? $POST["Candidat$ID_ELEVE"] : null;
        $DATES = (isset($POST["DATE$ID_ELEVE"])) ? $POST["DATE$ID_ELEVE"] : null;
        $DUREE = (isset($POST["DUREE$ID_ELEVE"])) ? $POST["DUREE$ID_ELEVE"] : null;
        $HEURE = (isset($POST["HEURE$ID_ELEVE"])) ? $POST["HEURE$ID_ELEVE"] : null;
        $prof = (isset($POST["prof$ID_ELEVE"])) ? $POST["prof$ID_ELEVE"] : null;
        $Intervenant = (isset($POST["Intervenant$ID_ELEVE"])) ? $POST["Intervenant$ID_ELEVE"] : null;
        $Note = (isset($POST["Note$ID_ELEVE"])) ? $POST["Note$ID_ELEVE"] : null;
        $Commentaire = (isset($POST["Commentaire$ID_ELEVE"])) ? $POST["Commentaire$ID_ELEVE"] : null;
    
    }

    $sql_prof= "SELECT e.ID_ENSEIGNANT FROM enseignants e WHERE e.Nom_enseignant= ? ";
    $info_prof = $connection->prepare($sql_prof);
    $info_prof->bindParam(1, $prof, PDO::PARAM_STR);
    $info_prof->execute();
    $info_prof = $info_prof->fetchAll();

    $id_prof = $info_prof[0]["ID_ENSEIGNANT"];

    $sql_aj= "UPDATE notes_ccf n
    SET n.NOTE= :Note ,
    n.DATE_EVAL= :DATES ,
    n.DUREE_EVAL= :DUREE ,
    n.HEURE_EVAL= :HEURE ,
    n.fk_ID_ENSEIGNANT= :id_prof ,
    n.Nom_Intervenant= :Intervenant ,
    n.Commentaire= :Commentaire
    WHERE n.fk_ID_CCF= :id_CCF and n.fk_ID_ELEVE= :ID_ELEVE ";
    $info_aj = $connection->prepare($sql_aj);
    $info_aj->bindParam(':Note', $Note, PDO::PARAM_STR);
    $info_aj->bindParam(':DATES', $DATES, PDO::PARAM_STR);
    $info_aj->bindParam(':DUREE', $DUREE, PDO::PARAM_STR);

    $info_aj->bindParam(':HEURE', $HEURE, PDO::PARAM_STR);
    $info_aj->bindParam(':id_prof', $id_prof, PDO::PARAM_STR);
    $info_aj->bindParam(':Intervenant', $Intervenant, PDO::PARAM_STR);

    $info_aj->bindParam(':Commentaire', $Commentaire, PDO::PARAM_STR);
    $info_aj->bindParam(':id_CCF', $id_CCF, PDO::PARAM_STR);
    $info_aj->bindParam(':ID_ELEVE', $ID_ELEVE, PDO::PARAM_STR);

    $info_aj->execute();

    $sql_aj_CN= "UPDATE eleves e
    SET e.N_Candidat= :Candidat 
    WHERE e.ID_ELEVE= :ID_ELEVE ";
    $info_aj_CN = $connection->prepare($sql_aj_CN);
    $info_aj_CN->bindParam(':Candidat', $Candidat, PDO::PARAM_STR);
    $info_aj_CN->bindParam(':ID_ELEVE', $ID_ELEVE, PDO::PARAM_STR);
    $info_aj_CN->execute();

}

?>