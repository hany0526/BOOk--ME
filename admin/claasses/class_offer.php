<?php
//----------------- class offer -------------------
                $cu4=new customer();
	 	$ad4=new admin();
		$hm2=new hotelmanager();
class offer {

    private $id_offer;
    private $name_offer;
       private $description_offer;
		private $hotelname;
		private $start_offer;
		private $end_offer;
		private $price;
		
		
   //-----setter & getter------

		public function setid_offer($id_offer){
			$this->id_offer=$id_offer;
		}
		public function getid_offer(){
			return $this->id_offer;
		}


		public function setname_offer($name_offer){
					$this->name_offer=$name_offer;
				}
		public function getname_offer(){
			return $this->name_offer;
		}


		public function setdescription_offer($description_offer){
					$this->description_offer=$description_offer;
				}
		public function getdescription_offer(){
			return $this->description_offer;
		}


		public function sethotelname($hotelname){
					$this->hotelname=$hotelname;
				}
		public function gethotelname(){
			return $this->hotelname;
		}


		public function setstart_offer($start_offer){
					$this->start_offer=$start_offer;
				}
		public function getstart_offer(){
			return $this->start_offer;
		}


		public function setend_offer($end_offer){
					$this->end_offer=$end_offer;
				}
		public function getend_offer(){
			return $this->end_offer;
		}


		public function setprice($price){
					$this->price=$price;
				}
		public function getprice(){
			return $this->price;
		}

		private function addphoto()
		{}
	
}


?>