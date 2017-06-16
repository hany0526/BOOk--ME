<?php
	ob_start();
	session_start();
	$pageTitle = 'Homepage';
	include 'init.php';
?>
<div class="container">
	<div class="row"> <br><br>

<?php

  $allHotels = getAllFrom('*', 'users', 'where typeUserID = 2', '', 'userID');
    
    foreach ($allHotels as $hotel ) {

     echo  '<div class="card-box col-md-4 col-sm-6"> <div class="card"> <div class="header">';     
              
     		echo "<img src='admin/uploads/avatar/ ". $hotel['avatar'] . " ' alt='' />";
      
    		  //  echo   '<img src=" '. 'admin/uploads/avatar/' .'  $hotel["avatar"] '. '.jpg" />';
                        
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