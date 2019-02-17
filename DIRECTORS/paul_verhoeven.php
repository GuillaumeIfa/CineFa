<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../CSS/style.css">
	<title>Paul Verhoeven</title>
</head>
<body>
	<h1>Paul Verhoeven</h1>
	<?php 

		require_once '../configure.php';

		$db_handle = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
		$db_name = 'cinefa';
		$db = mysqli_select_db($db_handle, $db_name);

		if($db)
		{
			$rqt_movies = 
			'
			SELECT title
			FROM movies
			INNER JOIN directors ON movies.id_director = directors.id_director
			WHERE directors.name = "paul verhoeven"
			ORDER BY movies.release_date DESC LIMIT 3;
			';

			$rqt_directors =
			'
			SELECT *
			FROM directors
			WHERE directors.name = "paul verhoeven";
			';

			$result_query_directors = mysqli_query($db_handle, $rqt_directors);
			$db_field_directors = mysqli_fetch_assoc($result_query_directors);

			echo '<h3>Informations:</h3>';
			echo '<p>Date de naissance<br>';
			echo $db_field_directors['date_of_birth'].'</p><br>';
			echo '<p>Genre<br>';
			echo $db_field_directors['gender'].'</p><br>';


			$result_query_movies = mysqli_query($db_handle, $rqt_movies);

			echo '<p>Liste des films:</p><br>';

			while ($db_field_movies = mysqli_fetch_assoc($result_query_movies)) 
			{
				echo '<div><a href="'.str_replace(' ', '_', $db_field_movies['title']).'">'.ucwords($db_field_movies['title']).'</a></div><br>';
			}


		}

	 ?>
</body>
</html>