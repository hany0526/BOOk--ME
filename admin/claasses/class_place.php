<?php
//----------------- class place -------------------
$cu3=new customer();
    $ad2=new admin();
    $hm1=new hotelmanager();
class place {
private $id_place;
	private $name_place;
	private $location_place;
	private $description_place;
	

    //----setter & getter------

			public function setid_place ($id_place){
				$this->id_place=$id_place;
			}
			public function getid_place(){
				return $this->id_place;
			}


			public function setname_place ($name_place){
				$this->name_place=$name_place;
			}
			public function getname_place(){
				return $this->name_place;
			}


			public function setlocation_place ($location_place){
				$this->location_place=$location_place;
			}
			public function getlocation_place(){
				return $this->location_place;
			}


			public function setdescription_place ($description_place){
				$this->description_place=$description_place;
			}
			public function getdescription_place(){
				return $this->description_place;
			}
}

?>