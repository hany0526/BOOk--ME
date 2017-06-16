<?php
	ob_start();
	session_start();
	$pageTitle = 'Show Profile Hotel';
	include 'init.php';

	// Check If Get Request offer Is Numeric & Get Its Integer Value hotelid
	
	$hotelid = isset($_GET['hotelid']) && is_numeric($_GET['hotelid']) ? intval($_GET['hotelid']) : 0;

	// Select All Data Depend On This ID
	$stmt = $con->prepare("SELECT *	FROM users WHERE userID = ? AND typeUserID = 2 ");

	// Execute Query
	$stmt->execute(array($hotelid));

	$count = $stmt->rowCount();
	
	if ($count > 0) {

	// Fetch The Data
	$info = $stmt->fetch();
	   
	?>
<h1 class="text-center">Profile Hotel <?php echo $info['userName']; ?></h1>
<div class="information block">
	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading text-center">Informations</div>
			<div class="panel-body">
				<ul class="list-unstyled">
					<li class="text-centet" >
						<i class="fa fa-user fa-fw"></i>
						<span> Name</span> : <?php echo $info['userName'] ?>
					</li>
					<li>
						<i class="fa fa-envelope-o fa-fw"></i>
						<span>Email</span> : <?php echo $info['email'] ?>
					</li>
					<li>
						<i class="fa fa-tags fa-fw"></i>
						<span>Location</span> : <?php echo $info['location'] ?>
					</li>
					<li>
						<i class="fa fa-user fa-fw"></i>
						<span> Phone</span> : <?php echo '0'. $info['phone'] ?>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
 <?php
 	} else {
		echo '<div class="container">';
			echo '<div class="alert alert-danger">There\'s no Such ID Or This hotel Is Waiting Approval</div>';
		echo '</div>';
	}


	$stmt = $con->prepare("SELECT *	FROM offer WHERE hotelID = ? AND approve = 1  ");

	// Execute Query
	$stmt->execute(array($hotelid));

	$count = $stmt->rowCount();
	
	if ($count > 0) {

	// Fetch The Data
	$info = $stmt->fetch();
	
	?>

  <!-- Start Section Price Table -->
        
        <section class="price_table text-center">

            <div class="container">
                
                <h2 class="h1">Our Amazing Prices</h2><br>
      
              
					 <form class="form-horizontal" action="?do=Insert" method="GET" >
					 	  <div class="row">      
					  <div class="col-lg-3 col-sm-6 col-xs-12">
                        <div class="price_box wow fadeInUp" data-wow-duration="2s" data-wow-offset="400">
                            <h2 class="text-info"> <?php echo $info['offerName']; ?></h2>
                            <p class="center-block  ">$<?php echo $info['Price']; ?></p>
                            <ul class="list-unstyled">
                                <li>Space : <?php echo $info['noUser']; ?> Users</li>
                                <li>Start :<?php echo $info['start']; ?></li>
                                <li>End : <?php echo $info['end']; ?></li>
                                <li><?php echo $info['description']; ?></li>
                            </ul>
<?php echo "<a href='insertpayment.php?do=insert&offerID=" . $info['offerID'] . "'
			 class='btn btn-info'> Order Now</a>"; 
?>
                        </div>
                    </div>
                   </form> 
                </div>
            </div>
        </section>
        
        <!-- End Section Price Table -->
 
 	<?php } 
 
 	else {
		echo '<div class="container">';
			echo '<div class="alert alert-danger text-center">There\'s no Offer in This hotel or Is Waiting Approval</div>';
		echo '</div>';
	}
    

	include $tpl . 'footer.php';
	ob_end_flush();
?>
