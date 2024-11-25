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

	<p id='Titre'>Affichage des véhicules ayant été équipé de plus de 3000€ d’options et étant neufs.</p>

	<p id='codeSQL'>
		<?php
		$connexion =mysqli_connect("10.34.1.75","ndc2g1","ABWabw#1","ndc2g1");
		if (! $connexion)
		{
			die("Connexion impossible:".mysqli_error(connexion));
		}


		$SQL = "SELECT Véhicule.Numserie, Véhicule.Modèle, Véhicule.Type, SUM(Equipement.cout) AS sommedescouts
		FROM Véhicule
		INNER JOIN Possède ON Véhicule.Numserie = Possède.Numserie
		INNER JOIN Equipement ON Possède.IDEquipement = Equipement.IDEquipement WHERE Véhicule.Neuf
		GROUP BY Véhicule.Numserie
		HAVING sommedescouts > 3000";

		echo $SQL;
		mysqli_query($connexion,"SET NAMES UTF8");
        $resultat = mysqli_query($connexion,$SQL);
        if (! $resultat)

		{
			die("Requete SQL invalide :".mysqli_error($connexion));
		}
		?>
	</p>
	<table>
		<tr>
			<td class='titreTableau'>Numéro de série du véhicule</td><td class='titreTableau'>Type de véhicule</td><td class='titreTableau'>Marque</td><td class='titreTableau'>Cout total des options (en €)</td>
		</tr>
		<?php
		 while($ligneResultat = mysqli_fetch_assoc($resultat))
         {
              echo "<tr>";
              echo "<td>".$ligneResultat["Numserie"]."</td>";
              echo "<td>".$ligneResultat["Type"]."</td>";
			  echo "<td>".$ligneResultat["Modèle"]."</td>";
			  echo "<td>".$ligneResultat["sommedescouts"]."</td>";
			  
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
