<?php
	ob_start();
	session_start();
	$pageTitle = 'Homepage';
	include 'init.php';
?>
<div class="container">
	<div class="row"> <br><br>

		<?php /*
			$allItems = getAllFrom('*', 'items', 'where Approve = 1', '', 'Item_ID');
			foreach ($allItems as $item) {
				echo '<div class="col-sm-6 col-md-3">';
					echo '<div class="thumbnail item-box">';
						echo '<span class="price-tag">$' . $item['Price'] . '</span>';
						echo '<img class="img-responsive" src="img.png" alt="" />';
						echo '<div class="caption">';
							echo '<h3><a href="items.php?itemid='. $item['Item_ID'] .'">' . $item['Name'] .'</a></h3>';
							echo '<p>' . $item['Description'] . '</p>';
							echo '<div class="date">' . $item['Add_Date'] . '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			}
		*/ ?>
<?php
  $allHotels = getAllFrom('*', 'users', 'where typeUserID = 2', '', 'userID');
    
    foreach ($allHotels as $hotel ) {

     echo  '<div class="card-box col-md-4 col-sm-6"> <div class="card"> <div class="header">';     
                
        echo   '<img src=" '. "admin/uploads/avatar/" . 'x.jpg" />';
                        
        echo   '<div class="container social-line social-line-visible" data-buttons="4">
               
                     <button class="btn btn-social  btn-facebook">
                       <i class="fa fa-facebook"></i>    </button>
                       
                     <button class="btn btn-social   btn-twitter">
                       <i class="fa fa-twitter"></i>     </button>
                      
				             <button class="btn btn-social btn-pinterest">
                       <i class="fa fa-pinterest"></i>   </button>
                           
                     <button class="btn btn-social    btn-google">
                       <i class="fa fa-google-plus"></i> </button>';
                      
        echo '</div> </div>';
                    
        echo           '<div class="content">
                        <br class="hi" ><h6 class="category text-center">';

                       echo '<a href="profileHotel.php?hotelid='. $hotel['UserID'] .'">Hotel Name :  ' . $hotel['userName'] . '</a> </h6><br>
                        
                        </a><h4  class="text-center title">' . $hotel['description'] . '</h4>
                        </div>  
                </div> <!-- end card -->
            </div>';
          }
?>
	</div>
</div>

       

<?php
	include $tpl . 'footer.php'; 
	ob_end_flush();
?>