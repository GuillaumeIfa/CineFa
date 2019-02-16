<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="./CSS/style.css">
	<title>Réalisateurs</title>
</head>
<body>
	<?php 

		require_once './configure.php';
		include './functions.php';

		$db_handle = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
		$db_name ='cinefa';
		$db = mysqli_select_db($db_handle, $db_name);

		if($db)
		{
			$rqt_directors = 
			'
			SELECT * 
			FROM directors;
			';

			$result_query = mysqli_query($db_handle, $rqt_directors);
			// $db_field = mysqli_fetch_assoc($result_query);

			while ($db_field = mysqli_fetch_assoc($result_query)) 
			{
				echo '<a href="'.str_replace(' ', '_', $db_field['name']).'">'.ucwords($db_field['name']).'</a><br>';
				echo '<hr>';
			}
					
		}

	 ?>
</body>
</html>