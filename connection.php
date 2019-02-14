<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="./CSS/style.css">
	<title>Connection</title>
</head>
<body>
	<section>
		<h1>Connection Base De Données</h1>
		<?php 

			require_once './configure.php';

			$db_handle = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);

			$db_name = 'cinefa';
			$db = mysqli_select_db($db_handle, $db_name);

			if($db)
			{
				echo 'La base de données ' .$db_name. ' à bien été trouvée !<br>';
			}

		 ?>
	</section>
	<section>
		<h1>Connection Utilisateur:</h1>

		<form name="form1" action="connection.php" method="POST">

			<label for="pseudo">Pseudo:</label><br>
			<input type="text" name='pseudo'><br>
			<label for="password">Mot De Passe:</label><br>
			<input type="password" name="password"><br>
			<input type="submit" name="submit1">

		</form>

		<?php 

			include './functions.php';

			$pseudo = '';
			$mdp = '';

			if (isset($_POST['submit1'])) 
			{
				$pseudo = $_POST['pseudo'];
				$mdp = $_POST['password'];

				$pseudo = trimmer($pseudo);
				$mdp = trimmer($mdp);

				echo $pseudo.' '.$mdp;
			}

		 ?>
	</section>
	<section>
		
		<p>
			Ou inscrivez vous <a href="inscription.php">ICI !</a>
		</p>

	</section>
</body>
</html>