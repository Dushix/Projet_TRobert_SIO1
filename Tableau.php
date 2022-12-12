<!-- PHP code to establish connection with the localserver -->
<?php
 
// Username is root
$user = 'root';
$password = '';
 
// Database name is geeksforgeeks
$database = 'bkridbis';
 
// Server is localhost with
// port number 3306
$servername='localhost:3306';
$mysqli = new mysqli($servername, $user,
                $password, $database);
 
// Checking for connections
if ($mysqli->connect_error) {
    die('Connect Error (' .
    $mysqli->connect_errno . ') '.
    $mysqli->connect_error);
}
 
// SQL query to select data from database
$sql = "SELECT e.nom_eleve,e.prenom_eleve,lb.code_bts,lb.code_option FROM eleve e
INNER JOIN liste_des_bts lb
ON e.fk_ID_OPTION = lb.ID_BTS";
$result = $mysqli->query($sql);
$mysqli->close();
?>
<!-- HTML code to display data in tabular format -->
<!DOCTYPE html>
<html lang="en">
    <header>
        <link rel="stylesheet" href="./tableau.css">
        <script type="text/javascript" src="Tableau.js"></script>
    </header>
 
<head>
    <meta charset="UTF-8">
    <title>Tableau</title>
    <!-- CSS FOR STYLING THE PAGE -->


    <form>
        <div>
            <label for="country">Veuillez choisir votre pays :</label>
            <select id="country" name="country">
            <option>Royaume-Uni</option>
            <option selected>États-Unis</option>
            <option>Allemagne</option>
            </select>
        </div>
        <div>
            <p>Veuillez saisir vos numéros de téléphone : </p>
            <span class="areaDiv">
            <input id="areaNo" name="areaNo" type="tel" required
                    placeholder="Code régional" pattern="[0-9]{3}"
                    aria-label="Code régional">
            <span class="validity"></span>
            </span>
            <span class="number1Div">
            <input id="number1" name="number1" type="tel" required
                    placeholder="Premier fragment" pattern="[0-9]{3}"
                    aria-label="Premier fragment du numéro">
            <span class="validity"></span>
            </span>
            <span class="number2Div">
            <input id="number2" name="number2" type="tel" required
                    placeholder="Second fragment" pattern="[0-9]{4}"
                    aria-label="Second fragment du numéro">
            <span class="validity"></span>
            </span>
        </div>
        <div>
            <button>Envoyer</button>
        </div>
    </form>


</head>
 
<body>
    <section>
        <h1>Tableau</h1>
        <!-- TABLE CONSTRUCTION -->
        <table>
            <tr>
                <th>Nom</th>
                <th>Prenom</th>
                <th>BTS</th>
                <th>Option</th>
            </tr>
            <!-- PHP CODE TO FETCH DATA FROM ROWS -->
            <?php
                // LOOP TILL END OF DATA
                while($rows=$result->fetch_assoc())
                {
            ?>
            <tr>
                <!-- FETCHING DATA FROM EACH
                    ROW OF EVERY COLUMN -->
                <td><?php echo $rows['nom_eleve'];?></td>
                <td><?php echo $rows['prenom_eleve'];?></td>
                <td><?php echo $rows['code_bts'];?></td>
                <td><?php echo $rows['code_option'];?></td>
            </tr>
            <?php
                }
            ?>
        </table>
    </section>
</body>
 
</html>