<?php
    include('../database/db.php');


if(isset($_POST['id']) && $_POST['id']>0) {
    $id=mysqli_real_escape_string($link, $_POST['id']);
    if(isset($_COOKIE['verified'.$id])) {
        setcookie('verified'.$id, "yes", 1);
         $sql = "update answer set verifed = 'no' where id='$id'";
        $op = "unlike";
    }
    else
    {
        setcookie('verified'.$id, "no", time()+60*600*24*5);
         $sql = "update answer set verifed = 'yes' where id='$id'";
        $op = "like";
    }
    
    
    mysqli_query($link, $sql);
    
    $row=mysqli_fetch_assoc(mysqli_query($link, "select * from answer where id='$id'"));
    
    echo json_encode([
        'op'=>$op,
        'like_count'=>$row['liked']
    ]);
}

?>