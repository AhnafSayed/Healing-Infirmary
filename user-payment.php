<head>
<title>User Dashboard | Healing Infirmary</title>
<link rel="icon" href="assets/img/mlogo.png">
</head>
<?php
session_start();
include('include/conn.php');
include_once('sql.php');

if(strlen($_SESSION['email'])==0)
  { 
header('location:login.php');
}
else{ 
$_SESSION['email'];

$eamil=$_SESSION['email'];
 
$result = mysqli_query($conn,"SELECT * FROM users Where email='$eamil'");


if (mysqli_num_rows($result) > 0) {

  $i=0;
  $row = mysqli_fetch_array($result);

  
  }
  else{
  echo "No result found";
  }


include_once('include/header.php');
include_once('include/user-sidebar.php');
?>

<?php
//session_start();
include('include/conn.php');
include_once('sql.php');


//Flash Message
$message="";
if(isset($dbh)){
//connection check
if(isset($_POST['submit'])){


$stmt = $dbh->prepare("INSERT INTO `user_payment`(`name`,`feename`,`tranxid`,`additionalinfo`,`lastthreedigit`,`date`) VALUES (:name,:feename,:tranxid,:additionalinfo,:lastthreedigit,:date)");

//bindParam
//$stmt->bindParam(':date', $date);
$stmt->bindParam(':name', $name);
$stmt->bindParam(':feename', $feename);
$stmt->bindParam(':tranxid', $tranxid);
$stmt->bindParam(':additionalinfo', $additionalinfo);
$stmt->bindParam(':lastthreedigit', $lastthreedigit);
$stmt->bindParam(':date', $date);

//$doc_type= $_POST['date'];
$name = $_POST['name'];
$feename = $_POST['feename'];
$tranxid = $_POST['tranxid'];
$additionalinfo = $_POST['additionalinfo'];
$lastthreedigit = $_POST['lastthreedigit'];
$date= $_POST['date'];
//This variable data has been assigned by us



if($stmt->execute()){
  $message="Insert Row Success";
  header("Location:user-payment.php");

}
else{
 $message="Insert Row Failed!";

}
}
}

?>





<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> User Dashboard</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        </ul>
      </div>
    <div class="row">
    <div class="col-md-6 m-auto">
      <div class="tile">
        <h3 class="tile-title">Payment</h3>
        <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <div class="table-responsive">
            <table class="table table-hover table-bordered" id="sampleTable">
              <thead>
              <tr>
              <td>Doctor Appointment Fee</td>
              <td>Ambulance Fee</td>
              <td>Bkash Merchant Number</td>
              <td>Nagad Merchant Number</td>
              </tr>
              </thead>
              <tbody>
              <tr>
                 <td><h5>500 Taka</h5></td>
                 <td><h5>400 Taka</h5></td>
                 <td><h5>01848694959</h5></td>
                 <td><h5>01749594757</h5></td>
              </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
</div>
        <div class="tile-body">
          <form action="user-payment.php" method="post" class="form-horizontal" enctype="multipart/form-data">

            <label class="control-label">Name:<span class="text-danger">*</span></label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Name" autocomplete="off">
          </div>

          <div class="form-group">
          <label class="control-label text-dark" > Fee Name: <span class="text-danger">*</span></label>
			    <select id="feename" name="feename" class="form-control">
			    <option value="Doctor Appointment Fee">Doctor Appointment Fee</option>
			    <option value="Ambulance Fee">Ambulance Fee</option>
			    <option value="Doctor Appointment and Ambulance Fee">Doctor Appointment and Ambulance Fee</option>
			    </select>
		      </div>
        
          <div class="form-group">
            <label class="control-label">Transaction ID:<span class="text-danger">*</span></label>
            <input type="text" name="tranxid" id="tranxid" class="form-control" placeholder="Transaction ID" autocomplete="off">
            <span id='message'></span>
          </div>

          <div class="form-group">
            <label class="control-label">Additional Info: <span class="text-danger">*</span></label>
            <input type="text" name="additionalinfo" rows="10" cols="50" class="form-control"  placeholder="Write your addtional info here (If needed)">
          </div>

          <div class="form-group">
            <label class="control-label">Last Three Digit: <span class="text-danger">*</span></label>
            <input type="text" name="lastthreedigit" id="threedigit" rows="10" cols="50" class="form-control"  placeholder="Last the three digit of your phone number!">
          </div>

          <div class="form-group">
            <label class="control-label">Date: <span class="text-danger">*</span></label>
            <input type="date" name="date" rows="10" cols="50" class="form-control"  placeholder="">
          </div>

          <div class="form-group btn-container">
            <button class="btn btn-primary btn-block" type="submit" name="submit" value="submit"><i class="fa fa-sign-in fa-lg fa-fw"></i>Send Payment</button>
          </div>
            
        </form>
      </div>
    </div>
  </div>
  <!-- =================================== JS VALIDATION START ========================================== -->

<script src="https://cdn.rawgit.com/PascaleBeier/bootstrap-validate/v2.2.0/dist/bootstrap-validate.js" ></script>
<script>
  
  // bootstrapvalidate('#temperature','min:2:Enter at least 2 character');

  bootstrapValidate('#name', 'regex:^[A-z]+$:Must enter character!' );
  bootstrapValidate('#tranxid', 'min:10:Enter valid transaction id!' );
  bootstrapValidate('#threedigit', 'regex:^[0-9]+$:Enter valid last three digit of your mobile number!' );
  bootstrapValidate('#threedigit', 'min:3:Enter last three digit of your mobile number!' );
 



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
    </main>

    <?php 
      include_once('include/footer.php');
      //include_once('include/Hfooter.php');
}
  
     ?>