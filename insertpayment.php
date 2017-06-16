<?php // echo "string";
	ob_start(); // Output Buffering Start

	session_start();

	$pageTitle = 'payment';

	if (isset($_SESSION['user'])) {

		include 'init.php';

		$do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

		// Start Manage Page

		if ($do == 'insert') { 
		//	echo "string";
			if ($_SERVER['REQUEST_METHOD'] == 'GET') {

				echo "<h1 class='text-center'>Insert offer</h1>";
				echo "<div class='container'>";
				
				$userID  = $_SESSION['uid'];

				$offerID = $_GET['offerID'];

		// Check If User Exist in Database
		
		$statement = $con->prepare("SELECT userID FROM payments WHERE offerID = ?");

		$statement->execute(array($offerID));

		$check = $statement->rowCount();

					$check = checkItem("userID", "payments", $userID);

					if ($check == 2) {

		$theMsg = '<div class="alert alert-danger">Sorry This User recourded this offer</div>';

						redirectHome($theMsg, 'back');

					} else {

						// Insert Userinfo In Database

			$stmt = $con->prepare(" INSERT INTO `payments` (  `offerID`, `userID`)

			 VALUES ( $offerID , $userID );");
					
			$stmt->execute();

			$theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Inserted</div>';

					redirectHome($theMsg, 'back');

			}

}
	include $tpl . 'footer.php';
} else {

		header('Location: index.php');

		exit();
	}

	ob_end_flush(); // Release The Output
 }?>
