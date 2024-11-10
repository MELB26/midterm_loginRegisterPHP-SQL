

<?php 
require_once 'dbConfig.php'; 
require_once 'models.php';



if (isset($_POST['insertBusinessCategory'])) {
	$casino_name = ($_POST['casino_cat'] === 'Other') ? $_POST['custom_casino'] : $_POST['casino_cat'];
    $business_category = trim($_POST['casino_cat']);
    if (!empty($business_category)) {
        $query = insertNewCategory($pdo, $business_category, $added_by);

        if ($query) {
            header("Location: ../index.php");
            exit();
        } else {
            echo "Insert failed. Please try again.";
        }
    } else {
        echo "Make sure that all fields are filled.";
    }
};



if (isset($_POST['insertBusinessDetails'])) {
    $businessOwner = trim($_POST['customer_name']);
    $businessName = trim($_POST['date_added']);
    $branch = trim($_POST['business_branch']);
    $categoryId = trim($_POST['business_category']); 

    if (!empty($businessOwner) && !empty($businessName) && !empty($branch) && !empty($categoryId)) {
      
        $query = insertIntoUsersRecords($pdo, $businessOwner, $businessName, $branch, $categoryId);

        if ($query) {
            header("Location: ../index.php");
            exit();
        } else {
            echo "Insert failed. Please try again.";
        }
    } else {
        echo "Make sure that all fields are filled.";
    }
};

if (isset($_POST['editDetails'])) {
	$query = updateProject($pdo, $_POST['customer_name'], $_POST['Branch'], $_GET['customer_id']);

	if ($query) {
		header("Location: ../viewbusiness.php?casino_cat_id=".$_GET['casino_cat_id']);
	}
	else {
		echo "Update failed";
	}

}


if (isset($_POST['deletebusiness'])) {
	$query = deletebusiness($pdo, $_GET['customer_id']);

	if ($query) {
		header("Location: ../viewbusiness.php?casino_cat_id=".$_GET['casino_cat_id']);
	}
	else {
		echo "Deletion failed";
	}
}



if (isset($_POST['editCategory'])) {
	$query = updateCategory($pdo, $_POST['casino_cat'], $_GET['casino_cat_id']);

	if ($query) {
		header("Location: ../index.php");
	}

	else {
		echo "Update failed";;
	}

}


if (isset($_POST['deleteCategory'])) {
	$query = deleteCategory($pdo, $_GET['casino_cat_id']);

	if ($query) {
		header("Location: ../index.php");
	}

	else {
		echo "Delete failed";;
	}

}

if (isset($_POST['registerUserBtn'])) {

	$username = $_POST['username'];
	$password = sha1($_POST['password']);

	if (!empty($username) && !empty($password)) {

		$insertQuery = insertNewUser($pdo, $username, $password);

		if ($insertQuery) {
			header("Location: ../login.php");
		}
		else {
			header("Location: ../register.php");
		}
	}

	else {
		$_SESSION['message'] = "Please make sure the input fields 
		are not empty for registration!";

		header("Location: ../login.php");
	}

}




if (isset($_POST['loginUserBtn'])) {

	$username = $_POST['usernames'];
	$password = sha1($_POST['passwords']);

	if (!empty($username) && !empty($password)) {

		$loginQuery = loginUser($pdo, $username, $password);
	
		if ($loginQuery) {
			header("Location: ../index.php");
			$_SESSION['user'] = $username;
		}
		else {
			header("Location: ../login.php");
		}

	}

	else {
		$_SESSION['message'] = "Please make sure the input fields 
		are not empty for the login!";
		header("Location: ../login.php");
	}
 
}



if (isset($_GET['logoutAUser'])) {
	unset($_SESSION['username']);
	header('Location: ../login.php');
}

?>