<?php


session_start();


if(empty($_SESSION['id_company'])) {
  header("Location: dashboard_company.php");
  exit();
}

require_once("db.php");
?>

<!doctype html>
<html lang="en">

<head>
	<title>Company Profile</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="dashboard.css">
	<link rel="stylesheet" href="page-profile.css">
	<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/vendor/linearicons/style.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="assets/css/main.css">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="assets/css/demo.css">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<li><a href="dashboard_company.php" class="active"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
						<li><a href="edit-company.php" class=""><i class="lnr lnr-pencil"></i>Edit Profile</span></a></li>
                        <li><a href="create-job-post.php" class=""><i class="lnr lnr-calendar-full"></i></span>Create Job</span></a></li>
						<li><a href="my-job-post.php" class=""><i class="lnr lnr-briefcase"></i> <span>My Job Posts</span></a></li>
                        <li><a href="job-applications.php" class=""><i class="lnr lnr-envelope"></i> <span>Job Application</span></a></li>
						<li class="active"><a href="resume-database.php"><i class="lnr lnr-user"></i> Resumes</a></li>
						<li class="active"><a href="company-settings.php"><i class="lnr lnr-cog"></i> Settings</a></li>
					    <li><a href="logout.php"><i class="lnr lnr-arrow-right-circle"></i> Logout</span></a></li>
					
					</ul>
				</nav>
			</div>
		</div>
        <!-- END LEFT SIDEBAR -->
        
		<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<div class="panel panel-profile">
						<div class="clearfix">
							<!-- LEFT COLUMN -->
							<div class="profile-left">
								<!-- PROFILE HEADER -->
								<div class="profile-header">
									<div class="overlay"></div>
									<div >
										<img src="assets/img/user5.png" class="img-circle" alt="Avatar">
										<h3 class="name"><?php echo $_SESSION['name']; ?></h3>
										<span class="online-status status-available">Available</span>
									</div>
									<!-- <div class="profile-stat">
										<div class="row">
											<div class="col-md-4 stat-item">
												45 <span>Available</span>
											</div>
											<div class="col-md-4 stat-item">
												15 <span>Applied</span>
											</div>
											<div class="col-md-4 stat-item">
												2 <span>Approved</span>
											</div>
										</div>
									</div> -->
								</div>
								<!-- END PROFILE HEADER -->
								<!-- PROFILE DETAIL -->
								<div class="profile-info">
									<h4 class="heading">Social</h4>
									<ul class="list-inline social-icons">
										<li><a href="#" class="facebook-bg"><i class="fa fa-facebook"></i></a></li>
										<li><a href="#" class="twitter-bg"><i class="fa fa-twitter"></i></a></li>
										<li><a href="#" class="google-plus-bg"><i class="fa fa-google-plus"></i></a></li>
										<li><a href="#" class="github-bg"><i class="fa fa-github"></i></a></li>
									</ul>
								</div>
								
									
									
									
								</div>
								<!-- END PROFILE DETAIL -->
							</div>
							<?php
            //Sql to get logged in user details.
            $sql = "SELECT * FROM company WHERE id_company='$_SESSION[id_company]'";
            $result = $conn->query($sql);

            //If user exists then show his details.
            if($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
            ?>
							<!-- END LEFT COLUMN -->
							<!-- RIGHT COLUMN -->
							<div class="profile-right">
								<div class="profile-info">
									<ul class="list-unstyled list-justify">
									<li><h4 class="heading">About<span><button type="submit" class="btn btn-primary btn-sm btn-block">Edit</button> </span></h4></li>
									
									</ul>	
									<p>Interactively fashion excellent information after distinctive outsourcing.</p>
									
								</div>
								
								<div class="profile-detail">
									<div class="profile-info">
										<h4 class="heading">Basic Info</h4>
										<ul class="list-unstyled list-justify">
											<li>City <span><?php echo $row['city']; ?></span></li>
											<li>Mobile <span><?php echo $row['contactno']; ?></span></li>
											<li>Email <span><?php echo $row['email']; ?></span></li>
											<!-- <li>Qualification<span><?php echo $row['qualification']; ?></span></li>
											<li>Address<span><?php echo $row['address']; ?><?php echo  $row['state']; ?></span></li> -->
											<li>Website<span><?php echo $row['website']; ?><?php echo  $row['website']; ?></span></li>
										</ul>
									</div>
								
								<!-- END TABBED CONTENT -->
							</div>
							<!-- END RIGHT COLUMN -->
							
						</div>
					</div>
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>
		<!-- END MAIN -->
		<div class="clearfix"></div>
		<footer>
			<div class="container-fluid">
				<p class="copyright">&copy; 2024 All Rights Reserved.</p>
			</div>
		</footer>
	</div>
	<?php
}
              }
            ?>
	<!-- END WRAPPER -->
	<!-- Javascript -->
	<script src="assets/vendor/jquery/jquery.min.js"></script>
	<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="assets/scripts/klorofil-common.js"></script>
</body>

</html>
