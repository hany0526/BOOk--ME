<?php

//----------------- class hotelmanager -------------------
include_once 'admin.php';

$ad5 =new admin();

class hotelmanager extends user{
private $location;
private $offermyoffer;
	


		//------setter & getter-------
		public function setlocation ($location){
			$this->location=$location;
		}
		public function getlocation(){
			return $this->location;
		}

		public function setoffermyoffer ($offermyoffer){
			$this->offermyoffer=$offermyoffer;
		}
		public function getoffermyoffer(){
			return $this->offermyoffer;
		}

		public function addoffer()
		{
			$stmt = $con->prepare("SELECT 
								offer.*,  
								users.Username 
							FROM 
								offer
							
							INNER JOIN 
								users 
							ON 
								users.UserID = offer.userID 
							WHERE 
								userID = ?
							AND 
								Approve = 1");
		}
		public function editoffer()
		{}
		public function deleteoffer()
		{}
		public function recevefeedback()
		{}
		public function showpayment()
		{}
		public function showplace()
		{}
}
?>