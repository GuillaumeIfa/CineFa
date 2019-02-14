<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="./CSS/style.css">
	<title>Inscription</title>
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
		
		<h1>Inscription</h1>
		<p>
			Veuillez entrer vos informations:
		</p>
		<form action="inscription.php" name="form1" method="POST">
			<label for="pseudo">Pseudo:</label><br>
			<input type="text" name='pseudo'><br>
			<label for="address">Adresse:</label><br>
			<input type="text" name="address"><br>
			<label for="email">Email</label><br>
			<input type="mail" name="email"><br>
			<label for="phone">Téléphone</label><br>
			<input type="tel" name="phone"><br>
			<label for="password">Mot De Passe:</label><br>
			<input type="password" name="password1"><br>
			<label for="password">Confirmer Mot De Passe:</label><br>
			<input type="password" name="password2"><br>

			<input type="submit" name="submit1">
		</form>

	</section>
</body>
</html>