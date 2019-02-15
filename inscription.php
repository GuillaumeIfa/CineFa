<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="./CSS/style.css">
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

			require_once './configure.php';
			include 'functions.php';

			$db_handle = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);

			$db_name = 'cinefa';
			$db = mysqli_select_db($db_handle, $db_name);
			$password1 = '';
			$password2 = '';

			if (isset($_POST['submit1']))
			{
				if ($_POST['password1'] != $_POST['password2'])
				{
					echo "Les mots de passe ne correspondent pas ¯\_(ツ)_/¯<br>";
				}
				else
				{


					$pseudo = trimmer($_POST['pseudo']);
					$address = $_POST['address'];
					$email = $_POST['email'];
					$phone = $_POST['phone'];
					define('avant', 'caramelmou');      // Definition Variable de Sécurité
					define('apres', 'chocopete');		// Definition Variable de Sécurité

					$password = sha1(avant.$_POST['password1'].apres);   // Hashage du MDP

				
					if($db)
					{
						/*echo 'La base de données ' .$db_name. ' à bien été trouvée !<br>';*/


						$rqt_pseudo = 'SELECT * FROM USERS WHERE pseudo = "' .$pseudo. '";';
						$result_query = mysqli_query($db_handle, $rqt_pseudo);   // Ouvre la requete
						$db_field = mysqli_fetch_assoc($result_query);			// Lit dans la table

						if ($db_field)
						{
							echo '<b>Ce pseudo existe déjà !</b>';
						}
						else
						{
							$rqt = 
							'
								INSERT INTO USERS 
								(
								pseudo, address, email, phone, password
								)
								VALUES 
								("'.$pseudo.'","'.$address.'","'.$email.'","'.$phone.'","'.$password.'");
							';

							$result_query = mysqli_query($db_handle, $rqt);

							if ($result_query) 
							{
								echo '<i>Vous êtes inscrit !</i>';
							}
						}
					}
				}	
			}
		 ?>
	</section>
</body>
</html>