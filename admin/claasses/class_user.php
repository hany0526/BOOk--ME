<?php



//----------------- class user -------------------
include_once 'DbConnection.php';
class user{

	private $id;
	private $name;
	private $age;
	private $email;
	private $gender;
	private $phone;
    private $user_type_id;
			//-----setter & getter--------
			public function setid ($id){
				$this->id=$id;
			}
			public function getid(){
				return $this->id;
			}


			public function setname($name){
				$this->name=$name;
			}
			public function getname(){
				return $this->name;
			}


			public function setage ($age){
				$this->age=$age;
			}
			public function getage(){
				return $this->age;
			}


			public function setemail($email){
				$this->email=$email;
			}
			public function getemail(){
				return $this->email;
			}


			public function setgender ($gender){
				$this->gender=$gender;
			}
			public function getgender(){
				return $this->gender;
			}


			public function setphone ($phone){
				$this->phone=$phone;
			}
			public function getphone(){
				return $this->phone;
			}


			public function setuser_type_id ($user_type_id){
				$this->user_type_id=$user_type_id;
			}
			public function getuser_type_id(){
				return $this->user_type_id;
			}


			public function __construct($user_id) {
			        if($user_id !=""){
			                    $Db_object=new DbConnection();
			                    $select_user_SQL="SELECT * FROM `users`  where id=$user_id";
			                    $data=$Db_object->get_row($select_user_SQL);
			                    $this->id=$data['id'];
			                    $this->name=$data['name'];
			                    $this->id=$data['id'];
			                    $this->age=$data['age'];
			                    $this->email=$data['email'];
			                    $this->gender=$data['gender'];
			                    $this->phone=$data['phone'];

			        }
			         
			    }
                            			public function login()
			{
						$Db_object=new DbConnection();
			    $this->name=$Db_object->clean($this->name);
			    $this->id=$Db_object->clean($this->id);
			    // echo $this->username;
			    $select_user_SQL="SELECT * FROM `users`  where name='$this->name' and id='$this->id'";
			    
			    $select_user_Result=$Db_object->database_query($select_user_SQL);
			    
			    if($Db_object->database_num_rows($select_user_Result)==1){
			             $user_data=$Db_object->get_row($select_user_SQL);
			             $this->id=$user_data['id'];
			              return TRUE;
			            
			                   }
			      else{
			          
			       return FALSE;
           
             }

       

    }
                            			public function logout()
			{
				if(isset( $_SESSION['name'])&&isset( $_SESSION['id'])&&isset( $_SESSION['type'])){
   				 	session_destroy();
   					 header("Location: login.php");
    }

			}
                            public function search()
			{
				$searchq=$_GET['q'];
				$q=mysqli_connect($conn,"SELECT * FROM search WHERE keywords LIKE '%$searchq%' OR title LIKE'%$searchq%'")or die (mysqli_error());
			}
                        
			public function editprofile()
			{
								session_start();
					$pageTitle = 'Profile';
					include 'init.php';
					if (isset($_SESSION['user'])) {
						$getUser = $con->prepare("SELECT * FROM users WHERE userName = ?");
						$getUser->execute(array($sessionUser));
						$info = $getUser->fetch();
						$userid = $info['UserID'];
			}

}

                                        }
?>