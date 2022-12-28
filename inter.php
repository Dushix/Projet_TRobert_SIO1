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
            <td>
                    <select name='option'>";
            foreach ($info_classe as $key => $value) {
                foreach ($value as $sous_key => $sous_value) {
                    if($sous_key == "Nom_classe"){
                        $Nom_cl = $sous_value;
                      }
                }
                echo "<option id='$Nom_cl'>$Nom_cl</option>";
    
            }
            echo "
            </td>
                    </select>";
            // $sql_lignes = 'SELECT COUNT(*) AS "lignes" FROM eleves';
            // $nombre_lignes = $connection->prepare($sql_lignes);
            // $nombre_lignes->execute();
            // $nombre_lignes = $nombre_lignes->fetchAll();
            // $nom_lign = $nombre_lignes[0]["lignes"];
        } else{
            echo "non";
        }
    } else {
        echo '<h1>Le site est en cour de maintenance, merci de revenir en arriére</h1>';
    }
} else {
    echo '<script type="text/javascript">alert("Vous devez remplir tous les champs"); </script>';
}
?>