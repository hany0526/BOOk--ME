<?php
//----------------- class feedback -------------------
include_once 'Class_customer.php';

$cu1 = new customer();

class feedback {
    
private $id_feedback; 
private $username_feedback;
private $description_feedback;
private $number_feedback;
private $hotelname;
	


		//-----setter & getter------

		public function setid_feedback ($id_feedback){
			$this->id_feedback=$id_feedback;
		}
		public function getid_feedback(){
			return $this->id_feedback;
		}


		public function setusername_feedback ($username_feedback){
			$this->username_feedback=$username_feedback;
		}
		public function getusername_feedback(){
			return $this->username_feedback;
		}


		public function setdiscription_feedback($discription_feedback){
			$this->discription_feedback=$discription_feedback;
		}
		public function getdiscription_feedback(){
			return $this->discription_feedback;
		}


		public function setnumber_feedback ($number_feedback){
			$this->number=$number_feedback;
		}
		public function getnumber_feedback(){
			return $this->number_feedback;
		}


		public function sethotelname ($hotelname){
			$this->hotelname=$hotelname;
		}
		public function gethotelname(){
			return $this->hotelname;
		}

		/*public function sendadmin()
		{}*/

}
?>