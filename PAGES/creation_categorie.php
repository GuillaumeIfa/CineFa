<?php

	session_start();

	if (isset($_POST['submit1']))
	{
		$title = $_POST['title'];
		$date = date("Y-m-d");

		require_once '../SCRIPT/configure.php';

		$db_handle = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
		$db_name = 'cinefa';
		$db = mysqli_select_db($db_handle, $db_name);

		if ($db)
		{
			$rqt_title = 
			'
			SELECT *
			FROM categories
			WHERE title = "' .$title. '" AND id_user = '.$_SESSION["id_user"].';
			';
			$result_query = mysqli_query($db_handle, $rqt_title);
			$db_field = mysqli_fetch_assoc($result_query);

			if ($db_field)
			{
				echo '<b>Cette categorie existe déjà !</b><br><span>¯\_(ツ)_/¯</span>';
			}
			else
			{
				$rqt_title_category =
				'
				INSERT INTO categories
				(
				title, creation_date, id_user
				)
				VALUES
				(
				"'.$title.'", "'.$date.'", "'.$_SESSION["id_user"].'"
				);
				';

				$result_query = mysqli_query($db_handle, $rqt_title_category);

				if ($result_query)
				{
					header('Location: ./categories.php');
				}
			}
		}
	}

 ?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="../SCRIPT/style.css">
		<title>Créer Catégorie</title>
	</head>
	<body>
		<div class="conteneur">
			<h1>Créer une Catégorie</h1>

			<form name="form1" action="" method="POST">

				<label for="title">Titre:</label><br>
				<input type="text" name='title' required><br>
				<input class="button" type="submit" name="submit1">

			</form>
		</div>
	</body>
</html>