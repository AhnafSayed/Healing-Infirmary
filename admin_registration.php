<!-- Font-icon css-->
<title>Admin Dashboard |  Healing Infirmary</title>
<link rel="icon" href="assets/img/mlogo.png">
<?php
session_start();

include_once('include/conn.php');
include_once('sql.php');
$_SESSION['email'];

$eamil=$_SESSION['email'];
 
$result = mysqli_query($conn,"SELECT * FROM admin_registration Where email='$eamil'");


if (mysqli_num_rows($result) > 0) {

	$i=0;
$row = mysqli_fetch_array($result);

	
	}

	else{
	echo "No result found";
	}
?>
<?php
session_start();
//connect to DB
include_once('include/header.php');
include_once('include/admin-sidebar.php');
$message="";
if(isset($dbh)){
//connection check
if(isset($_POST['submit'])){


$stmt = $dbh->prepare("INSERT INTO `admin_registration`(`name`,`email`,`mobile`,`password`,`image`) VALUES (:name, :email, :mobile, :password, :image)");

$stmt1 = $dbh->prepare("INSERT INTO `login`(`email`,`password`,`user`) VALUES (:email, :password,:user)");

//bindParam FOR LOGIN TABLE
$stmt1->bindParam(':email', $email);
$stmt1->bindParam(':password', $password);
$stmt1->bindParam(':user', $user);

//bindParam FOR ADMIN REG
$stmt->bindParam(':name', $name);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':mobile', $mobile);

$stmt->bindParam(':password', $password);
$stmt->bindParam(':image', $image);

//insert File
$target_dir = "assets/img/user/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

//Fatch data user form
if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
$name = $_POST['name'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$passwordtest = $_POST['password'];
$image = $target_file;
$confirmpassword = $_POST['confirmpassword'];

//This variable data has been assigned by us
$user="admin";
//check name 

//checkpassword
if($passwordtest == $confirmpassword){
  $password = ($passwordtest);
  
  
  if($stmt->execute()){
       $message="Insert Row Success";
    }
    else{
      $message="Insert Row Fail";
    }

  //STMT1 FOR LOGIN TABLE
    if($stmt1->execute()){
      $message="Insert Row Success";
   }
   else{
     $message="Insert Row Fail";
   } 
//end of the second condition
}
else{
  $message="confirm password Not match!";
}
}
else{
  $message="You file is not an image!";
}
}
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
    <link rel="stylesheet" type="text/css" href="assets/css/custom.css">
  </head>
  <body>
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
      <div class="logo">
        
      </div>
      <div class="login-box2">
        <!-- <form action="" method="post" enctype="multipart/form-data"> -->
          
       
        <form action="admin_registration.php" method="post" class="login-form" enctype="multipart/form-data">
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-users"></i>Add Admin</h3>
           <div class="message text-danger"><?php if($message!="") { echo $message; } ?></div> 
          <div class="form-group">
            <label class="control-label text-dark">ADMIN NAME: <span class="text-danger">*</span></label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Name of new admin" autocomplete="off">
          </div>
          <div class="form-group">
            <label class="control-label text-dark">ADMIN EMAIL: <span class="text-danger">*</span></label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Enter new admin's email" autocomplete="off">
          </div>
          <div class="form-group">
            <label class="control-label text-dark">MOBILE: <span class="text-danger">*</span></label>
            <input type="tel" name="mobile" id="mobile" class="form-control" placeholder="Mobile number of new admin" autocomplete="off">
          </div>
          <div class="form-group">
            <label class="control-label text-dark">PASSWORD: <span class="text-danger">*</span></label>
            <input type="password" name="password" class="form-control" placeholder="Password" autocomplete="off" id="password">
          </div>
          <div class="form-group">
            <label class="control-label text-dark">CONFIRM PASSWORD: <span class="text-danger">*</span></label>
            <input type="password" name="confirmpassword" id="confirmpassword" class="form-control" placeholder="Confirm password" autocomplete="off">
            <span id='message'></span>
          </div>
          <div class="form-group">
            <label class="control-label text-dark">Image: <span class="text-danger">*</span></label>
            <input type="file" name="image" id="" class="form-control">
          </div>
          <div class="form-group btn-container">
            <button class="btn btn-primary btn-block" type="submit" name="submit" value="submit"><i class="fa fa-sign-in fa-lg fa-fw"></i>Add Admin</button>
          </div>

        </form>
        
      </div>
    <!-- =================================== JS VALIDATION START ========================================== -->

<script src="https://cdn.rawgit.com/PascaleBeier/bootstrap-validate/v2.2.0/dist/bootstrap-validate.js" ></script>
<script>
  
  // bootstrapvalidate('#temperature','min:2:Enter at least 2 character');

  bootstrapValidate('#name', 'regex:^[A-z]+$:Must enter character!' );
  bootstrapValidate('#email', 'email:Enter valid email!' );
  bootstrapValidate('#password', 'min:4:Password must be 4 digit!' );
  bootstrapValidate('#mobile', 'min:11:Mobile number must be 11 digit!' );
  bootstrapValidate('#mobile', 'regex:^[0-9]+$:Enter valid mobile number!' );
 



</script>
<!-- =================================== JS VALIDATION START ========================================== -->
      
    </section>
    <!-- Essential javascripts for application to work-->
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="assets/js/plugins/pace.min.js"></script>
    <script>
      $(document).ready(function(){
        $('#password, #confirmpassword').on('keyup', function () {
          if ($('#password').val() == $('#confirmpassword').val()) {
            $('#message').html('Matching').css('color', 'green');
          } else 
            $('#message').html('Not Matching').css('color', 'red');
        });
      });
    </script>
  </body>
  	  <?php
	  include_once('include/footer.php');
      include_once('include/Hfooter.php');
	  ?>
</html>