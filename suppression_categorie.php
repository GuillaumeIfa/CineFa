<?php session_start(); ?>
<?php

	if (isset($_POST['submit']))
	{
		require_once './SCRIPT/configure.php';

		$db_handle = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
		$db_name = 'cinefa';
		$db = mysqli_select_db($db_handle, $db_name);
		$id_category = $_POST['category'];

		if ($db)
		{
			$rqt_supprimer_content =
			'
			DELETE FROM category_content
			WHERE id_category = '.$id_category.';
			';

			$rqt_supprimer_category =
			'
			DELETE FROM categories
			WHERE id_category = '.$id_category.';
			';

			$result_query_supprimer_content = mysqli_query($db_handle, $rqt_supprimer_content);
			$result_query_supprimer_category = mysqli_query($db_handle, $rqt_supprimer_category);
			header('Location: ./categories.php');
		}
	}
 ?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="./SCRIPT/style.css">
	<title>Supprimer une Catégorie</title>
</head>
<body>
	<h1>Supprimer Catégorie:</h1>
	<form action="" method="POST">
		<select name="category">
		<?php 

			require_once './SCRIPT/configure.php';

			$db_handle = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
			$db_name = 'cinefa';
			$db = mysqli_select_db($db_handle, $db_name);

			if ($db) 
			{
				$rqt_categories =
				'
				SELECT *
				FROM categories
				WHERE id_user = ' .$_SESSION["id_user"]. ';
				';

				$result_query_categories = mysqli_query($db_handle, $rqt_categories);

				if ($result_query_categories) 
				{
					while ($db_field_categories = mysqli_fetch_assoc($result_query_categories)) 
					{
						echo '<option value="'.$db_field_categories['id_category'].'">'.$db_field_categories["title"].'</option>';
					}
				}
			}
		?>
		</select><br><br>
		<input type="submit" name="submit" value="Supprimer !">
	</form>

	<br>
	<a href="./categories.php">Retour</a>
</body>
</html>