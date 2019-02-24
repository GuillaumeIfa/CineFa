<?php session_start() ?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="./SCRIPT/style.css">
	<title><?php echo ucwords($_GET["name"])?></title>
</head>
<body>
	<h1><?php echo ucwords($_GET["name"])?></h1>
	<?php 

		require_once './SCRIPT/configure.php';

		$db_handle = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
		$db_name = 'cinefa';
		$db = mysqli_select_db($db_handle, $db_name);

		if($db)
		{

			$rqt_movies =
			'
			SELECT *
			FROM movies
			INNER JOIN directors ON directors.id_director = movies.id_director
			WHERE movies.id_movie = "'.$_GET["id"].'";
			';

			$rqt_actors = 
			'
			SELECT actors.name, actors.id_actor
            FROM actors
            INNER JOIN plays_in ON plays_in.id_actor = actors.id_actor
            INNER JOIN movies ON movies.id_movie = plays_in.id_movie
            WHERE movies.id_movie = '.$_GET["id"].';
            ';

            $rqt_avg = 
            '
            SELECT round(AVG(note),1) AS note
            FROM movie_notes
            ';

			$result_query_movies = mysqli_query($db_handle, $rqt_movies);
			$db_field_movies = mysqli_fetch_assoc($result_query_movies);

			echo '<img src="'.$db_field_movies['poster'].' alt="'.$db_field_movies['title'].' style="width:150px;">';
			echo '<h3>Informations:</h3>';
			echo '<p>Date de sortie:<br>';
			echo $db_field_movies['release_date'].'</p>';
			echo '<p>Réalisateur:<br>';
			echo '<a href="fiche_realisateur.php?id='.$db_field_movies["id_director"].'&name='.$db_field_movies["name"].'">'.ucwords($db_field_movies["name"]).'</a></p>';

			$result_query_actors = mysqli_query($db_handle, $rqt_actors);

			echo 'Acteurs:<br>';

			while ($db_field_actors = mysqli_fetch_assoc($result_query_actors)) 
			{
				echo '<a href="fiche_acteur.php?id='.$db_field_actors["id_actor"].'&name='.$db_field_actors["name"].'">'.ucwords($db_field_actors["name"]).'</a><br>';
			}

			if (isset($_SESSION['pseudo']))
			{
				$rqt_note = 
				'
				SELECT note
				FROM movie_notes
				INNER JOIN movies ON movies.id_movie = movie_notes.id_movie
				INNER JOIN users ON users.id_user = movie_notes.id_user
				WHERE movie_notes.id_movie = '.$_GET["id"].' && movie_notes.id_user = '.$_SESSION["id_user"].';
				';

				$result_query_note = mysqli_query($db_handle, $rqt_note);
				$db_field_note = mysqli_fetch_assoc($result_query_note);

				if ($db_field_note) 
				{
					echo '<h3>Votre note: '.$db_field_note["note"].'</h3>';
				}
			}

			$result_query_avg = mysqli_query($db_handle, $rqt_avg);
			$db_field_avg = mysqli_fetch_assoc($result_query_avg);

			echo '<p>Note moyenne: ';
			echo $db_field_avg['note'].'</p>';
		}
	 ?>

	 <?php 

	 	if (isset($_POST['submit_note'])) 
	 	{
	 		if (!isset($_SESSION['pseudo'])) 
	 		{
	 			echo '<br><b>Veuillez vous connecter </b><a href="./connection.php">ICI</a><br>';
	 		}
	 		elseif (isset($db_field_note['note'])) 
	 		{
	 			if ($db) 
	 			{
	 				$note = $_POST['note'];
	 				$id_movie = $_GET['id'];
	 				$id_user = $_SESSION['id_user'];

	 				$rqt_note = 
	 				'
					UPDATE movie_notes
					SET note = '.$note.'
					WHERE id_user = '.$id_user.'
	 				';

	 				$result_query_note = mysqli_query($db_handle, $rqt_note);

	 				if ($result_query_note) 
	 				{
	 					echo '<script>alert("Vous avez donné '.$_POST['note'].' à ce flim '.ucwords($_SESSION['pseudo']).' !")</script>';
	 				}
	 			}
	 		}
	 		else
	 		{
	 			if ($db) 
	 			{
	 				$note = $_POST['note'];
	 				$id_movie = $_GET['id'];
	 				$id_user = $_SESSION['id_user'];

	 				$rqt_note = 
	 				'
					INSERT INTO movie_notes
					(
					id_movie, id_user, note
					)
					VALUES
					(
					"'.$id_movie.'","'.$id_user.'","'.$note.'"
					);
	 				';

	 				$result_query_note = mysqli_query($db_handle, $rqt_note);

	 				if ($result_query_note) 
	 				{
	 					echo '<script>alert("Vous avez donné '.$_POST['note'].' à ce flim '.ucwords($_SESSION['pseudo']).' !")</script>';
	 				}
	 			}
	 		}
	 	}
	  ?>
</body>
	 <h2>Notez Le film:</h2>

	 <form action="" method="POST">
	 	<select name="note">
	 		<option>📼</option>
		 	<option value="0">0</option>
		 	<option value="1">1</option>
		 	<option value="2">2</option>
		 	<option value="3">3</option>
		 	<option value="4">4</option>
		 	<option value="5">5</option>
	 	</select>
	 	<input type="submit" name="submit_note" value="Noter">
	 </form>
	 <br>
	 <a href="./films.php">Retour</a>
</html>