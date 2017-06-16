<?php

	/*
	================================================
	== Manage Members Page
	== You Can Add | Edit | Delete Members From Here
	================================================
	*/

	ob_start(); // Output Buffering Start

	session_start();

	$pageTitle = 'Members';

	if (isset($_SESSION['Username'])) {

		include 'init.php';

		$do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

		// Start Manage Page

		if ($do == 'Manage') { // Manage Members Page

			$query = '';

			if (isset($_GET['page']) && $_GET['page'] == 'Pending') {

				$query = 'AND RegStatus = 0';

			}

			// Select All Users Except Admin 

			$stmt = $con->prepare("SELECT users.* , typeuser.typeName
			 FROM users 
			 INNER JOIN typeuser	 ON typeuser.typeUserID = users.typeUserID 
			
			");
  // typeUserID != 9 $query ORDER BY UserID DESC
			// Execute The Statement

			$stmt->execute();

			// Assign To Variable 

			$rows = $stmt->fetchAll();

			if (! empty($rows)) {

			?>

			<h1 class="text-center">Manage Members</h1>
			<div class="container">
				<div class="table-responsive">
					<table class="main-table memo  text-center  table table-bordered">
						<tr>
							<td>ID</td>
							<td>Type User</td>
							<td>Avatar</td>
							<td>User Name</td>
							<td>Email</td>
							<td>Type User</td>
							<td>Phone</td>
							<td>Control</td>
						</tr>
						<?php
							foreach($rows as $row) {
								echo "<tr>";
									echo "<td>" . $row['UserID'] . "</td>";
									echo "<td>" . $row['typeName'] . "</td>";
									echo "<td>";
									if (empty($row['avatar'])) {
										echo "No Image";
									} else {
									echo "<img src='uploads/avatar/ ". $row['avatar'] . " ' alt='' /></td>";
											}
									echo "<td>" . $row['userName'] . "</td>";
									echo "<td>" . $row['email'] . "</td>";
									echo "<td>" . $row['typeUserID'] . "</td>";
									echo "<td>" . $row['phone'] ."</td>";
									echo "<td>
										<a href='members.php?do=Edit&userid=" . $row['UserID'] . "' class='btn btn-success'><i class='fa fa-edit'></i> Edit</a>
										<a href='members.php?do=Delete&userid=" . $row['UserID'] . "' class='btn btn-danger confirm'><i class='fa fa-close'></i> Delete </a>";
										if ($row['RegStatus'] == 0) {
											
											echo "<a href='members.php?do=Activate&userid=" . $row['UserID'] . 
											
											"' class='btn btn-info activate'>
											
											<i class='fa fa-check'></i> Activate</a>";
										}
									echo "</td>";
								echo "</tr>";
							}
						?>
						<tr>
					</table>
				</div>
				<a href="members.php?do=Add" class="btn btn-primary">
					<i class="fa fa-plus"></i> New Member
				</a>
			</div>

			<?php } else {

				echo '<div class="container">';
					echo '<div class="nice-message">There\'s No Members To Show</div>';
					echo '<a href="members.php?do=Add" class="btn btn-primary">
							<i class="fa fa-plus"></i> New Member
						</a>';
				echo '</div>';

			} ?>

		<?php 

		} elseif ($do == 'Add') { // Add Page ?>

			<h1 class="text-center">Add New Member</h1>
			<div class="container">
				<form class="form-horizontal" action="?do=Insert" method="POST" enctype="multipart/form-data" >

				    <!-- Start type Field -->
					<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label">Type User</label>
						<div class="col-sm-10 col-md-6">
							<select name="typeUserID">
								<option class="text-center" value="o">        </option>
								<option class="text-center" value="1">traveler</option>
								<option class="text-center" value="2">manger</option>
								<option class="text-center" value="3">admin</option>
							</select>
						</div>
					</div>
					<!-- End Status Field -->
					<!-- Start Username Field -->
					<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label">New Name</label>
						<div class="col-sm-10 col-md-6">
							<input type="text" name="username" class="form-control" autocomplete="off" required="required" placeholder="Username To Login Into Shop" />
						</div>
					</div>
 					<!-- End Username Field -->
				
					<!-- Start Email Field -->
					<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label">Email</label>
						<div class="col-sm-10 col-md-6">
							<input type="email" name="email" class="form-control" required="required" placeholder="Email Must Be Valid" />
						</div>
					</div>
					<!-- End Email Field -->
					<!-- Start Password Field -->
					<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label">Password</label>
						<div class="col-sm-10 col-md-6">
							<input type="password" name="password" class="password form-control" required="required" autocomplete="new-password" placeholder="Password Must Be Hard & Complex" />
							<i class="show-pass fa fa-eye fa-2x"></i>
						</div>
					</div>
					<!-- End Password Field -->

					<!-- Start phone Field -->
					<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label">Phone</label>
						<div class="col-sm-10 col-md-6">
							<input type="text" name="phone" class="form-control" required="required" placeholder="Full Name Appear In Your Profile Page" />
						</div>
					</div>
					<!-- End phone Field -->
					


					<!-- Start location Field -->
					<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label">Location</label>
						<div class="col-sm-10 col-md-6">
							<input type="text" name="location" class="form-control" required="required" placeholder="Full Name Appear In Your Profile Page" />
						</div>
					</div>
					<!-- End location Field -->
					<!-- Start avatar Field -->
					<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label">New avatar</label>
						<div class="col-sm-2 col-md-3">
							<input type="file" value="x" name="avatar" class="form-control" autocomplete="off"  placeholder="please add image "/>
						</div>
					</div>
 					<!-- End avatar Field -->
					<!-- Start Submit Field -->
					<div class="form-group form-group-lg">
						<div class="col-sm-offset-2 col-sm-10">
							<input type="submit" value="Add Member" class="btn btn-primary btn-lg" />
						</div>
					</div>
					<!-- End Submit Field -->

				</form>
			</div>

		<?php 

		} elseif ($do == 'Insert') {

			// Insert Member Page

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				echo "<h1 class='text-center'>Insert Member</h1>";
				echo "<div class='container'>";


					$avatar 	 = $_FILES['avatar'];
						
					//	 print_r($avatar); 	// Array ( [name] => xamarin.png [type] => image/png [tmp_name] => C:\xampp\tmp\phpBA0.tmp [error] => 0 [size] => 402909 ) 
					
					//		echo  ' <br><br> ' . $_FILES['avatar']['name'] . '<br>' ;
					
					// Get Variables From The Form

				$avatarName  =  $_FILES['avatar']['name'];
				$avatarType  =  $_FILES['avatar']['type'];
				$avatarTemp  =  $_FILES['avatar']['tmp_name'];
				$avatarSize  =  $_FILES['avatar']['size'];

		   		$avatarAllowedExtention  = array("png" , "jpg" , "gif" ,"jpeg");
   				
                @$avatarExtention  = end(explode('.',$avatarName));
				 
				// print_r($avatarExtention);
				
               if(in_array($avatarExtention, $avatarAllowedExtention) ) 
                {
               // 	echo "<br>good";
                }
  
			// 	echo "<br> ///// <br> ".  $avatarName . '<br>'. $avatarType . "<br>  ".  $avatarTemp . '<br>' . $avatarSize ;

				$typeUserID  =  $_POST['typeUserID'];
				$user        =  $_POST['username'];
				$email 		 =  $_POST['email'];
				$pass 		 =  $_POST['password'];
				$hashPass    =  sha1($_POST['password']);
				$phone 	     =  $_POST['phone'];
				$location    =  $_POST['location'];
			

				// Validate The Form

				$formErrors = array();

     /*			if (strlen($user) < 4) {
					$formErrors[] = 'Username Cant Be Less Than <strong>4 Characters</strong>';
				}

				if (strlen($user) > 20) {
					$formErrors[] = 'Username Cant Be More Than <strong>20 Characters</strong>';
				}
*/
				if (empty($user)) {
					$formErrors[] = 'Username Cant Be <strong>Empty</strong>';
				}

				if (empty($pass)) {
					$formErrors[] = 'Password Cant Be <strong>Empty</strong>';
				}

				if (empty($phone)) {
					$formErrors[] = 'phone Cant Be <strong>Empty</strong>';
				}

				if (empty($email)) {
					$formErrors[] = 'Email Cant Be <strong>Empty</strong>';
				}
				if (empty($location)) {
					$formErrors[] = 'location Cant Be <strong>Empty</strong>';
				}
                if (empty($typeUserID)) {
					$formErrors[] = 'type User Cant Be <strong>Empty</strong>';
				}
				if(!empty($avatarName) && !in_array($avatarExtention, $avatarAllowedExtention) ) 
                {
                	$formErrors[] = 'this extention dont  <strong>Allowed</strong>';
                }
                 if (empty($avatarName)) {
					$formErrors[] = 'avatar Cant Be <strong>Empty</strong>';
				}
				  if ( $avatarSize  > 4444444 ) {
					$formErrors[] = 'avatar size lage than <strong>4MG</strong>';
				}



				// Loop Into Errors Array And Echo It

				foreach($formErrors as $error) {
					echo '<div class="alert alert-danger">' . $error . '</div>';
				}

				// Check If There's No Error Proceed The Update Operation

				if (empty($formErrors)) {

					$avatar =  rand(0 , 100000). '_' . $avatarName;
					
					move_uploaded_file($avatarTemp , "uploads\avatar\ " . $avatar );

					// Check If User Exist in Database

					$check = checkItem("Username", "users", $user);

					if ($check == 1) {

						$theMsg = '<div class="alert alert-danger">Sorry This User Is Exist</div>';

						redirectHome($theMsg, 'back');

					} else {

						// Insert Userinfo In Database

			$stmt = $con->prepare("INSERT INTO `users` (`UserID`, `typeUserID`, `userName`, `email`, `password`, `phone` , `location` , `RegStatus`, `avatar`)

					               VALUES (NULL , '2', :zuser, :zmail , :zpass, :zphone , :zloc , '1', :zavatar );");
					$stmt->execute(array(

						'zuser'   => $user,
						'zmail'   => $email,
						'zpass'   => $hashPass,
						'zphone'  => $phone,
					    'zloc'    => $location,
					    'zavatar' => $avatar 
					));

						// Echo Success Message

				$theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Inserted</div>';

					redirectHome($theMsg, 'back');
					
				}

				}   
				

			} else {

				echo "<div class='container'>";

				$theMsg = '<div class="alert alert-danger">Sorry You Cant Browse This Page Directly</div>';

				redirectHome($theMsg);

				echo "</div>";

			}

			echo "</div>";

		} elseif ($do == 'Edit') {

			// Check If Get Request userid Is Numeric & Get Its Integer Value

			$userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;

			// Select All Data Depend On This ID

			$stmt = $con->prepare("SELECT * FROM users WHERE UserID = ? LIMIT 1");

			// Execute Query

			$stmt->execute(array($userid));

			// Fetch The Data

			$row = $stmt->fetch();

			// The Row Count

			$count = $stmt->rowCount();

			// If There's Such ID Show The Form

			if ($count > 0) { ?>

				<h1 class="text-center">Edit Member</h1>
				<div class="container">
					<form class="form-horizontal" action="?do=Update" method="POST">
						<input type="hidden" name="userid" value="<?php echo $userid ?>" />
						
						<!-- Start Username Field -->
						<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label">User Name</label>
							<div class="col-sm-10 col-md-6">
								<input type="text" name="username" class="form-control" value="<?php echo $row['userName'] ?>" autocomplete="off" required="required" />
							</div>
						</div>
						<!-- End Username Field -->
						<!-- Start Password Field -->
						<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label">Password</label>
							<div class="col-sm-10 col-md-6">
								<input type="hidden" name="oldpassword" value="<?php echo $row['Password'] ?>" />
								<input type="password" name="newpassword" class="form-control" autocomplete="new-password" placeholder="Leave Blank If You Dont Want To Change" />
							</div>
						</div>
						<!-- End Password Field -->
						<!-- Start Email Field -->
						<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label">Email</label>
							<div class="col-sm-10 col-md-6">
								<input type="email" name="email" value="<?php echo $row['email'] ?>" class="form-control" required="required" />
							</div>
						</div>
						<!-- End Email Field -->
						
						<!-- Start phone Field -->
						<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label">phone</label>
							<div class="col-sm-10 col-md-6">
								<input type="text" name="full" value="<?php echo $row['phone'] ?>" class="form-control" required="required" />
							</div>
						</div>
						<!-- End phone Field -->

							<!-- Start Location Field -->
						<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label">Location</label>
							<div class="col-sm-10 col-md-6">
								<input type="text" name="full" value="<?php echo $row['location'] ?>" class="form-control" required="required" />
							</div>
						</div>
						<!-- End location Field -->
						
						<!-- Start Submit Field -->
						<div class="form-group form-group-lg">
							<div class="col-sm-offset-2 col-sm-10">
								<input type="submit" value="Save" class="btn btn-primary btn-lg" />
							</div>
						</div>
						<!-- End Submit Field -->
					</form>
				</div>

			<?php

			// If There's No Such ID Show Error Message

			} else {

				echo "<div class='container'>";

				$theMsg = '<div class="alert alert-danger">Theres No Such ID</div>';

				redirectHome($theMsg);

				echo "</div>";

			}

		} elseif ($do == 'Update') { // Update Page

			echo "<h1 class='text-center'>Update Member</h1>";
			echo "<div class='container'>";

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				// Get Variables From The Form

				$id 	= $_POST['userid'];
				$user 	= $_POST['username'];
				$email 	= $_POST['email'];
				$name 	= $_POST['full'];

				// Password Trick

				$pass = empty($_POST['newpassword']) ? $_POST['oldpassword'] : sha1($_POST['newpassword']);

				// Validate The Form

				$formErrors = array();

				if (strlen($user) < 4) {
					$formErrors[] = 'Username Cant Be Less Than <strong>4 Characters</strong>';
				}

				if (strlen($user) > 20) {
					$formErrors[] = 'Username Cant Be More Than <strong>20 Characters</strong>';
				}

				if (empty($user)) {
					$formErrors[] = 'Username Cant Be <strong>Empty</strong>';
				}

				if (empty($name)) {
					$formErrors[] = 'Full Name Cant Be <strong>Empty</strong>';
				}

				if (empty($email)) {
					$formErrors[] = 'Email Cant Be <strong>Empty</strong>';
				}

				// Loop Into Errors Array And Echo It

				foreach($formErrors as $error) {
					echo '<div class="alert alert-danger">' . $error . '</div>';
				}

				// Check If There's No Error Proceed The Update Operation

				if (empty($formErrors)) {

					$stmt2 = $con->prepare("SELECT 
												*
											FROM 
												users
											WHERE
												Username = ?
											AND 
												UserID != ?");

					$stmt2->execute(array($user, $id));

					$count = $stmt2->rowCount();

					if ($count == 1) {

						$theMsg = '<div class="alert alert-danger">Sorry This User Is Exist</div>';

						redirectHome($theMsg, 'back');

					} else { 

						// Update The Database With This Info

						$stmt = $con->prepare("UPDATE users SET userName = ?, email = ?,phone  = ?, Password = ? WHERE UserID = ?");

						$stmt->execute(array($user, $email, $name, $pass, $id));

						// Echo Success Message

						$theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Updated</div>';

						redirectHome($theMsg, 'back');

					}

				}

			} else {

				$theMsg = '<div class="alert alert-danger">Sorry You Cant Browse This Page Directly</div>';

				redirectHome($theMsg);

			}

			echo "</div>";

		} elseif ($do == 'Delete') { // Delete Member Page

			echo "<h1 class='text-center'>Delete Member</h1>";
			echo "<div class='container'>";

				// Check If Get Request userid Is Numeric & Get The Integer Value Of It

				$userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;

				// Select All Data Depend On This ID

				$check = checkItem('userid', 'users', $userid);

				// If There's Such ID Show The Form

				if ($check > 0) {

					$stmt = $con->prepare("DELETE FROM users WHERE UserID = :zuser");

					$stmt->bindParam(":zuser", $userid);

					$stmt->execute();

					$theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Deleted</div>';

					redirectHome($theMsg, 'back');

				} else {

					$theMsg = '<div class="alert alert-danger">This ID is Not Exist</div>';

					redirectHome($theMsg);

				}

			echo '</div>';

		} elseif ($do == 'Activate') {

			echo "<h1 class='text-center'>Activate Member</h1>";
			echo "<div class='container'>";

				// Check If Get Request userid Is Numeric & Get The Integer Value Of It

				$userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;

				// Select All Data Depend On This ID

				$check = checkItem('userid', 'users', $userid);

				// If There's Such ID Show The Form

				if ($check > 0) {

					$stmt = $con->prepare("UPDATE users SET RegStatus = 1 WHERE UserID = ?");

					$stmt->execute(array($userid));

					$theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Updated</div>';

					redirectHome($theMsg);

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