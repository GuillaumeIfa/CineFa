<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="./SCRIPT/style.css">
	<title>Inscription</title>
</head>
<body>
	<section>
		<h1>Inscription</h1>
		<p>
			Veuillez entrer vos informations:
		</p>
		<form action="inscription.php" name="form1" method="POST">

			<label for="pseudo">Pseudo:</label><br>
			<input type="text" name='pseudo' required><br>
			<label for="address">Adresse:</label><br>
			<input type="text" name="address"><br>
			<label for="email">Email</label><br>
			<input type="email" name="email"><br>
			<label for="phone">Téléphone</label><br>
			<input type="tel" name="phone"><br>
			<label for="password">Mot De Passe:</label><br>
			<input type="password" name="password1" required><br>
			<label for="password">Confirmer Mot De Passe:</label><br>
			<input type="password" name="password2" required><br>

			<input type="submit" name="submit1">

		</form>
	</section>

	<section>

		<?php 

			require_once './SCRIPT/configure.php';
			include './SCRIPT/functions.php';

			$db_handle = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);

			$db_name = 'cinefa';
			$db = mysqli_select_db($db_handle, $db_name);
			$password1 = '';
			$password2 = '';

			if (isset($_POST['submit1']))
			{
				if ($_POST['password1'] != $_POST['password2'])
				{
					echo "Les mots de passe ne correspondent pas 😬<br>";
				}
				else
				{

					$pseudo = trimmer($_POST['pseudo']);
					$address = $_POST['address'];
					$email = $_POST['email'];
					$phone = $_POST['phone'];

					$password = sha1(avant.$_POST['password1'].apres);   // Hashage du MDP

					if($db)
					{

						$rqt_pseudo = 'SELECT * FROM USERS WHERE pseudo = "' .$pseudo. '";';
						$result_query = mysqli_query($db_handle, $rqt_pseudo);   // Ouvre la requete
						$db_field = mysqli_fetch_assoc($result_query);			// Lit dans la table

						if ($db_field)
						{
							echo '<b>Ce pseudo existe déjà !</b><br><span>¯\_(ツ)_/¯</span>';
						}
						else
						{
							$rqt = 
							'
								INSERT INTO users 
								(
								pseudo, address, email, phone, password
								)
								VALUES 
								("'.$pseudo.'","'.$address.'","'.$email.'","'.$phone.'","'.$password.'");
							';

							$result_query = mysqli_query($db_handle, $rqt);

							if ($result_query) 
							{
								echo '<i>Félicitations ! Vous êtes inscrit !</i>👌<br>';
								echo 'Connectez vous <a href="./connection.php" >ici</a>';
							}
						}
					}
				}
			}
		 ?>
	</section>
</body>
</html>