<?php
// debug($this->vars);
?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1" />
		<title>File manager</title>
		<link rel="stylesheet" href="./assets/css/style.css" />
	</head>
	<body>
		<main id="">
            <?php if (!empty($viewOut)) {
                echo $viewOut;
            } else {
                echo "un problème est survenu.";
            } ?>
			<script src="./assets/js/jquery-3.7.0.min.js"></script>
			<script src="./assets/js/script.js"></script>
		</main>
	</body>
</html>
