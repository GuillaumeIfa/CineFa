<?php session_start() ?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="../SCRIPT/style.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
		<title>Réalisateurs</title>
	</head>
	<body>
		<div class="conteneur">
			<section>
				<h1>Réalisateurs</h1>
				<i class="fas fa-video" style="font-size:60px;"></i>
				<br>
				<br>
				<form action="./realisateurs.php" method="POST">

					<p>Recherche par nom:</p>
					<input type="text" name="name">
					<br>
					<input class="button" type="submit" name="submit" value="Rechercher">

				</form>
			</section>
			<section>
				<h3>Liste des réalisateurs:</h3>
				<?php

					require_once '../SCRIPT/configure.php';
					include '../SCRIPT/functions.php';

					$db_handle = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
					$db_name ='cinefa';
					$db = mysqli_select_db($db_handle, $db_name);

					if($db)
					{

						if (isset($_POST['submit']))
						{
							$name = $_POST['name'];

							$rqt_directors =
							'
							SELECT *
							FROM directors
							WHERE name LIKE "%'.$name.'%";
							';
						}
						else
						{
							$rqt_directors = 
							'
							SELECT * 
							FROM directors;
							';
						}

						$result_query = mysqli_query($db_handle, $rqt_directors);

						while ($db_field = mysqli_fetch_assoc($result_query)) 
						{
							echo '<br><a href="fiche_realisateur.php?id='.$db_field['id_director'].'&name='.$db_field['name'].'">'.ucwords($db_field['name']).'</a>';
						}
					}
					mysqli_close($db_handle);
					echo '<br>';
					echo '<br><a href="../index.php">Retour</a><br>';
				 ?>
			</section>
		</div>
	</body>
</html>