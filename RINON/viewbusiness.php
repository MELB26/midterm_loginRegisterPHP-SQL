<?php require_once 'core/models.php'; ?>
<?php require_once 'core/dbConfig.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>View Casino</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>

	<form action="core/handleForms.php" method="POST">
    <a href="index.php" class="btn home">Home</a>
    <h1></h1>
		<p>
			<label for="customer_name">Customer Name</label> 
			<input type="text" name="customer_name">
		</p>
		<p>
			<label for="date_added">Date Added</label> 
			<input type="date" name="date_added">
		</p>
		<p>
			<label for="business_branch">Branch</label> 
			<input type="text" name="business_branch">
		</p>
		<p>

		<?php $getBusinessCategories = getBusinessCategories($pdo); ?>
		<div>
			<label for="businessCategory">Casino Type</label>
			<select name="business_category" id="businessCategory" onchange="toggleOtherInput()">
				<?php foreach ($getBusinessCategories as $row): ?>
					<option value="<?php echo ($row['casino_cat_id']); ?>">
						<?php echo ($row['casino_cat']); ?>
					</option>
				<?php endforeach; ?>
			</select>
		</div>
        </p>
		<p>
			<input type="submit" name="insertBusinessDetails">
		</p>
	</form>


	<table style="center;">
	  <tr>
	    <th>Customer ID</th>
	    <th>Customer Name</th>
	    <th>Date Added</th>
	    <th>Branch</th>
	    <th>Casino</th>   
	    <th>Casino ID</th>
		<th>Added By</th>   
	    <th>Updated Date</th>
		<th>Action</th>
	  </tr>
	  <?php 
	  $getcasino_details = getcasino_details($pdo, $_GET['casino_cat_id']);
	  foreach ($getcasino_details as $row) {	?>
	  <tr>
        <td><?php echo ($row['customer_id']); ?></td>
        <td><?php echo ($row['customer_name']); ?></td>
        <td><?php echo ($row['date_added']); ?></td>
        <td><?php echo ($row['Branch']); ?></td>
        <td><?php echo ($row['casino_cat']); ?></td>
        <td><?php echo ($row['casino_cat_id']); ?></td>
		<td><?php echo $row['added_by']; ?></td>
        <td><?php echo $row['last_updated']; ?></td>
		<td>
	  		<a href="editcasinodetails.php?customer_id=<?php echo $row['customer_id']; ?>&casino_cat_id=<?php echo $_GET['casino_cat_id']; ?>" class="btn edit">Edit</a>
	  		<a href="deletecasinodetails.php?customer_id=<?php echo $row['customer_id']; ?>&casino_cat_id=<?php echo $_GET['casino_cat_id']; ?>" class="btn delete">Delete</a>


	  	</td>	  


	  </tr>
	<?php } ?>
	</table>

	
</body>
</html>