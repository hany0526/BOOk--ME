<?php
include_once 'Class_customer.php';
//----------------- class payment -------------------
  $cu2=new customer();
    $ad1=new admin();
    
class payment{
private $id_payment;
	private $username_payment;
	private $hotelname;
	private $id_offer;
	private $price;
	private $description_payment;
  

	//-----setter & getter-------

		public function setid_payment($id_payment){
			$this->id_payment=$id_payment;
		}
		public function getid_payment(){
			return $this->id_payment;
		}


		public function setusername_payment ($username_payment){
			$this->username_payment=$username_payment;
		}
		public function getusername_payment(){
			return $this->username_payment;
		}


		public function sethotelname ($hotelname){
			$this->hotelname=$hotelname;
		}
		public function getid_feedback(){
			return $this->hotelname;
		}


		public function setid_offer ($id_offer){
			$this->id_offer=$id_offer;
		}
		public function getid_offer(){
			return $this->id_offer;
		}


		public function setprice ($price){
			$this->price=$price;
		}
		public function getprice(){
			return $this->price;
		}


		public function setdescription_payment ($description_payment){
			$this->description_payment=$description_payment;
		}
		public function getdescription_payment(){
			return $this->description_payment;
		}


}
?>