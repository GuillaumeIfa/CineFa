<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="./CSS/style.css">
	<title>Films</title>
</head>
<body>
	<?php 

		echo '<h1>Films</h1>';

		require_once './configure.php';
		include './functions.php';

		$db_handle = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
		$db_name ='cinefa';
		$db = mysqli_select_db($db_handle, $db_name);

		if($db)
		{
			$rqt_movies = 
			'
			SELECT * 
			FROM movies;
			';

			$result_query = mysqli_query($db_handle, $rqt_movies);

			while ($db_field = mysqli_fetch_assoc($result_query)) 
			{
				echo '<a href="./MOVIES/'.str_replace(' ', '_', $db_field['title']).'.php">'.ucwords($db_field['title']).'</a><br>';
			}
					
		}

	 ?>
</body>
</html>