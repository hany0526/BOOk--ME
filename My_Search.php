<!DOCTYPE html>
<html>
<head>
	<title> search-home </title>
</head>
<body>
	<form action="./search.php" method = "get">
    <input type ="text" name "q" dir ="ltr">
    <input type ="submit" value "go" >
	</form>
</body>
</html>
<?php
$conn = mysqli_connect("localhost","root","","tutorial");
if (mysqli_connect_error())
{
	echo "failed to connect ".mysqli_connect_error();
}
?>


<?php
$output ='';
if (isset($_GET['q']) && $_GET['q'] !==' ')
{

	$searchq=$_GET['q'];
	$q=mysqli_connect($conn,"SELECT * FROM search WHERE keywords LIKE '%$searchq%' OR title LIKE'%$searchq%'")or die (mysqli_error());

	$c =mysqli_num_rows($q);
	if ( $c === 0)
	{
	$output='no search result for <b>"'.$searchq.'"</br>';
	}
	else
	{
		while($row = mysqli_fetch_array($q))
		{
			$id=$row['id'];
			$title=$row['title'];
			$desc=$row['description'];
			$link=$row['link'];
			$output.='<a href="'.$link.'">
			<h3>'.$title.'</h3>.<p>'.$desc.'</p></a>';
		}
		
	}
}
else
{
	header("location : ./");
}
print("$output");
mysqli_close($conn);
?>

