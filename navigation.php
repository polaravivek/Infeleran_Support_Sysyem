<!DOCTYPE html>
<html lang="en">
<head>


    <!-- navigation bar -->

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 	integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<!-- end navigation -->

    <title>Document</title>
</head>
<body>

    <!-- navigation bar -->
    <nav class="navbar navbar-light navbar-expand-md bg-faded justify-content-center">
        <a href="/" class="navbar-brand d-flex mr-auto"><img src="../images/logo.png" style="width: 130px;height:50px;background-color: #fff;	"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsingNavbar3">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse w-50" id="collapsingNavbar3">
            <ul class="navbar-nav w-100 justify-content-center">
              <li class="nav-item active justify-content-center w-30">
                <a class="nav-link " href="../unsolved_section/fetch_questions.php"><b>Unsolved</b></a>
              </li>
              <div style="width:30px"></div>
              <li class="nav-item w-30">
                <a class="nav-link" href="../solved_section/solved.php"><b>Solved</b></a>
              </li>
              <div style="width:30px"></div>
              <li class="nav-item w-30">
                <a class="nav-link" href="../ask_section/ask.php"><b>Ask</b></a>
              </li>
              <div style="width:30px"></div>
              <li class="nav-item">
                <a class="nav-link" href="#"><b>Support</b></a>
              </li>
            </ul>
                <div class="btn-group dropleft">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                        <a href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="../images/bill_gates.jpg" width="50" height="50" class="rounded-circle" style="border-color: black;box-shadow: 3px 3px 3px rgb(87, 87, 87); margin-top: 5px ; margin-right: 20px;">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" style="border-color: black;box-shadow: 2px 2px 2px rgb(87, 87, 87); margin-top: 5px ; margin-right: 20px">
                          <a class="dropdown-item" href="#">Profile</a>
                          <a class="dropdown-item" href="#">My Questions</a>
                          <a class="dropdown-item" href="#">Log Out</a>
                        </div>
                        </li>   
                    </ul>
              </div>
        </div>
      </nav>
  
</body>
</html>