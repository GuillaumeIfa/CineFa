<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="./SCRIPT/style.css">
	<title>cIneFA</title>
</head>
<body>
	<h1>cIneFA</h1>
	<div>
		<a href="./realisateurs.php">réal<b>I</b>sateurs</a>
		<a href="./films.php"><b>F</b>ilms</a>
		<a href="./acteurs.php"><b>A</b>cteurs</a>
		<?php
			// if (isset($_SESSION['pseudo'])) 
			// {
			// 	echo '<br><br><a href="./categories.php">Vos Catégories</a>';
			// }
		?>
	</div>
	<br>
	<?php
		if (isset($_SESSION['pseudo'])) 
		{
			echo '<br>Salut ' .ucwords($_SESSION['pseudo']). '<br>';
			echo '<a href="./categories.php"><button>Vos Catégories</button></a><br><br>';
		}
	?>
	<div>
		<a href="./connection.php"><button>Connection</button></a>
		<a href="./inscription.php"><button>Inscription</button></a>
		<a href="./SCRIPT/quit.php"><button>Deconnection</button></a>
	</div>
</body>
</html>