<?php require_once 'core/models.php'; ?>
<?php require_once 'core/dbConfig.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Delete Casino</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
    <a href="index.php" class="btn home">Home</a>
	<h1>Are you sure you want to delete this?</h1>
	<?php $getBusinessCategory = getBusinessCategory($pdo, $_GET['casino_cat_id']); ?>
	<div class="container" style="border-style: solid; height: 400px;">
		<h2>ID: <?php echo $getBusinessCategory['casino_cat_id']; ?></h2>
		<h2>Username: <?php echo $getBusinessCategory['casino_cat']; ?></h2>
		<div class="deleteBtn" style="float: right; margin-right: 10px;">
			<form action="core/handleForms.php?casino_cat_id=<?php echo $_GET['casino_cat_id']; ?>" method="POST">
				<input type="submit" name="deleteCategory" value="Delete">
			</form>			
		</div>	

	</div>
</body>
</html>