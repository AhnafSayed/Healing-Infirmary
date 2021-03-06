<head>
<title>Admin Dashboard | Healing Infirmary</title>
<link rel="icon" href="assets/img/mlogo.png">
</head>
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

if(strlen($_SESSION['email'])==0)
{
header('location:login.php');
}
else{
include_once('include/header.php');
include_once('include/admin-sidebar.php');
$sql = 'SELECT * FROM `user_payment` ';
$message="";
if(isset($dbh)){
//connection check
$stmt = $dbh->prepare($sql);
$stmt->execute();
$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-th-list"></i>User Payment List </h1>
    </div>
    <ul class="app-breadcrumb breadcrumb side">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item">Admin Dashboard</li>
      <li class="breadcrumb-item active"><a href="#">View Profile</a></li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <div class="table-responsive">
            <table class="table table-hover table-bordered" id="sampleTable">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Fee Name</th>
                  <th>Transaction ID</th>
                  <th>Additional Info</th>
                  <th>Last Three Digit</th>
                  <th>Date</th>
                  <th align="center">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $count = 1;
                foreach ($row as  $value) {
                ?>
                <tr>
                  <td><?php echo $count; ?></td>
                  <td><?php echo $value['name']; ?></td>
                  <td><?php echo $value['feename']; ?></td>
                  <td><?php echo $value['tranxid']; ?></td>
                  <td><?php echo $value['additionalinfo']; ?></td>
                  <td><?php echo $value['lastthreedigit']; ?></td>
                  <td><?php echo $value['date']; ?></td>
                  <td align="center">
                    <a href="delete-user-payment.php?id=<?php echo $value['id']; ?>" class="btn btn-danger">
                      <i class="fa fa-trash" aria-hidden="true"></i>
                    </a>
                  </td>
                </tr>
                <?php
                $count++;
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<?php
include_once('include/footer.php');
include_once('include/Hfooter.php');
}
}
?>