<?php
$host='localhost';
$username='root';
$password='';
$dbname = "healing-infirmary";
$conn=mysqli_connect($host,$username,$password,"$dbname");
if(!$conn)
    {
      die('Could not Connect MySql Server:' .mysql_error());
    }
$sql = "DELETE FROM doucument WHERE email='$email'" ;
$data=mysqli_query($conn,$sql);
if($data){

echo "Data deleted successfully";
header("Location:view-document.php");
}
else{

echo "Something is wrong!";
}

?>


