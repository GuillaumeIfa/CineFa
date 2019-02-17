<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../CSS/style.css">
	<title>Arnold Schwarzenegger</title>
</head>
<body>
	<h1>Arnold Schwarzenegger</h1>
	<?php 

		require_once '../configure.php';

		$db_handle = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
		$db_name = 'cinefa';
		$db = mysqli_select_db($db_handle, $db_name);

		if($db)
		{
			$rqt_movies = 
			'
			SELECT movies.title
            FROM movies
            INNER JOIN plays_in ON plays_in.id_movie = movies.id_movie
            INNER JOIN actors ON actors.id_actor = plays_in.id_actor
            WHERE actors.name = "arnold schwarzenegger"
            ORDER BY movies.release_date DESC LIMIT 3;
            ';

			$rqt_actors =
			'
			SELECT *
			FROM actors
			WHERE actors.name = "arnold schwarzenegger";
			';

			$result_query_actors = mysqli_query($db_handle, $rqt_actors);
			$db_field_actors = mysqli_fetch_assoc($result_query_actors);

			echo '<h3>Informations:</h3>';
			echo '<p>Date de naissance<br>';
			echo $db_field_actors['date_of_birth'].'</p><br>';
			echo '<p>Genre<br>';
			echo $db_field_actors['gender'].'</p><br>';

			$result_query_movies = mysqli_query($db_handle, $rqt_movies);

			echo '<p>Liste des films:</p><br>';

			while ($db_field_movies = mysqli_fetch_assoc($result_query_movies)) 
			{
				echo '<div><a href="'.str_replace(' ', '_', $db_field_movies['title']).'.php">'.ucwords($db_field_movies['title']).'</a></div><br>';
			}


		}

	 ?>
</body>
</html>