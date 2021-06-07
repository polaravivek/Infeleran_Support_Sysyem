<?php

$question = htmlspecialchars($_GET["ques"]);

    session_start();
    
    if(!isset($_SESSION['loggedin'])) {
		header("Location: ../index.php");
    }
    
    include('../models/answer.php');
    include('../database/db.php'); 
    // $questionWith = mysqli_real_escape_string($link,$question);

    $queryQuestion ="select * from questions where title = '$question'";
    $resultQuestion = $link->query($queryQuestion) or die($link->error);
    
    $current_email = $_SESSION["email"];
    $query_login = "SELECT * FROM student_login WHERE email ='".$current_email."'";
    $result_login = $link->query($query_login) or die($link->error);

    while($row = $result_login->fetch_assoc()){
        $image_profile = $row["photo"];
    }
    
    while($row = $resultQuestion->fetch_assoc()) {

        $title = $row['title'];
        $name = $row['name'];
        $category = $row['category'];
        $created_at = $row['created_at'];
        $description = $row['description'];
        $image = $row['document'];
    }

    $query="select * from solved where title = '$title'";
    $result = $link->query($query) or die($link->error);

    $items = array();
    while($row = $result->fetch_assoc()) {
        $item = new Answers($row['question_name'],$row['answer_name'],$row['title'],$row['answer'],$row['answered_document'],$row['liked'],$row['verified'],$row['created_at']);

        $items[] = $item;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>question and answers</title>
    <link rel="stylesheet" href="../styles/question_with_answer.css?v=<?php echo time(); ?>">

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
                <li class="nav-item justify-content-center w-30">
                    <a class="nav-link " href="../unsolved_section/fetch_questions.php"><b>Unsolved</b></a>
                </li>
                <div style="width:30px"></div>
                <li class="nav-item active w-30">
                    <a class="nav-link" href="../solved_section/solved.php"><b>Solved</b></a>
                </li>
                <div style="width:30px"></div>
                <li class="nav-item w-30">
                    <a class="nav-link" href="../ask_section/main_ask.php"><b>Ask</b></a>
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

    <!--end navigation bar -->

    <div class="cont">

        <div class="main_question_div">
            <div class="main_question">
                <span id="question">
                    <?php echo $title
                        ?>
                </span>
                <span id="category">
                    <?php echo $category
                        ?>
                </span>
            </div>
            <div class="sub_details">
                <span id="name">
                    <?php echo '-'.$name
                        ?>
                </span>

                <span id="date">
                    <?php
				    $string = $created_at;
				    $data   = preg_split('/\s+/', $string);
				    		  echo ''.$data[0];
			        ?>
                </span>
            </div>

        </div>

        <div class="description">

            <h2 style="margin: 60px 40px 5px 60px">Description</h2>

            <div class="description_with_document">

                <?php
                        echo $description;
                    ?>

                <div class="document_img">
                    <?php
                            echo '<img src="data:image;base64,'.base64_encode($image).'">';
                        ?>
                </div>
            </div>


            <div class=" button_post_answer" style="background-color:rgb(255, 130, 130)">

                <a class="post_text" style="color:white;    font-weight:bold;align:center">
                    Post Answer
                </a>

            </div>
        </div>
    </div>

    <!-- question part -->

    <div class="main_border">

        <?php
            
            if(count($items) == 0){
                echo "
                    <div style='font-size: 20px;
                    text-align:center;width:80%;padding:40px;background-color:#212838; color:white; margin: auto;'>
                    No answer available
                </div>
            ";
        }else{
            foreach($items as $row){
                $name = $row->get_answer_name();
                $answer = $row->get_answer();
                $answer_image = $row->get_answered_document();
                $verified = $row->get_verified();
        ?>

        <div class="list_box">
            <?php
            if($verified == '1'){
                echo '<div class="answer_user_details" style="background-color: green;">
                <p class="answer_user_text" style="color:white;">'.$name.'</p>
        </div>';
        }else{
            echo '<div class="answer_user_details" style="color:#929292">
                <p class="answer_user_text">'.$name.'</p>
        </div>';
        }
        ?>

            <h2 style="margin: 40px 40px 5px 100px">Answer</h2>

            <div class="description_with_doc">

                <?php
                    echo $answer;
                ?>

                <div class="document_img">
                    <?php
                        if($answer_image != null){
                            echo '<img src="data:image;base64,'.base64_encode($answer_image).'">';
                        }
                    ?>
                </div>

            </div>
        </div>
        <?php
            }
        ?>
        <?php
            }
        ?>

    </div>

    <script src=" https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
    </script>

    <script>
    function myTrim(x) {
        return x.replace(/^\s+|\s+$/gm, '');
    }

    $(document).ready(function() {

        $('.button_post_answer').on('click', function() {

            var str = $('#question').text();
            var question = myTrim(str);

            location.replace(
                `http://localhost:80/merge/unsolved_answer_input/unsolved_ask.php? ques=${question}`
            )

        });
    });
    </script>

</body>

</html>