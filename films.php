<?php session_start() ?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="./SCRIPT/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<title>Films</title>
</head>
<body>
	<h1>Films</h1>
	<i class="far fa-file-video" style="font-size: 60px;"></i>
	<br>
	<br>
	<form action="./films.php" method="POST">

		Recherche par titre:<br>
		<input type="text" name="title">
		<br>
		<input class="button" type="submit" name="submit" value="Rechercher">

	</form>
	<br><span>Liste des films:</span>
	<form action="./films.php" method="POST">

		<input class="button" type="submit" name="submit_note" value="Afficher uniquement les films que vous avez notés">

	</form>
	<?php

		require_once './SCRIPT/configure.php';
		include './SCRIPT/functions.php';

		$db_handle = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
		$db_name ='cinefa';
		$db = mysqli_select_db($db_handle, $db_name);

		if($db)
		{
			if (isset($_POST['submit']))
			{
				$title = $_POST['title'];

				$rqt_movies =
				'
				SELECT *
				FROM movies
				WHERE title LIKE "%'.$title.'%";
				';
			}
			elseif (isset($_POST['submit_note'])) 
			{
				if (isset($_SESSION['id_user'])) 
				{
					$rqt_movies =
					'
					SELECT * 
					FROM movies				
					INNER JOIN movie_notes ON movie_notes.id_movie = movies.id_movie
					INNER JOIN users ON users.id_user = movie_notes.id_user
					WHERE users.id_user = '.$_SESSION['id_user'].';
					';
				}
				else
				{
					echo '<br><b>Vous n\'êtes pas connecté(e)...</b><br>';
					$rqt_movies = 
					'
					SELECT * 
					FROM movies;
					';
				}
			}
			else
			{
				$rqt_movies = 
				'
				SELECT * 
				FROM movies;
				';
			}

			$result_query = mysqli_query($db_handle, $rqt_movies);

			while ($db_field = mysqli_fetch_assoc($result_query)) 
			{
				echo '<br><a href="fiche_film.php?id='.$db_field['id_movie'].'&name='.$db_field['title'].'">'.ucwords($db_field['title']).'</a>';
			}
		}
		echo '<br>';
		echo '<br><a href="./index.tmp.php">Retour</a><br>';

		// if (isset($_SESSION['pseudo']) && isset($_SESSION['password']))
		// {
		// 	echo '<br><h2>Bonjour '.ucwords($_SESSION['pseudo']). ' !</h2><br>';
		// }
	 ?>
</body>
</html>