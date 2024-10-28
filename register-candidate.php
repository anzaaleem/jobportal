<?php
session_start();

if(isset($_SESSION['id_user']) || isset($_SESSION['id_company'])) { 
  header("Location: index.php");
  exit();
}

require_once("db.php");
?>
<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Job Portal </title>
  <link rel="stylesheet" href="dashboard.css">
  <link rel="stylesheet" href="register-company.css">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="css/AdminLTE.min.css">
  <link rel="stylesheet" href="css/_all-skins.min.css">
  <!-- Custom -->
  <link rel="stylesheet" href="css/custom.css">
  
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">

  <header class="main-header">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left: 0px;">

   <section class="content-header">
      <div class="container">
        <div class="row latest-job margin-top-50 margin-bottom-20 bg-white">
          <h1 class="text-center margin-bottom-20">CREATE CANDIDATE PROFILE</h1>
          <form method="post" id="registerCandidate" action="addcandidate.php" enctype="multipart/form-data">
            <div class="col-md-6 latest-job ">
              <div class="form-group">
                <input class="form-control input-sm" type="text" name="fname" placeholder="First Name" required>
              </div>
              <div class="form-group">
                <input class="form-control input-sm" type="text" name="lname" placeholder="Last Name" required>
              </div>
              <div class="form-group">
                <input class="form-control input-sm" type="text" name="email" placeholder="Email" required>
              </div>
              <div class="form-group">
                <textarea class="form-control input-sm" rows="4" name="address" placeholder="Enter your address"></textarea>
              </div>
              <div class="form-group">
                <input class="form-control input-sm" type="password" name="password" placeholder="Password" required>
              </div>
              <div class="form-group">
                <input class="form-control input-sm" type="password" name="cpassword" placeholder="Confirm Password" required>
              </div>
              <div class="form-group checkbox">
                <label><input type="checkbox" required> I accept terms & conditions</label>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-flat btn-success">Register</button>
              </div>
              <?php 
              //If Company already registered with this email then show error message.
              if(isset($_SESSION['registerError'])) {
                ?>
                <div>
                  <p class="text-center" style="color: red;">Email Already Exists! Choose A Different Email!</p>
                </div>
              <?php
               unset($_SESSION['registerError']); }
              ?> 
              <?php 
              if(isset($_SESSION['uploadError'])) {
                ?>
                <div>
                  <p class="text-center" style="color: red;"><?php echo $_SESSION['uploadError']; ?></p>
                </div>
              <?php
               unset($_SESSION['uploadError']); }
              ?> 
            </div>
            <div class="col-md-6 latest-job ">

              <div class="form-group">
                <input class="form-control input-sm" type="text" name="contactno" placeholder="Phone Number" minlength="10" maxlength="12" autocomplete="off" onkeypress="return validatePhone(event);" required>
              </div>
            <div class="form-group">
                <input class="form-control input-sm" type="text" name="city" placeholder="City" >
              </div>
              <div class="form-group">
                <input class="form-control input-sm" type="text" name="state" placeholder="State" >
              </div>
              <div class="form-group">
                <input class="form-control input-sm" type="text" name="qualification" placeholder="Qualification" required>
              </div>
              <div class="form-group">
                <input class="form-control input-sm" type="text" name="stream" placeholder="Stream" required>
              </div>
              <div class="form-group">
                <input class="form-control input-sm" type="year" name="p_year" placeholder="Passing year" required>
              </div>
              <div class="form-group">
                <input class="form-control input-sm" type="date" name="dob" placeholder="Date of birth" required>
              </div>
              <div class="form-group">
                <input class="form-control input-sm" type="number" name="age" placeholder="Age" required>
              </div>
              <div class="form-group">
                <input class="form-control input-sm" type="text" name="designation" placeholder="Designation" required>
              </div>
              <div class="form-group">
                <input class="form-control input-sm" type="text" name="about" placeholder="About yourself" required>
              </div>
              <div class="form-group">
                <input class="form-control input-sm" type="text" name="skills" placeholder="Skills" required>
              </div>
              <div class="form-group">
                <label>Attach Resume/CV</label>
                <input type="file" name="image" class="form-control input-sm" required>
              </div>
            </div>
          </form>
          
        </div>
      </div>
    </section>

    

  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer" style="margin-left: 0px;">
    <div class="text-center">
      <strong>Copyright &copy; 2024 <a href="learningfromscratch.online">Job Portal</a>.</strong> All rights
    reserved.
    </div>
  </footer>

  <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="js/adminlte.min.js"></script>

<script type="text/javascript">
  function validatePhone(event) {

    //event.keycode will return unicode for characters and numbers like a, b, c, 5 etc.
    //event.which will return key for mouse events and other events like ctrl alt etc. 
    var key = window.event ? event.keyCode : event.which;

    if(event.keyCode == 8 || event.keyCode == 46 || event.keyCode == 37 || event.keyCode == 39) {
      // 8 means Backspace
      //46 means Delete
      // 37 means left arrow
      // 39 means right arrow
      return true;
    } else if( key < 48 || key > 57 ) {
      // 48-57 is 0-9 numbers on your keyboard.
      return false;
    } else return true;
  }
</script>

<!-- <script>
  $("#city").on("change", function() {
    var id = $(this).find(':selected').attr("data-id");
    $("#state").find('option:not(:first)').remove();
    if(id != '') {
      $.post("state.php", {id: id}).done(function(data) {
        $("#state").append(data);
      });
      $('#stateDiv').show();
    } else {
      $('#stateDiv').hide();
      $('#cityDiv').hide();
    }
  });
</script>


<script>
  $("#state").on("change", function() {
    var id = $(this).find(':selected').attr("data-id");
    $("#city").find('option:not(:first)').remove();
    if(id != '') {
      $.post("city.php", {id: id}).done(function(data) {
        $("#city").append(data);
      });
      $('#cityDiv').show();
    } else {
      $('#cityDiv').hide();
    }
  });
</script> -->
<script>
  $("#registerCandidates").on("submit", function(e) {
    e.preventDefault();
    if( $('#password').val() != $('#cpassword').val() ) {
      $('#passwordError').show();
    } else {
      $(this).unbind('submit').submit();
    }
  });
</script>
</body>
</html>
