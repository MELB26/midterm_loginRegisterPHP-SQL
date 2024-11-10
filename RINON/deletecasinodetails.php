<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Delete Details</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	
	<?php $getBusinessbyId = getBusinessbyId($pdo, $_GET['customer_id']); ?>
	<h1>Are you sure you want to delete this customer?</h1>
	<div class="container" style="border-style: solid; height: 400px;">

		<h2>Customer Name<?php echo $getBusinessbyId['customer_name'] ?></h2>
		<h2>Date Added <?php echo $getBusinessbyId['date_added'] ?></h2>
		<h2>Branch: <?php echo $getBusinessbyId['Branch'] ?></h2>

		<div class="deleteBtn" style="float: right; margin-right: 10px;">

			<form action="core/handleForms.php?customer_id=<?php echo $_GET['customer_id']; ?>&casino_cat_id=<?php echo $_GET['casino_cat_id']; ?>" method="POST">
				<input type="submit" name="deletebusiness" value="Delete">
			</form>			
			
		</div>	

	</div>
</body>
</html>