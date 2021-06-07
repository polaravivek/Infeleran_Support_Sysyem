<?php

$question = htmlspecialchars($_GET["ques"]);

    include('../database/db.php');
    
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


    $queryQuestion ="select * from questions where title = '$question'";
    $resultQuestion = $link->query($queryQuestion) or die($link->error);

    while($row = $resultQuestion->fetch_assoc()) {

        $title = $row['title'];
        $name = $row['name'];
        $category = $row['category'];
        $created_at = $row['created_at'];
        $description = $row['description'];
        $image = $row['document'];
    }

?>

<?php

      $query="SELECT * FROM student_login where email='".$_SESSION["email"]."'";
      $result = $link->query($query) or die($link->error);
      if ($result->num_rows > 0) {
   
        while($row = $result->fetch_assoc()) {

            $ansname=$row["name"];

            }   } else {
            echo "0 results";
            }

      #setting validation error array
      $errors = array();
      #checking if form was submitted
      if (isset($_POST["submit"])) {

            $ansdescription=mysqli_real_escape_string($link, $_POST["description"]);
      
            if($_FILES["photo"]["tmp_name"] != null){
                $image = addslashes(file_get_contents($_FILES["photo"]["tmp_name"]));
            }else{
                $image = "";
            }
            
          if (count($errors)== 0) {
           
            $query = "INSERT INTO solved(answer_name, title,question_name, answer, answered_document) VALUES ('$ansname','$title', '$name','$ansdescription', '$image')";
        
            
          if (mysqli_query($link, $query)) {

               header('Location: ../unsolved_section/fetch_questions.php');
           
           } else{
                
              array_push($errors, "Data inserting failed try again");
           }
             }
          }
 ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>unsloved_ask</title>

    <link rel="stylesheet" type="text/css" href="../styles/unsolved_ask.css?v=<?php echo time(); ?>">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

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

    <div class="container">
        <div class="content">

            <div class="question1">
                <div class="main_question">
                    <?php echo $title
            ?>
                    <span class="title">
                        <?php echo $category
           ?>
                    </span>
                </div>
                <span class="name">
                    <?php echo '-'.$name
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

        <section class="all">
            <div class="all_answer">
                <h3>Description</h3>
                <p>
                    <?php
         echo $description;
        ?>
                </p>
                <h3>Document</h3>
                <div class="document_img">
                    <?php
             echo '<img src="data:image;base64,'. base64_encode($image).'">';
          ?>
                </div>

            </div>
        </section>

        <form action="" class="form" method="post" enctype="multipart/form-data">
            <div class="form1">

                <label for="description">Description</label><br>
                <textarea class="textarea" name="description" id="" cols="30" rows="10"
                    placeholder="Enter the description"></textarea>
                <p>Add other document</p>
                <input type="file" id="myFile" name="photo">
                <input class="submit" value="submit" name="submit" type="Submit">
            </div>
        </form>

    </div>
</body>

</html>