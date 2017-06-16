<?php
//----------------- class customer -------------------

include_once 'Class_user.php';
include_once 'admin.php';

    $ad3 = new admin();

class customer extends user
{
	
		public function chooseoffer()
		{
					$pageTitle = 'offers';

			if (isset($_SESSION['Username'])) {

				include 'init.php';

				$do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

				if ($do == 'Manage') {


					$stmt = $con->prepare("SELECT offer.*, users.userName FROM offer
							 JOIN users ON users.UserID = offer.hotelID
							ORDER BY offerID DESC");
                                                        
                                        
                                }

                /*	public function editoffer()
		{}
		public function sendfeedback()
		{}
		public function canceloffer()
		{}
		public function payment()
		{}
		public function chooseplace()
		{}*/

                }
                
                                }
}

?>