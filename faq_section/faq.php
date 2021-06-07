<?php
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

    <link rel="stylesheet" href="../styles/faq.css?v=<?php echo time(); ?>">

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
                <li class="nav-item w-30">
                    <a class="nav-link" href="../ask_section/main_ask.php"><b>Ask</b></a>
                </li>
                <div style="width:30px"></div>
                <li class="nav-item selected">
                    <a class="nav-link" href="../faq_section/faq.html"><b>Support</b></a>
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


    <main class="wrapper">
        <div class="image__wrapper">
            <div class="image__wrapper_inner">

            </div>
            <img class="box" src="../svg_files/illustration-box-desktop.svg" alt="box">
        </div>

        <div class="accordion__wrapper">
            <h1 class="title__accordion">FAQ</h1>

            <div class="container">

                <input type="text" onkeyup="filter()" placeholder="Search.." id="search">

                <ul id="menu">
                    <li>
                        <div class="questions__accordions">
                            <div class="question-answer__accordion">
                                <div class="question">
                                    <h3 class="title__question">
                                        <a href="#" style="text-decoration: none; color:white">Infelearn classes
                                            program
                                            is available for which classes ?</a>
                                    </h3>
                                    <img src="../svg_files/icon-arrow-down.svg">
                                </div>
                                <div class="answer">
                                    Students across classes 4 to 10 can attend and learn from Infelearn clesses.
                                </div>
                            </div>
                    </li>
                    <li>
                        <div class="question-answer__accordion">
                            <div class="question">
                                <h3 class="title__question">
                                    <a href="#" style="text-decoration: none; color:white">How many classes will be
                                        there in a week?</a>
                                </h3>
                                <img src="../svg_files/icon-arrow-down.svg">
                            </div>
                            <div class="answer ">
                                There will be 3-4 classes per week.
                            </div>
                        </div>
                    </li>

                    <li>
                        <div class="question-answer__accordion">
                            <div class="question">
                                <h3 class="title__question">
                                    <a href="#" style="text-decoration: none; color:white"> Do you give lesson notes
                                        and
                                        homework?</a>
                                </h3>
                                <img src="../svg_files/icon-arrow-down.svg">
                            </div>
                            <div class="answer ">
                                Yes, homework will be provided after every class. Your child can submit their
                                Infelearn's Classes homework on our platform to get the teacher's feedback.
                                Additionally, your child can also access engaging video lessons and practice tests
                                on
                                the Infelearn'S app to revise and practice anytime anywhere.
                            </div>
                        </div>
                    </li>

                    <li>
                        <div class="question-answer__accordion">
                            <div class="question">
                                <h3 class="title__question">
                                    <a href="#" style="text-decoration: none; color:white">How can my child clear
                                        his/her doubts instantly during the online class?</a>
                                </h3>
                                <img src="../svg_files/icon-arrow-down.svg">
                            </div>
                            <div class="answer ">
                                There was this doubts sloving section in our Infelearn app or website . Where any
                                student can ask the question and also any student can slove the question.
                            </div>
                        </div>
                    </li>

                    <li>
                        <div class="question-answer__accordion">
                            <div class="question">
                                <h3 class="title__question">
                                    <a href="#" style="text-decoration: none; color:white"> Do you provide
                                        additional
                                        support?</a>
                                </h3>
                                <img src="../svg_files/icon-arrow-down.svg">
                            </div>
                            <div class="answer ">
                                Chat and email support is available 24/7. Phone lines are open during normal
                                business
                                hours.
                            </div>
                        </div>
                    </li>

                    <li>
                        <div class="question-answer__accordion">
                            <div class="question">
                                <h3 class="title__question">
                                    <a href="#" style="text-decoration: none; color:white">Where can I track my
                                        child's
                                        progress?</a>
                                </h3>
                                <img src="../svg_files/icon-arrow-down.svg">
                            </div>
                            <div class="answer ">
                                Mentors will be in touch with you regularly to discuss your child's progress.
                                Monthly PTA meetings will also be conducted and a comprehensive progress report will
                                be
                                shared with you, to help you be a part of their learning journey.
                            </div>
                        </div>
            </div>
            </li>

            </ul>
        </div>
        </div>
    </main>


    <script>
    function filter() {

        var filterValue, input, ul, li, a, i;
        input = document.getElementById("search");
        filterValue = input.value.toUpperCase();
        ul = document.getElementById("menu");
        li = ul.getElementsByTagName("li");

        for (i = 0; i < li.length; i++) {
            a = li[i].getElementsByTagName("a")[0];
            if (a.innerHTML.toUpperCase().indexOf(filterValue) > -1) {
                li[i].style.display = "";

            } else {
                li[i].style.display = "none";
            }
        }
    }
    this.addEventListener("DOMContentLoaded", () => {
        const questions = document.querySelectorAll(".question")
        questions.forEach((question) => question.addEventListener("click", () => {

            if (question.parentNode.classList.contains("active")) {
                question.parentNode.classList.toggle("active")
            } else {
                questions.forEach(question => question.parentNode.classList.remove("active"))
                question.parentNode.classList.add("active")
            }

        }))
    })
    </script>
</body>

</html>