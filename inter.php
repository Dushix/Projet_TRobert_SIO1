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