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


$stmt = $dbh->prepare("INSERT INTO `ambulance`(`Contact_Number`,`Driver_Name`,`License_No`) VALUES (:Contact_Number,:Driver_Name,:License_No)");


//Fatch data user form
$stmt->bindParam(':Contact_Number', $Contact_Number);
$stmt->bindParam(':Driver_Name', $Driver_Name);
$stmt->bindParam(':License_No', $License_No);

$Contact_Number = $_POST['Contact_Number'];
$Driver_Name = $_POST['Driver_Name'];
$License_No = $_POST['License_No'];

//This variable data has been assigned by us
$user="admin";
//check name 
  
  if($stmt->execute()){
       $message="Insert Row Success";
    }
    else{
      $message="Insert Row Fail";
    }

//end of the second condition
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
          
       
        <form action="add-ambulance-admin.php" method="post" class="login-form" enctype="multipart/form-data">
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-ambulance"></i>Add Ambulance Service</h3>
           <div class="message text-danger"><?php if($message!="") { echo $message; } ?></div> 
          <div class="form-group">
            <label class="control-label text-dark">DRIVER NAME: <span class="text-danger">*</span></label>
            <input type="text" name="Driver_Name" id="name" class="form-control" placeholder="Driver Name" autocomplete="off">
          </div>
          <div class="form-group">
            <label class="control-label text-dark">MOBILE NUMBER: <span class="text-danger">*</span></label>
            <input type="text" name="Contact_Number" id="mobile" class="form-control" placeholder="Ambulance driver's mobile number" autocomplete="off">
          </div>
          <div class="form-group">
            <label class="control-label text-dark">LICENSE NO: <span class="text-danger">*</span></label>
            <input type="text" name="License_No" id="" class="form-control" placeholder="License No" autocomplete="off">
          </div>
          <div class="form-group btn-container">
            <button class="btn btn-primary btn-block" type="submit" name="submit" value="submit"><i class="fa fa-sign-in fa-lg fa-fw"></i>Add Ambulance Service</button>
          </div>

        </form>
        
      </div>
        <!-- =================================== JS VALIDATION START ========================================== -->

<script src="https://cdn.rawgit.com/PascaleBeier/bootstrap-validate/v2.2.0/dist/bootstrap-validate.js" ></script>
<script>
  
  // bootstrapvalidate('#temperature','min:2:Enter at least 2 character');

  bootstrapValidate('#name', 'regex:^[A-z]+$:Must enter character!' );
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