<?php 

	require_once '../SCRIPT/configure.php';
	include '../SCRIPT/functions.php';

	$pseudo = '';
	$mdp = '';

	$db_handle = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
	$db_name = 'cinefa';
	$db = mysqli_select_db($db_handle, $db_name);

	if (isset($_POST['submit1'])) 
	{
		$pseudo = $_POST['pseudo'];
		$password = sha1(avant.$_POST['password'].apres);

		if($db)
		{
			$rqt_password =
			'
			SELECT password, id_user FROM USERS 
			WHERE pseudo = "'.$pseudo.'";
			';

			$result_query = mysqli_query($db_handle, $rqt_password);
			$db_field = mysqli_fetch_assoc($result_query);
			
			if ($db_field) 
			{
				if ($db_field['password'] == $password) 
				{
					session_start();
					$_SESSION['pseudo'] = $_POST['pseudo'];
					$_SESSION['password'] = $_POST['password'];
					$_SESSION['id_user'] = $db_field['id_user'];
					header('Location: ../index.php');
				}
				else
				{
					echo '<b>Le mot de passe est erroné</b>';
				}
			}
			else
			{
				echo '<b>Le pseudo n\'existe pas...</b>';
			}
		}
	}
	mysqli_close($db_handle);
 ?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="../SCRIPT/style.css">
		<title>Connection</title>
	</head>
	<body>
		<div class="conteneur">
			<section>
				<h1>Connection Utilisateur:</h1>

				<form name="form1" action="" method="POST">

					<label for="pseudo">Pseudo:</label><br>
					<input type="text" name='pseudo' required><br>
					<label for="password">Mot De Passe:</label><br>
					<input type="password" name="password" required><br>
					<input class="button" type="submit" name="submit1" value="Valider">

				</form>

			</section>
			<section>

				<p>
					Ou inscrivez vous <a href="inscription.php">ICI !</a>
				</p>

			</section>
		</div>
	</body>
</html>
