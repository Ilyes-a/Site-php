<html>
<head>
    <meta charset='utf-8'/>
    <META HTTP-EQUIV='Pragma' CONTENT='no-cache'/>
    <link rel='stylesheet' type='text/css' href='Style.css'/>
</head>
<body>
    <?php
    include("Entete.html");


    $connexion = mysqli_connect("10.34.1.75", "ndc2g1", "ABWabw#1", "ndc2g1");
    if (!$connexion) {
        die("Connexion impossible : " . mysqli_error(connexion));
    }
    $SQL = "SELECT AVG(nb) AS NbMoyenVehicule FROM Liste";
    $resultat = mysqli_query($connexion, $SQL);
    if (!$resultat) {
        die("Requete SQL invalide : " . mysqli_error($connexion));
    }

    // Récupération de la valeur de NbMoyenVehicule
    $ligneResultat = mysqli_fetch_assoc($resultat);
    $nbMoyenVehicule = $ligneResultat["NbMoyenVehicule"];
    ?>

    <div id='Contenu'>

    <p id='Titre'>Affichage du nombre moyen de voitures par employé. On ne tiendra pas compte des employés n’ayant pas le permis.</p>

    <p id='codeSQL'>
        <?php
        // Affichage de la requête SQL
        echo $SQL;
        ?>
    </p>

    <p id='moyenne'>
        <?php
        // Affichage de la moyenne
        echo "Nombre moyen de véhicules par employé : " . $nbMoyenVehicule;
        ?>
    </p>

    </div>
    <?php
    include("Piedpage.html");

    mysqli_close($connexion);
    ?>
</body>
</html>
