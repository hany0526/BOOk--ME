<?php
	ob_start();
	session_start();
	$pageTitle = 'Create New offer';
	include 'init.php';
	if (isset($_SESSION['user'])) {

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			$formErrors = array();

			$name 		= filter_var($_POST['name'], FILTER_SANITIZE_STRING);
			$desc 		= filter_var($_POST['description'], FILTER_SANITIZE_STRING);
			$price 		= filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_INT);
			$start 		= filter_var($_POST['start'], FILTER_SANITIZE_NUMBER_INT);
			$end 		= filter_var($_POST['end'], FILTER_SANITIZE_NUMBER_INT);
			$tags 		= filter_var($_POST['tags'], FILTER_SANITIZE_STRING);

			if (strlen($name) < 4) {

				$formErrors[] = 'Item Title Must Be At Least 4 Characters';

			}

			if (strlen($desc) < 10) {

				$formErrors[] = 'Item Description Must Be At Least 10 Characters';

			}


			if (empty($price)) {

				$formErrors[] = 'offer Price Cant Be Empty';

			}

			if (empty($start)) {

				$formErrors[] = 'offer Status Cant Be Empty';

			}

			if (empty($end)) {

				$formErrors[] = 'offer Category Cant Be Empty';

			}

			// Check If There's No Errozr Proceed The Update Operation

			if (empty($formErrors)) {

				// Insert Userinfo In Database
				$x = $_SESSION["uid"] ;
		
				$stmt = $con->prepare("INSERT INTO
				   `offer` ( `offerName`, `hotelID`, `Price`, `start`, `end`, `description`, `Approve`) 
					 VALUES( :zname , $x   , :zprice, :zstart , :zend , :zdesc , '0' );");

				$stmt->execute(array(

					'zname' 	=> $name,
					'zprice' 	=> $price,
					'zstart' 	=> $start,
					'zend' 		=> $end,
					'zdesc'		=> $desc

				));

				// Echo Success Message

				if ($stmt) {

					$succesMsg = 'offer Has Been Added';
					
				}

			}

		}

?>
<h1 class="text-center"><?php echo $pageTitle ?></h1>
<div class="create-ad block">
	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading"><?php echo $pageTitle ?></div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-8">



						<form class="form-horizontal main-form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
							<!-- Start Name Field -->
							<div class="form-group form-group-lg">
								<label class="col-sm-3 control-label">Name</label>
								<div class="col-sm-10 col-md-9">
									<input 
										pattern=".{4,}"
										title="This Field Require At Least 4 Characters"
										type="text" 
										name="name" 
										class="form-control live"  
										placeholder="Name of The offer"
										data-class=".live-title"
										required />
								</div>
							</div>
							<!-- End Name Field -->
							
						
						
							<!-- Start Description Field -->
							<div class="form-group form-group-lg">
								<label class="col-sm-3 control-label">Description</label>
								<div class="col-sm-10 col-md-9">
									<input 
										pattern=".{10,}"
										title="This Field Require At Least 10 Characters"
										type="text" 
										name="description" 
										class="form-control live"   
										placeholder="Description of The offer" 
										data-class=".live-desc"
										required />
								</div>
							</div>
							<!-- End Description Field -->
							<!-- Start Price Field -->
							<div class="form-group form-group-lg">
								<label class="col-sm-3 control-label">Price</label>
								<div class="col-sm-10 col-md-9">
									<input 
										type="text" 
										name="price" 
										class="form-control live" 
										placeholder="Price of The offer" 
										data-class=".live-price" 
										required />
								</div>
							</div>
							<!-- End Price Field -->
						
							<!-- Start start Field -->
							<div class="form-group form-group-lg">
								<label class="col-sm-3 control-label">Start</label>
								<div class="col-sm-10 col-md-9">
									<input 
										data-type="DATE"
										name="start" 
										class="form-control live" 
										
										data-class=".live-price" 
										required />
								</div>
							</div>
							<!-- End start Field -->
							<!-- Start end Field -->
							<div class="form-group form-group-lg">
								<label class="col-sm-3 control-label">END</label>
								<div class="col-sm-10 col-md-9">
									<input 
										type="text" 
										name="end" 
										class="form-control live" 
										
										data-class=".live-price" 
										required />
								</div>
							</div>
							<!-- End start Field -->


<?php  /*
							<!-- Start Categories Field -->
							<div class="form-group form-group-lg">
								<label class="col-sm-3 control-label">Category</label>
								<div class="col-sm-10 col-md-9">
									<select name="category" required>
										<option value="">...</option>
										<?php
											$cats = getAllFrom('*' ,'categories', '', '', 'ID');
											foreach ($cats as $cat) {
												echo "<option value='" . $cat['ID'] . "'>" . $cat['Name'] . "</option>";
											}
										?>
									</select>
								</div>
							</div>
							<!-- End Categories Field -->
*/ ?>
							<!-- Start Tags Field -->
							<div class="form-group form-group-lg">
								<label class="col-sm-3 control-label">Tags</label>
								<div class="col-sm-10 col-md-9">
									<input 
										type="text" 
										name="tags" 
										class="form-control" 
										placeholder="Separate Tags With Comma (,)" />
								</div>
							</div>
							<!-- End Tags Field -->
							<!-- Start Submit Field -->
							<div class="form-group form-group-lg">
								<div class="col-sm-offset-3 col-sm-9">
									<input type="submit" value="Add Item" class="btn btn-primary btn-sm" />
								</div>
							</div>
							<!-- End Submit Field -->
						</form>
					</div>
					<div class="col-md-4">
						<div class="thumbnail item-box live-preview">
							<span class="price-tag">
								$<span class="live-price">0</span>
							</span>
							<img class="img-responsive" src="img.png" alt="" />
							<div class="caption">
								<h3 class="live-title">Title</h3>
								<p class="live-desc">Description</p>
							</div>
						</div>
					</div>
				</div>
				<!-- Start Loopiong Through Errors -->
				<?php 
					if (! empty($formErrors)) {
						foreach ($formErrors as $error) {
							echo '<div class="alert alert-danger">' . $error . '</div>';
						}
					}
					if (isset($succesMsg)) {
						echo '<div class="alert alert-success">' . $succesMsg . '</div>';
					}
				?>
				<!-- End Loopiong Through Errors -->
			</div>
		</div>
	</div>
</div>
<?php
	} else {
		header('Location: login.php');
		exit();
	}
	include $tpl . 'footer.php';
	ob_end_flush();
?>