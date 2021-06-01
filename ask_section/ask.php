
<?php

    include_once '../database/db.php';
    session_start();

      $query="SELECT * FROM student_login where email='".$_SESSION["email"]."'";
      $result = $link->query($query) or die($link->error);
      if ($result->num_rows > 0) {
   
    while($row = $result->fetch_assoc()) {

 $name=$row["name"];

    }	} else {
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
        $target =$_FILES['photo']['name'];
          if (count($errors)== 0) {

            move_uploaded_file($_FILES['photo']['tmp_name'], "images/$target");

           
           
            $query = "INSERT INTO questions(name, title,category, description, document,unsolved) VALUES ('$name','$title', '$category','$description', '$image','1')";
          if (mysqli_query($link, $query)) {

               header('Location: unsolved.php');
           
           } else{
                
              array_push($errors, "Data inserting failed try again");
           }
             }
          }
 ?>
 
<html>

<head>
    <title>Infelearn</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style type="text/css">
    *{
    margin: 0;
    padding: 0;
    
}
.header{
    height: 10vh;
    color: black;
    
}
.header1{
    margin-right: 20px;
    font-style: 'sans serif';
    font-size: 45px;
    
}
.li1{
    color: coral;
    margin-top: 20px;
    font-size: 25px;
    text-align: center;
    
}
.form{
    border: 0cm;
    position: absolute;
    top: 20%;
    left: 20%;
    width: 60%;
    border-color: black 2px;
    background-color: #212838;
    box-shadow: .5rem 2px .5rem rgba(0, 0, 0, 0.1);
    margin-left: 20px;
    margin-right: 400px;
    padding: 20px;
    border-radius: 5px;
    font-size: 16px;
    

}
.form1{
    margin-left: 20px;
    margin-top: 20px ;
    color:white;
}
.input{
  width: 25%;

  padding: 12px 20px;
  margin: 8px 0;
  color: black;
  display: inline-block;
  box-shadow:  0 0 15px  #05b2a7;
  border-radius: 4px;
  box-sizing: border-box;
  text-align: center;
}
.c1{
    color: black;
    margin-left: 150px;
    width: 15%;
    padding: 4px 4px;
    box-shadow:  0 0 15px  #05b2a7;
    box-sizing: border-box;
    text-align: center;
}
.textarea{
    width: 100%;
  height: 150px;
  color: black;
  padding: 12px 20px;
  box-sizing: border-box;
 box-shadow:  0 0 15px #05b2a7;
  border-radius: 4px;
  background-color: #f8f8f8;
  font-size: 16px;
  resize: none;
}
.submit{
    margin-left: 2000px;
    text-align: center;
    background-color:grey;
    box-shadow:  0 0 15px #05b2a7;
    color: white;
    border: none;
    padding: 8px 24px;
    text-decoration: none;
    margin: 4px 300px;
    border-radius: 15px;
}
.submit:hover:before{
            transform: scale(1.1);
            box-shadow: 0 0 15px #ffee10;
        }
.submit:hover{
            color: # #05b2a7;
            box-shadow: 0 0 5px #ffee10;

        }
</style>
</head>

<body>                  
 
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
            <textarea class="textarea" name="description" id="" cols="30" rows="10" placeholder="Enter the description"></textarea>
            <p>Add other document</p>
              <input type="file" class="input-form" name="photo"><br>
            
           <input class="submit" name="submit" type="submit" value="submit">
        </div>
    </form> 
    <br>

</body>

</html>




