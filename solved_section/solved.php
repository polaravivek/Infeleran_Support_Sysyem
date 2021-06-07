<?php

    include('../database/db.php');
    include('../models/model.php');

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

	// if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
	// 	header("location: ../index.php");
	// 	exit;
	// }

    $query="select * from questions where solved = 1";
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

    <!-- search box -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

    <link rel="stylesheet" href="../styles/searchBox.css?v=<?php echo time(); ?>">

    <!-- end search box -->

    <style>
    html {
        margin: 0px;
        padding: 0px transition: 3s ease all;
    }

    .main_question_div {
        width: 90%;
        height: 170px;
        border-radius: 8px;
        background-size: cover;
        background-color: #212838;
        box-shadow: .5rem 2px .5rem rgba(0, 0, 0, 0.1);
        border: 2px solid grey;
        margin: 20px auto;
        cursor: pointer
    }

    .main_question_div:hover:before {
        transform: scale(1.1);
        box-shadow: 0 0 15px #ffee10;
    }

    .main_question_div:hover {
        color: #ffee10;
        box-shadow: 0 0 5px #ffee10;
    }

    .main_question {
        font-family: cursive;
        font-size: 25px;
        font-weight: 400;
        margin-top: 20px;
        margin-left: 20px;
        color: #ffffff;
        padding: 20px;
    }

    .sub_details {
        font-family: cursive;
        font-weight: 400;
        margin-left: 20px;
        color: #ffffff;
    }

    #name {
        font-family: cursive;
        font-size: 20px;
        font-weight: 200;
        margin-bottom: 10px;
        margin-left: 50px;
        color: grey;
        padding: 20px;
    }

    #category {
        float: right;
        margin-right: 45px;
    }

    #question {
        margin-left: 30px;
    }

    #date {
        color: grey;
        float: right;
        margin-right: 65px;
    }

    .cont {
        margin: auto;
        clear: both;
    }

    .active a {
        color: rgb(255, 130, 130) !important;
    }

    .search_div {
        float: right;
        margin-right: 90px;
        margin-bottom: 20px;
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

    <!-- search box -->

    <div class="search_div">
        <div class="search-box">
            <input type="text" placeholder=" " /><span></span>
        </div>
        <span style="font-size:1.5rem;margin-top: 20px;margin-left: 20px">Click Me</span>
    </div>

    <script src="../javascript/script.js"></script>

    <!-- end search box -->

    <div class="cont">

        <?php
            $i = 0;
			if(count($items) == 0){
                echo "
                    <div style='font-size: 20px;
                    text-align:center;width:80%;padding:40px;background-color:#212838; color:white; margin: auto;'>
                    No answer available
                </div>
            ";
        }else{
            foreach($items as $row){
                $title = $row->get_title();
                $description = $row->get_description();
                $category = $row->get_category();
                $email = $row->get_email();
                $created_at = $row->get_created_at();
                $i++;
            ?>

        <div class="main_question_div">
            <div class="main_question">
                <span id="question">
                    <?php
                  echo 'Q-'.$i." ".$title;
                    ?>
                </span>
                <span id="category">
                    <?php
                  echo $category;
                    ?>
                </span>
            </div>
            <div class="sub_details">
                <span id="name">
                    <?php
					 		echo '- '.$email;
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

    </div>

    <?php 
                }
            	?>
    <?php 
                }
            	?>
    <!-- adding jquery for fetch question by clicking -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
    function myTrim(x) {
        return x.replace(/^\s+|\s+$/gm, '');
    }

    $(document).ready(function() {
        $('.main_question_div').on('click', function() {
            $div = $(this).closest('div');

            var data = $div.children('div').children('span').map(function() {
                return $(this).text();
            }).get();

            console.log(data);
            var str = data[0];
            var user = data[3];
            var trimStr = myTrim(str);

            var ques = trimStr.substr(trimStr.indexOf(' ') + 1);

            // alert ( user );

            location.replace(
                `http://localhost:80/merge/showing_verified_answer/question_with_verified_answer.php?	ques=${ques}`
            )

            console.log(data[0]);
        });
    });
    </script>
    </div>

</body>

</html>