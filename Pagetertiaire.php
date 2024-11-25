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

	<p id='Titre'>Affichage des modèles de véhicules qui ont eu le moteur cassé (qui ont été réparés) avec moins de 10 000km.</p>

	<p id='codeSQL'>
		<?php
		$connexion =mysqli_connect("10.34.1.75","ndc2g1","ABWabw#1","ndc2g1");
		if (! $connexion)
		{
			die("Connexion impossible:".mysqli_error(connexion));
		}


		$SQL = "SELECT Véhicule.Modèle, piece.Nom, Réparer.Kilométrage
        FROM Véhicule
        INNER JOIN Réparer ON Véhicule.Numserie = Réparer.Numserie
        INNER JOIN piece ON Réparer.IDpiece = piece.IDpiece
        WHERE piece.Nom LIKE 'Moteur%' AND Réparer.Kilométrage < 10000;";

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
			<td class='titreTableau'>Modèle</td><td class='titreTableau'>Kilométrage lors de la casse</td><td class='titreTableau'>Nom pièce</td>
		</tr>
		<?php
		 while($ligneResultat = mysqli_fetch_assoc($resultat))
         {
              echo "<tr>";
              echo "<td>".$ligneResultat["Modèle"]."</td>";
              echo "<td>".$ligneResultat["Kilométrage"]."</td>";
			  echo "<td>".$ligneResultat["Nom"]."</td>";
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
