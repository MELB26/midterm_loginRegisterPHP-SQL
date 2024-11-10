<?php    

function insertIntoUsersRecords($pdo, $businessOwner, $businessName, $branch, $categoryId){
    $addedBy = isset($_SESSION['username']) ? $_SESSION['username'] : 'Unknown'; // Get the logged-in user from session
    $sql = "INSERT INTO casino_details (customer_name, date_added, Branch, casino_cat_id, added_by) VALUES(?,?,?,?,?)";

    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$businessOwner, $businessName, $branch, $categoryId, $addedBy]);

    if ($executeQuery) {
        return true;
    }
    return false;
}



function insertNewCategory($pdo, $business_category, $added_by){
    $sql = "INSERT INTO casino (casino_cat, added_by) VALUES(?,?)";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$business_category, $added_by]);

	if ($executeQuery) {
		return true;
	}

}




function getBusinessCategories($pdo) {
    $sql = "SELECT * FROM casino";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}


function getAllbusiness_category($pdo) {
	$sql = "SELECT * FROM casino";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();

	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}
function getcasino_details($pdo, $casino_cat_id) {
    $sql = "SELECT 
                casino_details.customer_id AS `customer_id`,
                casino_details.customer_name AS `customer_name`,
                casino_details.date_added AS `date_added`,
                casino_details.Branch AS `Branch`,
                casino_details.added_by AS added_by,
                casino_details.last_updated AS last_updated,
                casino_details.casino_cat_id AS `casino_cat_id`,
                casino.casino_cat AS `casino_cat`
            FROM casino_details
            JOIN casino ON casino_details.casino_cat_id = casino.casino_cat_id
            WHERE casino_details.casino_cat_id = ? 
            ";

    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$casino_cat_id]);

    if ($executeQuery) {
        return $stmt->fetchAll(); 
    }
    return []; 
}
function getBusinessbyId($pdo, $customer_id) {
    $sql = "SELECT 
                casino_details.customer_id AS customer_id,
                casino_details.customer_name AS customer_name,
                casino_details.date_added AS date_added,
                casino_details.added_by AS added_by, 
                casino_details.last_updated AS last_updated,
                casino_details.Branch AS Branch,
                casino.casino_cat AS Business_Category
            FROM casino_details
            JOIN casino ON casino.casino_cat_id = casino_details.casino_cat_id
            WHERE casino_details.customer_id = ? 
            GROUP BY casino_details.date_added";

    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$customer_id]);
    if ($executeQuery) {
        return $stmt->fetch();
    }
    return null; 
}



function updateProject($pdo, $customer_name,$Branch, $customer_id){
        $sql = "UPDATE casino_details
        SET customer_name = ?,
        Branch =?
        WHERE customer_id = ?
        ";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$customer_name,$Branch, $customer_id]);

    if ($executeQuery) {
    return true;
    }
}


function deletebusiness($pdo, $customer_id){
    $sql = "DELETE FROM casino_details WHERE customer_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$customer_id]);
	if ($executeQuery) {
		return true;
	}
}

function getBusinessCategory($pdo,$casino_cat_id){
    $sql = "SELECT * FROM casino WHERE casino_cat_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$casino_cat_id]);

	if ($executeQuery) {
		return $stmt->fetch();
	}
}

function updateCategory($pdo, $casino_cat, $casino_cat_id){
    $sql = "UPDATE casino
				SET casino_cat = ?
				WHERE casino_cat_id = ?
			";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$casino_cat, $casino_cat_id ]);
	
	if ($executeQuery) {
		return true;
	}
    
    
}
function deleteCategory($pdo,$casino_cat_id){
    $sql = "DELETE FROM casino WHERE casino_cat_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$casino_cat_id]);
	if ($executeQuery) {
		return true;
	}
}

function logAction($pdo, $action_type, $affected_id, $affected_type, $user) {
    $sql = "INSERT INTO action_logs (action_type, affected_id, affected_type, user) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$action_type, $affected_id, $affected_type, $user]);
}

function getAllActionLogs($pdo) {
    $sql = "SELECT * FROM action_logs ORDER BY timestamp DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    
    return $stmt->fetchAll();
}


function insertNewUser($pdo, $username, $password) {

	$checkUserSql = "SELECT * FROM user_passwords WHERE username = ?";
	$checkUserSqlStmt = $pdo->prepare($checkUserSql);
	$checkUserSqlStmt->execute([$username]);

	if ($checkUserSqlStmt->rowCount() == 0) {

		$sql = "INSERT INTO user_passwords (username,password) VALUES(?,?)";
		$stmt = $pdo->prepare($sql);
		$executeQuery = $stmt->execute([$username, $password]);

		if ($executeQuery) {
			$_SESSION['message'] = "User successfully inserted";
			return true;
		}

		else {
			$_SESSION['message'] = "An error occured from the query";
		}

	}
	else {
		$_SESSION['message'] = "User already exists";
	}

	
}



function loginUser($pdo, $username, $password) {
	$sql = "SELECT * FROM user_passwords WHERE username=?";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$username]); 

	if ($stmt->rowCount() == 1) {
		$userInfoRow = $stmt->fetch();
		$usernameFromDB = $userInfoRow['username']; 
		$passwordFromDB = $userInfoRow['password'];

		if ($password == $passwordFromDB) {
			$_SESSION['username'] = $usernameFromDB;
			$_SESSION['message'] = "Login successful!";
			return true;
		}

		else {
			$_SESSION['message'] = "Password is invalid, but user exists";
		}
	}

	
	if ($stmt->rowCount() == 0) {
		$_SESSION['message'] = "Username doesn't exist from the database. Please register first";
	}

}

function getAllUsers($pdo) {
	$sql = "SELECT * FROM user_passwords";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();

	if ($executeQuery) {
		return $stmt->fetchAll();
	}

}

function getUserByID($pdo, $user_id) {
	$sql = "SELECT * FROM user_passwords WHERE user_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$user_id]);
	if ($executeQuery) {
		return $stmt->fetch();
	}
}

?>