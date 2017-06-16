<?php
	ob_start();
	session_start();
	$pageTitle = 'Profile';
	include 'init.php';
	if (isset($_SESSION['user'])) {
		$getUser = $con->prepare("SELECT * FROM users WHERE userName = ?");
		$getUser->execute(array($sessionUser));
		$info = $getUser->fetch();
		$userid = $info['UserID'];
?>
<h1 class="text-center">My Profile</h1>
<div class="information block">
	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">My Information</div>
			<div class="panel-body">
				<ul class="list-unstyled">
					<li>
						<i class="fa fa-unlock-alt fa-fw"></i>
						<span>Login Name</span> : <?php echo $info['userName'] ?>
					</li>
					<li>
						<i class="fa fa-envelope-o fa-fw"></i>
						<span>Email</span> : <?php echo $info['email'] ?>
					</li>
					<li>
						<i class="fa fa-user fa-fw"></i>
						<span> Phone</span> : <?php echo '0 '. $info['phone'] ?>
					</li>
		<?php /*	<li>
						<i class="fa fa-tags fa-fw"></i>
						<span>Fav Category</span> :
			 */	?>	</li>
				</ul>
			<?php //	<a href="#" class="btn btn-default">Edit Information</a>  ?>
			</div>
		</div>
	</div>
</div>
<?php /*
<div id="my-ads" class="my-ads block">
	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">My offers</div>
			<div class="panel-body">
			<?php
				$myItems = getAllFrom("*", "offer", "where userid = $userid", "", "offerID");
				if (! empty($myItems)) {
					echo '<div class="row">';
					foreach ($myItems as $item) {
						echo '<div class="col-sm-6 col-md-3">';
							echo '<div class="thumbnail item-box">';
							
								echo '<span class="price-tag">$' . $item['Price'] . '</span>';
								echo '<img class="img-responsive" src="img.png" alt="" />';
								echo '<div class="caption">';
									echo '<h3><a href="items.php?itemid='. $item['offerID'] .'">' . $item['offerName'] .'</a></h3>';
									echo '<p>' . $item['description'] . '</p>';
									echo '<div class="date">' . $item['start'] . '</div>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
					}
					echo '</div>';
				} else {
					echo 'Sorry There\' No Ads To Show, Create <a href="newad.php">New Ad</a>';
				}
			?>
			</div>
		</div>
	</div>
</div>
			 */	?>

<?php
	} else {
		header('Location: login.php');
		exit();
	}
	include $tpl . 'footer.php';
	ob_end_flush();
?>