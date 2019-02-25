<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="./SCRIPT/style.css">
	<title><?php echo ucwords($_GET["name"]); ?></title>
</head>
<body>
	<h1><?php echo ucwords($_GET["name"]); ?></h1>
	<?php 

		require_once './SCRIPT/configure.php';

		$db_handle = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
		$db_name = 'cinefa';
		$db = mysqli_select_db($db_handle, $db_name);

		if($db)
		{
			$rqt_actors =
			'
			SELECT *
			FROM actors
			WHERE actors.id_actor = "'.$_GET["id"].'";
			';

			$rqt_movies = 
			'
			SELECT *
			FROM movies
			INNER JOIN plays_in ON plays_in.id_movie = movies.id_movie
			INNER JOIN actors ON actors.id_actor = plays_in.id_actor
			WHERE actors.id_actor = "'.$_GET["id"].'"
			ORDER BY movies.release_date DESC LIMIT 3;
			';

			$result_query_actors = mysqli_query($db_handle, $rqt_actors);
			$db_field_actors = mysqli_fetch_assoc($result_query_actors);

			echo '<img src="'.$db_field_actors['picture'].' alt="'.$db_field_actors['name'].' style="width:150px;">';
			echo '<h3>Informations:</h3>';
			echo '<p>Date de naissance:<br>';
			echo $db_field_actors['date_of_birth'].'</p>';
			echo '<p>Genre:<br>';
			echo $db_field_actors['gender'].'</p>';

			$result_query_movies = mysqli_query($db_handle, $rqt_movies);

			echo '<p>Liste des films:</p>';

			while ($db_field_movies = mysqli_fetch_assoc($result_query_movies)) 
			{
				echo '<a href="fiche_film.php?id='.$db_field_movies["id_movie"].'&name='.$db_field_movies["title"].'">'.ucwords($db_field_movies["title"]).'</a><br>';
			}
		}

		echo '<br><a href="./acteurs.php">Retour</a>';
	 ?>
</body>
</html>