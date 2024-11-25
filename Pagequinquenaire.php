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

	<p id='Titre'>Affichage des véhicules ayant été prêtés et restitués.</p>

	<p id='codeSQL'>
		<?php
		$connexion =mysqli_connect("10.34.1.75","ndc2g1","ABWabw#1","ndc2g1");
		if (! $connexion)
		{
			die("Connexion impossible:".mysqli_error(connexion));
		}


		$SQL = "SELECT Véhicule.Numserie, Véhicule.Type, Pret.Statutresti, Véhicule.Modèle
        FROM Véhicule 
        LEFT JOIN Pret ON Véhicule.Numserie = Pret.Numserie 
        WHERE Pret.Statutresti";

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
			<td class='titreTableau'>Numéro de série du véhicule</td><td class='titreTableau'>Type de véhicule</td><td class='titreTableau'>Marque</td><td class='titreTableau'>Statut de restitution</td>
		</tr>
		<?php
		 while($ligneResultat = mysqli_fetch_assoc($resultat))
         {
              echo "<tr>";
              echo "<td>".$ligneResultat["Numserie"]."</td>";
              echo "<td>".$ligneResultat["Type"]."</td>";
			  echo "<td>".$ligneResultat["Modèle"]."</td>";
			  echo "<td>".$ligneResultat["Statutresti"]."</td>";
			  
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
