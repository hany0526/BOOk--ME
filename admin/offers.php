<?php

	/*
	================================================
	== offers Page
	================================================
	*/

	ob_start(); // Output Buffering Start

	session_start();

	$pageTitle = 'offers';

	if (isset($_SESSION['Username'])) {

		include 'init.php';

		$do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

		if ($do == 'Manage') {


			$stmt = $con->prepare("SELECT 
										offer.*, 
										
										users.userName 
									FROM 
										offer
									INNER JOIN 
										users 
									ON 
										users.UserID = offer.hotelID
									ORDER BY 
										offerID DESC");


			// Execute The Statement

			$stmt->execute();

			// Assign To Variable 

			$items = $stmt->fetchAll();

			if (! empty($items)) {

			?>

			<h1 class="text-center">Manage offers</h1>
			<div class="container">
				<div class="table-responsive">
					<table class="main-table text-center table table-bordered">
						<tr>
							<td>ID</td>
							<td>Offer Name</td>
							<td>Hotel Name</td>
							<td>Price</td>
							<td>start</td>
							<td>End</td>
							<td>Description</td>
							<td>Control</td>
						</tr>
						<?php
							foreach($items as $item) {
								echo "<tr>";
									echo "<td>" . $item['offerID'] . "</td>";
									echo "<td>" . $item['offerName'] . "</td>";
									echo "<td>" . $item['userName'] . "</td>";
									echo "<td>" . $item['Price'].' $' . "</td>";
									echo "<td>" . $item['start'] ."</td>";
									echo "<td>" . $item['end'] ."</td>";
									echo "<td>" . $item['description'] ."</td>";
									echo "<td>
										<a href='offers.php?do=Edit&offerID=" . $item['offerID'] . "' class='btn btn-success'><i class='fa fa-edit'></i> Edit</a>
										<a href='offers.php?do=Delete&itemid=" . $item['offerID'] . "' class='btn btn-danger confirm'><i class='fa fa-close'></i> Delete </a>";
									echo "</td>";
								echo "</tr>";
							}
						?>
						<tr>
					</table>
				</div>
				<a href="offers.php?do=Add" class="btn btn-sm btn-primary">
					<i class="fa fa-plus"></i> New offer
				</a>
			</div>

			<?php } else {

				echo '<div class="container">';
					echo '<div class="nice-message">There\'s No offers To Show</div>';
					echo '<a href="offers.php?do=Add" class="btn btn-sm btn-primary">
							<i class="fa fa-plus"></i> New Item
						</a>';
				echo '</div>';

			} ?>

		<?php 

		} elseif ($do == 'Add') { ?>

			<h1 class="text-center">Add New offer</h1>
			<div class="container">
				<form class="form-horizontal" action="?do=Insert" method="POST">
					<!-- Start Name Field -->
					<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label">Name</label>
						<div class="col-sm-10 col-md-6">
							<input 
								type="text" 
								name="name" 
								class="form-control" 
								required="required"  
								placeholder="Name of The Item" />
						</div>
					</div>
					<!-- End Name Field -->
					
					<!-- Start Hotel Name Field -->
					<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label">Hotel Name</label>
						<div class="col-sm-10 col-md-6">
							<select name="userID">
								<option value="0">...</option>
								<?php
									$allCats = getAllFrom("*", "users", "where typeUserID = 2", "", "UserID");
									foreach ($allCats as $cat) {
										echo "<option value='" . $cat['UserID'] . "'>" . $cat['userName'] . "</option>";
									
									//	$childCats = getAllFrom("*", "users", "where parent = {$cat['ID']}", "", "ID");
									//	foreach ($childCats as $child) {
									//		echo "<option value='" . $child['ID'] . "'>--- " . $child['Name'] . "</option>";
									//	}
									}
								?>
							</select>
						</div>
					</div>
					<!-- End Hotel Name Field -->

					<!-- Start Price Field -->
					<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label">Price</label>
						<div class="col-sm-10 col-md-6">
							<input 
								type="text" 
								name="price" 
								class="form-control" 
								required="required" 
								placeholder="Price of The Item" />
						</div>
					</div>
					<!-- End Price Field -->
					
					<!-- Start dAte Field -->
					<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label">Start</label>
						<div class="col-sm-10 col-md-6">
							<input 
								type="date" 
								name="country" 
								class="form-control" 
								required="required" 
								placeholder="Country of Made" />
						</div>
					</div>
					<!-- End date Field -->

					<!-- Start dAte Field -->
					<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label">End</label>
						<div class="col-sm-10 col-md-6">
							<input 
							class="datepicker form-control"
							
								type="date" 
							
								class="datepicker form-control" 
								 
								placeholder="Country of Made" />
						</div>
					</div>
					<!-- End date Field -->

			<?php /*

					<!-- Start Status Field -->
					<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label">Status</label>
						<div class="col-sm-10 col-md-6">
							<select name="status">
								<option value="0">...</option>
								<option value="1">New</option>
								<option value="2">Like New</option>
								<option value="3">Used</option>
								<option value="4">Very Old</option>
							</select>
						</div>
					</div>
					<!-- End Status Field -->
				*/ 

		    ?>	
		    		<!-- Start Description Field -->
					<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label">Description</label>
						<div class="col-sm-10 col-md-6">
							<input 
								type="text" 
								name="description" 
								class="form-control" 
								required="required"  
								placeholder="Description of The Item" />
						</div>
					</div>
					<!-- End Description Field -->		
					<!-- Start Submit Field -->
					<div class="form-group form-group-lg">
						<div class="col-sm-offset-2 col-sm-10">
							<input type="submit" value="Add Offer" class="btn btn-primary btn-sm" />
						</div>
					</div>
					<!-- End Submit Field -->
				</form>
			</div>

			<?php

		} elseif ($do == 'Insert') {

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				echo "<h1 class='text-center'>Insert Offer</h1>";
				echo "<div class='container'>";

				// Get Variables From The Form

				$name		= $_POST['name'];
				$userID     = $_POST['userID'];
				$price 		= $_POST['price'];
				$desc 		= $_POST['description'];
				
				// Validate The Form

				$formErrors = array();

				if (empty($name)) {
					$formErrors[] = 'Name Can\'t be <strong>Empty</strong>';
				}

				if (empty($desc)) {
					$formErrors[] = 'Description Can\'t be <strong>Empty</strong>';
				}

				if (empty($price)) {
					$formErrors[] = 'Price Can\'t be <strong>Empty</strong>';
				}

				// Loop Into Errors Array And Echo It

				foreach($formErrors as $error) {
					echo '<div class="alert alert-danger">' . $error . '</div>';
				}

				// Check If There's No Error Proceed The Update Operation

				if (empty($formErrors)) {

					// Insert Userinfo In Database

					$stmt = $con->prepare("INSERT INTO 

						offer ( offerName , hotelID , Price, start , end , Description ,Approve )

						VALUES(:zname,    :zuserID ,:zprice , now(), now() , :zdesc , 1 )");

					$stmt->execute(array(

						'zname' 	=> $name,
						'zuserID'	=> $userID,
						'zprice' 	=> $price,
						'zdesc' 	=> $desc
					));

					// Echo Success Message

					$theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Inserted</div>';

					redirectHome($theMsg, 'back');

				}

			} else {

				echo "<div class='container'>";

				$theMsg = '<div class="alert alert-danger">Sorry You Cant Browse This Page Directly</div>';

				redirectHome($theMsg);

				echo "</div>";

			}

			echo "</div>";

		} elseif ($do == 'Edit') {

			// Check If Get Request item Is Numeric & Get Its Integer Value

			$offerID = isset($_GET['offerID']) && is_numeric($_GET['offerID']) ? intval($_GET['offerID']) : 0;

			// Select All Data Depend On This ID

			$stmt = $con->prepare("SELECT * FROM offer WHERE offerID = ?");

			// Execute Query

			$stmt->execute(array($offerID));

			// Fetch The Data

			$item = $stmt->fetch();

			// The Row Count

			$count = $stmt->rowCount();

			// If There's Such ID Show The Form

			if ($count > 0) { ?>

				<h1 class="text-center">Edit offer</h1>
				<div class="container">
					<form class="form-horizontal" action="" method="POST">
						
						<input type="hidden" name="offerID" value="<?php  echo $item['offerID'] ?>" />
						<!-- Start Name Field -->
						<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label">Offer Name</label>
							<div class="col-sm-10 col-md-6">
								<input 
									type="text" 
									name="name" 
									class="form-control" 
									required="required"  
									placeholder="Name of The Item"
									value="<?php echo $item['offerName'] ?>" />
							</div>
						</div>
						<!-- End Name Field -->
						<!-- Start Description Field -->
						<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label">Description</label>
							<div class="col-sm-10 col-md-6">
								<input 
									type="text" 
									name="description" 
									class="form-control" 
									required="required"  
									placeholder="Description of The Item"
									value="<?php echo $item['description'] ?>" />
							</div>
						</div>
						<!-- End Description Field -->
						<!-- Start Price Field -->
						<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label">Price</label>
							<div class="col-sm-10 col-md-6">
								<input 
									type="text" 
									name="price" 
									class="form-control" 
									required="required" 
									placeholder="Price of The Item"
									value="<?php echo $item['Price'] ?>" />
							</div>
						</div>
						<!-- End Price Field -->
						<!-- Start start Field -->
						<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label">Start</label>
							<div class="col-sm-10 col-md-6">
								<input 
									type="text" 
									name="start" 
									class="form-control" 
									required="required" 
									placeholder=""
									value="<?php echo $item['start'] ?>" />
							</div>
						</div>
						<!-- End start Field -->

						<!-- Start end Field -->
						<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label">End</label>
							<div class="col-sm-10 col-md-6">
								<input 
									type="text" 
									name="country" 
									class="form-control" 
									required="required" 
									placeholder="Country of Made"
									value="<?php echo $item['end'] ?>" />
							</div>
						</div>
						<!-- End end Field -->

						<!-- Start nouser Field -->
						<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label">Namber Of Users</label>
							<div class="col-sm-10 col-md-6">
								<input 
									type="text" 
									name="noUser" 
									class="form-control" 
									required="required" 
									placeholder="Country of Made"
									value="<?php echo $item['noUser'] ?>" />
							</div>
						</div>
						<!-- End nouser Field -->

						<!-- Start Submit Field -->
						<div class="form-group form-group-lg">
							<div class="col-sm-offset-2 col-sm-10">
								<input type="submit" value="Save offer" class="btn btn-primary btn-sm" />
							</div>
						</div>
						<!-- End Submit Field -->
					</form>

			<?php

			// If There's No Such ID Show Error Message

			} else {

				echo "<div class='container'>";

				$theMsg = '<div class="alert alert-danger">Theres No Such ID</div>';

				redirectHome($theMsg);

				echo "</div>";

			}			

		} elseif ($do == 'Update') {

			echo "<h1 class='text-center'>Update Offer</h1>";
			echo "<div class='container'>";

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				// Get Variables From The Form

				$id 		= $_POST['offerID'];
				$name 		= $_POST['name'];
				$desc 		= $_POST['description'];
				$price 		= $_POST['price'];
				$start 	    = $_POST['start'];
				$end 	    = $_POST['end'];
				$nouser  	= $_POST['noUser'];

				// Validate The Form

				$formErrors = array();

				if (empty($name)) {
					$formErrors[] = 'Name Can\'t be <strong>Empty</strong>';
				}

				if (empty($desc)) {
					$formErrors[] = 'Description Can\'t be <strong>Empty</strong>';
				}

				if (empty($price)) {
					$formErrors[] = 'Price Can\'t be <strong>Empty</strong>';
				}

				if (empty($start)) {
					$formErrors[] = 'Country Can\'t be <strong>Empty</strong>';
				}


				if ($nouser == 0) {
					$formErrors[] = 'You Must Choose the <strong>Member</strong>';
				}

			

				// Loop Into Errors Array And Echo It

				foreach($formErrors as $error) {
					echo '<div class="alert alert-danger">' . $error . '</div>';
				}

				// Check If There's No Error Proceed The Update Operation

				if (empty($formErrors)) {

					// Update The Database With This Info

					$stmt = $con->prepare("UPDATE 
												items 
											SET 
												Name = ?, 
												Description = ?, 
												Price = ?, 
												Country_Made = ?,
												Status = ?,
												Cat_ID = ?,
												Member_ID = ?,
												tags = ?
											WHERE 
												Item_ID = ?");

					$stmt->execute(array($name, $desc, $price, $country, $status, $cat, $member, $tags, $id));

					// Echo Success Message

					$theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Updated</div>';

					redirectHome($theMsg, 'back');

				}

			} else {

				$theMsg = '<div class="alert alert-danger">Sorry You Cant Browse This Page Directly</div>';

				redirectHome($theMsg);

			}

			echo "</div>";

		} elseif ($do == 'Delete') {

			echo "<h1 class='text-center'>Delete Item</h1>";
			echo "<div class='container'>";

				// Check If Get Request Item ID Is Numeric & Get The Integer Value Of It

				$itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;

				// Select All Data Depend On This ID

				$check = checkItem('offerID', 'offer', $itemid);

				// If There's Such ID Show The Form

				if ($check > 0) {

					$stmt = $con->prepare("DELETE FROM offer WHERE offerID = :zid");

					$stmt->bindParam(":zid", $itemid);

					$stmt->execute();

					$theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Deleted</div>';

					redirectHome($theMsg, 'back');

				} else {

					$theMsg = '<div class="alert alert-danger">This ID is Not Exist</div>';

					redirectHome($theMsg);

				}

			echo '</div>';

		} elseif ($do == 'Approve') {

			echo "<h1 class='text-center'>Approve Item</h1>";
			echo "<div class='container'>";

				// Check If Get Request Item ID Is Numeric & Get The Integer Value Of It

				$itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;

				// Select All Data Depend On This ID

				$check = checkItem('Item_ID', 'items', $itemid);

				// If There's Such ID Show The Form

				if ($check > 0) {

					$stmt = $con->prepare("UPDATE items SET Approve = 1 WHERE Item_ID = ?");

					$stmt->execute(array($itemid));

					$theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Updated</div>';

					redirectHome($theMsg, 'back');

				} else {

					$theMsg = '<div class="alert alert-danger">This ID is Not Exist</div>';

					redirectHome($theMsg);

				}

			echo '</div>';

		}

		include $tpl . 'footer.php';

	} else {

		header('Location: index.php');

		exit();
	}

	ob_end_flush(); // Release The Output

?>