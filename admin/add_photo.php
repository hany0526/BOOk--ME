<!DOCTYPE html >
<html>
    <head>
       <title> add photo in php </title> 
    </head>
	<body>
	 	<form action = 'uploade.php' method ='post' enctype = 'multipart/form-data'>
	 		<label>Image:</label><input type ='file'name='image'>
		    <input type='submit' value ='uploade'>
		</form>
	</body>

<?php
     $allowed_types= array('image/png','image/jpg');
     $image_name = $_FILES['image']['name'];
     $image_name = $image_name;
     $tmp_name = $_FILES ['image']['tmp_name'];
     $image_type =$_FILES ['image']['type'];

	move_uploaded_file($tmp_name,"uploade/".$image_name);
	
?>