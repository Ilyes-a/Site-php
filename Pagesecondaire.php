<html>
<head>
	<meta charset='utf-8'/>
	<META HTTP-EQUIV='Pragma' CONTENT='no-cache'/>
	<link rel='stylesheet' type='text/css'href='Style.css'/>
</head>
<body>
	<?php
	include("Entete.html");
	?>

	<div id='Contenu'>

	<p id='Titre'>Affichage du nombre de véhicules dépassant les 50k€ ainsi que la liste détaillant ces derniers</p>

	<p id='codeSQL'>
		<?php
		$connexion =mysqli_connect("10.34.1.75","ndc2g1","ABWabw#1","ndc2g1");
		if (! $connexion)
		{
			die("Connexion impossible:".mysqli_error(connexion));
		}


		$SQL = "SELECT Véhicule.Prixht, Véhicule.Modèle, Employé.Nom, Véhicule.Numserie, COUNT(Véhicule.Numserie) AS nb 
        FROM Véhicule 
        INNER JOIN Employé ON Véhicule.Titulaire = Employé.Insee 
        WHERE Véhicule.Prixht > 50000
        GROUP BY Véhicule.Numserie";

		echo $SQL;
		mysqli_query($connexion,"SET NAMES UTF8");
        $resultat = mysqli_query($connexion,$SQL);
        if (! $resultat)

		{
			die("Requete SQL invalide :".mysqli_error($connexion));
		}


        $SQL_count = "SELECT COUNT(*) AS count FROM ($SQL) AS subquery";
        $resultat_count = mysqli_query($connexion, $SQL_count);
        if (!$resultat_count) {
            die("Requete SQL invalide :" . mysqli_error($connexion));
        }       

        $ligneResultat_count = mysqli_fetch_assoc($resultat_count);
        $count = $ligneResultat_count["count"];
		?>

	</p>
        <p id='nbVoitures'>Nombre de voitures dépassant 50k€ : <?php echo $count; ?></p>
	<table>
		<tr>
			<td class='titreTableau'>Modèle</td><td class='titreTableau'>Possesseur</td><td class='titreTableau'>Prix (en €)</td>
		</tr>
		<?php
		 while($ligneResultat = mysqli_fetch_assoc($resultat))
         {
              echo "<tr>";
              echo "<td>".$ligneResultat["Modèle"]."</td>";
              echo "<td>".$ligneResultat["Nom"]."</td>";
              echo "<td>".$ligneResultat["Prixht"]."</td>";
              echo "</tr>";

		}
		?>
	</table>
	<br/>
	<br/>
	</div>
	<?php
	include("Piedpage.html");
	?>
</body>
</html>
