<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">	
	<link rel="stylesheet" href="./SCRIPT/style.css">
	<title>cIneFA</title>
</head>
<body>
	<h1>cIneFA</h1>
	<i class="fas fa-film" style="font-size:60px;"></i>
	<br><br>
	<div>
		<i class="fas fa-video"></i>
		<a href="./realisateurs.php">réal<b>I</b>sateurs</a>
		<i class="far fa-file-video"></i>
		<a href="./films.php"><b>F</b>ilms</a>
		<i class="fas fa-theater-masks"></i>
		<a href="./acteurs.php"><b>A</b>cteurs</a>
		<?php
			if (isset($_SESSION['pseudo'])) 
			{
				echo '<i class="fas fa-list-alt"> </i> ';
				echo '<a href="./categories.php">Vos Catégories</a>';
			}
		?>
	</div>
	<br>
	<?php
		if (isset($_SESSION['pseudo'])) 
		{
			echo '<h2>Salut ' .ucwords($_SESSION['pseudo']). ' !</h2>';
			// echo '<a href="./categories.php"><button>Vos Catégories</button></a><br><br>';
		}
	?>
	<div>
		<a href="./connection.php"><button class="button">Connection</button></a>
		<a href="./inscription.php"><button class="button">Inscription</button></a>
		<a href="./SCRIPT/quit.php"><button class="button">Deconnection</button></a>
	</div>
</body>
</html>