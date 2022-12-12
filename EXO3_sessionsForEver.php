<?php
session_start();
if ( isset($_SESSION['utilisateur']) && isset($_SESSION['estValide'])
&& $_SESSION['estValide'] == true )
{
echo "Je sais qui vous êtes Mr $_SESSION[utilisateur] <BR>";
echo "Rien ne m echappe <BR>";
echo "A l'intérieur de cette session vous avez le droit d'accès à cette page <BR>";
}
else {
echo "Les brigands cherchant à accéder à des ressources protégées <BR>";
echo "Seront sévèrement chatiés <BR>";
echo 'Soyez raisonnables et identifiez vous ! <a href="EXO2_FormulaireLoginSoluce.html"> Login </a>';
}

session_destroy();

?>