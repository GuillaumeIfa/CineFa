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
	</div>
	<br><br>
	<div>
		<a href="./connection.php"><button>Connection</button></a>
		<a href="./inscription.php"><button>Inscription</button></a>
		<a href="./SCRIPT/quit.php"><button>Deconnection</button></a>
	</div>
	<?php
		if (isset($_SESSION['pseudo'])) 
		{
			echo 'Salut ' .$_SESSION['pseudo']. '<br>';
		}
		
	?>
</body>
</html>