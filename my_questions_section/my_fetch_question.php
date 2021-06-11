<?php

    include('../database/db.php');
    include('../models/model.php');

	session_start();

    $current_email = $_SESSION["email"];
    $query_login = "SELECT * FROM student_login WHERE email ='".$current_email."'";
    $result_login = $link->query($query_login) or die($link->error);

	if(!isset($_SESSION['loggedin'])) {
		header("Location: ../index.php");
	}

    while($row = $result_login->fetch_assoc()){
        $image_profile = $row["photo"];
        $name = $row["name"];
    }

	// if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
	// 	header("location: ../index.php");
	// 	exit;
	// }

    $query="select * from questions where name = '$name' ";
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

    <!-- end navigation -->

    <!-- search box -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

    <link rel="stylesheet" href="../styles/searchBox.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../styles/fetch_question.css?v=<?php echo time(); ?>">

</head>

<body>

    <!-- search box -->

    <div class="search_div">
        <div class="search-box">
            <input type="text" placeholder=" " id="myinput" onkeyup="search()" /><span></span>
        </div>
        <span style="font-size:1.5rem;margin-top: 20px;margin-left: 20px">Click Me</span>
    </div>

    <script src="../javascript/script.js"></script>

    <!-- end search box -->

    <div class="cont" id="ul">

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

        <div class=" main_question_div">
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
                `http://localhost:80/merge/my_questions_section/question_with_answer_my_question.php?	ques=${ques}`
            )

            console.log(data[0]);
        });
    });

    function myFunction() {
        var input, filter, ul, li, a, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        ul = document.getElementById("myUL");
        li = ul.getElementsByTagName("li");
        for (i = 0; i < li.length; i++) {
            a = li[i].getElementsByTagName("a")[0];
            txtValue = a.textContent || a.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";
            }
        }
    }

    function search() {
        let input = document.getElementById('myinput').value
        input = input.toLowerCase();
        let x = document.getElementsByClassName('main_question_div');

        for (i = 0; i < x.length; i++) {
            if (!x[i].innerHTML.toLowerCase().includes(input)) {
                x[i].style.display = "none";
            } else {
                x[i].style.display = "block";
            }
        }
    }
    </script>
    </div>

</body>

</html>