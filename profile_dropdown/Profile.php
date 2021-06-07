<?php

 include_once '../database/db.php';
 session_start();

      #setting validation error array
      $current_email = $_SESSION["email"];
      $query_login = "SELECT * FROM student_login WHERE email ='".$current_email."'";
      $result_login = $link->query($query_login) or die($link->error);

      while($row = $result_login->fetch_assoc()){
          $username = $row["name"];
          $email = $row["email"];
          $phone = $row["phone"];
          $image_profile = $row["photo"];
      }

      $errors = array();
      #checking if form was submitted
      if (isset($_POST["submit"])) {
            $name=mysqli_real_escape_string($link, $_POST["name"]);
            $email=mysqli_real_escape_string($link, $_POST["email"]);

            $phone=mysqli_real_escape_string($link, $_POST["phone"]);
      
        $image = $_FILES['photo']['name'];
        $images = addslashes(file_get_contents($_FILES["photo"]["tmp_name"]));
          if (count($errors)== 0) {

      $query=" UPDATE student_login SET name = '$name', email= '$email', phone='$phone', photo='$images' WHERE email ='".$current_email."' ";

            
          if (mysqli_query($link, $query)) {
            header('Location: Profile.php');

           die();

               header('Location: Profile.php');

           } else{
                
              array_push($errors, "Profile Updating failed try again");
            }
             
             }

          }
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../styles/Profile.css">
</head>

<body>

    <h2 style="text-align: left ">User Profile Card</h2>

    <div class="card">
        <?php
    if($image_profile == null){
      echo '<img src="../images/profile_pic_default.jpg" alt="Profile Picture" style="width:85%;padding:10px">';
    }else{
      echo '<img alt="Profile Picture" style="width:85%;padding:10px" src="data:image;base64,'.base64_encode($image_profile).'">';
    }
  ?>
        <h1>
            <?php
      echo $username;
    ?>
        </h1>
        <p class="title">
            <?php
      echo $phone;
    ?>
        </p>
        <p class="Email">
            <?php
      echo $email;
    ?>
        </p>
        <div style="margin: 24px 0;">
            <button class="contact-link" onclick="openForm()">Edit</button>
            <div class="form-popup" id="myForm">
                <form action=" " enctype="multipart/form-data" class="form-container" method="POST">
                    <label for="username"><b>Name</b></label>
                    <input type="text" placeholder="Enter Username" name="name" required>

                    <label for="email"><b>Email</b></label>
                    <input type="text" placeholder="Enter Password" name="email" required>
                    <label for="phone-number"><b>Phone No</b></label>
                    <input type="text" placeholder="Enter Number" name="phone" required>

                    <label for="phone-number"><b>Image</b></label>
                    <input type="file" placeholder=" " name="photo" required><br><br>

                    <button type="submit" value="submit" name="submit" class="btn">Save</button>
                    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
                </form>
            </div>
        </div>
        <script>
        function openForm() {
            document.getElementById("myForm").style.display = "block";
        }

        function closeForm() {
            document.getElementById("myForm").style.display = "none";
        }
        </script>
</body>

</html>