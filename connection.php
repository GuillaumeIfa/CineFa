<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="./CSS/style.css">
	<title>Connection</title>
</head>
<body>
	<section>
		<h1>Connection Utilisateur:</h1>

		<form name="form1" action="connection.php" method="POST">

			<label for="pseudo">Pseudo:</label><br>
			<input type="text" name='pseudo' required><br>
			<label for="password">Mot De Passe:</label><br>
			<input type="password" name="password" required><br>
			<input type="submit" name="submit1">

		</form>

		<?php 

			require_once './configure.php';
			include './functions.php';

			$pseudo = '';
			$mdp = '';
/*			define('avant','caramelmou');
			define('apres', 'chocopete');*/

			$db_handle = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
			$db_name = 'cinefa';
			$db = mysqli_select_db($db_handle, $db_name);

			if (isset($_POST['submit1'])) 
			{
				$pseudo = $_POST['pseudo'];
				$password = sha1(avant.$_POST['password'].apres);

				if($db)
				{
					// echo '<br>La base de données ' .$db_name. ' à bien été trouvée !<br><br>';

					$rqt_password =
					'
					SELECT password FROM USERS 
					WHERE pseudo = "'.$pseudo.'";
					';

					$result_query = mysqli_query($db_handle, $rqt_password);
					$db_field = mysqli_fetch_assoc($result_query);
					
					if ($db_field) 
					{
						if ($db_field['password'] == $password) 
						{
							echo 'Bienvenue '.$pseudo.' !';
							// session_start();
							$_SESSION['pseudo'] = $_POST['pseudo'];
							$_SESSION['password'] = $_POST['password'];
						}
						else
						{
							echo 'Le mot de passe est erroné ';
						}
					}
					else
					{
						echo "Le pseudo n'existe pas...";
					}
				}
			}
		 ?>
	</section>
	<section>
		
		<p>
			Ou inscrivez vous <a href="inscription.php">ICI !</a>
		</p>

	</section>
	<?php 
		if (isset($_SESSION['pseudo']) && isset($_SESSION['password']))
		{
			echo 'ça marche !<br>';
			echo $_SESSION['pseudo'];
		}
	 ?>
</body>
</html>