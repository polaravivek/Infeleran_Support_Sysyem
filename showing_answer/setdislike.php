<?php
    include('../database/db.php');


if(isset($_POST['id']) && $_POST['id']>0) {
    $id=mysqli_real_escape_string($link, $_POST['id']);
    $question = $_POST['question'];
    $name = $_POST['name'];
    if(isset($_COOKIE['verified'.$id])) {
        setcookie('verified'.$id, "yes", 1);
         $sql = "update solved set verified = 'no' where id='$id'";
         $sql2 = "update questions set solved = solved-1 WHERE name ='$name' AND title = '$question'";
         $sql3 = "update questions set unsolved = unsolved+1 WHERE name ='$name' AND title = '$question'";
        $op = "unlike";
    }
    else
    {
        setcookie('verified'.$id, "no", time()+60*600*24*5);
         $sql = "update solved set verified = 'yes' where id='$id'";
         $sql2 = "update questions set solved = solved+1 WHERE name ='$name' AND title = '$question'";
         $sql3 = "update questions set unsolved = unsolved-1 WHERE name ='$name' AND title = '$question'";
        $op = "like";
    }
    
    mysqli_query($link, $sql2);
    mysqli_query($link, $sql3);
    mysqli_query($link, $sql);
    
    
    $row=mysqli_fetch_assoc(mysqli_query($link, "select * from solved where id='$id'"));
    
    echo json_encode([
        'op'=>$op,
        'like_count'=>$row['liked']
    ]);
}

?>