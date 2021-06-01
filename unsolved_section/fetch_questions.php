<?php

    include('connection.php');
    include('model.php');

    $query="select * from questions where unsolved = 1";
    $result = $link->query($query) or die($link->error);

    $items = array();
    while($row = $result->fetch_assoc()) {
        $object = new Questions($row['name'],$row['title'],$row['category'],$row['description'],$row['document'],$row['unsolved'],$row['solved'],$row['created_at']);

        $items[] = $object;
    }
?>

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

	<!-- search box -->

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

    <link rel="stylesheet" href="../styles/search_box.css">

	<!-- end search box -->

	<style type="text/css">

		html{
			margin: 0px;
			padding: 0px
			transition: 3s ease all;
		}

		.question1{
			width: 1300px;
			height: 170px;
			border-radius: 8px;
			background-size: cover;
			background-color: #212838;
			box-shadow: .5rem 2px .5rem rgba(0, 0, 0, 0.1);
			border: 2px solid grey;
			margin: 20px auto;
			cursor: pointer
		}

		.question1:hover:before{
			transform: scale(1.1);
			box-shadow: 0 0 15px #ffee10;
		}
		.question1:hover{
			color: #ffee10;
			box-shadow: 0 0 5px #ffee10;
		}
		.main_question{
			font-family: cursive;
			font-size: 25px;
			font-weight: 400;
			margin-top: 20px;
			margin-left: 20px;
			color: #ffffff;
			padding: 20px;
		}
		.name{
			font-family: cursive;
			font-size: 20px;
			font-weight: 200;
			margin-bottom: 10px;
			margin-left: 50px;
			color: grey;
			padding: 20px;
		}
		.title{
			float: right;
			margin-right: 45px;
		}
		.question{
			margin-left: 30px;
		}
		.date{
			float: right;
			margin-right: 50px;
			color: grey;
			padding: 15px;
		}
		.cont{
			margin: auto;
			clear: both;
		}
		.active a{
    		color: rgb(255, 130, 130) !important;
		}

	</style>
</head>

<body>
	<nav class="navbar navbar-light navbar-expand-md bg-faded justify-content-center">
	  <a href="/" class="navbar-brand d-flex mr-auto"><img src="../images/logo.png" style="width: 130px;height:50px;background-color: #fff;	"></a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsingNavbar3">
	      <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="navbar-collapse collapse w-50" id="collapsingNavbar3">
	      <ul class="navbar-nav w-100 justify-content-center">
	        <li class="nav-item active justify-content-center w-30">
	          <a class="nav-link " href="#"><b>Unsolved</b></a>
	        </li>
	        <div style="width:30px"></div>
	        <li class="nav-item w-30">
	          <a class="nav-link" href="#"><b>Solved</b></a>
	        </li>
	        <div style="width:30px"></div>
	        <li class="nav-item w-30">
	          <a class="nav-link" href="#"><b>Ask</b></a>
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
					  <img src="../images/bill_gates.jpg" width="40" height="40" class="rounded-circle">
					  </a>
					  <div class="dropdown-menu dropdown-menu-right" >
						<a class="dropdown-item" href="#">Profile</a>
						<a class="dropdown-item" href="#">My Questions</a>
						<a class="dropdown-item" href="#">Log Out</a>
					  </div>
					  </li>   
				  </ul>
			</div>
	  </div>
	</nav>
	
	<script>
	    function reply_click(event)
	  {
	       var target = event.target || event.srcElement;
		   var str = target.innerHTML;
		   var ques = str.substr(str.indexOf(' ')+1);

	    alert ( ques )
	      location.replace(`http://localhost:80/infelearn/fetching/shreyansh/query.php?	ques=${ques}`)
	  }

	</script>

	<!-- search box -->

	<div class="search-box">
  		<input type="text" placeholder=" "/><span></span>
	</div>
	<span style="font-size:1.5rem;margin-top: 20px;margin-left: 20px">Click Me</span>

	<script  src="../jagrati searchbar/script.js"></script>

	<!-- end search box -->

    <div class="cont">

            <?php
            $i = 0;
            foreach($items as $row){
                $title = $row->get_title();
                $description = $row->get_description();
                $category = $row->get_category();
                $email = $row->get_email();
                $created_at = $row->get_created_at();
                $i++;
            ?>
			
			<div class="question1" onClick='reply_click(event)'>
				<div class="main_question">
                    <?php
                  echo '<span class = "question">Q-'.$i." ".$title.'</span>';
                    ?>
					<span class="title">
                    <?php
                  echo $category;
                    ?>
                    </span>
				</div>
				<span class="name">
                    <?php
                  echo '- '.$email;
              ?>
				</span>
				
				<span class="date">
                <?php
					$string = $created_at;
					$data   = preg_split('/\s+/', $string);
                  echo ''.$data[0];
              ?>
                </span>

                </div>
				
			</div>

                <?php 
                }
            ?>
		
	</div>

</body>

</html>