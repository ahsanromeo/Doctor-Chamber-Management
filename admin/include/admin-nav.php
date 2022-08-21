<nav class="navbar">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="http://localhost/dcm/">Home</a></li>
        <?php if($login !=0) {?>
        <li><a href="test.php">Test</a></li>
        <li><a href="test_details.php">Test Details</a></li>
        <li><a href="doctor.php">Doctor</a></li>
        <li><a href="patient.php">Patient Details</a></li>
        <li><a href="appointment.php">Appointment List</a></li>
        <li><a href="test_result.php">Result</a></li>
        <li><a href="report.php">Report</a></li>
        <li><a href="logout.php">Logout</a></li>
        <?php } ?>
      </ul>      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>