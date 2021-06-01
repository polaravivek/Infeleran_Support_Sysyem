<?php

    include_once '../database/db.php';
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
<html>
    <head>
        <title>Navigation Bar</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initaial-scale=1.0">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;1,200&display=swap');
        
*{
    margin:0px;
    padding: 0px;
    box-sizing:border-box ;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
		background-color: #3c4053;
}

nav{
    width: 100%;
    z-index: 1;
}

nav span img{
    margin: 30px 0px 0px 30px;
    padding: 10px;
    height: 60px;
    width: 150px;
    background-color: #f9f9f9;
    
}

.container{  
    text-align: center;
    
}

nav ul li{
    display: inline-flex;
    list-style: none;
    
}

nav ul li a{
    color: white;
    text-decoration: none;
    font-size: 16px;
    font-weight: 600;
    padding: 0px 40px;
}

nav ul li a:hover{
    color: #0898e7;
}

nav ul li .active{
    color: #39424d;
}

#icon{
    float: right;
    margin: 30px 0px 0px 30px;
}

.navbar a {
  float: left;
  font-size: 16px;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

.dropdown {
  float: right;
  overflow: hidden;
}

.dropdown .dropbtn {
  cursor: pointer;
  font-size: 16px;  
  border: none;
  outline: none;
  padding: 14px 16px;
  color: black;
  background-color: inherit;
  font-family: inherit;
  margin-right: 45px;
  margin-top: 30px;
}

.navbar a:hover, .dropdown:hover .dropbtn, .dropbtn:focus {
  background-color: #212838;
}

.material-icons{
  color: white;
}

.dropdown-content {
  display: none;
  position: relative;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 8px 0px rgba(0,0,0,0.2);
}

.dropdown-content a {
  float: none;
  color: white;
  padding: 12px 12px;
  text-decoration: none;
  display: block;
  text-align: left;
  box-sizing: inherit;
}

.dropdown-content a:hover {
  background-color: #212838;
}

.show {
  display: block;
}

.question1{
			width: 80rem;
			height: 10rem;
			border-radius: 8px;
			background-size: cover;
			background-color: #212838;
			box-shadow: .5rem 2px .5rem rgba(0, 0, 0, 0.1);
			border: 2px solid grey;
			margin: 2rem;
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
			margin-left: 30px;
			color: #ffffff;
      background-color: #212838;
			padding: 20px;
		}
		.name{
			font-family: cursive;
			font-size: 20px;
			font-weight: 200;
			margin-bottom: 10px;
			margin-left: 50px;
			color: grey;
      background-color: #212838;
			padding: 20px;
		}
		.title{
			float: right;
			margin-right: 30px;
      background-color: #212838;
		}

		.date{
			float: right;
			margin-right: 50px;
			color: grey;
			padding: 15px;
      background-color: #212838;

		}

    .question{
      background-color: #212838;
    }
</style>

    </head>
    <body>
      
        <nav>
            <span class="logo">
                <img src="../images/logo.png">
                <span class="navbar">
  <span class="dropdown">
  <button class="dropbtn" onclick="myFunction()">
    <i class="material-icons icons" style ="font-size:48px">person</i>
  </button>
  <span class="dropdown-content" id="myDropdown">
    <a>Profile</a>
    <a>My Questions</a>
    <a>Logout</a>
  </span>
</span> 
</span>
<script>

/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */


function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(e) {
  console.log(e.target);
  if (!e.target.matches('.dropbtn') && !e.target.matches('.icons')) {
    console.log('true')
  var myDropdown = document.getElementById("myDropdown");
    if (myDropdown.classList.contains('show')) {
      myDropdown.classList.remove('show');
    }
  }
}

</script>
  </div>
            </span>
                
            <div class="container">
            <ul>
                <li><a href="">Unsolved</a></li>
                <li><a href="">Solved</a></li>
                <li><a href="../ask_section/ask.php">Ask</a></li>
                <li><a href="">Support</a></li>
            </ul>
        </div>
        </nav>
        <div class="container1">
          <div class="content">

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
                     echo '-'.$email;
                    ?>
				            </span>
				
			            	<span class="date">
                    <?php
                     echo ''.$created_at;
                     ?>
                     </span>

                    </div>
				
			              </div>

                    <?php 
                     }
                    ?>
          </div>
          
        </div>
    </body>
</html>