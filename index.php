<?php 
	session_start();
	// if ( isset($_SESSION['pseudo'])) 
	// {
	// 	setcookie('pseudo', $_SESSION['pseudo'], time()+180);
	// 	echo '<script>alert("Bienvenue '.$_SESSION['pseudo'].' !");</script>';
	// }
	// elseif ( isset($_COOKIE['pseudo']) ) 
	// {
	// 	$_SESSION['pseudo'] = $_COOKIE['pseudo'];
	// }
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
		<div class="conteneur">
			<h1>cIneFA</h1>
			<i class="fas fa-film" style="font-size:60px;"></i>
			<br><br>
			<div>
				<ul>
					<li><i class="fas fa-video"></i>
					<a href="./PAGES/realisateurs.php">réal<b>I</b>sateurs</a></li>
					<li><i class="far fa-file-video"></i>
					<a href="./PAGES/films.php"><b>F</b>ilms</a></li>
					<li><i class="fas fa-theater-masks"></i>
					<a href="./PAGES/acteurs.php"><b>A</b>cteurs</a></li>
					<?php
						if (isset($_SESSION['pseudo'])) 
						{
							echo '<li><i class="fas fa-list-alt"> </i> ';
							echo '<a href="./PAGES/categories.php">Vos Catégories</a></li>';
						}
					?>
				</ul>
			</div>
			<br>
			<?php
				if (isset($_SESSION['pseudo'])) 
				{
					echo '<h2>Salut ' .ucwords($_SESSION['pseudo']). ' !</h2>';
				}
			?>
			<br><br>
			<div>
				<a href="./PAGES/connection.php"><button class="button">Connection</button></a>
				<a href="./PAGES/inscription.php"><button class="button">Inscription</button></a>
				<a href="./SCRIPT/quit.php"><button class="button">Déconnection</button></a>
			</div>
		</div>
	</body>
</html>