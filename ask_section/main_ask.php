<?php

    include_once '../database/db.php';
    session_start();
    if(!isset($_SESSION['loggedin'])) {
		header("Location: ../index.php");
    }

    $current_email = $_SESSION["email"];
    $query_login = "SELECT * FROM student_login WHERE email ='".$current_email."'";
    $result_login = $link->query($query_login) or die($link->error);

    while($row = $result_login->fetch_assoc()){
        $image_profile = $row["photo"];
    }

    $query="SELECT * FROM student_login where email='".$_SESSION["email"]."'";
    $result = $link->query($query) or die($link->error);
    if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {

            $name=$row["name"];

        }
    } else {
      echo "0 results";
    }

    #setting validation error array
    $errors = array();
    #checking if form was submitted
    if (isset($_POST["submit"])) {

          $title=mysqli_real_escape_string($link, $_POST["title"]);
          $category=mysqli_real_escape_string($link, $_POST["category"]);

          $description=mysqli_real_escape_string($link, $_POST["description"]);

          $image = $_FILES['photo']['name'];
          $images = addslashes(file_get_contents($_FILES["photo"]["tmp_name"]));
        if (count($errors)== 0) {

          $query = "INSERT INTO questions(name, title,category, description, document,unsolved) VALUES ('$name','$title', '$category','$description', '$images','1')";

        if (mysqli_query($link, $query)) {

        	  header('Location: ../unsolved_section/fetch_questions.php');

          } else{
              array_push($errors, "Data inserting failed try again");
          }
          }
      }
 ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- navigation bar -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- end navigation -->
	<title>Document</title>
	 <style type="text/css">
    .li1 {
        color: coral;
        margin-top: 20px;
        font-size: 25px;
        text-align: center;
    }

    .active a {
        color: rgb(255, 130, 130) !important;
    }

    .form {
        border: 0cm;
        margin: 40px auto;
        width: 60%;
        border-color: black 2px;
        background-color: #212838;
        padding: 20px;
        border-radius: 5px;
        font-size: 16px;

    }

    .form1 {
        margin-left: 20px;
        margin-top: 20px;
        color: white;
    }

    .input {
        width: 25%;

        padding: 12px 20px;
        margin: 8px 0;
        color: black;
        display: inline-block;
        border-radius: 4px;
        box-sizing: border-box;
        text-align: center;
    }

    .c1 {
        color: black;
        margin-left: 150px;
        width: 15%;
        padding: 4px 4px;
        box-sizing: border-box;
		
        text-align: center;
    }

    .textarea {
        width: 100%;
        height: 150px;
        color: black;
        padding: 12px 20px;
        box-sizing: border-box;
        border-radius: 4px;
        background-color: #f8f8f8;
        font-size: 16px;
        resize: none;
    }

    .submit {
        margin-left: 2000px;
        text-align: center;
        background-color: rgb(255, 130, 130);
        box-shadow: 2px 2px 2px rgb(8, 8, 8);
        color: white;
        border: none;
        padding: 8px 24px;
        text-decoration: none;
        margin: 4px 300px;
        border-radius: 25px;
        cursor: pointer;
    }

    .submit:hover:before {
        transform: scale(1.1);
    }

    .submit:hover {
        background-color: rgb(255, 145, 145);
    }

@media screen and (max-width: 600px) {

.form {
	margin-left:90px;
	width:400px;
	}


}
.form1 {
        margin-left: 20px;
        margin-top: 20px;
        color: white;
}

.input{
	width:200px;
	padding: 8px 20px;
}
.c1 {
        color: black;
        margin-left: 5px;
        width: 150px;
        padding: 4px 10px;
        box-sizing: border-box;
        text-align: center
	}
	
  .submit {
    
    margin-top: 10px;
	margin-left:-2px;

  }
}
    </style>

    

</head>

<body>

    <!-- navigation bar -->
    <nav class="navbar navbar-light navbar-expand-md bg-faded justify-content-center">
        <a href="/" class="navbar-brand d-flex mr-auto"><img src="../images/logo.png"
                style="width: 130px;height:50px;background-color: #fff;	"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsingNavbar3">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse w-50" id="collapsingNavbar3">
            <ul class="navbar-nav w-100 justify-content-center">
                <li class="nav-item justify-content-center w-30">
                    <a class="nav-link " href="../unsolved_section/fetch_questions.php"><b>Unsolved</b></a>
                </li>
                <div style="width:30px"></div>
                <li class="nav-item w-30">
                    <a class="nav-link" href="../solved_section/solved.php"><b>Solved</b></a>
                </li>
                <div style="width:30px"></div>
                <li class="nav-item w-30 active">
                    <a class="nav-link" href="../ask_section/ask.php"><b>Ask</b></a>
                </li>
                <div style="width:30px"></div>
                <li class="nav-item">
                    <a class="nav-link" href="../faq_section/faq.php"><b>Support</b></a>
                </li>
            </ul>
            <div class="btn-group dropleft">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php
                                if($image_profile == null){
                                    echo '<img src="../images/profile_pic_default.jpg" width="50" height="50" class="rounded-circle"
                                style="border-color: black;box-shadow: 3px 3px 3px rgb(87, 87, 87); margin-top: 5px ; margin-right: 20px">';
                                }else{
                                    echo '<img src="data:image;base64,'.base64_encode($image_profile).'" width="50" height="50" class="rounded-circle"
                                style="border-color: black;box-shadow: 3px 3px 3px rgb(87, 87, 87); margin-top: 5px ; margin-right: 20px">';
                                }
                            ?>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right"
                            style="border-color: black;box-shadow: 2px 2px 2px rgb(87, 87, 87); margin-top: 5px ; margin-right: 20px">
                            <a class="dropdown-item" href="../profile_dropdown/profile.php">Profile</a>
                            <a class="dropdown-item" href="#">My Questions</a>
                            <a class="dropdown-item" href="../logout_section/logout.php">Log Out</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <br>
    <form action="" method="POST" enctype="multipart/form-data" class="form">
        <div class="form1">
            <label for="titile">Title</label><br>
            <input type="text" class="input" name="title" placeholder="Enter the title">
            <select class="c1" name="category">
                <option value="">category</option>
                <option>Coding</option>
                <option>Social</option>
                <option>Science</option>
                <option>English</option>
            </select><br>
            <label for="description">Discription</label><br>
            <textarea class="textarea" name="description" id="" cols="30" rows="10"
                placeholder="Enter the description"></textarea>
            <p>Add other document</p>
            <input type="file" class="input-form" name="photo"><br>

            <input class="submit" name="submit" type="submit" value="submit">
        </div>
    </form>
    <br>
</body>

</html>
