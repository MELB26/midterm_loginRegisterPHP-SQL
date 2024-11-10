<?php require_once 'core/models.php'; ?>
<?php require_once 'core/dbConfig.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edit Details</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	
	<h1>Edit Casino Details</h1>
	<?php $getBusinessbyId = getBusinessbyId($pdo, $_GET['customer_id']); ?>
	<form action="core/handleForms.php?casino_cat_id=<?php echo $_GET['casino_cat_id']; ?>
	&customer_id=<?php echo $_GET['customer_id']; ?>" method="POST">
		<p>
		<a href="viewbusiness.php?casino_cat_id=<?php echo $_GET['casino_cat_id']; ?>" class="btn home">
		Back</a>
		<h1></h1>
			<label for="Owner">Name</label> 
			<input type="text" name="customer_name" 
			value="<?php echo $getBusinessbyId['customer_name']; ?>">
		</p>
		<p>
			<label for="Branch">Branch</label> 
			<input type="text" name="Branch" 
			value="<?php echo $getBusinessbyId['Branch']; ?>">
			<input type="submit" name="editDetails">
		</p>
	</form>
</body>
</html>