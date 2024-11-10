
<?php require_once 'core/handleForms.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edit Casino</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<?php $getBusinessCategory = getBusinessCategory($pdo, $_GET['casino_cat_id']); ?>
	<h1>EditCasino</h1>
	<form action="core/handleForms.php?casino_cat_id=<?php echo $_GET['casino_cat_id']; ?>" method="POST">
		<p>
		<a href="index.php" class="btn home">Home</a>
		<h1></h1>
			<label for="Category">Category</label> 
			<select name="casino_cat" value="<?php echo $getBusinessCategory['casino_cat']; ?>">
			<option value="Super Casino">Super Casino</option>
			<option value="Dream Casino">Dream Casino</option>
			<option value="WIN Casino">WIN Casino</option>
			<option value="MEGA Casino">MEGA Casino</option>
			<option value="PAGCOR Casino">PAGCOR Casino</option>	
		</p>
		<p>
			<input type="submit" name="editCategory">
		</p>
	</form>
</body>
</html>