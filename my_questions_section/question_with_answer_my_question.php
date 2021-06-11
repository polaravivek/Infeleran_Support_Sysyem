<?php

$question = htmlspecialchars($_GET["ques"]);

    include('../models/answer.php');
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
    
    $queryVerified="select * from solved where title = '$title' ORDER BY liked DESC";
    $result = $link->query($queryVerified) or die($link->error);

    $items = array();
    while($row = $result->fetch_assoc()) {
        $item = new Answers($row['id'],$row['question_name'],$row['answer_name'],$row['title'],$row['answer'],$row['answered_document'],$row['liked'],$row['verified'],$row['class_id'],$row['created_at']);

        $items[] = $item;
    }

    // $query="select * from solved where title = '$title'";
    // $result = $link->query($query) or die($link->error);

    // $items = array();
    // while($row = $result->fetch_assoc()) {
    //     $item = new Answers($row['id'],$row['question_name'],$row['answer_name'],$row['title'],$row['answer'],$row['answered_document'],$row['liked'],$row['verified'],$row['class_id'],$row['created_at']);

    //     $items[] = $item;
    // }
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>question and answers</title>
    <link rel="stylesheet" href="../styles/question_with_answer.css?v=<?php echo time(); ?>">

    <!-- navigation bar -->

    <!-- end navigation -->

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />


    <style>
    .answer-section {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        margin: 5px;
    }

    .answer-child {
        display: block;
    }

    .answer-childs {
        flex-direction: column;
    }

    input,
    i {
        border-radius: 5px;
        border: none;
        cursor: pointer;
    }

    i {
        color: lime;
    }

    .no {
        box-shadow: 4px 8px 36px -2px rgba(73, 60, 60, 0.75);
        -webkit-box-shadow: 4px 8px 36px -2px rgba(73, 60, 60, 0.75);
        -moz-box-shadow: 4px 8px 36px -2px rgba(73, 60, 60, 0.75);
    }

    .yes {
        background-color: lime;
    }

    .like-section {
        display: flex;
        margin-left: 100px;
        margin-top: 30px;
    }

    .liked {
        margin-right: 5px;
    }
    </style>
</head>

<body>
    <!-- navigation bar -->

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
                        if($image != null){
                            echo '<img src="data:image;base64,'.base64_encode($image).'">';
                        }
                    ?>
                </div>
            </div>

            <div class="button_post_answer" style="background-color:rgb(255, 130, 130)">

                <a class="post_text" style="color:white; font-weight:bold;align:center">
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
								$id = $row->get_id();
								$class_id = $row->get_class_id();
								$liked = $row->get_liked();
								$verified = $row->get_verified();
							?>

        <div class="list_box" id='post<?php echo $id ?>'>
            <div class="answer_user_details">
                <p class="answer_user_text"><?php echo $name ?></p>
            </div>

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
            <div class='like-section'>
                <h3 class='liked' id='liked'> <?php echo $liked ; ?> </h3>
                <i class='<?php echo $class_id?> fa-thumbs-up fa-2x' id='like_<?php echo $id ?>' onclick='go("<?php echo $id;
      $aa = $id?>")'></i>
            </div>
            <div class='answer-childs' id='answer-childs'>

                <input type='submit' class='<?php echo $verified ?>' id='satisfied<?php echo $id ?>' name='satisfied'
                    value='Satisfied' onclick='goo("<?php echo $id ?>")'>
                <input type="hidden" id="verified<?php echo $id ?>" value="<?php echo $verified ?>">
                <span class='span' id='span'></span>
            </div>
        </div>
        <?php
            }
        ?>
        <?php
            }
        ?>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <script>
    $(document).ready(function() {
        $('.satisfied').on('click', function() {
            $div = $(this).closest('div');

            var data2 = $div.children('div').children('span').map(function() {
                return $(this).text();
            }).get();

            console.log(data2);
        });
    });

    function myTrim(x) {
        return x.replace(/^\s+|\s+$/gm, '');
    }

    const question = document.getElementById('question').innerHTML;
    const name = document.getElementById('name').innerHTML;
    var questionWithoutSpace = myTrim(question);
    var nameWithoutHyphon = myTrim(name).slice(1);

    let a;
    let que;
    let nam;

    function go(id) {
        a = id;

        jQuery.ajax({
            url: 'setlike.php',
            type: 'post',
            data: {
                'id': id,
            },
            success: function(result) {
                result = jQuery.parseJSON(result);

                if (result.op == 'like') {
                    jQuery('#like_' + id).removeClass('far');
                    jQuery('#like_' + id).addClass('fas');
                } else if (result.op == 'unlike') {
                    jQuery('#like_' + id).addClass('far');
                    jQuery('#like_' + id).removeClass('fas');
                }
                jQuery('#post' + id + ' #liked').html(result.like_count);
            }
        })
    }

    function goo(id) {
        que = questionWithoutSpace;
        nam = nameWithoutHyphon;
        jQuery.ajax({
            url: 'setdislike.php',
            type: 'post',
            data: {
                'id': id,
                'question': que,
                'name': nam,
            },
            success: function(result) {
                result = jQuery.parseJSON(result);
                if (result.op == 'like') {
                    jQuery('#satisfied' + id).addClass('yes');
                } else if (result.op == 'unlike') {
                    jQuery('#satisfied' + id).removeClass('yes');
                }
            }
        })
    }

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